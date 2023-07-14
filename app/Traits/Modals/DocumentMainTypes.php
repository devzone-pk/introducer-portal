<?php

namespace App\Traits\Modals;

use App\Models\Options\Option;

trait DocumentMainTypes
{
    public $dmt_search = true;
    public $dmt_search_query;
    public $dmt_data = [];
    public $dmt_selected_data;
    public $dmt_title = 'Document Types';


    public function dmtOpenModel($array, $search_flag = '1')
    {
        $this->dmt_selected_data = $array;
        if (empty($search_flag)) {
            $this->dmt_search = false;
        }
        $this->dmtfetchData();
        $this->dispatchBrowserEvent('open-modal', ['model' => 'document-types-main-modal']);
    }

    public function dmtfetchData()
    {

        $data = Option::where('option_type_id', '2')
            ->when(empty($this->document_count), function ($q) {
                $q->where('additional_info', 'primary');
            })
            ->select('secondary_name as name')->groupBy('secondary_name')->get();
        if ($data->isEmpty()) {
            $this->dmt_data = [];
        } else {
            $this->dmt_data = $data->toArray();
        }

    }

    public function updatedDmtSearchQuery($value)
    {
        $this->dmtfetchData();
    }

    public function dmtSelection($json)
    {
        $data = json_decode($json, true);

        if (!empty($data['name'])) {


            $this->{$this->dmt_selected_data} = $data['name'];
        }

        $this->reset(['dmt_selected_data', 'dmt_search_query', 'dmt_search']);
        $this->dispatchBrowserEvent('close-modal', ['model' => 'document-types-main-modal']);

    }
}
