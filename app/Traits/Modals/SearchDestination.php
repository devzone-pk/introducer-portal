<?php

namespace App\Traits\Modals;

use App\Models\Partner\Bank;
use App\Models\Partner\PayoutLocation;

trait SearchDestination
{
    public $sd_search = true;
    public $sd_search_query;
    public $sd_data = [];
    public $sd_selected_data;
    public $sd_title = "Search Destination";


    public function sdOpenModel($array, $search_flag = '1')
    {
        $this->sd_selected_data = $array;
        if (empty($search_flag)) {
            $this->sd_search = false;
        }
        $this->sdfetchData();
        $this->dispatchBrowserEvent('open-modal', ['model' => 'destination-search-modal']);
    }

    public function sdfetchData()
    {

        $data = PayoutLocation::where('country_id', $this->receiving_country['id'])
            ->where('payer_id', $this->selected_payer['id'])
            ->when(!empty($this->sd_search_query), function ($q) {
                $q->where('name', 'LIKE', '%' . $this->sd_search_query . '%');
            })->whereNull('deleted_at')
            ->select('id','name')
            ->where('status', 't')
            ->get();
        if ($data->isEmpty()) {
            $this->sd_data = [];
        } else {
            $this->sd_data = $data->toArray();
            if (count($this->sd_data) == 1) {
                $data = $this->sd_data[0];
                $this->selected_cash_destination = $data;
            }
        }

    }

    public function updatedSdSearchQuery($value)
    {
        $this->sdfetchData();
    }

    public function sdSelection($json)
    {
        $data = json_decode($json, true);

        if (!empty($data['id'])) {

            $this->{$this->sd_selected_data}['name'] = $data['name'];
            $this->{$this->sd_selected_data}['id'] = $data['id'];
        }

        $this->reset(['sd_selected_data', 'sd_search_query', 'sd_search']);
        $this->dispatchBrowserEvent('close-modal', ['model' => 'destination-search-modal']);
    }
}
