<?php

namespace App\Traits\Modals;

use App\Models\User\BeneficiaryBank;

trait BeneficiaryBankList
{
    public $bb_search = true;
    public $bb_search_query;
    public $bb_data = [];
    public $bb_selected_data;
    public $bb_title = "Select receiver's bank";


    public function bbOpenModel($array, $search_flag = '1')
    {
        $this->bb_selected_data = $array;
        if (empty($search_flag)) {
            $this->bb_search = false;
        }
        $this->bbfetchData();
        $this->dispatchBrowserEvent('open-modal', ['model' => 'beneficiary-bank-search-modal']);
    }

    public function bbfetchData()
    {

        if (empty($this->selected_beneficiary['id'])) {
            $this->bb_data = [];
        } else {
            $data = BeneficiaryBank::where('beneficiary_id', $this->selected_beneficiary['id'])
                ->select('*','name as old_name')
                ->get();
            if ($data->isEmpty()) {
                $this->bb_data = [];
            } else {
                $this->bb_data = $data->toArray();
            }
        }


    }

    public function updatedBbSearchQuery($value)
    {
        $this->bbfetchData();
    }

    public function bbSelection($json)
    {
        $data = json_decode($json, true);

        if (!empty($data['id'])) {
            $this->{$this->bb_selected_data}['id'] = $data['id'];
            $this->{$this->bb_selected_data}['name'] = $data['name'];
            $this->{$this->bb_selected_data}['old_name'] = $data['name'];
            $this->{$this->bb_selected_data}['bank_id'] = $data['bank_id'];
            $this->{$this->bb_selected_data}['code'] = $data['code'];
            $this->{$this->bb_selected_data}['branch_name'] = $data['branch_name'];
            $this->{$this->bb_selected_data}['branch_code'] = $data['branch_code'];
            $this->{$this->bb_selected_data}['account_no'] = $data['account_no'];
            $this->{$this->bb_selected_data}['iban'] = $data['iban'];
        }

        if(isset($this->show_beneficiary_bank)){
            $this->show_beneficiary_bank = true;
        }

        $this->reset(['bb_selected_data', 'bb_search_query', 'bb_search']);
        $this->dispatchBrowserEvent('close-modal', ['model' => 'beneficiary-bank-search-modal']);
    }
}
