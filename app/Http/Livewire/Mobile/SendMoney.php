<?php

namespace App\Http\Livewire\Mobile;

use App\Mail\TransferCreated;
use App\Mail\TransferFollowUp;
use App\Models\Customer\Customer;
use App\Models\Partner\Payer;
use App\Models\Partner\PayerValidation;
use App\Models\Partner\Routing;
use App\Models\Transfer\Coupon;
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
use App\Traits\Modals\BeneficiaryBankList;
use App\Traits\Modals\BeneficiaryList;
use App\Traits\Modals\PayerList;
use App\Traits\Modals\ReceivingCountries;
use App\Traits\Modals\ReceivingMethods;
use App\Traits\Modals\Relationship;
use App\Traits\Modals\SearchBanks;
use App\Traits\Modals\SearchDestination;
use App\Traits\Modals\SendingMethods;
use App\Traits\Modals\SendingReasons;
use App\Traits\Modals\SourceFund;
use App\Traits\Validation\UserDocumentValidation;
use App\Traits\Validation\UserProfileValidation;
use App\Traits\Validation\ValidateFreeFeeOffer;
use Devzone\Rms\AdminFee;
use Devzone\Rms\AllRates;
use Devzone\Rms\Source;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Validator;
use Livewire\Component;

class SendMoney extends Component
{
    use ReceivingCountries, ReceivingMethods, PayerList, SourceFund,
        BeneficiaryList, Relationship, BeneficiaryBankList,
        SearchBanks, SendingMethods, SendingReasons, SearchDestination,
        UserProfileValidation, UserDocumentValidation,ValidateFreeFeeOffer;

