<?php

namespace App\Traits\Modals;

use DB;
use Illuminate\Support\Collection;

trait SearchCities
{
    public $sc_search = true;
    public $sc_search_query;
    public $sc_data;
    public $sc_selected_data;
    public $sc_title = 'Search Cities';

    public function scOpenModal($array, $search_flag = 1)
    {
        $this->sc_selected_data = $array;
        if (empty($search_flag)) {
            $this->sc_search = false;
            $this->scFetchData();
        }
        $this->dispatchBrowserEvent('open-modal', ['model' => 'sc_search_cities']);
    }

    public function scFetchData()
    {

        $data = DB::table('cities')->when(!empty($this->sc_search_query), function ($query) {
            $query->where('name', 'LIKE', "$this->sc_search_query%");
        })->where('country_id', '=', $this->country_id)->select(['id', 'name', 'state_id', 'country_id', 'country_code'])
            ->limit(20)
            ->get();

        $this->populatingData($data);
    }

    public function updatedScSearchQuery($value)
    {
        $this->scFetchData();
    }

    public function scSelection($json)
    {
        $data = json_decode($json, true);

        if (!empty($data['id'])) {
            $this->{$this->sc_selected_data}['id'] = $data['id'];
            $this->{$this->sc_selected_data}['name'] = $data['name'];
            $this->{$this->sc_selected_data}['state_id'] = $data['state_id'];
            $this->{$this->sc_selected_data}['country_id'] = $data['country_id'];
            $this->{$this->sc_selected_data}['country_code'] = $data['country_code'];
        }
        $this->emitSelf('emit_' . $this->sc_selected_data);
        $this->reset(['sc_selected_data', 'sc_search_query', 'sc_search', 'sc_data']);
        $this->dispatchBrowserEvent('close-modal', ['model' => 'sc_search_cities']);
    }

    public function populatingData(Collection $data): void
    {
        $data = json_decode(json_encode($data), true);
        if (empty($data)) {
            $this->sc_data = [];
        } else {
            $this->sc_data = $data;
        }
    }
}
