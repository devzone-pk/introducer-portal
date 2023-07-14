<?php

namespace App\Traits\Modals;

use App\Models\User\Beneficiary;

trait BeneficiaryList
{
    public $bene_search = true;
    public $bene_search_query;
    public $bene_data = [];
    public $bene_selected_data;
    public $bene_title = 'Whom do you want to send money to?';


    public function beneOpenModel($array, $search_flag = '1')
    {
        $this->bene_selected_data = $array;
        if (empty($search_flag)) {
            $this->bene_search = false;
        }
        $this->benefetchData();
        $this->dispatchBrowserEvent('open-modal', ['model' => 'beneficiary-search-modal']);
    }

    public function benefetchData()
    {

        $data = Beneficiary::from('beneficiaries as b')
            ->join('countries as c', 'c.id', '=', 'b.country_id')
            ->when(!empty($this->bene_search_query), function ($q) {
                $q->where(function ($e) {
                    $e->orWhere('b.first_name', 'LIKE', '%' . $this->bene_search_query . '%')
                        ->orWhere('b.last_name', 'LIKE', '%' . $this->bene_search_query . '%');
                });
            })
            ->leftJoin('options as o', 'o.id', '=', 'b.relationship_id')
            ->where('b.customer_id', session('customer_id'))
            ->where('b.country_id', $this->receiving_country['id'])
            ->select([
                'b.id', 'b.customer_id', 'b.first_name', 'b.last_name', 'b.relationship_id', 'o.name as relationship_name', 'b.phone',
                'c.id as country_id', 'c.currency', 'c.name as country_name','c.iso2','c.phonecode as code'
            ])->get();

        if ($data->isEmpty()) {
            $this->bene_data = [];
        } else {
            $this->bene_data = $data->toArray();
        }

    }

    public function updatedBeneSearchQuery($value)
    {
        $this->benefetchData();
    }

    public function beneSelection($json)
    {
        $data = json_decode($json, true);

        if (!empty($data['id'])) {
            $this->{$this->bene_selected_data}['id'] = $data['id'];
            $this->{$this->bene_selected_data}['name'] = $data['first_name'] . ' ' . $data['last_name'];
            $this->{$this->bene_selected_data}['first_name'] = $data['first_name'];
            $this->{$this->bene_selected_data}['last_name'] =$data['last_name'];
            $this->{$this->bene_selected_data}['currency'] = $data['currency'];
            $this->{$this->bene_selected_data}['country_id'] = $data['country_id'];
            $this->{$this->bene_selected_data}['country_name'] = $data['country_name'];
            $this->{$this->bene_selected_data}['relationship_id'] = $data['relationship_id'];
            $this->{$this->bene_selected_data}['relationship_name'] = $data['relationship_name'];
            $this->{$this->bene_selected_data}['phone'] = $data['phone'];
        }
        $this->emitSelf('emit_select_beneficiary');
        $this->reset(['bene_selected_data', 'bene_search_query', 'bene_search']);
        $this->dispatchBrowserEvent('close-modal', ['model' => 'beneficiary-search-modal']);

    }
}
