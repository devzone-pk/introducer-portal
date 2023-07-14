<?php

namespace App\Http\Livewire\Mobile\Account;

use App\Models\City;
use App\Models\Customer\Customer;
use App\Models\Customer\CustomerDocument;
use App\Traits\Modals\SearchCities;
use App\Traits\Validation\UserDocumentValidation;
use Illuminate\Validation\Validator;
use Livewire\Component;

class Address extends Component
{
    use SearchCities, \App\Traits\Modals\Address, UserDocumentValidation;

    public $modal;
    public $house_no;
    public $street_name;
    public $postal_code;
    public $country;
    public $country_id;
    public $city_name;
    public $success;
    public $alert;
    public $address;
    public $customer = [];
    public $incomplete_profile = false;

    protected $rules = [
        'house_no' => 'required|string',
        'street_name' => 'required|string',
        'postal_code' => 'required|string',
        'country_id' => 'required|integer',
        'city_name' => 'required|string'
    ];
    protected $validationAttributes = [
        'city_name' => 'city',

    ];
    protected $listeners = [
        'resetErrors' => 'resetErrors'
    ];

    public function mount($modal = false)
    {
        $req = request()->all();
        $this->modal = $modal;
        $this->customer = Customer::find(session('customer_id'));
        $this->house_no = $this->customer['house_no'];
        $this->street_name = $this->customer['street_name'];
        $this->postal_code = $this->customer['postal_code'];
        $this->country_id = $this->customer['country_id'];
        $this->city_name = $this->customer['city_name'];

        $this->country = optional($this->customer->country)->name;

        if (!empty($req['incomplete'])) {
            $this->incomplete_profile = true;
        }
    }

    public function render()
    {
        return view('livewire.mobile.account.address');
    }

    public function resetErrors()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function addressUpdate()
    {
        $this->success = '';
        $this->withValidator(function (Validator $validator) {
            if ($validator->fails()) {
                $this->dispatchBrowserEvent('close-modal', ['model' => 'error-dialog']);
                $this->dispatchBrowserEvent('open-modal', ['model' => 'error-dialog']);
            }
        })->validate();

        $data = [];
        if ($this->customer['is_verified'] == 'f') {
            $data['house_no'] = $this->house_no;
            $data['street_name'] = $this->street_name;
            $data['postal_code'] = $this->postal_code;
            $data['city_name'] = $this->city_name;

            Customer::find($this->customer['id'])
                ->update($data);
            $this->success = 'Customer address has been updated.';
            $this->customer = Customer::find($this->customer['id']);
            $this->emit('addressDone');

            if (!empty($req['incomplete'])) {
                $doc = $this->validateUserDocuments($this->customer);
                if ($doc['status'] != true) {
                    return $this->redirect('/mobile/document/add?incomplete=true');
                } else {
                    return $this->redirect('/mobile/send/money');
                }
            }


        } else {
            $this->alert = 'Please contact support team to update information.';
        }

    }
}
