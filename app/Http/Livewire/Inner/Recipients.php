<?php

namespace App\Http\Livewire\Inner;

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
            ->select('b.first_name', 'b.last_name', 'b.phone', 'c.name as country', 'o.name as relation','b.id')->paginate(7);
        return view('livewire.inner.recipients', compact('beneficiary'));
    }
}
