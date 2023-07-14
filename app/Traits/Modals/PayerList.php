<?php

namespace App\Traits\Modals;

trait PayerList
{
    public $payer_search = true;
    public $payer_search_query;
    public $payer_data = [];
    public $payer_selected_data;
    public $payer_title = 'Where do you want the money to be received from?';


    public function payerOpenModel($array, $search_flag = '1')
    {
        $this->payer_selected_data = $array;
        if (empty($search_flag)) {
            $this->payer_search = false;
            $this->payerFetchData();
        }
        $this->dispatchBrowserEvent('open-modal', ['model' => 'payers_list']);
    }

    public function payerFetchData()
    {
        //in view we will loop through payers directly;
        //$this->payer_data = $this->payers;
    }

    public function updatedPayerSearchQuery($value)
    {
        $this->payerFetchData();
    }

    public function payerSelection($json)
    {
        $data = json_decode($json, true);

        if (!empty($data['id'])) {
            $this->{$this->payer_selected_data}['id'] = $data['id'];
            $this->{$this->payer_selected_data}['name'] = $data['name'];
            $this->{$this->payer_selected_data}['currency'] = $data['currency'];
            $this->{$this->payer_selected_data}['rate_after_spread'] = $data['rate_after_spread'];
        }
        $this->emitSelf('emit_payer_list');
        $this->reset(['payer_selected_data', 'payer_search_query', 'payer_search']);
        $this->dispatchBrowserEvent('close-modal', ['model' => 'payers_list']);

    }
}
