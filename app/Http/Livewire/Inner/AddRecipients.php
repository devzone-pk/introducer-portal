<?php

namespace App\Http\Livewire\Inner;

use App\Models\Country\Country;
use App\Models\User\Beneficiary;
use App\Traits\Modals\ReceivingCountries;
use App\Traits\Modals\Relationship;
use Exception;
use Illuminate\Validation\Validator;
use Livewire\Component;

class AddRecipients extends Component
{
    use Relationship, ReceivingCountries;

    public $country = [];
    public $relation = [];
    public $first_name;
    public $last_name;
    public $phone;
    public $code;
    public $success;
    protected $rules = [
        'first_name' => 'required|string|regex:/^[a-zA-Z\s]*$/',
        'last_name' => 'required|string|regex:/^[a-zA-Z\s]*$/',
        'phone' => 'required|string',
        'code' => 'required|string',
        'country' => 'required|integer',
        'relation' => 'required|integer'
    ];
    protected $validationAttributes = [
        'relation.relationship_id' => 'relation',
        'country.id' => 'country'
    ];
    protected $messages = [
        'first_name.regex' => 'The first name must only contain letters.',
        'first_name.required' => 'First name is required.',
        'last_name.regex' => 'The last name must only contain letters.',
        'last_name.required' => 'Last name is required.',
        'phone.required' => 'Phone is required.',
        'code.required' => 'Code is required.',
        'country.required' => 'Country is required.',
        'relation.required' => 'Relation is required.',
    ];

    public function mount()
    {
        $this->rcFetchData();
        $this->rlfetchData();
    }

    public function addNew()
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
            $number = $phoneUtil->parse($this->code . $this->phone, $this->country);

            $isValid = $phoneUtil->isValidNumber($number);
            if (!$isValid) {
                $this->addError('phone', 'Please enter valid phone number.');
                return;
            }
            $first_name = preg_replace('/\s+/', ' ', $this->first_name);
            $last_name = preg_replace('/\s+/', ' ', $this->last_name);
            Beneficiary::create([
                'customer_id' => session('customer_id'),
                'first_name' => trim($first_name),
                'last_name' => trim($last_name),
                'code' => $this->code,
                'phone' => $this->phone,
                'country_id' => $this->country,
                'relationship_id' => $this->relation,
                'type' => 'on',
                'status' => 't'
            ]);

            $this->success = 'Beneficiary created successfully.';
            $this->reset(['relation', 'country', 'code', 'phone', 'first_name', 'last_name']);

        } catch (Exception $exception) {
            $this->addError('error', $exception->getMessage());
        }
    }

    public function updatedCountry($val)
    {

        if (!empty($val)) {
            $country_found = Country::find($val);
            if ($country_found) {
                $this->code = $country_found['phonecode'];
            }
        } else {
            $this->code = null;
        }

    }

    public function resetErrors()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.inner.add-recipients');
    }
}
