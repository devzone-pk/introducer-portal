<?php

namespace App\Http\Livewire\Mobile;

use App\Models\Transfer\Transfer;
use Livewire\Component;

class SendMoneySuccess extends Component
{
    public $transfer_code;


    public function mount($transfer_code)
    {
        $this->transfer_code = $transfer_code;
    }

    public function render()
    {
        $transfer = Transfer::where('transfer_code', $this->transfer_code)->first();
        return view('livewire.mobile.send-money-success', compact('transfer'));
    }
}
