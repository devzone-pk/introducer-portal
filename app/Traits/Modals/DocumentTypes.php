<?php

namespace App\Traits\Modals;

use App\Models\Options\Option;

trait DocumentTypes
{
    public $dt_search = true;
    public $dt_search_query;
    public $dt_data = [];
    public $dt_selected_data;
    public $dt_title = 'Document Name';


    public function dtOpenModel($array, $search_flag = '1')
    {
        $this->dt_selected_data = $array;
        if (empty($search_flag)) {
            $this->dt_search = false;
        }
        $this->dtfetchData();
        $this->dispatchBrowserEvent('open-modal', ['model' => 'document-types-modal']);
    }

    public function dtfetchData()
    {

        $data = Option::where('option_type_id', '2')
            ->when(empty($this->document_count), function ($q) {
                $q->where('additional_info', 'primary');
            })
            //->where('secondary_name', $this->type_name)
            ->when(!empty($this->dt_search_query), function ($q) {
                $q->where('name', 'LIKE', '%' . $this->dt_search_query . '%');
            })->orderBy('additional_info')->get();
        if ($data->isEmpty()) {
            $this->dt_data = [];
        } else {
            $this->dt_data = $data->toArray();
        }

    }

    public function updatedDtSearchQuery($value)
    {
        $this->dtfetchData();
    }

    public function dtSelection($json)
    {
        $data = json_decode($json, true);

        if (!empty($data['id'])) {

            $this->{$this->dt_selected_data}['id'] = $data['id'];
            $this->{$this->dt_selected_data}['name'] = $data['name'];
        }

        $this->reset(['dt_selected_data', 'dt_search_query', 'dt_search']);
        $this->dispatchBrowserEvent('close-modal', ['model' => 'document-types-modal']);

    }
}
