<?php

namespace App\Http\Livewire\Mobile;

use App\Models\Agent;
use App\Models\Country\Country;
use App\Models\Partner\Payer;
use App\Models\Partner\PayerValidation;
use App\Traits\Modals\PayerList;
use App\Traits\Modals\ReceivingCountries;
use App\Traits\Modals\ReceivingMethods;
use App\Traits\Modals\SendingMethods;
use Devzone\Rms\AdminFee;
use Devzone\Rms\AllRates;
use Devzone\Rms\Source;
use Illuminate\Validation\Validator;
use Livewire\Component;

class RateCalculator extends Component
{
    use ReceivingCountries, ReceivingMethods, PayerList, SendingMethods;

    public $receiving_country = [];  // Detail of country where customer will send money
    public $error;
    public $selected_sending_method = [];
    public $receiving_method; //selected receiving method detail like Bank,Cash
    public $receiving_methods = []; //possible list of all receiving methods
    public $receiving_method_id;
    public $payers = []; //list of all possible payers against receiving country
    public $selected_payer = []; //selected payer details
    protected $listeners = [
        'emit_receiving_country' => 'getReceivingMethods',
        'emit_receiving_methods' => 'getPayers',
        'emit_sending_methods' => 'setSendingMethod',
        'emit_payer_list' => 'setPayer',
        'emit_select_beneficiary' => 'selectBeneficiary',
        'documentAdded' => 'documentAdded',
        'addressUpdated' => 'addressUpdated',
        'profileUpdated' => 'profileUpdated',
        'profileDone' => 'profileDone',
        'addressDone' => 'addressDone',
        'documentDone' => 'documentDone',
        'resetErrors' => 'resetErrors',
        'handleBackNavigation' => 'handleBackNavigation'
    ];
    public $iteration = 0;
    public $validationAttributes = [
        'receiving_country.iso2' => 'receiving country',
        'receiving_method' => 'receiving method',
        'selected_payer.id' => 'payout',
        'amounts.total' => 'total amount',
        'amounts.sending_amount' => 'sending amount',
        'selected_beneficiary.first_name' => 'beneficiary first name',
        'selected_beneficiary.last_name' => 'beneficiary last name',
        'selected_beneficiary.phone' => 'beneficiary phone',
        'selected_beneficiary.code' => 'beneficiary phone code',
        'selected_beneficiary.relationship_id' => 'beneficiary relationship',
        'selected_bank_beneficiary.account_no' => 'account #',
        'selected_bank_beneficiary.iban' => 'iban',
        'selected_sending_method.id' => 'sending method',
        'selected_sending_reason.id' => 'sending reason',
        'selected_bank_beneficiary.bank_id' => 'bank',
        'selected_bank_beneficiary.name' => 'bank name',
        'selected_bank_beneficiary.ifsc' => 'ifsc code',
        'selected_bank_beneficiary.branch_name' => 'branch name'
    ];
    public $main_agent;
    public $rates;
    public $amounts = [
        'sending_amount' => 0,
        'receive_amount' => 0,
        'fees' => 0,
        'calculation_mode' => 'S',
        'total' => 0
    ];
    public $country;

    protected function rules()
    {
        return [
            'receiving_country.iso2' => 'required|string',
            'receiving_method' => 'required|string',
            'selected_payer.id' => 'required',
            'amounts.total' => 'required',
            'amounts.sending_amount' => 'required|string',
            'selected_sending_method.id' => 'required'
        ];
    }


    public function mount()
    {
        $agent = Agent::where('status', 't')
            ->where('country_id', '232')
            ->select('user_id', 'country_id')
            ->where('type', 'ma')->where('channel', 'on')->first();

        $this->main_agent = $agent['user_id'];
        $this->country = Country::find($agent['country_id']);
    }

    public function render()
    {
        return view('livewire.mobile.rate-calculator');
    }

    private function calculateRate()
    {
        $this->reset(['error']);
        $this->resetErrorBag();

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
                // $this->dispatchBrowserEvent('focus-out', ['id' => 'youSend']);
                $this->amounts['receive_amount'] = round($this->selected_payer['rate_after_spread'] * $this->amounts['sending_amount'], 2);
            } else {
                // $this->dispatchBrowserEvent('focus-out', ['id' => 'recipient_gets']);
                $this->amounts['sending_amount'] = round($this->amounts['receive_amount'] / $this->selected_payer['rate_after_spread'], 2);
            }

//            $this->validate([
//                'amounts.sending_amount' => 'required|numeric|gte:1',
//            ]);

            $source = new Source();
            $source->userAgentId = $this->main_agent;
            $source->destinationCountry = $this->receiving_country['iso2'];
            $source->payerId = $this->selected_payer['id'];
            $source->sourceAmount = $this->amounts['sending_amount'];
            $source->sourceCurrency = $this->selected_payer['source_currency'];
            $source->receiving_method_id = $this->receiving_method_id;
            //  dd($this->selected_sending_method);
            $source->sending_method_id = $this->selected_sending_method['sending_method_id'];

            $rates = new AdminFee($source);
            $fees = $rates->apply();
            $this->amounts['fees'] = round($fees, 2);
            $this->amounts['total'] = $fees + $this->amounts['sending_amount'];

            if ($this->amounts['calculation_mode'] == 'S') {
                $this->amounts['receive_amount'] = number_format($this->amounts['receive_amount'], 2);
                $this->amounts['sending_amount'] = number_format($this->amounts['sending_amount'], 2);
            } else {
                $this->amounts['sending_amount'] = number_format($this->amounts['sending_amount'], 2);
                $this->amounts['receive_amount'] = number_format($this->amounts['receive_amount'], 2);
            }

