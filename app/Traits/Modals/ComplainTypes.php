<?php

namespace App\Traits\Modals;

use App\Models\Options\Option;

trait ComplainTypes
{

    public $ct_search = true;
    public $ct_search_query;
    public $ct_data = [];
    public $ct_selected_data;
    public $ct_title = 'Ticket Types';


    public function ctOpenModel($array, $search_flag = '1')
    {
        $this->ct_selected_data = $array;
        if (empty($search_flag)) {
            $this->ct_search = false;
        }
        $this->ctfetchData();
        $this->dispatchBrowserEvent('open-modal', ['model' => 'complain-types-modal']);
    }

    public function ctfetchData()
    {

        $data = Option::where('option_type_id', 15)
            ->when(!empty($this->ct_search_query), function ($q) {
                $q->where('name', 'LIKE', '%' . $this->ct_search_query . '%');
            })->orderBy('additional_info')->get();
        if ($data->isEmpty()) {
            $this->ct_data = [];
        } else {
            $this->ct_data = $data->toArray();
        }

    }

    public function updatedCtSearchQuery($value)
    {
        $this->ctfetchData();
    }

    public function ctSelection($json)
    {
        $data = json_decode($json, true);

        if (!empty($data['id'])) {

            $this->{$this->ct_selected_data}['id'] = $data['id'];
            $this->{$this->ct_selected_data}['name'] = $data['name'];
        }


        $this->reset(['ct_selected_data', 'ct_search_query', 'ct_search']);
        $this->dispatchBrowserEvent('close-modal', ['model' => 'complain-types-modal']);

    }
}
