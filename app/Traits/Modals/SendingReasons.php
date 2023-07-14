<?php

namespace App\Traits\Modals;

use App\Models\Options\Option;

trait SendingReasons
{
    public $sr_search = true;
    public $sr_search_query;
    public $sr_data = [];
    public $sr_selected_data;
    public $sr_title = 'Why do you want to send money?';


    public function srOpenModel($array, $search_flag = '1')
    {
        $this->sr_selected_data = $array;
        if (empty($search_flag)) {
            $this->sr_search = false;
        }
        $this->srfetchData();
        $this->dispatchBrowserEvent('open-modal', ['model' => 'sending-reasons-modal']);
    }

    public function srfetchData()
    {

        $data = Option::where('option_type_id', '5')
            ->when(!empty($this->sr_search_query), function ($q) {
                $q->where('name', 'LIKE', '%' . $this->sr_search_query . '%');
            })->orderBy('name')->get();
        if ($data->isEmpty()) {
            $this->sr_data = [];
        } else {
            $this->sr_data = $data->toArray();
        }

    }

    public function updatedSrSearchQuery($value)
    {
        $this->srfetchData();
    }

    public function srSelection($json)
    {
        $data = json_decode($json, true);

        if (!empty($data['id'])) {

            $this->{$this->sr_selected_data}['id'] = $data['id'];
            $this->{$this->sr_selected_data}['name'] = $data['name'];

        }

        $this->reset(['sr_selected_data', 'sr_search_query', 'sr_search']);
        $this->dispatchBrowserEvent('close-modal', ['model' => 'sending-reasons-modal']);

    }
}
