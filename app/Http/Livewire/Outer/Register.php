<?php

namespace App\Http\Livewire\Outer;

use App\Mail\RegisterDone;
use App\Models\Agent;
use App\Models\AgentReferralCode;
use App\Models\Country\Country;
use App\Models\Customer\Customer;
use App\Models\Customer\CustomerDetail;
use App\Models\FeeFreeTransfer;
use App\Models\User\Leeds;
use App\Models\User\PasswordReset;
use App\Models\User\User;
use App\Models\User\UserToken;
use App\Traits\Modals\ReceivingCountries;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Validator;
use Livewire\Component;

class Register extends Component
{
    use ReceivingCountries;

    public $sending_countries = [];
    public $sending_country;
    public $receiving_country;

    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $phone;
    public $code;
    public $referral_code;
    public $agree = false;
    public $promotion = false;
    public $company_id;
    public $uuid;

    public $show_referral = false;

    protected function rules()
    {
        $rules = [
            'first_name' => ['required', 'string', 'regex:/^[a-zA-Z\s]*$/'],
            'last_name' => ['required', 'string', 'regex:/^[a-zA-Z\s]*$/'],
            'email' => ['required', 'email'],
            'show_referral' => 'nullable|boolean',
            'password' => ['required', Password::min(8)->mixedCase()->numbers()],
            'phone' => 'required|regex:/^[0-9]+$/',
            'sending_country' => ['required', 'integer', 'exists:countries,id'],
            'receiving_country' => ['required', 'integer', 'exists:countries,id'],
            'company_id' => ['required', 'exists:companies,id'],
            'agree' => 'accepted'
        ];

        if (!empty($this->show_referral)) {
            $rules['referral_code'] = 'required|string';
        }

        return $rules;
    }

    protected $messages = [
        'first_name.required' => 'First name field is required.',
        'last_name.required' => 'Last name field is required.',
        'email.required' => 'Email field is required.',
        'email.email' => 'Email must be of a valid email address.',
        'referral_code.required' => 'Referral code is required',
        'sign_up_coupon_code.required' => 'Coupon code is required.',
        'password.required' => 'Password field is required.',
        'receiving_country.required' => 'Sending To field is required.',
        'sending_country.required' => 'Sending From field is required.',
        'phone.required' => 'Mobile Number field is required.',
        'phone.regex' => 'Mobile Number must contain only digits.',
        'agree.accepted' => 'Please agree to the terms and conditions and privacy policy for signing up.',
        'first_name.regex' => 'First name must only contain letters.',
        'last_name.regex' => 'Last name must only contain letters.',
    ];

    public $success;

    public function mount()
    {
        $sending = Country::where('is_on_sending', 't')->get();
        $this->sending_countries = $sending->toArray();
        $uk = $sending->where('iso2', 'GB')->first();
        $this->code = $uk['phonecode'];
        $this->sending_country = $uk['id'];
        $this->company_id = env('COMPANY_ID');

        $this->rcFetchData();
        $this->uuid = Str::uuid()->toString();
        $input = request()->all();
        if (!empty($input['referral'])) {
            $this->referral_code = $input['referral'];
        }

    }

