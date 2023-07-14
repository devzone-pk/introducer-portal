<?php

namespace App\Http\Livewire\Mobile;

use App\Models\User\Beneficiary;
use Livewire\Component;

class Receivers extends Component
{
    protected $listeners = [
        'resetErrors' => 'resetErrors'
    ];
    public function render()
    {
        $beneficiary = Beneficiary::from('beneficiaries as b')
            ->leftJoin('options as o', 'o.id', '=', 'b.relationship_id')
            ->leftJoin('countries as c', 'c.id', '=', 'b.country_id')
            ->where('customer_id', session('customer_id'))
            ->select('b.id','b.first_name', 'b.last_name', 'b.code', 'b.phone', 'c.name as country','c.iso2', 'o.name as relation')
            ->orderBy('b.id','desc')->paginate(30);
        return view('livewire.mobile.receivers', compact('beneficiary'));
    }
}
