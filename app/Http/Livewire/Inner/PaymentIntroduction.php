<?php

namespace App\Http\Livewire\Inner;

use App\Models\Agent;
use App\Models\Country\Country;
use App\Models\Country\SendingReceivingCountry;
use App\Models\Customer\Customer;
use App\Models\Options\Option;
use App\Models\Partner\Payer;
use App\Models\User\Beneficiary;
use App\Models\User\User;
use App\Traits\Modals\Nationality;
use App\Traits\Modals\Occupation;
use App\Traits\Modals\Relationship;
use App\Traits\Validation\UserDocumentValidation;
use Devzone\Rms\AdminFee;
use Devzone\Rms\AllRates;
use Devzone\Rms\Source;
use Exception;
use Illuminate\Validation\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class PaymentIntroduction extends Component
{
    use WithFileUploads;
    use Nationality, Occupation, UserDocumentValidation,Relationship;

    public $customer = [];
    public $customer_documents = [];
    public $selected_beneficiary = [];
    public $payments = [];
    public $amounts = [
        'sending_amount' => 0,
        'receive_amount' => 0,
        'fees' => 0,
        'calculation_mode' => 'S',
        'total' => 0
    ];
    public $beneficiaries = [];
    public $countries = [];
    public $front;

    public $doc_type;
    public $back;
    public $options;
    public $success = null;
    public $iteration = 0;
    public $receiving_iso2;
    public $sending_iso2;
    public $receiving_country;
    public $receiving;
    public $sending_country;
    public $sending;
    public $receiving_method_id;
    public $receiving_methods;
    public $receiving_method;
    public $payers;
    public $payer_id;
    public $selected_payer;
    public $rates;
    public $high_rate = [
        'rate_after_spread' => 0
    ];
    public $agent_user_id;
    public $error;
    public $selected_window = 'beneficiary';

    protected function rules()
    {
        $rules = [];
        if ($this->selected_window == 'customer_info') {
            $rules = [
                'customer.first_name' => 'required|string|regex:/^[a-zA-Z\s]*$/',
                'customer.last_name' => 'required|string|regex:/^[a-zA-Z\s]*$/',
                'customer.dob' => 'required|date|date_format:Y-m-d|before:-17 years',
                'customer.gender' => 'required|string|in:f,m',
                'customer.phone' => 'required|regex:/^[0-9]+$/',
                'customer.code' => 'required|string',
                'customer.nationality_country_id' => 'required|integer',
                'occupation_id' => 'required|integer',
                'customer.place_of_birth' => 'required|string',
                'customer.house_no' => 'required|string',
                'customer.street_name' => 'required|string',
                'customer.postal_code' => 'required|string',
                'customer.city_name' => 'required|string',
            ];

        }
        if ($this->selected_window == 'cus_docs') {
            $rules = [
//                'customer_id' => 'required|integer|exists:customers,id',
                'customer_documents.type' => 'required|integer',
                'customer_documents.issuance' => 'required|date|before_or_equal:today|date_format:Y-m-d',
                'customer_documents.expiry' => 'required|date|after:issuance|after:today|date_format:Y-m-d',
                'front' => 'required|file|mimes:pdf,jpg,jpeg,png,bmp,svg,webp',
                'back' => 'nullable|file|mimes:pdf, jpg, jpeg, png, bmp,svg,webp',
                'customer_documents.issuer_country_id' => 'required',
                'customer_documents.doc_type' => 'required'
            ];
        }

        if ($this->selected_window == 'confirm') {
            $rules = [
                'receiving_country.iso2' => 'required|string',
                'receiving_method' => 'required|string',
                'selected_payer.id' => 'required',
                'amounts.total' => 'required',
                'amounts.sending_amount' => 'required|string',
                'amounts.receive_amount' => 'required|string',
                'selected_beneficiary.first_name' => 'required|string',
                'selected_beneficiary.last_name' => 'required|string',
                'selected_beneficiary.phone' => 'required|regex:/^[0-9]+$/',
                'selected_beneficiary.relationship_id' => 'required',
                'selected_sending_method.id' => 'required',
                'selected_sending_reason' => 'required',
                'source_of_funds' => 'required'
            ];
            return $rules;
        }
    }


    public function mount()
    {
        $this->countries = Country::whereNull('deleted_at')->get()->toArray();
        $this->customer['code'] = optional(collect($this->countries)->where('iso2', 'GB')->first())['phonecode'];
        $this->options = Option::where('option_type_id', '2')
            ->where('secondary_name', 'Identification Documents')
            ->orderBy('additional_info')->get();
        $this->ocfetchData();
        $this->nFetchData();
        $this->getPaymentsData();
        $this->addBeneficiaryCard();

    }

    public function getPaymentsData($iso = 'NG')
    {


        $this->receiving_iso2 = strtoupper($iso);


        if (in_array($this->sending_iso2, ['GB', 'CA'])) {
            $this->sending_iso2 = $_SERVER['HTTP_CF_IPCOUNTRY'];
        } else {
            $this->sending_iso2 = 'GB';
        }
        $countries = SendingReceivingCountry::from('sending_receiving_countries as sr')
            ->join('countries as s', 'sr.sending_country_id', '=', 's.id')
            ->join('countries as r', 'sr.receiving_country_id', '=', 'r.id')
            ->where('sr.company_id', config('app.company_id'))
            ->where('sr.status', 't')
            ->select('s.iso2 as sending', 'r.iso2 as receiving')->get();

        $configured_countries = [];//config('app.countries');
        foreach ($countries->groupBy(['sending', 'receiving'])->toArray() as $key => $value) {
            $configured_countries[$key] = array_keys($value);
        }


        $sending = Country::whereIn('iso2', array_keys($configured_countries))
            ->select('id', 'name', 'currency', 'iso2', 'iso3')->get();

        $selected_sending = $sending->where('iso2', $this->sending_iso2)->first();

        $receiving = Country::whereIn('iso2', $configured_countries[$selected_sending['iso2']])
            ->select('id', 'name', 'currency', 'iso2', 'iso3')->get();
        if (empty($selected_sending)) {
            $selected_sending = $sending->where('iso2', 'GB')->first();
        }
        if (!empty($selected_sending)) {
            $this->sending_country = $selected_sending->toArray();
        }

        $selected_receiving = $receiving->where('iso2', strtoupper($iso))->first();
        if (!empty($selected_receiving)) {
            $this->receiving_country = $selected_receiving->toArray();
        }


        $this->receiving = $receiving->toArray();
        $this->sending = $sending->toArray();

        $agent = Agent::where('company_id', config('app.company_id'))
            ->where('channel', 'on')->where('type', 'ma')->where('status', 't')
            ->where('country_id', $this->sending_country['id'])
            ->first();

        if (!empty($agent)) {
            $this->agent_user_id = $agent['user_id'];
            $this->getRates();
        }

    }

    public function getRates()
    {
        try {
            $source = new Source();
            $source->userAgentId = $this->agent_user_id;
            $this->reset('high_rate');
            $source->destinationCountry = $this->receiving_country['iso2'];
            $source->receiving_method_id = $this->receiving_method_id;
            $rates = new AllRates($source);
            $rates = $rates->rate();
            $this->rates = json_decode(json_encode($rates), true);
            $rates = collect($rates);
            if (!empty($this->receiving_method_id)) {

                $rates = $rates->where('method', ucfirst($this->receiving_method));
                $this->rates = json_decode(json_encode($rates), true);
            }
            $this->receiving_methods = array_unique($rates->pluck('method')->toArray());


            foreach ($this->rates as $r) {
                if ($this->high_rate['rate_after_spread'] < $r['rate_after_spread']) {
                    $this->high_rate = $r;
                }
            }


            if (!empty($this->high_rate['id'])) {
                $this->receiving_method = $this->high_rate['method'];
                // $this->selectMethod($this->receiving_method);
                $this->payers = collect($this->rates)->where('method', $this->receiving_method)->toArray();
                $this->selected_payer = $this->high_rate;
                $this->payer_id = $this->high_rate['id'];
                $this->updatedAmountsSendingAmount(0);

            }


        } catch (Exception $e) {
            $this->error = $e->getMessage();
        }

    }

    public function updatedSendingIso2($value)
    {


        $this->sending_country = collect($this->sending)->where('iso2', $value)->first();
        $agent = Agent::where('company_id', config('app.company_id'))
            ->where('channel', 'on')->where('type', 'ma')->where('status', 't')
            ->where('country_id', $this->sending_country['id'])
            ->first();

        $this->reset(['receiving_method', 'receiving_methods', 'selected_payer', 'amounts', 'payers', 'rates', 'high_rate']);

        if (!empty($agent)) {
            $this->agent_user_id = $agent['user_id'];
            $this->getRates();
            $this->calculateRate();
        }

    }

    public function updatedReceivingMethod($val)
    {

        $this->selectMethod($val);
    }


    public function updatedReceivingIso2($value)
    {
        if (!empty($value)) {
            return $this->redirect('/send-money-to/' . strtolower($value));
        }

    }

    public function updatedAmountsSendingAmount($value)
    {
        if (empty($this->selected_payer)) {
            return;
        }
        if (empty($value)) {
            $this->amounts['sending_amount'] = 100;
            $this->amounts['receive_amount'] = round($this->selected_payer['rate_after_spread'] * 100, 2);
            $this->calculateRate();
        } else {

            $this->amounts['calculation_mode'] = 'S';
            $this->calculateRate();
        }
    }

    public function updatedAmountsReceiveAmount($value)
    {
        if (empty($this->selected_payer)) {
            return;
        }

        if (empty($value)) {
            $this->amounts['sending_amount'] = 0;
            $this->amounts['receive_amount'] = round($this->selected_payer['rate_after_spread'] * 100, 2);
            $this->calculateRate();
        } else {
            $this->amounts['calculation_mode'] = 'R';
            $this->calculateRate();
        }
    }


    private function calculateRate()
    {
        $this->reset(['error']);

        //$this->validate();


        $this->reset('error');

        $this->amounts['sending_amount'] = preg_replace("/[^0-9.]/", "", $this->amounts['sending_amount']);//filter_var($this->amounts['sending_amount'], FILTER_SANITIZE_NUMBER_FLOAT);
        $this->amounts['receive_amount'] = preg_replace("/[^0-9.]/", "", $this->amounts['receive_amount']);//filter_var($this->amounts['receive_amount'], FILTER_SANITIZE_NUMBER_FLOAT);

        try {
            if (empty($this->selected_payer['id'])) {
                throw new \Exception('Payer is required');
            }

            if (empty($this->amounts['sending_amount']) && empty($this->amounts['receive_amount'])) {
                throw new \Exception('Please enter sending amount or receiving amount.');
            }

            if ($this->amounts['calculation_mode'] == 'S') {
                //  $this->dispatchBrowserEvent('focus-out', ['id' => 'youSend']);
                $this->amounts['receive_amount'] = round($this->selected_payer['rate_after_spread'] * $this->amounts['sending_amount'], 2);
            } else {
                //$this->dispatchBrowserEvent('focus-out', ['id' => 'recipient_gets']);
                $this->amounts['sending_amount'] = round($this->amounts['receive_amount'] / $this->selected_payer['rate_after_spread'], 2);
            }

//            $this->validate([
//                'amounts.sending_amount' => 'required|numeric|gte:1',
//            ]);

            $source = new Source();
            $source->userAgentId = $this->agent_user_id;
            $source->destinationCountry = $this->receiving_country['iso2'];
            $source->payerId = $this->selected_payer['id'];
            $source->sourceAmount = $this->amounts['sending_amount'];
            $source->sourceCurrency = $this->selected_payer['source_currency'];
            $source->receiving_method_id = $this->receiving_method_id;
            $rates = new AdminFee($source);
            $fees = $rates->apply();
            $this->amounts['fees'] = $fees;
            $this->amounts['total'] = $fees + $this->amounts['sending_amount'];

            if ($this->amounts['calculation_mode'] == 'S') {
                $this->amounts['receive_amount'] = number_format($this->amounts['receive_amount'], 2);
                $this->amounts['sending_amount'] = number_format($this->amounts['sending_amount']);
            } else {
                $this->amounts['sending_amount'] = number_format($this->amounts['sending_amount'], 2);
                $this->amounts['receive_amount'] = number_format($this->amounts['receive_amount']);
            }


        } catch (\Exception $e) {
            $this->error = $e->getMessage();
            $this->reset('amounts');
            $this->addError('error', $e->getMessage());
        }
    }


    public function validateCustomerDetails()
    {

        $this->withValidator(function (Validator $validator) {
            if ($validator->fails()) {
                $this->dispatchBrowserEvent('close-modal', ['model' => 'error-dialog']);
                $this->dispatchBrowserEvent('open-modal', ['model' => 'error-dialog']);
            }
        })->validate();

        try {

            $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
            $number = $phoneUtil->parse($this->customer['code'] . $this->customer['phone'], $this->customer['iso2']);
            $isValid = $phoneUtil->isValidNumber($number);
            if (!$isValid) {
                $this->addError('customer.phone', 'Please enter valid phone number.');
                return;
            }

            $customer_user_ids = Customer::where('phone', $this->customer['phone'])
                ->where('phone_code', $this->customer['code'])->whereNotNull('user_id')->pluck('user_id')->toArray();

            if (!empty($customer_user_ids)) {
                if (User::whereIn('id', $customer_user_ids)->where('company_id', env('COMPANY_ID'))->exists()) {
                    $this->addError('customer.phone', 'The phone number has already been taken.');
                    return;
                }
            }

            $this->customer['first_name'] = preg_replace('/\s+/', ' ', $this->customer['first_name']);
            $this->customer['last_name'] = preg_replace('/\s+/', ' ', $this->customer['last_name']);

            $this->selected_window = 'cus_docs';

        } catch (\Exception $e) {
            $this->addError('error', $e->getMessage());
        }

    }

    public function validateCustomerDocs()
    {

        $this->success = null;
        $this->resetErrorBag();
        $this->withValidator(function (Validator $validator) {
            if ($validator->fails()) {
                $this->dispatchBrowserEvent('close-modal', ['model' => 'error-dialog']);
                $this->dispatchBrowserEvent('open-modal', ['model' => 'error-dialog']);
            }
        })->validate();

        try {

            if (empty($this->front_url)) {
                $this->customer_documents['front'] = ($this->front->storePublicly('documents', 's3'));
            }

            if ($this->back && empty($this->back_url)) {
                $this->customer_documents['back'] = ($this->back->storePublicly('documents', 's3'));
            }

            $this->success = 'Document has been added';

            $this->selected_window = 'payments';

        } catch (\Exception $e) {
            $this->addError('error', $e->getMessage());
        }
    }

    public function validateSendingDetails()
    {
        $this->resetErrorBag();
        $this->withValidator(function (Validator $validator) {
            if ($validator->fails()) {
                $this->dispatchBrowserEvent('close-modal', ['model' => 'error-dialog']);
                $this->dispatchBrowserEvent('open-modal', ['model' => 'error-dialog']);
            }
        })->validate();

        if (!$this->payerLimits()) {
            //$this->reset('amounts');
            return false;
        }
        $this->selected_window = 'beneficiary';
        $this->addBeneficiaryCard();
//        $this->benefetchData();
    }

    public function addBeneficiaryCard()
    {
        $this->selected_beneficiary[] = [
            'first_name' => null,
            'last_name' => null,
            'code' => '+234',
            'phone' => null,
            'relationship_id' => null,
            'selected_sending_reason' => null,
        ];
    }

    public function validateBeneficiaryDetail()
    {
        $this->reset(['error']);
        $this->withValidator(function (Validator $validator) {
            if ($validator->fails()) {
                $this->dispatchBrowserEvent('close-modal', ['model' => 'error-dialog']);
                $this->dispatchBrowserEvent('open-modal', ['model' => 'error-dialog']);
            }
        })->validate();

        try {
            $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
            $number = $phoneUtil->parse($this->selected_beneficiary['code'] . $this->selected_beneficiary['phone'], $this->receiving_country['iso2']);
            $isValid = $phoneUtil->isValidNumber($number);
            if (!$isValid) {
                $this->addError('selected_beneficiary.phone', 'Please enter valid phone number.');
                return;
            }
        } catch (Exception $exception) {
            $this->addError('selected_beneficiary.phone', 'Please enter valid phone number.');
            return;
        }

        if (empty($this->selected_beneficiary['id'])) {

            $duplicate = Beneficiary::where('country_id', $this->receiving_country['id'])
                ->where(function ($q) {
                    return $q->orWhere(function ($w) {
                        return $w->where('first_name', $this->selected_beneficiary['first_name'])->where('last_name', $this->selected_beneficiary['last_name']);
                    })
                        ->orWhere('phone', $this->selected_beneficiary['phone']);
                })->where('customer_id', session('customer_id'))->exists();

            if ($duplicate) {
                $this->addError('error', 'Duplication Alert! The beneficiary already exists. Please choose from the existing receiver list.');
                $this->dispatchBrowserEvent('close-modal', ['model' => 'errors']);
                $this->dispatchBrowserEvent('open-modal', ['model' => 'errors']);
                return;
            }
        }

        $name = collect($this->rl_data)->firstWhere('id', $this->selected_beneficiary['relationship_id']);
        if (!empty($name)) {
            $this->selected_beneficiary['relationship_name'] = $name['name'];
        }


        //$this->dispatchBrowserEvent('goUp');
        if (strtolower($this->receiving_method) == 'bank') {
            $this->bbfetchData();
            $this->sbfetchData();
            $this->selected_window = 'bank';
        } else {
            $this->selected_window = 'confirm';
        }
    }
    public function getReceivingMethods()
    {

        try {
            $this->reset(['receiving_methods', 'receiving_method', 'payers', 'selected_payer', 'amounts', 'selected_cash_destination']);
            if (empty($this->receiving_country['iso2'])) {
                throw new \Exception('Sending to country is required.');
            }
            $source = new Source();
            $source->userAgentId = session('user_agent_id');
            $source->destinationCountry = $this->receiving_country['iso2'];
            $rates = new AllRates($source);
            $rates = $rates->rate();
            $this->rates = json_decode(json_encode($rates), true);

            $rates = collect($rates);
            $this->receiving_methods = array_unique($rates->pluck('method')->toArray());
            $this->selected_beneficiary['code'] = $this->receiving_country['phonecode'];
        } catch (\Exception $e) {
            $this->reset('amounts');
            $this->error = $e->getMessage();
            $this->addError('error', $e->getMessage());
        }
    }

    private function payerLimits()
    {
        $this->resetErrorBag();
        if (empty($this->selected_payer['id'])) {
            return true;
        }
        $receive_amount = preg_replace("/[^0-9.]/", "", $this->amounts['receive_amount']); //filter_var($this->amounts['sending_amount'], FILTER_SANITIZE_NUMBER_FLOAT);
        $payer = Payer::find($this->selected_payer['id']);
        $error_message = "You cannot send less than " . $payer['currency'] . ' ' . number_format($payer['min']) . ' or more than ' . $payer['currency'] . ' ' . number_format($payer['max']);

        if ($payer['min'] > $receive_amount) {
            $this->addError('amounts.receive_amount', $error_message);
            return false;
        }


        if ($payer['max'] < $receive_amount) {
            $this->addError('amounts.receive_amount', $error_message);
            return false;
        }

        return true;
    }

    public function render()
    {
        return view('livewire.inner.payment-introduction');
    }
}
