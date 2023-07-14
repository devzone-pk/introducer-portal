<?php

namespace App\Http\Livewire\Inner\Mobile;

use App\Models\Customer\Customer;
use App\Traits\Modals\SearchCities;
use Livewire\Component;

class Address extends Component
{
    use SearchCities;

    public $house_no;
    public $street_name;
    public $postal_code;
    public $country;
    public $country_id;
    public $city = [];
    public $success;
    public $customer = [];

    protected $rules = [
        'house_no' => 'required|string',
        'street_name' => 'required|string',
        'postal_code' => 'required|string',
        'country_id' => 'required|integer',
        'city.name' => 'required|string'
    ];

    public function mount()
    {
        $this->customer = Customer::find(session('customer_id'));
        $this->house_no = $this->customer['house_no'];
        $this->street_name = $this->customer['street_name'];
        $this->postal_code = $this->customer['postal_code'];
        $this->country_id = $this->customer['country_id'];
        $this->country = optional($this->customer->country)->name;

        $city = ($this->customer->city);
        $this->city['id'] = optional($city)->id;
        $this->city['name'] = optional($city)->name;

    }


    public function render()
    {
        return view('livewire.inner.mobile.address');
    }

    public function addressUpdate()
    {
        $this->success = '';
        $this->validate();

        $data = [];
        if (empty($this->customer['house_no'])) {
            $data['house_no'] = $this->house_no;
        }
        if (empty($this->customer['street_name'])) {
            $data['street_name'] = $this->street_name;
        }
        if (empty($this->customer['postal_code'])) {
            $data['postal_code'] = $this->postal_code;
        }
        if (empty($this->customer['city_id'])) {
            $data['city_id'] = $this->city['id'];
        }
        if (!empty($data)) {
            Customer::find($this->customer['id'])
                ->update($data);
            $this->success = 'Customer address has been updated.';
            $this->customer = Customer::find($this->customer['id']);
            $this->emit('addressDone');
        }


    }
}
