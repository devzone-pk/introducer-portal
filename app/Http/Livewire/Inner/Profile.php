<?php

namespace App\Http\Livewire\Inner;

use App\Models\Country\Country;
use App\Models\Customer\Customer;
use App\Models\Options\Option;
use App\Models\User\User;
use App\Traits\Modals\Nationality;
use App\Traits\Modals\Occupation;
use App\Traits\Modals\SearchCities;
use App\Traits\Validation\UserDocumentValidation;
use DB;
use Livewire\Component;

class Profile extends Component
{
    use Nationality, Occupation, UserDocumentValidation;

    public $edit = false;
    public $customer;
    public $occupation_id;
    public $nationality; //To capture nationality selected from Trait in listening method
    public $city; //To capture city selected from Trait in listening method
    public $countries = []; //To find city corresponding to country
    public $country_id; //To find city corresponding to country; //To find city corresponding to country
    public $show_password = true;
    public $incomplete_profile = false;


    protected $rules = [
        'customer.first_name' => 'required|string|regex:/^[a-zA-Z\s]*$/',
        'customer.last_name' => 'required|string|regex:/^[a-zA-Z\s]*$/',
        'customer.dob' => 'required|date|date_format:Y-m-d|before:-17 years',
        'customer.gender' => 'required|string|in:f,m',
        'customer.phone' => 'required|string',
        'customer.code' => 'required|string',
        'customer.nationality_country_id' => 'required|integer',
        'occupation_id' => 'required|integer',
        'customer.place_of_birth' => 'required|string',
        'customer.house_no' => 'required|string',
        'customer.street_name' => 'required|string',
        'customer.postal_code' => 'required|string',
        'customer.city_name' => 'required|string',
    ];
    protected $validationAttributes = [
        'nationality.id' => 'nationality',
        'occupation_id' => 'occupation',
        'customer.first_name' => 'first name',
        'customer.last_name' => 'last name',
        'customer.dob' => 'dob',
        'customer.gender' => 'gender',
        'customer.phone' => 'phone',
        'customer.code' => 'code',
        'customer.place_of_birth' => 'place of birth',
        'customer.house_no' => 'house no',
        'customer.street_name' => 'street name',
        'customer.postal_code' => 'post code',
        'customer.city_name' => 'city',
    ];

    protected $messages = [

        'customer.first_name.required' => 'First name is required.',
        'customer.last_name.required' => 'Last name is required.',
        'customer.dob.required' => 'Date of birth is required.',
        'customer.dob.date' => 'Date of birth format must be of date format.',
        'customer.dob.before' => 'Date of birth must be a date before -17 years.',
        'customer.phone.required' => 'Mobile number is required.',
        'customer.nationality_country_id.required' => 'Nationality is required.',
        'customer.place_of_birth.required' => 'Place of birth is required.',
        'occupation_id.required' => 'Occupation is required.',
        'customer.gender.required' => 'Gender is required.',
        'customer.first_name.regex' => 'First name must only contain letters.',
        'customer.last_name.regex' => 'Last name must only contain letters.',
        'customer.house_no.required' => 'House no is required.',
        'customer.street_name.required' => 'Street name is required.',
        'customer.postal_code.required' => 'Post code is required.',
        'customer.city_name.required' => 'City is required.',
    ];

    public function mount($show_password = true)
    {
        $req = request()->all();
        $this->show_password = $show_password;
        if ($show_password == false) {
            $this->edit = true;
        }
        if (!empty($req['incomplete'])) {
            $this->edit = true;
            $this->incomplete_profile = true;
        }
        $this->country_id = session('country_id');
        $data = User::from('users as u')
            ->join('customers as c', 'c.user_id', '=', 'u.id')
            ->join('countries as ct', 'ct.id', '=', 'c.country_id')
            ->where('u.email', session('email'))
            ->where('c.id', session('customer_id'))
            ->where('u.type', 'on')
            ->first([
                'c.email', 'c.place_of_birth', 'c.is_verified',
                'c.id', 'c.first_name', 'c.last_name', 'user_agent_id', 'c.occupation', 'c.postal_code',
                'ct.name as country_name', 'ct.phonecode', 'c.dob', 'c.gender', 'c.city_id', 'c.city_name',
                'ct.iso2', 'ct.currency', 'c.country_id', 'u.id as user_id', 'c.house_no', 'c.street_name',
                'c.birth_country_id', 'c.nationality_country_id', 'c.phone'
            ]);


        $this->customer = $this->nullCheck($data);

        $this->customer['code'] = $this->customer['phonecode'];

        if (!empty($this->customer['occupation'])) {
            $occupation = Option::find($this->customer['occupation']);
            if (!empty($occupation)) {
                $this->occupation_id = $occupation->id;
            }
        }

        $this->countries = Country::whereNull('deleted_at')->get()->toArray();
        $this->ocfetchData();
        $this->nFetchData();
    }

