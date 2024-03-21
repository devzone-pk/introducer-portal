<?php

namespace App\Http\Livewire\Mobile;

use App\Models\Country\Country;
use App\Models\Customer\Customer;
use App\Models\Transfer\Transfer;
use App\Traits\Modals\ReceivingCountries;
use Devzone\Rms\AllRates;
use Devzone\Rms\Source;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TodayRates extends Component
{
    use ReceivingCountries;

    public $country = [];
    public $high_rate = [
        'rate_after_spread' => 0,
        'currency' =>''
    ];
    public $total_transactions;
    public $incomplete;

    public function mount()
    {
        $customer = Customer::find(session('customer_id'));
        $this->country = Country::find($customer['send_money_to']);

        $this->total_transactions = Transfer::whereNotIn('status', ['REF', 'CAN', 'INC', 'PEN'])
            ->where('customer_id', session('customer_id'))
            ->select(DB::raw('count(id) as total'), DB::raw('sum(sending_amount) as total_amount'))->first();

        $this->incomplete = Transfer::whereIn('status', ['INC'])
            ->where('customer_id', session('customer_id'))->count();
    }

    public function render()
    {

        $this->reset('high_rate');
        $source = new Source();
        $source->userAgentId = session('user_agent_id');
        $source->destinationCountry = $this->country['iso2'];
        $source->receiving_country_id = $this->country['id'];


        $rates = new AllRates($source);
        $rates = $rates->rate();
        $rates = json_decode(json_encode($rates), true);

        $rates = collect($rates);

        foreach ($rates as $r) {
            if ($this->high_rate['rate_after_spread'] < $r['rate_after_spread']) {
                $this->high_rate = $r;
            }
        }
        return view('livewire.mobile.today-rates');
    }
}
