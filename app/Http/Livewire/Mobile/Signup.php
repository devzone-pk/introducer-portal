<?php

namespace App\Http\Livewire\Mobile;


use App\Mail\RegisterDone;
use App\Models\Agent;
use App\Models\Country\Country;
use App\Models\Customer\Customer;
use App\Models\Customer\CustomerDetail;
use App\Models\Notifications\PushNotificationChannel;
use App\Models\Notifications\PushNotificationDetail;
use App\Models\User\Leeds;
use App\Models\User\PasswordReset;
use App\Models\User\User;
use App\Models\User\UserToken;
use App\Traits\Modals\ReceivingCountries;
use App\Traits\Modals\SendingCountries;
use Exception;
use ExpoSDK\Expo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Validator;
use Livewire\Component;
use Illuminate\Validation\Rules\Password;

class Signup extends Component
{
    use ReceivingCountries, SendingCountries;

    public $receiving_country = [
        'id' => ''
    ];
    public $sending_country = [
        'id' => ''
    ];
    public $email;
    public $first_name;
    public $last_name;
    public $password;
    public $phone_number;
    public $phone_code;
    public $referral_code;
    public $agree = false;
    public $company_id;
    public $success = false;
    public $data = [];
    public $is_signed_up = false;
    public $promotion = false;
    public $unverified_email;
    public $error;
    public $otp;
    public $user_id;
    public $verify_success = false;

    protected $listeners = [
        'emit_sending_country' => 'setPhoneCode',
        'resetErrors' => 'resetErrors'
    ];


    protected function rules()
    {
        return
            [
                'first_name' => ['required'],
                'last_name' => ['required'],
                'email' => ['required', 'email'],
                'password' => ['required', Password::min(8)->mixedCase()->numbers()],
                'phone_number' => ['required', 'string'],
                'sending_country.id' => ['required', 'integer', 'exists:countries,id'],
                'receiving_country.id' => ['required', 'integer', 'exists:countries,id'],
                'company_id' => ['required', 'exists:companies,id'],
                'agree' => 'accepted'
            ];
    }

    protected $messages = [
        'agree.accepted' => 'Please accept Terms & Conditions.',
        'receiving_country.id.required' => 'The Send Money To field is required.',
        'sending_country.id.required' => 'The From field is required.'
    ];

    public function mount($data, $token)
    {

        $this->data = $data;
        $this->data['notification-token'] = $token;
        $country = $this->data['country'] ?? null;
        if (in_array($country, ['GB'])) {
            $num_code = $country;
        } else {
            $num_code = 'GB';
        }

        $this->sending_country = Country::where('iso2', $num_code)->first()->toArray();
        $this->phone_code = $this->sending_country['phonecode'];
        $this->company_id = env('COMPANY_ID');
    }

    public function setPhoneCode()
    {
        if (!empty($this->sending_country)) {
            $this->phone_code = $this->sending_country['phonecode'];
            $this->phone_number = '';
        }
    }

