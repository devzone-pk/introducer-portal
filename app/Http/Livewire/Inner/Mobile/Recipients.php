<?php

namespace App\Http\Livewire\Inner\Mobile;

use App\Models\User\Beneficiary;
use Livewire\Component;
use Livewire\WithPagination;

class Recipients extends Component
{
    use WithPagination;

    public function render()
    {
        $beneficiary = Beneficiary::from('beneficiaries as b')
            ->leftJoin('options as o', 'o.id', '=', 'b.relationship_id')
            ->leftJoin('countries as c', 'c.id', '=', 'b.country_id')
            ->where('customer_id', session('customer_id'))
            ->select('b.first_name', 'b.last_name', 'b.phone', 'c.name as country','c.currency', 'o.name as relation')->paginate(10);
        return view('livewire.inner.mobile.recipients', compact('beneficiary'));
    }
}
