<?php

namespace App\Http\Livewire\Inner;

use App\Mail\TransferCreated;
use App\Mail\TransferFollowUp;
use App\Models\Agent;
use App\Models\Country\Country;
use App\Models\Country\SendingReceivingCountry;
use App\Models\Customer\Customer;
use App\Models\Customer\CustomerDetail;
use App\Models\Customer\CustomerDocument;
use App\Models\Options\Option;
use App\Models\Partner\Payer;
use App\Models\Transfer\Ledger;
use App\Models\Transfer\StatusTracker;
use App\Models\Transfer\Transfer;
use App\Models\Transfer\TransferAdditionalDetail;
use App\Models\Transfer\TransferBeneficiary;
use App\Models\Transfer\TransferBeneficiaryBank;
use App\Models\Transfer\TransferCustomer;
use App\Models\Transfer\TransferDetail;
use App\Models\User\Beneficiary;
use App\Models\User\BeneficiaryBank;
use App\Models\User\User;
use App\Traits\Modals\BeneficiaryList;
use App\Traits\Modals\Nationality;
use App\Traits\Modals\Occupation;
use App\Traits\Modals\Relationship;
use App\Traits\Modals\SearchBanks;
use App\Traits\Modals\SendingReasons;
use App\Traits\Validation\UserDocumentValidation;
use Carbon\Carbon;
use Devzone\Rms\AdminFee;
use Devzone\Rms\AllRates;
use Devzone\Rms\Source;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class PaymentIntroduction extends Component
{
    use WithFileUploads;
    use Nationality,
        Occupation,
        UserDocumentValidation,
        Relationship,
        SearchBanks,
        SendingReasons,
        BeneficiaryList;

    public $customer = [];
    public $customer_check = false;
    public $customer_id = null;
    public $customer_user_id = null;
    public $customer_documents = [];
    public $selected_beneficiary = [];
    public $existing_beneficiary_id = [];
    public $existing_beneficiary_bank_id = null;
    public $existing_beneficiary_bank_data = [];
    public $details_completed = [
        'customer_info' => false,
        'customer_docs' => false,
        'docs_found' => false,
        'payments' => false,
        'beneficiary' => false,
    ];
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
    public $receiving = [];
    public $sending_country;
    public $sending = [];
    public $receiving_method_id;
    public $receiving_methods = [];
    public $receiving_method;
    public $payers = [];
    public $payer_id;
    public $selected_payer;
    public $rates;

    public $high_rate = [
        'rate_after_spread' => 0
    ];

    public $user_customer_rate = 0;
    public $agent_user_id;
    public $source_of_funds = null;
    public $error;
    public $selected_window = 'customer_info';
    protected $validationAttributes = [
        'receiving_country.iso2' => 'sending to',
        'receiving_method' => 'receiving method',
        'selected_payer.id' => 'payer',
        'amounts.total' => 'total amount',
        'amounts.sending_amount' => 'sending amount',
        'selected_beneficiary.*.first_name' => 'beneficiary first name',
        'selected_beneficiary.*.last_name' => 'beneficiary last name',
        'selected_beneficiary.*.phone' => 'beneficiary phone',
        'selected_beneficiary.*.code' => 'beneficiary phone code',
        'selected_beneficiary.*.relationship_id' => 'beneficiary relationship',
        'selected_beneficiary.*.selected_sending_reason' => 'sending reason',
        'selected_beneficiary.*.account_no' => 'account #',
        'selected_beneficiary.*.bank_id' => 'bank',
        'selected_beneficiary.*.name' => 'bank name',
        'selected_beneficiary.*.ifsc' => 'ifsc code',
        'customer_documents.type' => 'type',
        'customer_documents.document_no' => 'issuer_country',
        'customer_documents.issuance' => 'issuance',
        'customer_documents.expiry' => 'issuance',
        'customer_documents.issuer_country_id' => 'issuer country',
        'customer.occupation' => 'occupation',
        'customer.nationality_country_id' => 'nationality',
        'customer.first_name' => 'first name',
        'customer.last_name' => 'last name',
        'customer.email' => 'email',
        'customer.password' => 'password',
        'customer.dob' => 'dob',
        'customer.gender' => 'gender',
        'customer.phone' => 'phone',
        'customer.phone_code' => 'code',
        'customer.place_of_birth' => 'place of birth',
        'customer.house_no' => 'house no',
        'customer.street_name' => 'street name',
        'customer.postal_code' => 'post code',
        'customer.city_name' => 'city',
        'selected_beneficiary.*.receiving_amount' => 'receiving amount',


    ];

    protected $messages = [
        'selected_cash_destination.required' => 'Cash pick-up location is required.',
        'selected_beneficiary.*.first_name.required' => 'Beneficiary first name is required.',
        'selected_beneficiary.*.first_name.regex' => 'Beneficiary first name format is invalid.',
        'selected_beneficiary.*.last_name.required' => 'Beneficiary last name is required.',
        'selected_beneficiary.*.last_name.regex' => 'Beneficiary last name format is invalid.',
        'selected_beneficiary.*.phone.required' => 'Beneficiary phone is required.',
        'selected_beneficiary.*.relationship_id.required' => 'Beneficiary relationship is required.',
        'selected_beneficiary.*.selected_sending_reason.required' => 'Sending reason is required.',
        'selected_beneficiary.*.bank_id.required' => 'Bank is required.',
        'selected_beneficiary.*.account_no.required' => 'Account # is required.',
        'selected_beneficiary.*.receiving_amount.required' => 'Receiving Amount is required.',
        'selected_sending_method.id.required' => 'Sending method is required.',
        'selected_beneficiary.code.required' => 'Beneficiary phone code is required.',
        'amounts.sending_amount.required' => 'Sending amount is required.',
        'amounts.total.required' => 'Total amount is required.',
        'selected_payer.id.required' => 'Payer is required.',
        'receiving_method.required' => 'Receiving method is required.',
        'receiving_country.iso2.required' => 'Sending to is required.',
    ];

    protected function rules()
    {
        $rules = [];
        if ($this->selected_window == 'customer_info') {
            $rules = [
                'customer.first_name' => 'required|string|regex:/^[a-zA-Z\s]*$/',
                'customer.last_name' => 'required|string|regex:/^[a-zA-Z\s]*$/',
                'customer.email' => 'required|email',
                'customer.dob' => 'required|date|date_format:Y-m-d|before:-17 years',
                'customer.gender' => 'required|string|in:f,m',
                'customer.phone_code' => 'required',
                'customer.nationality_country_id' => 'required|integer',
                'customer.occupation' => 'required|integer',
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
                'back' => 'nullable|file|mimes:pdf,jpg,jpeg,png,bmp,svg,webp',
                'customer_documents.issuer_country_id' => 'required',
            ];
        }

        if ($this->selected_window == 'payments') {
            $rules = [
                'receiving_country.iso2' => 'required|string',
                'receiving_method' => 'required|string',
                'selected_payer.id' => 'required',
                'amounts.total' => 'required',
                'amounts.sending_amount' => 'required|string',
                'amounts.receive_amount' => 'required|string',
                'source_of_funds' => 'required|string',
                //'selected_sending_method.id' => 'required'
            ];
        }

        if ($this->selected_window == 'beneficiary') {
            $rules = [
                'selected_beneficiary.*.first_name' => 'required|string|regex:/^[a-zA-Z\s]*$/',
                'selected_beneficiary.*.last_name' => 'required|string|regex:/^[a-zA-Z\s]*$/',
                'selected_beneficiary.*.phone' => 'required|regex:/^[0-9]+$/',
                'selected_beneficiary.*.code' => 'required|string',
                'selected_beneficiary.*.relationship_id' => 'required',
                'selected_beneficiary.*.selected_sending_reason' => 'required',
                'selected_beneficiary.*.bank_id' => 'required',
                'selected_beneficiary.*.account_no' => 'required|string',
                'selected_beneficiary.*.receiving_amount' => 'required',
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
        }
        return $rules;
    }


    public function mount()
    {
        $this->countries = Country::whereNull('deleted_at')->get()->toArray();
        $uk_data = collect($this->countries)->where('iso2', 'GB')->first();
        $this->customer['phone_code'] = optional($uk_data)['phonecode'];
        $this->customer['country_name'] = optional($uk_data)['name'];
        $this->customer['iso2'] = optional($uk_data)['iso2'];
        $this->customer['dob'] = Carbon::now()->subYear(18)->toDateString();
        $this->options = Option::where('option_type_id', '2')
            ->where('secondary_name', 'Identification Documents')
            ->orderBy('additional_info')->get();
        $this->ocfetchData();
        $this->nFetchData();
        $this->getPaymentsData();
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

    public function updatedExistingBeneficiaryId($val, $key)
    {


        $bene_found = Beneficiary::find($val);
        if (!empty($bene_found)) {
//            $bene_bank = BeneficiaryBank::
            $this->selected_beneficiary[$key]['id'] = $bene_found->id;
            $this->selected_beneficiary[$key]['first_name'] = $bene_found->first_name;
            $this->selected_beneficiary[$key]['last_name'] = $bene_found->last_name;
            $this->selected_beneficiary[$key]['phone'] = $bene_found->phone;
            $this->selected_beneficiary[$key]['relationship_id'] = $bene_found->relationship_id;

            $bene_bank_found = BeneficiaryBank::where('beneficiary_id', $val)
                ->select('*', 'name as old_name')
                ->get();
            if ($bene_bank_found->isNotEmpty()) {
                $this->existing_beneficiary_bank_data = $bene_bank_found->toArray();
            } else {
                $this->existing_beneficiary_bank_data = [];
            }
        }

    }

    public function updatedExistingBeneficiaryBankId($val, $key)
    {

        $bene_bank_found = BeneficiaryBank::find($val);
        if (!empty($bene_bank_found)) {
            $this->selected_beneficiary[$key]['bank_id'] = $bene_bank_found->bank_id;
            $this->selected_beneficiary[$key]['account_no'] = $bene_bank_found->account_no;
        }

    }


    public function getRates()
    {
        try {
            $source = new Source();
            $source->userAgentId = $this->agent_user_id;
            $this->reset('high_rate');
            $source->destinationCountry = $this->receiving_country['iso2'];
            $source->receiving_country_id = $this->receiving_country['id'];
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
                $this->user_customer_rate = $this->high_rate['rate_after_spread'];
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
            $this->amounts['receive_amount'] = round($this->user_customer_rate * 100, 2);
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
            $this->amounts['receive_amount'] = round($this->user_customer_rate * 100, 2);
            $this->calculateRate();
        } else {
            $this->amounts['calculation_mode'] = 'R';
            $this->calculateRate();
        }
    }

    public function updatedUserCustomerRate($val)
    {
        $this->resetErrorBag();
        if (!empty($val)) {
            if (floatval($this->user_customer_rate) > $this->high_rate['rate_after_spread']) {

                $this->user_customer_rate = floatval($this->high_rate['rate_after_spread']);
                $this->addError('user_customer_rate', 'Rate must not be higher than current exchange rate ' . (!empty($this->selected_payer['rate_after_spread']) ? number_format($this->selected_payer['rate_after_spread'], 2) . ' ' . $this->selected_payer['currency'] : 0));
            }
        } else {
            $this->user_customer_rate = 0;
        }
        $this->calculateRate();
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
                $this->amounts['receive_amount'] = round($this->user_customer_rate * $this->amounts['sending_amount'], 2);
            } else {
                //$this->dispatchBrowserEvent('focus-out', ['id' => 'recipient_gets']);
                $this->amounts['sending_amount'] = round($this->amounts['receive_amount'] / $this->user_customer_rate, 2);
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
            $this->amounts['fees'] = 0;
            $this->amounts['total'] = $fees + $this->amounts['sending_amount'];

            if ($this->amounts['calculation_mode'] == 'S') {
                $this->amounts['receive_amount'] = number_format($this->amounts['receive_amount'], 2);
//                $this->amounts['sending_amount'] = number_format($this->amounts['sending_amount'],2);
            } else {
                $this->amounts['sending_amount'] = number_format($this->amounts['sending_amount'], 2);
//                $this->amounts['receive_amount'] = number_format($this->amounts['receive_amount'],2);
            }


        } catch (\Exception $e) {
            $this->error = $e->getMessage();
            $this->reset('amounts');
            $this->addError('error', $e->getMessage());
        }
    }

    public function customerExistsCheck()
    {

        $this->validate(['customer.email' => 'required', 'customer.phone' => 'required'], [], ['customer.email' => 'email', 'customer.phone' => 'phone']);
        try {

            $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
            $number = $phoneUtil->parse($this->customer['phone_code'] . $this->customer['phone'], $this->customer['iso2']);
            $isValid = $phoneUtil->isValidNumber($number);
            if (!$isValid) {
                $this->addError('customer.phone', 'Please enter valid phone number.');
                return;
            }

            $customer_found = Customer::join('users as u', 'u.id', '=', 'customers.user_id')
                ->join('countries as co', 'co.id', '=', 'customers.country_id')
                ->where('customers.email', $this->customer['email'])
                ->where('customers.phone_code', $this->customer['phone_code'])
                ->where('customers.phone', $this->customer['phone'])
                ->where('u.company_id', env('COMPANY_ID'))
                ->select('customers.id', 'customers.user_id', 'customers.first_name', 'customers.last_name', 'customers.email', 'customers.dob',
                    'customers.phone_code', 'customers.phone', 'customers.gender', 'customers.house_no', 'customers.street_name',
                    'customers.postal_code', 'customers.city_name', 'co.name as country_name', 'customers.is_verified', 'customers.nationality_country_id', 'customers.place_of_birth', 'customers.occupation')
                ->get()->first();

            if (!empty($customer_found)) {
                $customer_found = $customer_found->toArray();
                $this->customer_id = $customer_found['id'];
                $this->customer_user_id = $customer_found['user_id'];
                $iso2 = $this->customer['iso2'];
                $this->customer = $customer_found;
                $this->customer['iso2'] = $iso2;
                $this->details_completed['customer_info'] = true;
                $docs_found = CustomerDocument::where('customer_id', $this->customer_id)->where('is_primary', 't')->where('issuance', '<=', date('Y-m-d'))
                    ->where('expiry', '>=', date('Y-m-d'))->whereNull('deleted_at')->where('status', 't')->first();
                if ($docs_found) {
                    $this->customer_documents['type'] = $docs_found['type'];
                    $this->details_completed['customer_docs'] = true;
                    $this->details_completed['docs_found'] = true;
                    $this->benelistData();
//                    $this->selected_window = 'payments';
//                    $this->dispatchBrowserEvent('open-accord', ['id' => 'collapseThree']);
                }
//                else {
//                    $this->selected_window = 'cus_docs';
//                    $this->dispatchBrowserEvent('open-accord', ['id' => 'collapseTwo']);
//                }
            }
            $this->customer_check = true;

        } catch (Exception $e) {
            $this->addError('cus_check', $e->getMessage());
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
            $number = $phoneUtil->parse($this->customer['phone_code'] . $this->customer['phone'], $this->customer['iso2']);
            $isValid = $phoneUtil->isValidNumber($number);
            if (!$isValid) {
                $this->addError('customer.phone', 'Please enter valid phone number.');
                return;
            }
            $customer_user_ids = Customer::where('phone', $this->customer['phone'])
                ->when(!empty($this->customer_id), function ($q) {
                    $q->where('id', '!=', $this->customer_id);
                })
                ->where('phone_code', $this->customer['phone_code'])->whereNotNull('user_id')->pluck('user_id')->toArray();

            if (!empty($customer_user_ids)) {
                if (User::whereIn('id', $customer_user_ids)->where('company_id', env('COMPANY_ID'))->exists()) {
                    $this->addError('customer.phone', 'The phone number has already been taken.');
                    return;
                }
            }

            $this->customer['first_name'] = preg_replace('/\s+/', ' ', $this->customer['first_name']);
            $this->customer['last_name'] = preg_replace('/\s+/', ' ', $this->customer['last_name']);

            $this->details_completed['customer_info'] = true;

            if ($this->details_completed['customer_docs'] && $this->details_completed['docs_found']) {
                $this->selected_window = 'payments';
                $this->dispatchBrowserEvent('open-accord', ['id' => 'collapseThree']);

            } else {
                $this->selected_window = 'cus_docs';
                $this->dispatchBrowserEvent('open-accord', ['id' => 'collapseTwo']);
            }


        } catch (\Exception $e) {
            $this->addError('cus_info', $e->getMessage());
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

            $this->details_completed['customer_docs'] = true;

            $this->dispatchBrowserEvent('open-accord', ['id' => 'collapseThree']);
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
        $this->details_completed['payments'] = true;
        $this->dispatchBrowserEvent('open-accord', ['id' => 'collapseFour']);
        if (empty($this->selected_beneficiary)) {
            $this->addBeneficiaryCard();
        }
        $this->sbfetchData();
        $this->srfetchData();
        $this->rlfetchData();
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
            'receiving_amount' => 0,
        ];
    }

    public function deleteBeneficiaryCard($key)
    {
        unset($this->selected_beneficiary[$key]);
    }


    public function newBeneCard()
    {

        $previous_bene = last($this->selected_beneficiary);
        if (empty($previous_bene)) {
            $this->addBeneficiaryCard();
            return;
        }
        if ($this->validateBeneficiaryDetail($previous_bene)) {
            $this->addBeneficiaryCard();
        }
    }

    public function validateBeneficiaryDetail($previous_bene)
    {
        $this->reset(['error']);
        $this->resetErrorBag();

        $this->withValidator(function (Validator $validator) {
            if ($validator->fails()) {
                $this->dispatchBrowserEvent('close-modal', ['model' => 'error-dialog']);
                $this->dispatchBrowserEvent('open-modal', ['model' => 'error-dialog']);
            }
        })->validate();

        try {
            $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
            $number = $phoneUtil->parse($previous_bene['code'] . $previous_bene['phone'], $this->receiving_country['iso2']);
            $isValid = $phoneUtil->isValidNumber($number);
            if (!$isValid) {
                $this->addError('error', 'Please enter valid phone number.');
                return false;
            }
        } catch (Exception $exception) {
            $this->addError('selected_beneficiary.phone', 'Please enter valid phone number.');
            return false;
        }

        $duplicate = false;
        if (empty($previous_bene['id'])) {

            $duplicate = Beneficiary::where('country_id', $this->receiving_country['id'])
                ->when(!empty($this->customer_id) && ($this->customer_check), function ($q) {
                    return $q->where('customer_id', $this->customer_id);
                })
                ->where(function ($q) use ($previous_bene) {
                    return $q->orWhere(function ($w) use ($previous_bene) {
                        return $w->where('first_name', $previous_bene['first_name'])->where('last_name', $previous_bene['last_name']);
                    })->orWhere('phone', $previous_bene['phone']);
                })->exists();
        }

//        if ($duplicate) {
//            $this->addError('error', 'Duplication Alert! The beneficiary already exists. Please choose from the existing receiver list.');
//            $this->dispatchBrowserEvent('close-modal', ['model' => 'errors']);
//            $this->dispatchBrowserEvent('open-modal', ['model' => 'errors']);
//            return false;
//        }

        $bank_duplicate = BeneficiaryBank::join('beneficiaries as b', 'b.id', '=', 'beneficiary_banks.beneficiary_id')
            ->where('b.customer_id', $this->customer_id)
            ->where(function ($q) use ($previous_bene) {
                return $q->when(!empty($previous_bene['account_no']), function ($q) use ($previous_bene) {
                    $q->orWhere('account_no', $previous_bene['account_no']);
                })->when(!empty($previous_bene['iban']), function ($q) use ($previous_bene) {
                    $q->orWhere('iban', $previous_bene['iban']);
                });
            })->select('beneficiary_id')->first();

//        if (!empty($bank_duplicate)) {
//
//            $bene = Beneficiary::find($bank_duplicate['beneficiary_id']);
//
//            $this->addError('error', 'Duplication Alert! The bank details for the beneficiary named "' . $bene['first_name'] . ' ' . $bene['last_name'] . '" already exist. Please select from the existing options.');
//            $this->dispatchBrowserEvent('close-modal', ['model' => 'errors']);
//            $this->dispatchBrowserEvent('open-modal', ['model' => 'errors']);
//            return false;
//        }
        return true;
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
            $source->receiving_country_id = $this->receiving_country['id'];
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

    public function updatedSelectedBeneficiary($value, $name)
    {

        $name = explode('.', $name);
        if ($name[1] == 'bank_id') {
            $this->selected_beneficiary[$name[0]]['account_number'] = null;
        }
    }

    public function saveRequestForm()
    {

        foreach ($this->selected_beneficiary as $s) {
            if (!$this->validateBeneficiaryDetail($s)) {
                $this->addError('request_form', 'Invalid Beneficiary record found.');
            }
        }
        $this->details_completed['beneficiary'] = true;
        $this->success = null;
        $this->resetErrorBag();
        try {

            DB::beginTransaction();

            if (!\App\Models\Customer\CustomerDetail::where('customer_id', session('customer_id'))->where('is_introducer', 't')->exists()) {
                throw new Exception("You don't have the permission to perform this action.");
            }

            $details = $this->details_completed;
            unset($details['docs_found']);
            if (in_array(false, $details)) {
                throw new Exception('Please fill/confirm all the forms first');
            }

            $this->amounts['receive_amount'] = floatval(preg_replace("/[^0-9.]/", "", $this->amounts['receive_amount']));
            if ($this->amounts['receive_amount'] != array_sum(array_column($this->selected_beneficiary, 'receiving_amount'))) {
                throw new Exception('Total receiving amount must be equal to beneficiary receiving amount');
            }
            if (empty($this->customer_id)) {
                $customer = $this->customer;
                $user_id = User::create([
                    'email' => $customer['email'],
                    'password' => Hash::make('Abcd1234'),
                    'type' => 'on',
                    'status' => 't',
                    'company_id' => config('app.company_id'),
                ])->id;
                $customer['user_id'] = $user_id;
                $customer['status'] = 't';
                $customer['type'] = 'on';
                $customer['user_agent_id'] = session('user_agent_id');
                $customer['country_id'] = 232;
                unset($customer['country_name'], $customer['iso2'], $customer['password']);
                $customer_details = Customer::create($customer);
                $this->customer_id = $customer_details->id;
                CustomerDetail::create([
                    'customer_id' =>$this->customer_id,
                    'introducer_id' => session('customer_id')
                ]);
            } else {
                if ($this->customer['is_verified'] == 't') {
                    Customer::find($this->customer_id)->update(['phone' => $this->customer['phone']]);
                } else {
                    $update_customer = $this->customer;

                    unset($update_customer['country_name'], $update_customer['iso2'], $update_customer['email']);
                    Customer::find($this->customer_id)->update($update_customer);

                }
                $user_id = $this->customer['user_id'] ?? null;
            }
            if (!$this->details_completed['docs_found']) {
                $this->customer_documents['customer_id'] = $this->customer_id;
                $this->customer_documents['status'] = 't';
                CustomerDocument::create($this->customer_documents);
            }

            $introducer_batch_id = Str::uuid();
            foreach ($this->selected_beneficiary as $key => $bene) {
                $bene['customer_id'] = $this->customer_id;
                if (empty($this->existing_beneficiary_id[$key])) {
                    $bene_id = Beneficiary::create($this->beneficiaryMapping($bene))->id;
                } else {
                    $bene_id = $this->existing_beneficiary_id[$key];
                    Beneficiary::find($bene_id)->update($this->beneficiaryMapping($bene));
                }

                if (empty($this->existing_beneficiary_bank_id[$key])) {
                    $bank = BeneficiaryBank::create($this->beneficiaryBankMapping($bene, $bene_id));
                    $bene_bank_id = $bank->id;
                } else {
                    $bene_bank_id = $this->existing_beneficiary_bank_id[$key];
                    BeneficiaryBank::find($bene_bank_id)->update($this->beneficiaryBankMapping($bene, $bene_id));
                }
                $this->payments['status'] = 'PEN';
                $this->payments['customer_id'] = $this->customer_id;
                $this->payments['beneficiary_id'] = $bene_id;

                $sending_amount = $bene['receiving_amount'] / $this->user_customer_rate;


                if (floatval($this->user_customer_rate) > $this->high_rate['rate_after_spread']) {
                    $this->user_customer_rate = floatval($this->high_rate['rate_after_spread']);
                    $this->addError('user_customer_rate', 'Rate must not be higher than current exchange rate ' . (!empty($this->high_rate['rate_after_spread']) ? number_format($this->high_rate['rate_after_spread'], 2) . ' ' . $this->high_rate['currency'] : 0));
                    throw new Exception('Rate must not be higher than current exchange rate ' . (!empty($this->high_rate['rate_after_spread']) ? number_format($this->high_rate['rate_after_spread'], 2) . ' ' . $this->high_rate['currency'] : 0));
                }

                $transfer = Transfer::create([
                    'status' => $this->payments['status'],
                    'channel' => 'on',
                    'customer_id' => $this->customer_id,
                    'beneficiary_id' => $bene_id,
                    'beneficiary_bank_id' => $bene_bank_id,
                    'payer_id' => $this->selected_payer['id'],
                    'user_agent_id' => session('user_agent_id'),
                    'sending_currency' => $this->selected_payer['source_currency'],
                    'receiving_currency' => $this->selected_payer['currency'],
                    'sending_country_id' => session('country_id'),
                    'sending_country' => session('country_name'),
                    'receiving_country_id' => $this->receiving_country['id'],
                    'receiving_country' => $this->receiving_country['name'],
                    'customer_rate' => $this->user_customer_rate,
                    'agent_rate' => $this->selected_payer['rate_before_spread'],
                    'main_agent_rate' => $this->selected_payer['main_agent_rate'],
                    'sub_agent_rate' => !empty($this->selected_payer['sub_agent_rate'])? $this->selected_payer['sub_agent_rate']:0,
                    'sending_amount' => $sending_amount,
                    'receiving_amount' => $bene['receiving_amount'],
                    'agent_charges' => 0,
                    'company_charges' => $this->amounts['fees'],
                    'sending_method_id' => 91,
                    'gateway_id' => 3,
                    'sending_reason' => $bene['selected_sending_reason'],
                    'receiving_method_id' => $this->selected_payer['method_id'],
                    'user_id' => $user_id,
                    'company_id' => config('app.company_id'),
                    'payout_location_id' => $this->selected_cash_destination ?? null
                ]);

                $payer = Payer::find($this->selected_payer['id']);
                $number = rand(111111, 999999);
                $code = $payer['prefix'] . str_pad($transfer->id, 6, $number, STR_PAD_LEFT);

                Transfer::find($transfer->id)->update([
                    'transfer_code' => $code
                ]);

                StatusTracker::create([
                    'key' => 'PEN',
                    'caused_by' => session('customer_id'),
                    'subject_id' => $transfer->id
                ]);

                TransferDetail::create([
                    'transfer_id' => $transfer->id,
                    'coupon_id' => null,
                    'coupon_amount' => null,
                    'created_on' => 'w',
                    'fee_free_transfer_id' => null,
                    'source_of_fund' => $this->source_of_funds
                ]);

                $ip = isset($_SERVER['HTTP_CF_CONNECTING_IP']) ? $_SERVER['HTTP_CF_CONNECTING_IP'] : null;

                $device = \Jenssegers\Agent\Facades\Agent::device();
                $platform = \Jenssegers\Agent\Facades\Agent::platform();
                $browser = \Jenssegers\Agent\Facades\Agent::browser();
                $version = \Jenssegers\Agent\Facades\Agent::version($platform);

                TransferAdditionalDetail::create([
                    'transfer_id' => $transfer->id,
                    'ip' => $ip,
                    'device_details' => $device . ',' . $platform . ' (' . $version . '),' . $browser,
                    'introducer_id' => session('customer_id'),
                    'introducer_batch' => $introducer_batch_id,
                    'customer_rate_id' => optional($this->selected_payer)['customer_rate_id'] ?? null,
                ]);


                Ledger::create([
                    'user_id' => $user_id,
                    'debit' => $this->amounts['sending_amount'],
                    'credit' => 0,
                    'description' => 'INV ' . $transfer->id . '; Payment # ' . $code . '; Admin Charges ' . $this->amounts['fees'] . '; Sending Amount ' . $this->amounts['sending_amount'] . '; Rate ' . $this->selected_payer['rate_after_spread'],
                    'admin_charges' => $this->amounts['fees'],
                    'agent_charges' => 0,
                    'date' => date('Y-m-d'),
                    'added_by' => session('user_id')
                ]);
                $bank_data = BeneficiaryBank::where('id', $bene_bank_id)->first()->toArray();
                unset($bank_data['created_at'], $bank_data['status'], $bank_data['deleted_at'], $bank_data['updated_at'], $bank_data['id']);
                $bank_data['beneficiary_bank_id'] = $bene_bank_id;
                $bank_data['transfer_id'] = $transfer->id;
                TransferBeneficiaryBank::create($bank_data);
                $this->dumpBeneficiary($transfer, $bene);
                $this->dumpCustomer($transfer, $this->customer);

                if (env('APP_ENV') == 'production') {


                    $mail = (new TransferCreated($transfer, $this->customer_id))->onQueue('portal_' . config('app.company_id'))->afterCommit();
                    Mail::to($this->customer['email'])->queue($mail);


                    foreach (['admin@oriumglobalresources.com', 'bajwakaleem6@gmail.com'] as $email) {
                        $followup = (new TransferFollowUp($transfer))->onQueue('portal_' . config('app.company_id'))->afterCommit();
                        Mail::to($email)->queue($followup);
                    }
                }
            }

            DB::commit();
            redirect()->to('/paymentrequest')->with('form_success', 'Payment request form submitted successfully.');

        } catch (Exception $e) {
            DB::rollBack();
            $this->addError('request_form', $e->getMessage());
            if (!empty($this->customer_id) && (!Customer::where('id', $this->customer_id)->exists())) {
                $this->customer_id = null;
            }
        }
    }

    private function dumpBeneficiary($transfer, $bene)
    {
        $beneficiary = $this->beneficiaryMapping($bene);
        $beneficiary['beneficiary_id'] = $transfer->beneficiary_id;
        $beneficiary['transfer_id'] = $transfer->id;
        TransferBeneficiary::create($beneficiary);
    }

    private function dumpCustomer($transfer, $customer)
    {
        TransferCustomer::create([
            'transfer_id' => $transfer->id,
            'customer_id' => $this->customer_id,
            'first_name' => $customer['first_name'],
            'middle_name' => null,
            'last_name' => $customer['last_name'],
            'relation_id' => null,
            'relation_name' => null,
            'gender' => $customer['gender'],
            'dob' => $customer['dob'],
            'email' => $customer['email'],
            'phone' => $customer['phone'],
            'phone_code' => $customer['phone_code'],
            'city_name' => $customer['city_name'],
            'house_no' => $customer['house_no'],
            'street_name' => $customer['street_name'],
            'postal_code' => $customer['postal_code'],
            'city_id' => null,
            'country_id' => 232,
            'occupation' => null,
            'nationality_country_id' => null
        ]);
    }


    private function beneficiaryMapping($bene)
    {
        $first_name = preg_replace('/\s+/', ' ', $bene['first_name']);
        $last_name = preg_replace('/\s+/', ' ', $bene['last_name']);
        return [
            'customer_id' => $bene['customer_id'],
            'first_name' => $first_name,
            'last_name' => $last_name,
            'relationship_id' => $bene['relationship_id'],
            'nationality_country_id' => 161,
            'country_id' => 161,
            'phone' => $bene['phone'],
            'code' => $bene['code'],
            'type' => 'on'
        ];
    }

    private function beneficiaryBankMapping($bene, $bene_id)
    {
        return [
            'beneficiary_id' => $bene_id,
            'name' => optional(collect($this->sb_data)->where('id', $bene['bank_id'])->first())['name'] ?? null,
            'bank_id' => $bene['bank_id'],
            'code' => null,
            'branch_name' => null,
            'branch_code' => null,
            'account_no' => $bene['account_no'],
            'iban' => null,
            'ifsc' => null,
            'country_id' => null
        ];
    }

    public function render()
    {
        return view('livewire.inner.payment-introduction');
    }

    private function benelistData()
    {
        $data = Beneficiary::from('beneficiaries as b')
            ->join('countries as c', 'c.id', '=', 'b.country_id')
            ->when(!empty($this->bene_search_query), function ($q) {
                $q->where(function ($e) {
                    $e->orWhere('b.first_name', 'LIKE', '%' . $this->bene_search_query . '%')
                        ->orWhere('b.last_name', 'LIKE', '%' . $this->bene_search_query . '%');
                });
            })
            ->leftJoin('options as o', 'o.id', '=', 'b.relationship_id')
            ->where('b.customer_id', $this->customer_id)
            ->where('b.country_id', $this->receiving_country['id'])
            ->select([
                'b.id', 'b.customer_id', 'b.first_name', 'b.last_name', 'b.relationship_id', 'o.name as relationship_name', 'b.phone',
                'c.id as country_id', 'c.currency', 'c.name as country_name', 'c.iso2', 'c.phonecode as code'
            ])->get();

        if ($data->isEmpty()) {
            $this->bene_data = [];
        } else {
            $this->bene_data = $data->toArray();
        }
    }
}
