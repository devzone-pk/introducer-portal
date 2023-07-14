<?php

namespace App\Traits\Modals;

trait SourceFund
{
    public $sof_search = true;
    public $sof_search_query;
    public $sof_data = [];
    public $sof_selected_data;
    public $sof_title = 'What is the Source of Money?';


    public function sofOpenModel($array, $search_flag = '1')
    {
        $this->sof_selected_data = $array;
        if (empty($search_flag)) {
            $this->sof_search = false;
            $this->sofFetchData();
        }
        $this->dispatchBrowserEvent('open-modal', ['model' => 'source_fund']);
    }

    public function sofFetchData()
    {
        $this->sof_data = [
            'SALARY', 'SAVINGS', 'BUSINESS', 'GIFT', 'PENSION', 'BANK LOAN', 'SALES OF PROPERTY OR ASSETS'
        ];
    }

    public function updatedSofSearchQuery($value)
    {
        $this->sofFetchData();
    }

    public function sofSelection($json)
    {

        $this->{$this->sof_selected_data} = $json;

        $this->emitSelf('emit_sof_list');
        $this->reset(['sof_selected_data', 'sof_search_query', 'sof_search']);
        $this->dispatchBrowserEvent('close-modal', ['model' => 'source_fund']);

    }
}