            if (!$this->payerLimits()) {
                $this->reset('amounts');
                return false;
            }


        } catch (\Exception $e) {
            $this->error = $e->getMessage();
            $this->addError('error', $e->getMessage());
            $this->feeLimitBreech();
            $this->reset('amounts');


        }
    }

    public function updatedAmountsReceiveAmount($value)
    {


        if (empty($value)) {
            $this->amounts['sending_amount'] = 1;
            $this->amounts['receive_amount'] = round($this->selected_payer['rate_after_spread'], 2);
            $this->calculateRate();
        } else {
            $this->amounts['calculation_mode'] = 'R';
            $this->calculateRate();
        }
    }

    public function validateSendingDetails()
    {
        $this->reset(['error']);
        $this->resetErrorBag();

        if (!$this->payerLimits()) {
            $this->dispatchBrowserEvent('close-modal', ['model' => 'error-dialog']);
            $this->dispatchBrowserEvent('open-modal', ['model' => 'error-dialog']);
            $this->reset('amounts');
            return false;
        }
        if (!empty($this->amounts['coupon_code'])) {
            if (!$this->validateCouponCode($this->amounts['coupon_code'])) {
                return false;
            }
        }


        $this->withValidator(function (Validator $validator) {
            if ($validator->fails()) {
                $this->dispatchBrowserEvent('close-modal', ['model' => 'error-dialog']);
                $this->dispatchBrowserEvent('open-modal', ['model' => 'error-dialog']);
                $this->color_amount = '';
                $this->color_beneficiary = '';
                $this->color_confirm = '';
            } else {
                $this->color_amount = 'success-tab';
                $this->color_beneficiary = '';
                $this->color_confirm = '';
            }
        })->validate();

        $this->dispatchBrowserEvent('close-modal', ['model' => 'exchangeActionSheet']);
        $this->selected_window = 'beneficiary';


    }

    public function getReceivingMethods()
    {

        try {

            $this->reset(['receiving_methods', 'receiving_method', 'payers', 'selected_payer', 'amounts']);
            if (empty($this->receiving_country['iso2'])) {

                throw new \Exception('Sending to country is required.');
            }
            $source = new Source();
            $source->userAgentId = $this->main_agent;
            $source->destinationCountry = $this->receiving_country['iso2'];
            $rates = new AllRates($source);
            $rates = $rates->rate();
            $this->rates = json_decode(json_encode($rates), true);

            $rates = collect($rates);
            $this->receiving_methods = array_unique($rates->pluck('method')->toArray());


        } catch (\Exception $e) {

            $this->error = $e->getMessage();
            $this->addError('error', $e->getMessage());
        }
    }

    public function getPayers()
    {
        if (empty($this->selected_sending_method)) {
            $this->addError('error', 'Sending method field is required.');
        } else {
            $this->reset(['payers', 'selected_payer', 'amounts', 'receiving_method_id']);


            if (strtolower($this->receiving_method) == 'cash') {
                $this->receiving_method_id = 8;
            } else if (strtolower($this->receiving_method) == 'bank') {
                $this->receiving_method_id = 7;
            } else if (strtolower($this->receiving_method) == 'mobile wallet') {
                $this->receiving_method_id = 173;
            }

            $source = new Source();
            $source->userAgentId = $this->main_agent;
            $source->destinationCountry = $this->receiving_country['iso2'];
            $source->receiving_method_id = $this->receiving_method_id;
            $source->sending_method_id = $this->selected_sending_method['sending_method_id'];

            $rates = new AllRates($source);
            $rates = $rates->rate();

            $this->rates = json_decode(json_encode($rates), true);

            $this->payers = collect($this->rates)->where('method', $this->receiving_method)->toArray();
        }
    }

    public function setPayer()
    {
        $this->iteration++;
        $this->reset(['amounts']);
        $this->selected_payer = collect($this->rates)->where('id', $this->selected_payer['id'])->first();
        $this->amounts['sending_amount'] = 1;
        $this->amounts['receive_amount'] = round($this->selected_payer['rate_after_spread'], 2);
        $this->validation = PayerValidation::where('payer_id', $this->selected_payer['id'])->get()->toArray();
        //$this->calculateRate();
    }

    public function setSendingMethod()
    {
        $this->reset(['receiving_method', 'selected_payer']);
    }

    public function updatedAmountsSendingAmount($value)
    {


        if (empty($value)) {
            $this->amounts['sending_amount'] = 1;
            $this->amounts['receive_amount'] = round($this->selected_payer['rate_after_spread'], 2);
            $this->calculateRate();
        } else {

            $this->amounts['calculation_mode'] = 'S';
            $this->calculateRate();
        }
    }

    private function feeLimitBreech()
    {
        if ($this->error = 'Fee is not configured.') {
            $payer = Payer::find($this->selected_payer['id']);
            $error_message = "You cannot send less than " . $payer['currency'] . ' ' . number_format($payer['min']) . ' or more than ' . $payer['currency'] . ' ' . number_format($payer['max']);
            $this->addError('amounts.receive_amount', $error_message);
            $this->reset('error');
        }
    }

    private function payerLimits()
    {
        $this->resetErrorBag();
        if (empty($this->selected_payer['id'])) {
            return true;
        }
        $receive_amount = preg_replace("/[^0-9.]/", "", $this->amounts['receive_amount']);//filter_var($this->amounts['sending_amount'], FILTER_SANITIZE_NUMBER_FLOAT);
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
}
