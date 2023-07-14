<?php

namespace App\Http\Livewire\Inner;

use App\Models\Country\Country;
use App\Models\Customer\Customer;
use App\Models\Promotion;
use App\Models\Transfer\Transfer;
use App\Traits\Modals\ReceivingCountries;
use App\Traits\Validation\UserDocumentValidation;
use Carbon\Carbon;
use Devzone\Rms\AllRates;
use Devzone\Rms\Source;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    use ReceivingCountries, UserDocumentValidation;

    public $country = [];
    public $country_id;
    public $high_rate = [
        'rate_after_spread' => 0
    ];
    public $method;
    public $total_transactions;
    public $incomplete;
    public $address_completed = false;
    public $documents_completed = false;

    public function mount()
    {
        $customer = Customer::find(session('customer_id'));
        $this->country = Country::find($customer['send_money_to']);
        $this->rcFetchData();
        $this->total_transactions = Transfer::whereNotIn('status', ['REF', 'CAN', 'INC', 'PEN'])
            ->where('customer_id', session('customer_id'))
            ->select(DB::raw('count(id) as total'), DB::raw('sum(sending_amount) as total_amount'))->first();

        $this->incomplete = Transfer::whereIn('status', ['INC'])
            ->where('customer_id', session('customer_id'))->count();

        if (!empty($customer->postal_code) && !empty($customer->house_no) && !empty($customer->street_name) && !empty($customer->city_name)) {
            $this->address_completed = true;
        }

        $docs = $this->validateUserDocuments($customer);

        if ($docs['status'] == 'true') {
            $this->documents_completed = true;
        }

    }

    public function render()
    {
        $this->reset('high_rate');
        $source = new Source();
        $source->userAgentId = session('user_agent_id');
        $source->destinationCountry = $this->country['iso2'];


        $rates = new AllRates($source);
        $rates = $rates->rate();
        $rates = json_decode(json_encode($rates), true);

        $rates = collect($rates);
        $receiving_methods = array_unique($rates->pluck('method')->toArray());
        foreach ($rates as $r) {
            if ($this->high_rate['rate_after_spread'] < $r['rate_after_spread'] && empty($this->method)) {
                $this->high_rate = $r;
                $this->country_id = $r['country_id'];
                $this->method = $r['method'];
            } elseif ($this->high_rate['rate_after_spread'] < $r['rate_after_spread'] && $this->method == $r['method']) {
                $this->high_rate = $r;
                $this->country_id = $r['country_id'];
                $this->method = $r['method'];
            }
        }

        $promotions = Promotion::where('channel', 'on')
            ->where('type', 'desktop')
            ->where('country_id', session('country_id'))
            ->where('company_id', config('app.company_id'))
            ->where('start_at', '<=', date('Y-m-d H:i:s'))
            ->where('expire_at', '>=', date('Y-m-d H:i:s'))
            ->get();

        return view('livewire.inner.dashboard', compact('rates', 'receiving_methods', 'promotions'));
    }

    public function updatedCountryId($value)
    {
        $country = collect($this->rc_data)->firstWhere('id', $value);
        if (!empty($country)) {
            $this->country = $country;
            $this->reset('method');
        }
    }

    public function updatedMethod($value)
    {

    }
}
