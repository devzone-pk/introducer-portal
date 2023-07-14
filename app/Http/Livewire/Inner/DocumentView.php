<?php

namespace App\Http\Livewire\Inner;

use App\Models\Customer\CustomerDocument;
use Livewire\Component;

class DocumentView extends Component
{

    public $primary_id;

    public function mount($primary_id)
    {
        $this->primary_id = $primary_id;
    }

    public function render()
    {
        $document = CustomerDocument::from('customer_documents as cd')
            ->join('options as o', 'o.id', '=', 'cd.type')
            ->leftjoin('countries as c', 'c.id', '=', 'cd.issuer_country_id')
            ->select('cd.*', 'o.name as type_name', 'c.name as country_name')
            ->where('cd.id', $this->primary_id)
            ->where('cd.customer_id', session('customer_id'))
            ->first();
        return view('livewire.inner.document-view', compact('document'));
    }
}
