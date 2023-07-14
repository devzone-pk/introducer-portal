<?php

namespace App\Http\Livewire\Mobile\Account;

use App\Models\Customer\CustomerDocument;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ViewDocument extends Component
{
    public $primary_id;
    public $document = [];

    public function mount($primary_id)
    {
        $this->primary_id = $primary_id;
        $this->document = CustomerDocument::from('customer_documents as cd')
            ->join('options as o', 'o.id', '=', 'cd.type')
            ->leftjoin('countries as c', 'c.id', '=', 'cd.issuer_country_id')
            ->select('cd.*', 'o.name as type_name', 'c.name as country_name')
            ->where('cd.id', $this->primary_id)
            ->where('cd.customer_id', session('customer_id'))
            ->first()->toArray();
    }

    public function render()
    {


        return view('livewire.mobile.account.view-document');
    }
}
