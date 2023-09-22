<?php

namespace App\Http\Livewire\Outer;

use App\Models\Country\Country;
use App\Models\Country\SendingReceivingCountry;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class SendMoney extends Component
{


    public $sending_country = [];
    public $receiving_country = [];
    public $sending = [];
    public $receiving = [];

    public $receiving_id;
    public $sending_id;
    public $search_receiving;
    public $receiving_iso2;
    public $sending_iso2;


    protected $rules = [
        'receiving_id' => 'required',
        'sending_id' => 'required'
    ];

    protected $messages = [
        'sending_id.required' => 'Sending from field is required.',
        'receiving_id.required' => 'Sending to field is required.',
    ];

    public function mount()
    {

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

        $sending_iso2 = $_SERVER['HTTP_CF_IPCOUNTRY'] ?? 'GB';
        if (in_array($sending_iso2, ['GB', 'CA'])) {
            $sending_iso2 = $_SERVER['HTTP_CF_IPCOUNTRY'] ?? 'GB';
        } else {
            $sending_iso2 = 'GB';
        }

        $this->sending_country = $sending->where('iso2', $sending_iso2)->first();
        $this->sending_id = optional($this->sending_country)->id;
        $this->sending = $sending->toArray();


        $receiving = Country::whereIn('iso2', $configured_countries[$this->sending_country['iso2']])
            ->select('id', 'name', 'currency', 'iso2', 'iso3')->get();

        $this->receiving = $receiving->toArray();

    }

    public function render()
    {

//        $receiving = Country::when(!empty($this->search_receiving), function ($q) {
//            $q->where('name', 'LIKE', '%' . $this->search_receiving . '%');
//        })->where('is_on_receiving', 't')
//            ->select('id', 'name', 'currency', 'iso2', 'iso3')
//            ->get()->toArray();

        return view('livewire.outer.send-money');
    }

    public function selectSending($json)
    {
        $this->sending_country = json_decode($json, true);
    }

    public function updatedSendingId($value)
    {
        $country = Country::find($value);
        $this->sending_country = optional($country)->toArray();
    }

    public function updatedReceivingId($value)
    {
        $country = Country::find($value);
        $this->receiving_country = optional($country)->toArray();
    }

    public function selectReceiving($json)
    {
        $this->receiving_country = json_decode($json, true);
    }

    public function proceed()
    {
        $this->validate();
        redirect()->to('send-money-to/' . strtolower($this->receiving_country['iso2']));
    }
}
