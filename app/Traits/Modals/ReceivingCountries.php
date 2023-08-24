<?php

namespace App\Traits\Modals;

use App\Models\Country\Country;
use App\Models\Country\SendingReceivingCountry;

trait ReceivingCountries
{
    public $rc_search = true;
    public $rc_search_query;
    public $rc_data = [];
    public $rc_selected_data;
    public $rc_title = "Where do you want to send money?";


    public function rcOpenModel($array, $search_flag = '1')
    {
        $this->rc_selected_data = $array;
        if (empty($search_flag)) {
            $this->rc_search = false;
            $this->rcFetchData();
        }
        $this->dispatchBrowserEvent('open-modal', ['model' => 'rc_receiving_countries']);
    }

    public function rcFetchData()
    {

        if (!empty(session('currency'))) {
            $country_id = session('country_id');
        } elseif (isset($this->sending_country['id'])) {
            $country_id = $this->sending_country['id'];
        } else {
            $country_id = $this->sending_country;
        }


        $countries = SendingReceivingCountry::from('sending_receiving_countries as sr')
            ->join('countries as r', 'sr.receiving_country_id', '=', 'r.id')
            ->where('sr.company_id', config('app.company_id'))
            ->where('sr.status', 't')
            ->where('sr.sending_country_id', $country_id)
            ->select( 'r.iso2 as receiving')->get();


        $data = Country::when(!empty($this->rc_search_query), function ($q) {
            $q->where('name', 'LIKE', '%' . $this->rc_search_query . '%');
        })->where('is_on_receiving', 't')->whereIn('iso2',$countries->pluck('receiving')->toArray())
            ->select('id', 'name', 'currency', 'iso2', 'iso3', 'phonecode')->get();
        if ($data->isEmpty()) {
            $this->rc_data = [];
        } else {
            $this->rc_data = $data->toArray();
        }


    }

    public function updatedRcSearchQuery($value)
    {
        $this->rcFetchData();
    }

    public function rcSelection($json)
    {
        $data = json_decode($json, true);

        if (!empty($data['id'])) {
            $this->{$this->rc_selected_data}['id'] = $data['id'];
            $this->{$this->rc_selected_data}['name'] = $data['name'];
            $this->{$this->rc_selected_data}['currency'] = $data['currency'];
            $this->{$this->rc_selected_data}['iso2'] = $data['iso2'];
            $this->{$this->rc_selected_data}['phonecode'] = $data['phonecode'];
        }

        $this->emitSelf('emit_receiving_country');
        $this->reset(['rc_selected_data', 'rc_search_query', 'rc_search']);
        $this->dispatchBrowserEvent('close-modal', ['model' => 'rc_receiving_countries']);

    }
}
