<?php

namespace App\Traits\Modals;

use App\Models\Partner\Bank;

trait SearchBanks
{
    public $sb_search = true;
    public $sb_search_query;
    public $sb_data = [];
    public $sb_selected_data;
    public $sb_title = "Search Banks";


    public function sbOpenModel($array, $search_flag = '1')
    {
        $this->sb_selected_data = $array;
        if (empty($search_flag)) {
            $this->sb_search = false;
        }
        $this->sbfetchData();
        $this->dispatchBrowserEvent('open-modal', ['model' => 'bank-search-modal']);
    }

    public function sbfetchData()
    {

        $data = Bank::where('country_id', $this->receiving_country['id'])
            ->when(!empty($this->sb_search_query), function ($q) {
                $q->where('name', 'LIKE', '%' . $this->sb_search_query . '%');
            })->whereNull('deleted_at')->orderBy('name', 'asc')
            ->get();
        if ($data->isEmpty()) {
            $this->sb_data = [];
        } else {
            $this->sb_data = $data->toArray();
        }

    }

    public function updatedSbSearchQuery($value)
    {
        $this->sbfetchData();
    }

    public function sbSelection($json)
    {
        $data = json_decode($json, true);

        if (!empty($data['id'])) {
            $this->{$this->sb_selected_data}['name'] = $data['name'];
            $this->{$this->sb_selected_data}['bank_id'] = $data['id'];
        }
        $this->emitSelf('emit_bank_selection');

        $this->reset(['sb_selected_data', 'sb_search_query', 'sb_search']);
        $this->dispatchBrowserEvent('close-modal', ['model' => 'bank-search-modal']);
    }
}
