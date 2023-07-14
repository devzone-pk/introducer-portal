<?php

namespace App\Traits\Modals;

use App\Models\Options\Option;

trait Occupation
{
    public $oc_search = true;
    public $oc_search_query;
    public $oc_data = [];
    public $oc_selected_data;
    public $oc_title = 'Search Occupation';


    public function ocOpenModel($array, $search_flag = '1')
    {
        $this->oc_selected_data = $array;
        if (empty($search_flag)) {
            $this->oc_search = false;
        }
        $this->ocfetchData();
        $this->dispatchBrowserEvent('open-modal', ['model' => 'occupation-modal']);
    }

    public function ocfetchData()
    {

        $data = Option::where('option_type_id', '16')
            ->when(!empty($this->oc_search_query), function ($q) {
                $q->where('name', 'LIKE', '%' . $this->oc_search_query . '%');
            })->orderBy('name')->get();
        if ($data->isEmpty()) {
            $this->oc_data = [];
        } else {
            $this->oc_data = $data->toArray();
        }

    }

    public function updatedOcSearchQuery($value)
    {
        $this->ocfetchData();
    }

    public function ocSelection($json)
    {
        $data = json_decode($json, true);

        if (!empty($data['id'])) {

            $this->{$this->oc_selected_data}['id'] = $data['id'];
            $this->{$this->oc_selected_data}['name'] = $data['name'];


        }

        $this->reset(['oc_selected_data', 'oc_search_query', 'oc_search']);
        $this->dispatchBrowserEvent('close-modal', ['model' => 'occupation-modal']);

    }
}
