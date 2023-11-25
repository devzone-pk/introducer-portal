<?php

namespace App\Http\Livewire\Mobile;

use App\Models\User\Beneficiary;
use App\Traits\Modals\Nationality;
use App\Traits\Modals\Relationship;
use Exception;
use Illuminate\Validation\Validator;
use Livewire\Component;
use function Sodium\add;

class AddReceiver extends Component
{
    use Nationality, Relationship;

    public $country = [];
    public $relation = [];
    public $first_name;
    public $last_name;
    public $phone;
    public $code;
    public $success;
    protected $listeners = [
        'emit_country' => 'changeCountry',
        'resetErrors' => 'resetErrors'
    ];
    protected $rules = [
        'first_name' => 'required|string|regex:/^[a-zA-Z\s]*$/',
        'last_name' => 'required|string|regex:/^[a-zA-Z\s]*$/',
        'phone' => 'required|regex:/^[0-9]+$/',
        'code' => 'required|string',
        'country.id' => 'required|integer',
        'relation.relationship_id' => 'required|integer'
    ];
    protected $validationAttributes = [
        'relation.relationship_id' => 'relation',
        'country.id' => 'country'
    ];
    protected $messages = [
        'first_name.regex' => 'The first name must only contain letters.',
        'last_name.regex' => 'The last name must only contain letters.',
        'phone.regex' => 'The phone number must contain only digits.'
    ];

    public function render()
    {
        return view('livewire.mobile.add-receiver');
    }

    public function changeCountry()
    {
        if (!empty($this->country['iso2'])) {
            $this->code = $this->country['phonecode'];
        }
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
            $number = $phoneUtil->parse($this->code . $this->phone, $this->country['iso2']);

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
                'country_id' => $this->country['id'],
                'relationship_id' => $this->relation['relationship_id'],
                'type' => 'on',
                'status' => 't'
            ]);

            $this->reset(['relation', 'country', 'code', 'phone', 'first_name', 'last_name']);

        } catch (Exception $exception) {
            $this->addError('error', $exception->getMessage());
        }

    }

    public function resetErrors()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
