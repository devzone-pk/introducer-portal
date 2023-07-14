<?php

namespace App\Http\Livewire\Mobile\Account;

use Livewire\Component;

class ReferFriend extends Component
{
    public $message;

    public function mount()
    {
        $this->message = url('sign-up') . '?referral=' . str_pad(session('customer_id'), 6, "0", STR_PAD_LEFT);
    }

    public function render()
    {
        return view('livewire.mobile.account.refer-friend');
    }
}
