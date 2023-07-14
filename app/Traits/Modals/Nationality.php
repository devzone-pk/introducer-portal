<?php

namespace App\Traits\Modals;

use App\Models\Country\Country;

trait Nationality
{
    public $n_search = true;
    public $n_search_query;
    public $n_data;
    public $n_selected_data;
    public $n_title = 'Search Nationalities';
    public $n_country = false;
    public $n_tag = 'n_nationality';

    public function nOpenModal($array, $search_flag = 1)
    {

        $this->n_selected_data = $array;


        $this->nFetchData();

        if ($search_flag == 1) {
            $this->n_country = true;
            $this->n_title = 'Search Countries';
            $this->n_tag = 'n_nationalityc';
        }
        $this->dispatchBrowserEvent('open-modal', ['model' => $this->n_tag]);
    }

    public function nFetchData()
    {

        $data = Country::when(!empty($this->n_search_query), function ($query) {
            $query->where('name', 'LIKE', '%' . $this->n_search_query . '%');
        })->select(['id', 'name', 'nationality', 'currency', 'iso2', 'iso3', 'phonecode'])
            ->orderBy('nationality', 'asc')
            ->whereNotNull('nationality')
            ->get();
        if ($data->isEmpty()) {
            $this->n_data = [];
        } else {
            $this->n_data = $data->toArray();
        }


    }

    public function updatedNSearchQuery()
    {
        $this->nFetchData();
    }

    public function nSelection($json)
    {
        $data = json_decode($json, true);
        if($this->n_selected_data=='place_of_birth'){
            if (!empty($data['id'])) {
                $this->{$this->n_selected_data} = $data['name'];
            }
        } else {
            if (!empty($data['id'])) {
                $this->{$this->n_selected_data}['id'] = $data['id'];
                $this->{$this->n_selected_data}['name'] = $data['name'];
                $this->{$this->n_selected_data}['currency'] = $data['currency'];
                $this->{$this->n_selected_data}['iso2'] = $data['iso2'];
                $this->{$this->n_selected_data}['nationality'] = $data['nationality'];
                $this->{$this->n_selected_data}['phonecode'] = $data['phonecode'];
            }
        }


        $this->emitSelf('emit_' . $this->n_selected_data);
        $this->reset(['n_selected_data', 'n_search_query', 'n_search', 'n_data']);
        $this->dispatchBrowserEvent('close-modal', ['model' => $this->n_tag]);
    }
}
