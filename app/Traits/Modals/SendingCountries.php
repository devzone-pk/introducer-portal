<?php

namespace App\Traits\Modals;

use App\Models\Country\Country;

trait SendingCountries
{
    public $sc_search = true;
    public $sc_search_query;
    public $sc_data = [];
    public $sc_selected_data;
    public $sc_title = 'Where to you want to send money from';


    public function scOpenModel($array, $search_flag = '1')
    {
        $this->sc_selected_data = $array;
        if (empty($search_flag)) {
            $this->sc_search = false;
            $this->scfetchData();
        }
        $this->dispatchBrowserEvent('open-modal', ['model' => 'sc_sending_countries']);
    }

    public function scfetchData()
    {
        $data = Country::when(!empty($this->sc_search_query), function ($q) {
            $q->where('name', 'LIKE', '%' . $this->sc_search_query . '%');
        })->where('is_on_sending', 't')->select('id', 'name', 'currency', 'iso2', 'iso3', 'phonecode')->get();
        if ($data->isEmpty()) {
            $this->sc_data = [];
        } else {
            $this->sc_data = $data->toArray();
        }

    }

    public function updatedScSearchQuery($value)
    {
        $this->scfetchData();
    }

    public function scSelection($json)
    {
        $data = json_decode($json, true);

        if (!empty($data['id'])) {
            $this->{$this->sc_selected_data}['id'] = $data['id'];
            $this->{$this->sc_selected_data}['name'] = $data['name'];
            $this->{$this->sc_selected_data}['currency'] = $data['currency'];
            $this->{$this->sc_selected_data}['iso2'] = $data['iso2'];
            $this->{$this->sc_selected_data}['phonecode'] = $data['phonecode'];
        }
        $this->emitSelf('emit_sending_country');
        $this->reset(['sc_selected_data', 'sc_search_query', 'sc_search']);
        $this->dispatchBrowserEvent('close-modal', ['model' => 'sc_sending_countries']);

    }
}
