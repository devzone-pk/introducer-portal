<?php

namespace App\Http\Livewire\Inner;

use App\Models\User\Beneficiary;
use Livewire\Component;

class ViewRecipients extends Component
{
    public $primary_id;

    public function render()
    {
        $beneficiary_detail = Beneficiary::from('beneficiaries as b')
            ->leftJoin('options as o', 'o.id', '=', 'b.relationship_id')
            ->leftJoin('countries as c', 'c.id', '=', 'b.country_id')
            ->where('b.id', $this->primary_id)
            ->select('b.first_name', 'b.last_name', 'b.phone', 'c.name as country', 'o.name as relation')->first();

        return view('livewire.inner.view-recipients',compact('beneficiary_detail'));
    }
}
