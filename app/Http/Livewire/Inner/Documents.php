<?php

namespace App\Http\Livewire\Inner;

use App\Models\Customer\CustomerDocument;
use Livewire\Component;

class Documents extends Component
{
    public $document = [];

    public function render()
    {
        $documents = CustomerDocument::from('customer_documents as ad')
            ->where('ad.customer_id', session('customer_id'))
            ->whereNull('ad.deleted_at')
            ->join('options as o', 'o.id', '=', 'ad.type')
            ->leftJoin('countries as c', 'c.id', '=', 'ad.issuer_country_id')
            ->leftJoin('states as s', 's.id', '=', 'ad.issuer_state_id')
            ->leftJoin('cities as ct', 'ct.id', '=', 'ad.issuer_city_id')
            ->select('ad.*', 'o.name as type_name', 'c.name as country_name', 's.name as state_name', 'ct.name as city_name')
            ->orderBy('ad.is_primary', 'desc')
            ->orderBy('ad.status', 'desc')
            ->get();
        return view('livewire.inner.documents', compact('documents'));
    }

    public function openModal($data)
    {
        $this->document = json_decode($data, true);
        $this->dispatchBrowserEvent('open-modal', ['model' => 'bank-account-details']);
    }
}