    public function signup()
    {
        $this->success = false;
        $this->email = trim(strtolower($this->email));
        $this->withValidator(function (Validator $validator) {
            if ($validator->fails()) {
                $this->dispatchBrowserEvent('open-modal', ['model' => 'error-dialog']);
            }
        })->validate();
        $request = request()->all();


        try {
            $ip = isset($_SERVER['HTTP_CF_CONNECTING_IP']) ? $_SERVER['HTTP_CF_CONNECTING_IP'] : null;
            $iso2 = $_SERVER['HTTP_CF_IPCOUNTRY'] ?? null;
            if ($this->sending_country['iso2'] != $iso2) {
                $country_name = Country::where('iso2', $iso2)->first();
                throw new Exception('You cannot sign up from ' . optional($country_name)->name);
            }

            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception('The email must be a valid email address.');
            }

            $apiKey = getenv('SENDGRID_API_KEY');
            if (!empty($apiKey)) {
                $sg = new \SendGrid($apiKey);
                $request_body = [
                    "email" => $this->email,
                    "source" => "signup"
                ];
                $response = $sg->client->validations()->email()->post($request_body);
                $result = json_decode($response->body(), true);
                if (!empty($result['result']['verdict'])) {
                    if ($result['result']['verdict'] == 'Invalid') {
                        throw new  Exception('This email does not exist.');
                    }
                } else {
                    throw new  Exception('This email does not exist.');
                }
            }

            DB::beginTransaction();
            $sending_country = Country::find($this->sending_country['id']);
            $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
            $number = $phoneUtil->parse($this->phone_code . $this->phone_number, $sending_country['iso2']);

            $isValid = $phoneUtil->isValidNumber($number);
            if (!$isValid) {
                $this->addError('phone_number', 'Please enter valid phone number.');
                $this->dispatchBrowserEvent('open-modal', ['model' => 'error-dialog']);
                return;
            }


            $main_agent = Agent::where('status', 't')->where('channel', 'on')
                ->where('type', 'ma')->where('company_id', $this->company_id)
                ->where('country_id', $this->sending_country['id'])
                ->whereNull('white_label_id')
                ->get();
            if ($main_agent->isEmpty()) {
                throw new  Exception('This country is not configured for sending money.');
            }


            if (User::where('email', $this->email)->where('company_id', $this->company_id)->exists()) {
                throw new Exception('The email has already been taken.');
            }

            $customer_phone = Customer::where('phone', $this->phone_number)
                ->where('phone_code', $this->phone_code)->pluck('user_id')->toArray();
            if (User::where('id', $customer_phone)->where('company_id', $this->company_id)->exists()) {
                $this->addError('phone', 'The phone number has already been taken.');
                return;
            }

            $main_agent = $main_agent->first()->toArray();
            $user = User::create([
                'name' => $this->first_name . ' ' . $this->last_name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'email_verified_at' => date('Y-m-d H:i:s'),
                'type' => 'on',
                'status' => 't',
                'company_id' => $this->company_id
            ]);

            $this->user_id = $user->id;
            $this->unverified_email = $this->email;

            $customer = Customer::create([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'country_id' => $this->sending_country['id'],
                'type' => 'on',
                'timezone' => $main_agent['timezone'],
                'status' => 't',
                'user_id' => $user->id,
                'user_agent_id' => $main_agent['user_id'],
                'phone' => $this->phone_number,
                'phone_code' => $this->phone_code,
                'send_money_to' => $this->receiving_country['id'],
                'referral_code' => $this->referral_code
            ]);


            $device = \Jenssegers\Agent\Facades\Agent::device();
            $platform =\Jenssegers\Agent\Facades\Agent::platform();
            $browser = \Jenssegers\Agent\Facades\Agent::browser();
            $version = \Jenssegers\Agent\Facades\Agent::version($platform);
            CustomerDetail::create([
                'customer_id' => $customer->id,
                'ip' => $ip,
                'registration_device' => $device,
                'device_details' => $device . ',' .$platform . ' (' .$version . '),' .$browser,
            ]);

            if ($this->promotion) {
                \App\Models\Customer\CustomerPreference::updateOrCreate(
                    [
                        'customer_id' => $customer->id
                    ],
                    [
                        'sms' => true,
                        'phone' => true,
                        'post' => true,
                        'email' => true,
                    ]);
            }


            if (!empty($this->data['notification-token'])) {
                $user_token_id = UserToken::create([
                    'token' => trim($this->data['notification-token'], '"'),
                    'user_id' => $user->id,
                    'status' => 't'
                ])->id;


            }




//            $mail = (new RegisterDone())->onQueue('portal_' . config('app.company_id'));
//            Mail::to($this->email)->queue($mail);

            DB::commit();
            $this->reset(['receiving_country', 'referral_code', 'agree', 'email', 'password', 'phone_number', 'first_name', 'last_name']);
            $this->success = true;
          //  $this->is_signed_up = true;
            $this->dispatchBrowserEvent('open-modal', ['model' => 'signup-success']);
        } catch (Exception $exception) {
            DB::rollBack();
            $this->addError('email', $exception->getMessage());
        }
    }

    public function verify()
    {
        try {
            if (empty($this->otp)) {
                return $this->error = "Please enter valid OTP.";
            }

            $user = User::find($this->user_id);
            if ($user['email'] != $this->unverified_email) {
                throw new Exception('This link has been expired.');
            }
            if (!empty($user['email_verified_at'])) {
                throw new Exception('This email has already verified.');
            }
            if (!PasswordReset::where('email', $this->unverified_email)->where('company_id', config('app.company_id'))
                ->where('2fa_code', $this->otp)->exists()) {
                throw new Exception('Please enter valid OTP.');
            }

            $user->update([
                'email_verified_at' => date('Y-m-d h:i:s')
            ]);

            PasswordReset::where('email', $this->unverified_email)
                ->where('company_id', config('app.company_id'))
                ->where('2fa_code', $this->otp)->delete();

            $this->reset('otp');
            $this->verify_success = true;
            $this->error = null;

        } catch (Exception $exception) {
            $this->addError('verify', $exception->getMessage());
        }
    }

    public function resetErrors()
    {
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.mobile.signup');
    }

    public function updated($name, $value)
    {

        if (!empty($this->data['notification-token'])) {
            Leeds::updateOrCreate([
                'token' => $this->data['notification-token']
            ], [
                'country_id' => $this->sending_country['id'],
                'receiving_id' => $this->receiving_country['id'],
                'company_id' => config('app.company_id'),
                'email' => $this->email,
                'phone' => $this->phone_code . $this->phone_number,
                'promo_code' => $this->referral_code
            ]);


        }
    }
}
