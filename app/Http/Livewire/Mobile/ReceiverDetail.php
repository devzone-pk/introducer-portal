<?php

namespace App\Http\Livewire\Mobile;

use App\Models\User\Beneficiary;
use Livewire\Component;

class ReceiverDetail extends Component
{
    public $receiver_id;
    protected $listeners = [
        'resetErrors' => 'resetErrors'
    ];
    public function mount($receiver_id)
    {
        $this->receiver_id = $receiver_id;
    }

    public function render()
    {
        $beneficiary = Beneficiary::where('customer_id', session('customer_id'))->where('id', $this->receiver_id)->first();

        return view('livewire.mobile.receiver-detail', compact('beneficiary'));
    }
}
