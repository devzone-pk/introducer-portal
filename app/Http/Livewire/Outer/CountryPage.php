<?php

namespace App\Http\Livewire\Outer;

use App\Models\Agent;
use App\Models\Country\Country;
use Devzone\Rms\AdminFee;
use Devzone\Rms\AllRates;
use Devzone\Rms\Source;
use Devzone\Rms\Traits\SourceRate;
use Exception;
use Livewire\Component;

class CountryPage extends Component
{
    public $receiving_iso2;
    public $sending_iso2;
    public $receiving_method_id;
    public $sending_country = [];
    public $receiving_country = [];
    public $sending = [];
    public $receiving = [];
    public $rates;
    public $receiving_methods = [];
    public $receiving_method;
    public $payers = [];
    public $selected_payer;
    public $payer_id;
    public $amounts = [
        'sending_amount' => 0,
        'receive_amount' => 0,
        'fees' => 0,
        'calculation_mode' => 'S',
        'total' => 0
    ];
    public $agent_user_id;
    public $high_rate = [
        'rate_after_spread' => 0
    ];
    public $error;
    public $iteration = 0;

    public function mount($iso)
    {
        $this->receiving_iso2 = strtoupper($iso);


        if (in_array($this->sending_iso2, ['GB', 'CA'])) {
            $this->sending_iso2 = $_SERVER['HTTP_CF_IPCOUNTRY'];
        } else {
            $this->sending_iso2 = 'GB';
        }

        $receiving = Country::where('is_on_receiving', 't')->select('id', 'name', 'currency', 'iso2', 'iso3')->get();
        $sending = Country::where('is_on_sending', 't')->select('id', 'name', 'currency', 'iso2', 'iso3')->get();
        $selected_sending = $sending->where('iso2', $this->sending_iso2)->first();
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

    public function render()
    {
        return view('livewire.outer.country-page');
    }


    public function proceed()
    {
        //return $this->redirect('/sign-up');
    }

    public function selectMethod($method)
    {
        $this->iteration++;

        $this->reset(['receiving_method', 'selected_payer', 'amounts', 'payers', 'payer_id']);
        $this->receiving_method = $method;

        if (strtolower($this->receiving_method) == 'cash') {
            $this->receiving_method_id = 8;
        } else if (strtolower($this->receiving_method) == 'bank') {
            $this->receiving_method_id = 7;
        } else if (strtolower($this->receiving_method) == 'mobile wallet') {
            $this->receiving_method_id = 173;
        }

        $this->getRates();
        //$this->calculateRate();
        $this->payers = collect($this->rates)->where('method_id', $this->receiving_method_id)->toArray();

        $this->dispatchBrowserEvent('refresh-select2');
    }


    public function updatedPayerId($val)
    {


        $this->reset(['amounts']);
        $this->selected_payer = collect($this->rates)->where('id', $val)->first();

        $this->amounts['sending_amount'] = 100;
        $this->amounts['receive_amount'] = round($this->selected_payer['rate_after_spread'] * 100, 2);
        $this->calculateRate();
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
}
