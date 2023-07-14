<?php

namespace App\Traits\Modals;

trait ReceivingMethods
{
    public $rm_search = true;
    public $rm_search_query;
    public $rm_data = [];
    public $rm_selected_data;
    public $rm_title = 'How do you want money to be collected?';

    public function rmOpenModel($array, $search_flag = '1')
    {
        $this->rm_selected_data = $array;
        if (empty($search_flag)) {
            $this->rm_search = false;
            $this->rmFetchData();
        }
        $this->dispatchBrowserEvent('open-modal', ['model' => 'rm_receiving_methods']);
    }

    public function rmFetchData()
    {
       // $this->rm_data = $this->receiving_methods;

    }

    public function updatedRmSearchQuery($value)
    {
        $this->rmFetchData();
    }

    public function rmSelection($data)
    {


        if (!empty($data)) {
            $this->{$this->rm_selected_data} = $data;
        }

        $this->emitSelf('emit_receiving_methods');
        $this->reset(['rm_selected_data', 'rm_search_query', 'rm_search']);
        $this->dispatchBrowserEvent('close-modal', ['model' => 'rm_receiving_methods']);

    }
}