    public $receiving_country = [];  // Detail of country where customer will send money
    public $receiving_method; //selected receiving method detail like Bank,Cash
    public $receiving_methods = []; //possible list of all receiving methods
    public $receiving_method_id;
    public $payers = []; //list of all possible payers against receiving country
    public $selected_payer = []; //selected payer details
    public $selected_beneficiary = [
        'name' => '',
        'first_name' => '',
        'last_name' => ''
    ];
    public $source_of_funds;
    public $branches = [];
    public $branch_search_query;
    public $routings = [];
    public $show_beneficiary = false;
    public $show_beneficiary_bank = false;
    public $selected_bank_beneficiary = [];
    public $selected_sending_method = [];
    public $selected_sending_reason = [];
    public $beneficiary_id;
    public $beneficiary_bank_id = null;
    public $selected_window = 'transfer';
    public $selected_window_profile = '';
    public $success_page;
    public $amounts = [
        'sending_amount' => 0,
        'receive_amount' => 0,
        'fees' => 0,
        'calculation_mode' => 'S',
        'total' => 0
    ];
    public $coupon = [
        'receive_amount' => 0,
        'id' => null
    ];
    public $selected_cash_destination = [];
    public $request;
    public $rates = [];
    public $validation = [];
    public $error;
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
        'handleBackNavigation' => 'handleBackNavigation',
        'emit_bank_selection' => 'bankSelection'
    ];
    protected $validationAttributes = [
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
        'selected_bank_beneficiary.branch_name' => 'branch name',
        'selected_bank_beneficiary.branch_code' => 'branch code',
        'selected_cash_destination.id' => 'Cash Pickup Location'
    ];
    public $payment_done;

    public $profile = false;
    public $address = false;
    public $documents = false;
    public $profile_tab = false;
    public $address_tab = false;
    public $documents_tab = false;
    public $color_amount;
    public $color_beneficiary;
    public $color_confirm;
    public $color_profile;
    public $color_address;
    public $iteration = 0;

    public function documentDone()
    {
        $this->documents = false;

    }

    public function addressDone()
    {
        $this->color_address = 'success-tab';
        $this->dispatchBrowserEvent('show-tab', ['tab' => 'documents']);
        $this->address = false;
    }

    public function profileDone()
    {
        $this->color_profile = 'success-tab';
        if ($this->address == true) {
            $this->dispatchBrowserEvent('show-tab', ['tab' => 'address']);
        } else {
            $this->dispatchBrowserEvent('show-tab', ['tab' => 'documents']);
        }

        $this->profile = false;
    }


    public function mount($request, $redirect = null)
    {
        $this->request = $request;
        $this->success_page = $redirect;

        $customer = Customer::where('id', session('customer_id'))->where('type', 'on')->first();

        $doc = $this->validateUserDocuments($customer);
        if ($doc['status'] != true) {
            $this->redirectTo = url('mobile/document/add') . '?incomplete=true';
        }

        if (!$this->validateUserAddress($customer)) {
            $this->redirectTo = url('mobile/address') . '?incomplete=true';
        }


        if (!$this->validateUserMobileProfile($customer)) {
            $this->redirectTo = url('mobile/profile') . '?incomplete=true';
        }
        $this->rcFetchData();

        if (count($this->rc_data) == 1) {
            $this->receiving_country = $this->rc_data[0];
            $this->getReceivingMethods();
        }

        $this->smfetchData();
        if (count($this->sm_data) == 1) {
            $this->selected_sending_method = $this->sm_data[0];
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

            if (count($this->receiving_methods) == 1) {
                $this->receiving_method = $this->receiving_methods[0];
                $this->getPayers();
            }

        } catch (\Exception $e) {

            $this->error = $e->getMessage();
            $this->addError('error', $e->getMessage());
        }
    }

    public function getPayers()
    {
        if (empty($this->selected_sending_method) && false) {
            $this->addError('error', 'Sending method field is required.');
        } else {
            $this->reset(['payers', 'selected_payer', 'amounts', 'receiving_method_id', 'selected_cash_destination']);


            if (strtolower($this->receiving_method) == 'cash') {
                $this->receiving_method_id = 8;
            } else if (strtolower($this->receiving_method) == 'bank') {
                $this->receiving_method_id = 7;
            } else if (strtolower($this->receiving_method) == 'mobile wallet') {
                $this->receiving_method_id = 173;
            }

            $source = new Source();
            $source->userAgentId = session('user_agent_id');
            $source->destinationCountry = $this->receiving_country['iso2'];
            $source->receiving_method_id = $this->receiving_method_id;
            // $source->sending_method_id = $this->selected_sending_method['sending_method_id'];
            $source->receiving_country_id = $this->receiving_country['id'];

            $rates = new AllRates($source);
            $rates = $rates->rate();

            $this->rates = json_decode(json_encode($rates), true);

            $this->payers = collect($this->rates)->where('method', $this->receiving_method)->toArray();

            if (count($this->payers) == 1) {
                $this->selected_payer = $this->payers[0];
                $this->setPayer();
            }
        }
    }

    public function setPayer()
    {
        $this->iteration++;
        $this->reset(['amounts', 'selected_cash_destination']);
        $this->selected_payer = collect($this->rates)->where('id', $this->selected_payer['id'])->first();
        $this->amounts['sending_amount'] = 1;
        $this->amounts['receive_amount'] = round($this->selected_payer['rate_after_spread'], 2);
        $this->validation = PayerValidation::where('payer_id', $this->selected_payer['id'])->get()->toArray();
        //$this->calculateRate();
        $this->sdfetchData();
    }

    public function setSendingMethod()
    {
        //$this->reset(['receiving_method', 'selected_payer']);
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

    public function updatedAmountsCouponCode($value)
    {
        $this->validateCouponCode($value);
    }

//sorted.
    public function bankSelection()
    {
        $this->reset('branches', 'routings', 'branch_search_query');
        $bank = $this->selected_bank_beneficiary;
        $this->selected_bank_beneficiary['branch_name'] = null;
        $this->selected_bank_beneficiary['branch_code'] = null;
        if (!empty($bank)) {
            $this->branches = Routing::where('bank_name', $bank['name'])->select('branch_name', 'dist_name')->orderBy('dist_name')->get()->groupBy('dist_name')->toArray();
        }
    }



    public function branchSelection($name)
    {
        $this->selected_bank_beneficiary['branch_code'] = null;

        if (!empty($name)) {
            $this->selected_bank_beneficiary['branch_name'] = $name;
            $this->routings = Routing::where('bank_name', $this->selected_bank_beneficiary['name'])->where('branch_name', $name)->select('code')->first()->toArray();
            $this->selected_bank_beneficiary['branch_code'] = $this->routings['code'];

        }

    }

    public function updatedBranchSearchQuery()
    {
        $this->branches = Routing::where('bank_name', $this->selected_bank_beneficiary['name'])
            ->when(!empty($this->branch_search_query), function ($q) {
                return $q->where(function ($query) {
                    $query->orWhere('branch_name', 'LIKE', '%' . $this->branch_search_query . '%')
                        ->orWhere('dist_name', 'LIKE', '%' . $this->branch_search_query . '%');
                });
            })->select('branch_name', 'dist_name')->orderBy('dist_name')->get()->groupBy('dist_name')->toArray();
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
            $source->userAgentId = session('user_agent_id');
            $source->destinationCountry = $this->receiving_country['iso2'];
            $source->payerId = $this->selected_payer['id'];
            $source->sourceAmount = $this->amounts['sending_amount'];
            $source->sourceCurrency = $this->selected_payer['source_currency'];
            $source->receiving_method_id = $this->receiving_method_id;
            //  dd($this->selected_sending_method);
            //$source->sending_method_id = $this->selected_sending_method['sending_method_id'];

            $rates = new AdminFee($source);
            $fees = $rates->apply();

            $this->validateFreeFeeOffer();
            if ($this->free_fee_offer['status'] && !empty($this->free_fee_offer['id']) && $fees > 0) {
                $this->free_fee_offer['save'] = $fees;
                if (!empty($this->free_fee_offer['percentage'])) {
                    $dis = round(($fees * ($this->free_fee_offer['percentage'] / 100)), 2);
                    $fees = $fees - $dis;
                } else {
                    $fees = 0;
                }
            }
            $this->amounts['fees'] = round($fees, 2);
            $this->amounts['total'] = $fees + $this->amounts['sending_amount'];

            if ($this->amounts['calculation_mode'] == 'S') {
                $this->amounts['receive_amount'] = number_format($this->amounts['receive_amount'], 2);
//                $this->amounts['sending_amount'] = number_format($this->amounts['sending_amount']);
            } else {
                $this->amounts['sending_amount'] = number_format($this->amounts['sending_amount'], 2);
//                $this->amounts['receive_amount'] = number_format($this->amounts['receive_amount']);
            }

            if (!$this->payerLimits()) {
              //  $this->reset('amounts');
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
            //$this->reset('amounts');
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

    public function addNewBeneficiary()
    {
        $this->reset(['selected_beneficiary', 'selected_bank_beneficiary']);
        $this->selected_beneficiary['code'] = $this->receiving_country['phonecode'];
        $this->show_beneficiary = true;
    }

    public function selectBeneficiary()
    {
        $this->error = '';
        $this->reset(['selected_bank_beneficiary']);
        if ($this->receiving_country['id'] != $this->selected_beneficiary['country_id']) {
            $this->error = 'Please choose beneficiary from ' . $this->receiving_country['name'];
            $this->reset(['selected_beneficiary']);
        }
        $this->show_beneficiary = true;
    }

    public function sendMoney()
    {
        $this->resetErrorBag();
        $this->reset(['profile', 'address', 'documents']);
        if (!$this->payerLimits()) {
            $this->dispatchBrowserEvent('close-modal', ['model' => 'error-dialog']);
            $this->dispatchBrowserEvent('open-modal', ['model' => 'error-dialog']);
           // $this->reset('amounts');
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
            }
        })->validate();

        try {
            $this->reset(['error']);

            DB::beginTransaction();
            $customer = Customer::where('id', session('customer_id'))->where('type', 'on')->first();

            $this->validateUserProfile($customer);
            $this->validateUserDocuments($customer);

            if ($this->documents || $this->profile || $this->address) {

                if ($this->profile == true) {
                    $this->dispatchBrowserEvent('show-tab', ['tab' => 'profile']);
                }
                if ($this->profile == false && $this->address == true) {
                    $this->dispatchBrowserEvent('show-tab', ['tab' => 'address']);
                }
                if ($this->profile == false && $this->address == false && $this->documents == true) {

                    $this->dispatchBrowserEvent('show-tab', ['tab' => 'documents']);
                }


                return;
            }


            $this->validateRates();

            if (empty($this->selected_beneficiary['id'])) {
                $beneficiary = Beneficiary::create($this->beneficiaryMapping());
                $this->beneficiary_id = $beneficiary->id;

                //$mail = (new BeneficiaryCreated($this->beneficiaryMapping()))->onQueue('portal_' . config('app.company_id'))->afterCommit();
                //Mail::to(session('email'))->queue($mail);
            } else {

                $this->beneficiary_id = $this->selected_beneficiary['id'];
                $old_bene = optional(Beneficiary::find($this->beneficiary_id))->toArray();
                Beneficiary::where('id', $this->beneficiary_id)->update($this->beneficiaryMapping());

                $new = $this->beneficiaryMapping();
                if ($old_bene['first_name'] != $new['first_name'] || $old_bene['last_name'] != $new['last_name'] || $old_bene['phone'] != $new['phone'] || $old_bene['relationship_id'] != $new['relationship_id']) {
                    //$mail = (new BeneficiaryNameChanged($old_bene, $this->beneficiaryMapping()))->onQueue('portal_' . config('app.company_id'))->afterCommit();
                    // Mail::to(session('email'))->queue($mail);
                }

            }


            if (strtolower($this->receiving_method) == 'bank') {
                if (empty($this->selected_bank_beneficiary['id'])) {
                    $bank = BeneficiaryBank::create($this->beneficiaryBankMapping());
                    $this->beneficiary_bank_id = $bank->id;
                } else {
                    $this->beneficiary_bank_id = $this->selected_bank_beneficiary['id'];
                    BeneficiaryBank::where('id', $this->selected_bank_beneficiary['id'])->update($this->beneficiaryBankMapping());
                }
            }

            $status = 'PEN';

            if ($this->selected_sending_method['sending_method_id'] == '96' || $this->selected_sending_method['sending_method_id'] == '97') {
                $status = 'INC';
            }

            $transfer = Transfer::create([
                'status' => $status,
                'channel' => 'on',
                'customer_id' => session('customer_id'),
                'beneficiary_id' => $this->beneficiary_id,
                'beneficiary_bank_id' => $this->beneficiary_bank_id,
                'payer_id' => $this->selected_payer['id'],
                'user_agent_id' => session('user_agent_id'),
                'sending_currency' => $this->selected_payer['source_currency'],
                'receiving_currency' => $this->selected_payer['currency'],
                'sending_country_id' => session('country_id'),
                'sending_country' => session('country_name'),
                'receiving_country_id' => $this->receiving_country['id'],
                'receiving_country' => $this->receiving_country['name'],
                'customer_rate' => $this->selected_payer['rate_after_spread'],
                'agent_rate' => $this->selected_payer['rate_before_spread'],
                'main_agent_rate' => $this->selected_payer['main_agent_rate'],
                'sub_agent_rate' => !empty($this->selected_payer['sub_agent_rate'])? $this->selected_payer['sub_agent_rate']:0,
                'sending_amount' => $this->amounts['sending_amount'],
                'receiving_amount' => $this->amounts['receive_amount'] + $this->coupon['receive_amount'],
                'agent_charges' => 0,
                'company_charges' => $this->amounts['fees'],
                'sending_method_id' => $this->selected_sending_method['sending_method_id'],
                'gateway_id' => $this->selected_sending_method['id'],
                'sending_reason' => $this->selected_sending_reason['id'],
                'receiving_method_id' => $this->selected_payer['method_id'],
                'user_id' => $this->request['user_id'],
                'company_id' => config('app.company_id'),
                'payout_location_id' => $this->selected_cash_destination['id'] ?? null
            ]);

            StatusTracker::create([
                'key' => $status,
                'caused_by' => $this->request['user_id'],
                'subject_id' => $transfer->id
            ]);

            if (strtolower($this->receiving_method) == 'bank') {
                $this->dumpBeneficiaryBank($transfer);
            }

            $payer = Payer::find($this->selected_payer['id']);
            $number = rand(111111, 999999);
            $code = $payer['prefix'] . str_pad($transfer->id, 6, $number, STR_PAD_LEFT);


            Transfer::find($transfer->id)->update([
                'transfer_code' => $code
            ]);

            TransferDetail::create([
                'transfer_id' => $transfer->id,
                'coupon_id' => $this->coupon['id'],
                'coupon_amount' => $this->coupon['receive_amount'],
                'created_on' => 'm',
                'fee_free_transfer_id' => $this->free_fee_offer['id'],
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
                'customer_rate_id' => optional($this->selected_payer)['customer_rate_id'] ?? null,
            ]);


            Ledger::create([
                'user_id' => session('user_id'),
                'debit' => $this->amounts['sending_amount'] + $this->amounts['fees'],
                'credit' => 0,
                'description' => 'INV ' . $transfer->id . '; Payment # ' . $code . '; Admin Charges ' . $this->amounts['fees'] . '; Sending Amount ' . $this->amounts['sending_amount'] . '; Rate ' . $this->selected_payer['rate_after_spread'],
                'admin_charges' => $this->amounts['fees'],
                'agent_charges' => 0,
                'date' => date('Y-m-d'),
                'added_by' => session('user_id')
            ]);

            if ($this->coupon['receive_amount'] > 0) {
                Ledger::create([
                    'user_id' => session('user_id'),
                    'debit' => $this->coupon['receive_amount'],
                    'credit' => 0,
                    'description' => 'INV ' . $transfer->id . '; Payment # ' . $code . '; Coupon Code ' . $this->coupon['coupon_code'] . '; Type ' . $this->coupon['disc_type'] . '; Value ' . $this->coupon['value'],
                    'admin_charges' => 0,
                    'agent_charges' => 0,
                    'date' => date('Y-m-d'),
                    'added_by' => session('user_id')
                ]);
            }

            $this->dumpBeneficiary($transfer);
            $this->dumpCustomer($transfer, $customer);


            if (env('APP_ENV') == 'production') {


                $mail = (new TransferCreated($transfer, session('customer_id')))->onQueue('portal_' . config('app.company_id'))->afterCommit();
                Mail::to(session('email'))->queue($mail);


                foreach (['admin@oriumglobalresources.com', 'bajwakaleem6@gmail.com'] as $email) {
                    $followup = (new TransferFollowUp($transfer))->onQueue('portal_' . config('app.company_id'))->afterCommit();
                    Mail::to($email)->queue($followup);
                }
            }

            DB::commit();

            //redirect to payment gateway


            if (!empty($this->selected_sending_method['redirect_uri'])) {
                if ($this->selected_sending_method['gateway_code'] == 'online-transfer') {
                    return $this->redirect('/mobile/transfer/success?transfer_code=' . $code);
                } else {
                    return $this->redirect($this->selected_sending_method['redirect_uri'] . $code);
                }
            } else {
                return $this->redirect('/mobile/transfer/success?transfer_code=' . $code);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            $this->reset('amounts');
            $this->addError('error', $e->getMessage());
            $this->error = $e->getMessage();
            $this->feeLimitBreech();
            $this->dispatchBrowserEvent('close-modal', ['model' => 'error-dialog']);
            $this->dispatchBrowserEvent('open-modal', ['model' => 'error-dialog']);
        }
    }

    private function validateRates()
    {


        $this->amounts['sending_amount'] = preg_replace("/[^0-9.]/", "", $this->amounts['sending_amount']);
        $this->amounts['receive_amount'] = preg_replace("/[^0-9.]/", "", $this->amounts['receive_amount']);
        $this->amounts['fees'] = preg_replace("/[^0-9.]/", "", $this->amounts['fees']);
        $this->amounts['total'] = preg_replace("/[^0-9.]/", "", $this->amounts['total']);


        $source = new Source();
        $source->userAgentId = session('user_agent_id');
        $source->destinationCountry = $this->receiving_country['iso2'];
        $source->payerId = $this->selected_payer['id'];
        $source->receiving_method_id = $this->receiving_method_id;
        //$source->sending_method_id = $this->selected_sending_method['sending_method_id'];
        $source->receiving_country_id = $this->receiving_country['id'];

        $rates = new AllRates($source);
        $rates = $rates->rate();
        if (empty($rates)) {
            throw new \Exception('Payer not found. Please try again.');
        }
        $rates = json_decode(json_encode($rates[0]), true);
        if (round($rates['rate_after_spread'], 2) != round($this->selected_payer['rate_after_spread'], 2)) {
            throw new \Exception('New rate has been updated. Please try again.');
        }

        if ($this->amounts['calculation_mode'] == 'S') {
            $sending_amount = $this->amounts['sending_amount'];
            $receiving_amount = round($rates['rate_after_spread'] * $sending_amount, 2);
        } else {
            $receiving_amount = $this->amounts['receive_amount'];
            $sending_amount = round($receiving_amount / $rates['rate_after_spread'], 2);
        }

        if ($receiving_amount != $this->amounts['receive_amount']) {
            throw new \Exception("New rate has been updated. Please try again.");
        }


        $source = new Source();
        $source->userAgentId = session('user_agent_id');
        $source->destinationCountry = $this->receiving_country['iso2'];
        $source->payerId = $this->selected_payer['id'];
        $source->sourceAmount = $this->amounts['sending_amount'];
        $source->sourceCurrency = $this->selected_payer['source_currency'];
        $source->receiving_method_id = $this->receiving_method_id;
        //$source->sending_method_id = $this->selected_sending_method['sending_method_id'];
        $rates = new AdminFee($source);
        $fees = $rates->apply();
        $this->validateFreeFeeOffer();
        if ($this->free_fee_offer['status'] && !empty($this->free_fee_offer['id']) && $fees > 0) {
            $this->free_fee_offer['save'] = $fees;
            if (!empty($this->free_fee_offer['percentage'])) {
                $dis = round(($fees * ($this->free_fee_offer['percentage'] / 100)), 2);
                $fees = $fees - $dis;
            } else {
                $fees = 0;
            }
        }

        if (round($this->amounts['fees'], 2) != round($fees, 2)) {
            throw new \Exception('New fees has been updated against your sending amount. Please try again');
        }


        if ($this->amounts['total'] != $sending_amount + $fees) {
            throw new \Exception("New rate has been updated. Please try again.");
        }


    }

    private function beneficiaryMapping()
    {
        $first_name = preg_replace('/\s+/', ' ', $this->selected_beneficiary['first_name']);
        $last_name = preg_replace('/\s+/', ' ', $this->selected_beneficiary['last_name']);
        return [
            'customer_id' => session('customer_id'),
            'first_name' => $first_name,
            'last_name' => $last_name,
            'relationship_id' => $this->selected_beneficiary['relationship_id'],
            'nationality_country_id' => $this->selected_payer['country_id'],
            'country_id' => $this->selected_payer['country_id'],
            'phone' => $this->selected_beneficiary['phone'],
            'code' => $this->selected_beneficiary['code'],
            'type' => 'on'
        ];
    }

    private function beneficiaryBankMapping()
    {
        return [
            'beneficiary_id' => $this->beneficiary_id,
            'name' => $this->selected_bank_beneficiary['name'],
            'bank_id' => $this->selected_bank_beneficiary['bank_id'],
            'code' => $this->selected_bank_beneficiary['code'] ?? null,
            'branch_name' => $this->selected_bank_beneficiary['branch_name'] ?? null,
            'branch_code' => $this->selected_bank_beneficiary['branch_code'] ?? null,
            'account_no' => $this->selected_bank_beneficiary['account_no'] ?? null,
            'ifsc' => $this->selected_bank_beneficiary['ifsc'] ?? null,
            'iban' => $this->selected_bank_beneficiary['iban'] ?? null,
            'country_id' => $this->receiving_country['id']
        ];
    }

    private function dumpBeneficiaryBank($transfer)
    {
        $beneficiary_bank = $this->beneficiaryBankMapping();
        $beneficiary_bank['beneficiary_bank_id'] = $transfer->beneficiary_bank_id;
        $beneficiary_bank['transfer_id'] = $transfer->id;
        TransferBeneficiaryBank::create($beneficiary_bank);
    }

    private function dumpBeneficiary($transfer)
    {
        $beneficiary = $this->beneficiaryMapping();
        $beneficiary['beneficiary_id'] = $transfer->beneficiary_id;
        $beneficiary['transfer_id'] = $transfer->id;
        TransferBeneficiary::create($beneficiary);
    }

    private function dumpCustomer($transfer, $customer)
    {
        TransferCustomer::create([
            'transfer_id' => $transfer->id,
            'customer_id' => $customer->id,
            'first_name' => $customer->first_name,
            'middle_name' => $customer->middle_name,
            'last_name' => $customer->last_name,
            'relation_id' => $customer->relation_id,
            'relation_name' => $customer->relation_name,
            'gender' => $customer->gender,
            'dob' => $customer->dob,
            'email' => $customer->email,
            'phone' => $customer->phone,
            'phone_code' => $customer->phone_code,
            'house_no' => $customer->house_no,
            'street_name' => $customer->street_name,
            'postal_code' => $customer->postal_code,
            'city_name' => $customer->city_name,
            'city_id' => $customer->city_id,
            'country_id' => $customer->country_id,
            'occupation' => $customer->occupation,
            'nationality_country_id' => $customer->nationality_country_id
        ]);

    }

    public function addNewBeneficiaryBank()
    {
        $this->reset(['selected_bank_beneficiary']);
        $this->show_beneficiary_bank = true;
    }

    public function validateBeneficiaryDetail()
    {
        $this->reset(['error']);
        $this->withValidator(function (Validator $validator) {
            if ($validator->fails()) {
                $this->dispatchBrowserEvent('close-modal', ['model' => 'error-dialog']);
                $this->dispatchBrowserEvent('open-modal', ['model' => 'error-dialog']);
                if (strtolower($this->receiving_method) == 'cash') {
                    $this->color_beneficiary = '';
                    $this->color_confirm = '';
                }
            } else {
                if (strtolower($this->receiving_method) == 'cash') {
                    $this->color_beneficiary = 'success-tab';
                    $this->color_confirm = '';
                }
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
                ->where('customer_id',session('customer_id'))
                ->where(function ($q) {
                    return $q->orWhere(function ($w) {
                        return $w->where('first_name', $this->selected_beneficiary['first_name'])->where('last_name', $this->selected_beneficiary['last_name']);
                    })
                        ->orWhere('phone', $this->selected_beneficiary['phone']);
                })->exists();

            if ($duplicate) {
                $this->addError('selected_beneficiary.phone', 'Duplication Alert! The beneficiary already exists. Please choose from the existing receiver list.');
                $this->dispatchBrowserEvent('close-modal', ['model' => 'errors']);
                $this->dispatchBrowserEvent('open-modal', ['model' => 'errors']);
                return;
            }
        }

        //$this->dispatchBrowserEvent('goUp');
        if (strtolower($this->receiving_method) == 'bank') {
            $this->selected_window = 'bank';
        } else {
            $this->selected_window = 'confirm';
        }
    }

    public function validateBeneficiaryBankDetail()
    {
        $this->reset(['error']);
        $this->withValidator(function (Validator $validator) {
            if ($validator->fails()) {
                $this->dispatchBrowserEvent('close-modal', ['model' => 'error-dialog']);
                $this->dispatchBrowserEvent('open-modal', ['model' => 'error-dialog']);
                $this->color_beneficiary = '';
                $this->color_confirm = '';
            } else {
                $this->color_beneficiary = 'success-tab';
                $this->color_confirm = '';
            }
        })->validate();
        //  $this->dispatchBrowserEvent('goUp');
        if (empty($this->selected_bank_beneficiary['id']) && (!empty($this->selected_bank_beneficiary['iban']) || !empty($this->selected_bank_beneficiary['account_no']))) {
            $bene_ids = Beneficiary::where('customer_id', session('customer_id'))
                ->select('id')->get();

            if ($bene_ids->isNotEmpty()) {
                $bene_ids = $bene_ids->pluck('id')->toArray();

                $duplicate = BeneficiaryBank::whereIn('beneficiary_id', $bene_ids)
                    ->join('beneficiaries as b','b.id','=','beneficiary_banks.beneficiary_id')
                    ->where('b.customer_id',session('customer_id'))
                    ->where(function ($q) {
                        return $q->when(!empty($this->selected_bank_beneficiary['account_no']), function ($q) {
                            $q->orWhere('account_no', $this->selected_bank_beneficiary['account_no']);
                        })->when(!empty($this->selected_bank_beneficiary['iban']), function ($q) {
                            $q->orWhere('iban', $this->selected_bank_beneficiary['iban']);
                        });
                    })->select('beneficiary_id')->first();

                if (!empty($duplicate)) {

                    $bene = Beneficiary::find($duplicate['beneficiary_id']);

                    $this->addError('selected_bank_beneficiary.id', 'Duplication Alert! The bank details for the beneficiary named "' . $bene['first_name'] . ' ' . $bene['last_name'] . '" already exist. Please select from the existing options.');
                    $this->dispatchBrowserEvent('close-canvas', ['model' => 'errors']);
                    $this->dispatchBrowserEvent('open-canvas', ['model' => 'errors']);
                    return;
                }
            }
        }
        $this->selected_window = 'confirm';
    }

    public function goTo($window)
    {

        if ($this->selected_window == 'transfer') {
            $this->validateSendingDetails();
        }

        if ($this->selected_window == 'beneficiary') {
            $this->validateBeneficiaryDetail();
        }

        if ($this->selected_window == 'bank') {
            $this->validateBeneficiaryBankDetail();
        }


        if (strtolower($this->receiving_method) != 'bank') {
            if ($window == 'bank') {
                $this->selected_window = 'beneficiary';
            } else {
                $this->selected_window = $window;
            }
        } else {
            $this->selected_window = $window;
        }

    }

    public function handleBackNavigation()
    {


        if ($this->selected_window == 'confirm') {
            if (strtolower($this->receiving_method) == 'bank') {
                $this->selected_window = 'bank';
            } else {
                $this->selected_window = 'beneficiary';
            }
            return;
        }

        if ($this->selected_window == 'bank') {
            $this->selected_window = 'beneficiary';
        } elseif ($this->selected_window == 'beneficiary') {
            $this->selected_window = 'transfer';
        } elseif ($this->selected_window == 'transfer') {
            return $this->redirect('/mobile/dashboard');
        }


    }

    protected function rules()
    {
        $rules = [];
        if ($this->selected_window == 'transfer') {
            $rules = [
                'receiving_country.iso2' => 'required|string',
                'receiving_method' => 'required|string',
                'selected_payer.id' => 'required',
                'amounts.total' => 'required',
                'amounts.sending_amount' => 'required|string',
//                'selected_sending_method.id' => 'required'
            ];
            if (strtolower($this->receiving_method) == 'cash') {
                $rules['selected_cash_destination.id'] = 'required';
            }
        }
        if ($this->selected_window == 'beneficiary') {
            $rules = [
                'selected_beneficiary.first_name' => 'required|string|regex:/^[a-zA-Z\s]*$/',
                'selected_beneficiary.last_name' => 'required|string|regex:/^[a-zA-Z\s]*$/',
                'selected_beneficiary.phone' => 'required|regex:/^[0-9]+$/',
                'selected_beneficiary.code' => 'required|string|regex:/^[0-9+\-]+$/',
                'selected_beneficiary.relationship_id' => 'required',
                'selected_sending_reason.id' => 'required',
            ];
        }
        if ($this->selected_window == 'bank') {
            //TODO need to update rules dynamically here and confirm section also
            $rules = [
                'selected_bank_beneficiary.name' => 'required|string',
                'selected_bank_beneficiary.bank_id' => 'required',
            ];
            foreach ($this->validation as $r) {
                $rules['selected_bank_beneficiary.' . $r['name']] = $r['validation'];
            }

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
                'selected_sending_reason.id' => 'required',
                'source_of_funds' => 'required'
            ];
            if (!empty($this->receiving_method)) {
                if (strtolower($this->receiving_method) == 'bank') {
                    $rules['selected_bank_beneficiary.name'] = 'required|string';
                    $rules['selected_bank_beneficiary.bank_id'] = 'required';
                    foreach ($this->validation as $r) {
                        $rules['selected_bank_beneficiary.' . $r['name']] = $r['validation'];
                    }
                }

                if (strtolower($this->receiving_method) == 'cash') {
                    $rules['selected_cash_destination.id'] = 'required';
                }
            }
        }
        return $rules;
    }

    public function render()
    {
        return view('livewire.mobile.send-money');
    }

    public function resetErrors()
    {
        $this->resetErrorBag();
        $this->resetValidation();
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

    private function validateCouponCode($value)
    {
        $this->reset('coupon');
        $this->calculateRate();
        $sending_amount = preg_replace("/[^0-9.]/", "", $this->amounts['sending_amount']); //filter_var($this->amounts['sending_amount'], FILTER_SANITIZE_NUMBER_FLOAT);

        Log::error('coupon ' . $value, [
            'amount' => $sending_amount,
            'receiving_c' => $this->receiving_country['id'],
            'session' => session()->all(),
            // 'sen_me' => $this->selected_sending_method['sending_method_id'],
            'rec_me' => $this->receiving_method_id
        ]);

        $coupon = Coupon::where('company_id', config('app.company_id'))
            ->where('coupon_code', $value)
            ->where('expire_at', '>=', date('Y-m-d'))
            ->where('start_at', '<=', date('Y-m-d'))
            ->whereNull('deleted_at')
            ->where('min_sending_amount', '<=', $sending_amount)
            ->where(function ($q) {
                return $q->orWhere('customer_id', session('customer_id'))
                    ->orWhereNull('customer_id');
            })
            ->where(function ($q) {
                return $q->orWhere('sending_country_id', session('country_id'))
                    ->orWhere('sending_country_id', '0')->orWhereNull('sending_country_id');
            })
            ->where(function ($q) {
                return $q->orWhere('receiving_country_id', $this->receiving_country['id'])
                    ->orWhere('receiving_country_id', '0')->orWhereNull('receiving_country_id');
            })
            // ->where(function ($q) {
            //     return $q->orWhere('sending_method_id', $this->selected_sending_method['sending_method_id'])
            //         ->orWhere('sending_method_id', '0')->orWhereNull('sending_method_id');
            // })
            ->where(function ($q) {
                return $q->orWhere('receiving_method_id', $this->receiving_method_id)
                    ->orWhere('receiving_method_id', '0')->orWhereNull('receiving_method_id');
            })
            ->select(
                'coupon_code',
                'id',
                'disc_type',
                'value'
                )
            ->get();


        if ($coupon->isEmpty()) {
            $this->addError('error', 'Invalid coupon code.');
            $this->dispatchBrowserEvent('close-modal', ['model' => 'error-dialog']);
            $this->dispatchBrowserEvent('open-modal', ['model' => 'error-dialog']);
            return false;
        }

        $coupon = $coupon->first()->toArray();

        $old = Transfer::from('transfers as t')
            ->join('transfer_details as td', 'td.transfer_id', '=', 't.id')
            ->where('t.customer_id', session('customer_id'))
            ->where('td.coupon_id', $coupon['id'])
            ->exists();

        if ($old) {
            $this->addError('error', 'You have already redeemed this coupon.');
            $this->dispatchBrowserEvent('close-modal', ['model' => 'error-dialog']);
            $this->dispatchBrowserEvent('open-modal', ['model' => 'error-dialog']);
            return false;
        }

        $this->coupon = $coupon;

        if ($coupon['disc_type'] == 'flat') {
            $receiving_amount = $this->selected_payer['rate_after_spread'] * $coupon['value'];
            $this->coupon['receive_amount'] = $receiving_amount;
        } else {
            $receiving_amount = $this->selected_payer['rate_after_spread'] * ($this->amounts['sending_amount'] * ($coupon['value'] / 100));
            $this->coupon['receive_amount'] = $receiving_amount;
        }

        return true;
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

}