    private function nullCheck($collection): array
    {
        if (!collect($collection)->isEmpty()) return collect($collection)->toArray();
        return [];
    }

    private function fetchPlaceOfBirth(): array
    {
        $country = Country::where('id', $this->customer['birth_country_id'])->select(['id', 'name', 'currency', 'nationality'])->first();
        return $this->nullCheck($country);
    }

    private function fetchCityName(): array
    {
        if (empty($this->customer['city_id'])) {
            return [];
        }
        $city = json_decode(json_encode(DB::table('cities')->where('id', $this->customer['city_id'])->get('name')), true)[0];
        return $this->nullCheck($city);
    }

    private function fetchNationality(): array
    {
        $nationality = Country::where('id', $this->customer['nationality_country_id'])->select(['id', 'name', 'currency', 'nationality'])->first();
        return $this->nullCheck($nationality);
    }

    public function render()
    {
        return view('livewire.inner.profile');
    }

    public function update()
    {
        $this->validate();


        $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
        $number = $phoneUtil->parse($this->customer['code'] . $this->customer['phone'], $this->customer['iso2']);
        $isValid = $phoneUtil->isValidNumber($number);
        if (!$isValid) {

            $this->addError('customer.phone', 'Please enter valid phone number.');
            return;
        }

        $customer_user_ids = Customer::where('id', '!=', session('customer_id'))->where('phone', $this->customer['phone'])
            ->where('phone_code', $this->customer['code'])->whereNotNull('user_id')->pluck('user_id')->toArray();

        if(!empty($customer_user_ids)){
        if (User::whereIn('id', $customer_user_ids)->where('company_id', env('COMPANY_ID'))->exists()) {
            $this->addError('customer.phone', 'The phone number has already been taken.');
            return;
        }
        }



        $customer = Customer::find(session('customer_id'));
        $update = [
            'phone' => $this->customer['phone'],
            'phone_code' => $this->customer['code']
        ];

        $this->customer['first_name'] = preg_replace('/\s+/', ' ', $this->customer['first_name']);
        $this->customer['last_name'] = preg_replace('/\s+/', ' ', $this->customer['last_name']);

        if ($customer['is_verified'] != 't') {
            $update['first_name'] = $this->customer['first_name'];
            $update['last_name'] = $this->customer['last_name'];
            $update['gender'] = $this->customer['gender'];
            $update['dob'] = $this->customer['dob'];
            $update['birth_country_id'] = $this->customer['birth_country_id'];
            $update['nationality_country_id'] = $this->customer['nationality_country_id'];
            $update['postal_code'] = $this->customer['postal_code'];
            $update['house_no'] = $this->customer['house_no'];
            $update['street_name'] = $this->customer['street_name'];
            $update['city_name'] = $this->customer['city_name'];
            $update['occupation'] = $this->occupation_id;
            $update['place_of_birth'] = $this->customer['place_of_birth'];
        }


        $result = $customer->update($update);
        if ($this->incomplete_profile) {
            $doc = $this->validateUserDocuments($customer);
            if ($doc['status'] != true) {
                return $this->redirect('/user/document/add?incomplete=true');
            } else {
                return $this->redirect('/send/money');
            }
        }
        if ($result) session()->flash('success', 'Profile Updated Successfully.');
        else session()->flash('error', 'Unknown error while uploading profile. Please try again later.');
    }

    public function toggleEdit()
    {
        $this->edit = !$this->edit;
    }
}