    public function signup()
    {
        $this->success = false;

        $this->validate();
        $request = request()->all();
        try {
            $ip = isset($_SERVER['HTTP_CF_CONNECTING_IP']) ? $_SERVER['HTTP_CF_CONNECTING_IP'] : null;
            $sending_country = Country::find($this->sending_country);
            if (empty(env('LOGIN_FROM_ANYWHERE'))) {
                $iso2 = $_SERVER['HTTP_CF_IPCOUNTRY'] ?? null;
                if ($sending_country['iso2'] != $iso2) {
                    $country_name = Country::where('iso2', $iso2)->first();
                    throw new Exception('You cannot sign up from ' . optional($country_name)->name);
                }
            }


            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception('The email must be a valid email address.');
            }

            $apiKey = getenv('SENDGRID_API_KEY');
            $sg = new \SendGrid($apiKey);

            if (!empty($apiKey) && false) {
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
            $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
            $number = $phoneUtil->parse($this->code . $this->phone, $sending_country['iso2']);

            $isValid = $phoneUtil->isValidNumber($number);
            if (!$isValid) {
                $this->addError('phone', 'Please enter valid phone number.');
                return;
            }


            $main_agent = Agent::where('status', 't')->where('channel', 'on')
                ->where('type', 'ma')->where('company_id', $this->company_id)
                ->whereNull('white_label_id')
                ->where('country_id', $this->sending_country)->get();
            if ($main_agent->isEmpty()) {
                throw new  Exception('This country is not configured for sending money.');
            }

            if (User::where('email', $this->email)->where('company_id', $this->company_id)->exists()) {
                $this->addError('email', 'Email address already exists.');
                return;
            }

            $customer_phone = Customer::where('phone', $this->phone)
                ->where('phone_code', $this->code)->pluck('user_id')->toArray();
            if (User::where('id', $customer_phone)->where('company_id', $this->company_id)->exists()) {
                $this->addError('phone', 'Mobile number already exists.');
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

            $customer = Customer::create([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'country_id' => $this->sending_country,
                'type' => 'on',
                'timezone' => $main_agent['timezone'],
                'status' => 't',
                'user_id' => $user->id,
                'user_agent_id' => $main_agent['user_id'],
                'phone' => $this->phone,
                'phone_code' => $this->code,
                'send_money_to' => $this->receiving_country,
                'referral_code' => $this->referral_code
            ]);

            $referral_code = !empty($this->referral_code) ? $this->referral_code : env('REFERRAL_FEE_FREE','ORIUM');

            $fee_free_policy = AgentReferralCode::where('fee_free_transfers', 't')
                ->where('referral_code', $referral_code)
                ->select('number_of_transaction', 'number_of_days')
                ->first();


            if (!empty($fee_free_policy)) {
                $no_of_trans = $fee_free_policy['number_of_transaction'];
                $no_of_days = $fee_free_policy['number_of_days'];

                FeeFreeTransfer::create([
                    'company_id' => $this->company_id,
                    'customer_id' => $customer->id,
                    'description' => 'You have been selected for special fee free discount.',
                    'percentage' => '100',
                    'fee_free_counter' => $no_of_trans,
                    'start_at' => \Carbon\Carbon::now()->toDateString(),
                    'expire_at' => \Carbon\Carbon::now()->addDays($no_of_days)->toDateString()
                ]);
            }


            $device = \Jenssegers\Agent\Facades\Agent::device();
            $platform = \Jenssegers\Agent\Facades\Agent::platform();
            $browser = \Jenssegers\Agent\Facades\Agent::browser();
            $version = \Jenssegers\Agent\Facades\Agent::version($platform);
            CustomerDetail::create([
                'customer_id' => $customer->id,
                'ip' => $ip,
                'registration_device' => 'Web',
                'device_details' => $device . ',' . $platform . ' (' . $version . '),' . $browser,
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

            DB::commit();
            $this->reset(['receiving_country', 'referral_code', 'show_referral', 'first_name', 'last_name', 'agree', 'email', 'password', 'phone']);
            $this->success = 'Registration Successful! Please login.';
            $this->dispatchBrowserEvent('open-modal', ['model' => 'success-register']);
        } catch (Exception $exception) {
            DB::rollBack();
            $this->addError('email', $exception->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.outer.register');
    }

    public function updatedSendingCountry($value)
    {
        if (!empty($value)) {
            $country = collect($this->sending_countries)->firstWhere('id', $value);
            $this->code = $country['phonecode'];
            $this->phone = '';
        }

    }

    public function updated($name, $value)
    {

        if (!empty($this->uuid)) {
            Leeds::updateOrCreate([
                'token' => $this->uuid
            ], [
                'country_id' => $this->sending_country,
                'receiving_id' => $this->receiving_country ?? null,
                'company_id' => config('app.company_id'),
                'email' => $this->email,
                'phone' => $this->code . $this->phone,
                'promo_code' => $this->referral_code
            ]);


        }
    }
}
