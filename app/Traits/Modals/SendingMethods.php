<?php

namespace App\Traits\Modals;

use App\Models\Options\Option;

trait SendingMethods
{
    public $sm_search = true;
    public $sm_search_query;
    public $sm_data = [];
    public $sm_selected_data;
    public $sm_title = 'How do you want to send money?';


    public function smOpenModel($array, $search_flag = '1')
    {
        $this->sm_selected_data = $array;
        if (empty($search_flag)) {
            $this->sm_search = false;
        }
        $this->smfetchData();
        $this->dispatchBrowserEvent('open-modal', ['model' => 'sending-methods-modal']);
    }

    public function smfetchData()
    {

        if (!empty(session('country_id'))) {
            $country_id = session('country_id');
        } elseif (isset($this->sending_country['id'])) {
            $country_id = $this->sending_country['id'];
        } elseif(isset($this->country['id'])) {
            $country_id = $this->country['id'];
        } else {
            $country_id = $this->sending_country;
        }



        $data = Option::where('option_type_id', '14')
            ->join('gateways as g', 'g.sending_method_id', '=', 'options.id')
            ->when(!empty($this->sm_search_query), function ($q) {
                $q->where('name', 'LIKE', '%' . $this->sm_search_query . '%');
            })->where('g.status', 't')

            ->where('g.company_id', config('app.company_id'))
            ->where('g.sending_country_id', $country_id)
            ->select('g.*', 'options.name')->get();
        if ($data->isEmpty()) {
            $this->sm_data = [];
        } else {
            $this->sm_data = $data->toArray();
        }

    }

    public function updatedSmSearchQuery($value)
    {
        $this->smfetchData();
    }

    public function smSelection($json)
    {
        $data = json_decode($json, true);

        if (!empty($data['id'])) {

            $this->{$this->sm_selected_data}['id'] = $data['id'];
            $this->{$this->sm_selected_data}['name'] = $data['name'];
            $this->{$this->sm_selected_data}['sending_method_id'] = $data['sending_method_id'];
            $this->{$this->sm_selected_data}['gateway_code'] = $data['gateway_code'];
            $this->{$this->sm_selected_data}['redirect_uri'] = $data['redirect_uri'];


        }
        $this->emitSelf('emit_sending_methods');
        $this->reset(['sm_selected_data', 'sm_search_query', 'sm_search']);
        $this->dispatchBrowserEvent('close-modal', ['model' => 'sending-methods-modal']);

    }
}
