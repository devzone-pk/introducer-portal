<?php

namespace App\Traits\Modals;

use App\Models\Options\Option;
use App\Models\Transfer\Transfer;

trait CustomerTransfer
{


    public $ctx_search = true;
    public $ctx_search_query;
    public $ctx_data = [];
    public $ctx_selected_data;
    public $ctx_title = 'Customer Transfer';


    public function ctxOpenModel($array, $search_flag = '1')
    {
        $this->ctx_selected_data = $array;
        if (empty($search_flag)) {
            $this->ctx_search = false;
        }
        $this->ctxfetchData();
        $this->dispatchBrowserEvent('open-modal', ['model' => 'customer-transfer-modal']);
    }

    public function ctxfetchData()
    {

        $data = Transfer::join('transfer_beneficiaries as tb', 'tb.transfer_id', '=', 'transfers.id')
            ->where('transfers.customer_id', session('customer_id'))
            ->when(!empty($this->ctx_search_query), function ($q) {
                $q->where('transfers.transfer_code', 'LIKE', '%' . $this->ctx_search_query . '%');
            })
            ->select(['transfers.id', 'tb.id as tb_id', 'transfers.receiving_amount', 'transfers.transfer_code', \DB::raw('CONCAT(tb.first_name, " ", tb.last_name) as beneficiary_name')])
            ->groupBy('transfers.transfer_code')
            ->get();
        if ($data->isEmpty()) {
            $this->ctx_data = [];
        } else {
            $this->ctx_data = $data->toArray();
        }

    }

    public function updatedCtxSearchQuery($value)
    {
        $this->ctxfetchData();
    }

    public function ctxSelection($json)
    {
        $data = json_decode($json, true);

        if (!empty($data['id'])) {

            $this->{$this->ctx_selected_data}['id'] = $data['id'];
            $this->{$this->ctx_selected_data}['transfer_code'] = $data['transfer_code'];
            $this->{$this->ctx_selected_data}['receiving_amount'] = $data['receiving_amount']; //
            $this->{$this->ctx_selected_data}['beneficiary_name'] = $data['beneficiary_name'];

        }

        $this->reset(['ctx_selected_data', 'ctx_search_query', 'ctx_search']);
        $this->dispatchBrowserEvent('close-modal', ['model' => 'customer-transfer-modal']);

    }
}
