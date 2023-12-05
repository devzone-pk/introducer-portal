<?php

namespace App\Http\Livewire\Mobile\Account;

use App\Models\Country\Country;
use App\Models\Customer\Customer;
use App\Models\Options\Option;
use App\Models\User;
use App\Traits\Modals\Gender;
use App\Traits\Modals\Nationality;
use App\Traits\Modals\Occupation;
use App\Traits\Validation\UserDocumentValidation;
use App\Traits\Validation\UserProfileValidation;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Validator;
use Livewire\Component;

class Profile extends Component
{

    use Nationality, Occupation, Gender, UserProfileValidation, UserDocumentValidation;

    public $first_name;
    public $last_name;
    public $email;
    public $dob;
    public $day;
    public $month;
    public $year;
    public $gender;
    public $phone;
    public $code;
    public $place_of_birth;
    public $success;
    public $customer = [];
    public $nationality = [];
    public $occupation = [];
    public $alert;
    public $country = [];
    public $modal = false;
    public $profile = false;
    public $address = false;
    public $incomplete_profile = false;

    protected $rules = [
        'first_name' => 'required|string|regex:/^[a-zA-Z\s]*$/',
        'last_name' => 'required|string|regex:/^[a-zA-Z\s]*$/',
        'dob' => 'nullable|date|date_format:d-m-Y|before:-17 years',
        'gender' => 'required|string|in:f,m',
        'phone' => 'required|regex:/^[0-9]+$/',
        'code' => 'required|string|regex:/^[0-9+]+$/',
        'nationality.id' => 'required|integer',
        'occupation.id' => 'required|integer',
        'place_of_birth' => 'required|string'
    ];
    protected $validationAttributes = [
        'nationality.id' => 'nationality',
        'occupation.id' => 'occupation'
    ];
    protected $listeners = [
        'resetErrors' => 'resetErrors'
    ];

    protected $messages = [
        'first_name.regex' => 'The first name must only contain letters.',
        'last_name.regex' => 'The last name must only contain letters.',
        'phone.regex'=>'The phone number must contain only digits .'
    ];

    public function mount($modal = false)
    {
        $req = request()->all();
        if (!empty($req['success'])) {
            $this->success = $req['success'];
        }
        $this->modal = $modal;
        $this->customer = Customer::find(session('customer_id'));
        $country = Country::find($this->customer['country_id']);
        $national = Country::find($this->customer['nationality_country_id']);
        $this->nationality = optional($national)->toArray();
        $this->first_name = $this->customer['first_name'];
        $this->last_name = $this->customer['last_name'];
        $this->email = $this->customer['email'];
        $this->dob = $this->customer['dob'];
        $this->place_of_birth = $this->customer['place_of_birth'];
        if (!empty($this->customer['occupation'])) {
            $occupation = Option::find($this->customer['occupation']);
            if (!empty($occupation)) {
                $this->occupation = $occupation->toArray();
            }
        }

        if (!empty($this->dob)) {
            $this->dob = date('d-m-Y', strtotime($this->dob));
            $date = explode('-', $this->dob);
            $this->year = $date[0];
            $this->month = $date[1];
            $this->day = $date[2];
        }

        $this->gender = $this->customer['gender'];
        $this->phone = $this->customer['phone'];
        $this->code = $country['phonecode'];
        $this->country = $country;

        if (!empty($req['incomplete'])) {
            $this->incomplete_profile = true;
        }
    }


    public function profileUpdate()
    {
        $this->success = '';
        $this->withValidator(function (Validator $validator) {
            if ($validator->fails()) {
                $this->dispatchBrowserEvent('close-modal', ['model' => 'error-dialog']);
                $this->dispatchBrowserEvent('open-modal', ['model' => 'error-dialog']);
            }
        })->validate();


        try {
            $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
            $number = $phoneUtil->parse($this->code . $this->phone, $this->country['iso2']);
            $isValid = $phoneUtil->isValidNumber($number);
            if (!$isValid) {

                $this->addError('phone', 'Please enter valid phone number.');
                return;
            }

            $customer_user_ids = Customer::where('id', '!=', session('customer_id'))->where('phone', $this->phone)
                ->where('phone_code', $this->code)->whereNotNull('user_id')->pluck('user_id')->toArray();

            if(!empty($customer_user_ids)){
            if (User::whereIn('id', $customer_user_ids)->where('company_id', env('COMPANY_ID'))->exists()) {
                $this->addError('phone', 'The phone number has already been taken.');
                return;
            }
            }


            $data['phone'] = $this->phone;
            $data['phone_code'] = $this->code;
            if (empty($this->dob)) {
                $this->addError('dob', 'The dob field is required.');
                return;
            }
            $dob = Carbon::createFromFormat('d-m-Y', $this->dob);
            $first_name = preg_replace('/\s+/', ' ', $this->first_name);
            $last_name = preg_replace('/\s+/', ' ', $this->last_name);

            DB::beginTransaction();
            if ($this->customer['is_verified'] == 'f') {
                $data['first_name'] = trim($first_name);
                $data['last_name'] = trim($last_name);
                $data['dob'] = $dob->toDateString();
                $data['gender'] = $this->gender;
                $data['place_of_birth'] = $this->place_of_birth;
                $data['nationality_country_id'] = $this->nationality['id'];
                $data['occupation'] = $this->occupation['id'];
                session()->put('name', $data['first_name'] . ' ' . $data['last_name']);
            }
            Customer::find($this->customer['id'])
                ->update($data);

            $this->customer = Customer::find($this->customer['id']);
            $this->emit('profileDone');
            DB::commit();
            if ($this->incomplete_profile) {

                if (!$this->validateUserAddress($this->customer)) {
                    return $this->redirect('/mobile/address?incomplete=true');
                }


                $doc = $this->validateUserDocuments($this->customer);
                if ($doc['status'] != true) {
                    return $this->redirect('/mobile/document/add?incomplete=true');
                } else {
                    return $this->redirect('/mobile/send/money');
                }
            }
            $this->success = 'Customer profile has been updated.';
            return $this->redirect('/mobile/profile?success=Customer profile has been updated.');
        } catch (Exception $e) {
            DB::rollBack();
            $this->addError('alert', $e->getMessage());
        }
    }

    public function updatedDay($value)
    {
        if ($value < 1 || $value > 31) {
            $this->day = 31;
        } else {
            $this->makeDOB();
        }
    }

    private function makeDOB()
    {
        $this->dob = $this->year . '-' . str_pad($this->month, 2, "0", STR_PAD_LEFT) . '-' . str_pad($this->day, 2, "0", STR_PAD_LEFT);
    }

    public function updatedMonth($value)
    {

        if ($value > 0 && $value <= 12) {
            $this->makeDOB();
        } else {
            $this->month = 12;
        }
    }

    public function updatedYear($value)
    {
        $this->makeDOB();
    }

    public function render()
    {
        return view('livewire.mobile.account.profile');
    }


    public function resetErrors()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
