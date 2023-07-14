<?php

namespace App\Http\Livewire\Inner;

use App\Models\Transfer\Transfer;
use Livewire\Component;

class TransferDetails extends Component
{
    public $transfer_id;

    public function mount($primary_id)
    {
        $this->transfer_id = $primary_id;
    }

    public function render()
    {
        $transfer = Transfer::where('id', $this->transfer_id)->where('customer_id', session('customer_id'))->first();
//        $transfer = Transfer::where('id', $this->transfer_id)->first();
        return view('livewire.inner.transfer-details', compact('transfer'));
    }
}
