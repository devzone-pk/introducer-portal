<?php

namespace App\Http\Livewire\Inner;

use App\Models\Transfer\Transfer;
use Livewire\Component;

class SendMoneySuccess extends Component
{
    public $transfer_code;
    public $success_page;

    public function mount($transfer_code, $redirect = null)
    {
        $this->transfer_code = $transfer_code;
        $this->success_page = $redirect;
    }

    public function render()
    {
        $transfer = Transfer::where('transfer_code', $this->transfer_code)->first();

        return view('livewire.inner.send-money-success', compact('transfer'));
    }

    public function sendMoney()
    {
        return $this->redirect('/send/money');
    }
}
