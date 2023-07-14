<?php

namespace App\Traits\Modals;

use App\Models\Options\Option;

trait Relationship
{
    public $rl_search = true;
    public $rl_search_query;
    public $rl_data = [];
    public $rl_selected_data;
    public $rl_title = "Relations";


    public function rlOpenModel($array, $search_flag = '1')
    {
        $this->rl_selected_data = $array;
        if (empty($search_flag)) {
            $this->rl_search = false;

        }
        $this->rlfetchData();
        $this->dispatchBrowserEvent('open-modal', ['model' => 'relationships-modal']);
    }

    public function rlfetchData()
    {

        $data = Option::where('option_type_id', '9')
            ->when(!empty($this->rl_search_query), function ($q) {
                $q->where('name', 'LIKE', '%' . $this->rl_search_query . '%');
            })->orderBy('name')->get();
        if ($data->isEmpty()) {
            $this->rl_data = [];
        } else {
            $this->rl_data = $data->toArray();
        }

    }

    public function updatedRlSearchQuery($value)
    {
        $this->rlfetchData();
    }

    public function rlSelection($json)
    {
        $data = json_decode($json, true);

        if (!empty($data['id'])) {

            $this->{$this->rl_selected_data}['relationship_id'] = $data['id'];
            $this->{$this->rl_selected_data}['relationship_name'] = $data['name'];

        }

        $this->reset(['rl_selected_data', 'rl_search_query', 'rl_search']);
        $this->dispatchBrowserEvent('close-modal', ['model' => 'relationships-modal']);

    }
}
