<?php

namespace App\Http\Livewire\Mobile\Account;

use App\Models\Customer\CustomerDocument;
use Livewire\Component;

class Documents extends Component
{
    public function render()
    {
        $documents = CustomerDocument::from('customer_documents as ad')
            ->where('ad.customer_id', session('customer_id'))
            ->whereNull('ad.deleted_at')
            ->join('options as o', 'o.id', '=', 'ad.type')
            ->leftJoin('states as s', 's.id', '=', 'ad.issuer_state_id')
            ->leftJoin('cities as ct', 'ct.id', '=', 'ad.issuer_city_id')
            ->select('ad.*', 'o.name as type_name', 'o.additional_info', 's.name as state_name', 'ct.name as city_name')
            ->orderBy('ad.status', 'desc')
            ->get();
        return view('livewire.mobile.account.documents', compact('documents'));
    }
}
