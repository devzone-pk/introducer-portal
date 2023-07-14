<?php

namespace App\Http\Livewire\Inner;

use Livewire\Component;

class ReferFriend extends Component
{

    public $width;
    public $message;

    public function mount($width = null)
    {
        if (!empty($width)) {
            $this->width = $width;
        }
        $this->message = url('sign-up') . '?referral=' . str_pad(session('customer_id'), 6, "0", STR_PAD_LEFT);
    }


    public function copy()
    {
        sleep(1);
    }

    public function render()
    {

        return view('livewire.inner.refer-friend');
    }
}
