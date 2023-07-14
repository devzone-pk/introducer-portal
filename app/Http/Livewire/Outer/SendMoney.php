<?php

namespace App\Http\Livewire\Outer;

use App\Models\Country\Country;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class SendMoney extends Component
{


    public $sending_country = [];
    public $receiving_country = [];
    public $sending = [];
    public $receiving_id;
    public $sending_id;
    public $search_receiving;

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

        $sending = Country::where('is_on_sending', 't')->select('id', 'name', 'currency', 'iso2', 'iso3')->get();

        $sending_iso2 = $_SERVER['HTTP_CF_IPCOUNTRY'] ?? 'GB';
        if (in_array($sending_iso2, ['GB', 'CA'])) {
            $sending_iso2 = $_SERVER['HTTP_CF_IPCOUNTRY'] ?? 'GB';
        } else {
            $sending_iso2 = 'GB';
        }

        $this->sending_country = $sending->where('iso2', $sending_iso2)->first();
        $this->sending_id = optional($this->sending_country)->id;
        $this->sending = $sending->toArray();


    }

    public function render()
    {

        $receiving = Country::when(!empty($this->search_receiving), function ($q) {
            $q->where('name', 'LIKE', '%' . $this->search_receiving . '%');
        })->where('is_on_receiving', 't')
            ->select('id', 'name', 'currency', 'iso2', 'iso3')
            ->get()->toArray();

        return view('livewire.outer.send-money', compact('receiving'));
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
