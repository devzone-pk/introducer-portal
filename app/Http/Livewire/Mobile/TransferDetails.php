<?php

namespace App\Http\Livewire\Mobile;

use App\Models\Transfer\Transfer;
use Livewire\Component;

class TransferDetails extends Component
{
    public $transfer_id;
    protected $listeners = [
        'resetErrors' => 'resetErrors'
    ];
    public function mount($transfer_id)
    {
        $this->transfer_id = $transfer_id;
    }

    public function render()
    {
        $details = Transfer::find($this->transfer_id);
        return view('livewire.mobile.transfer-details',compact('details'));
    }
}
