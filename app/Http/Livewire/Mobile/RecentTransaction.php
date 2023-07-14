<?php

namespace App\Http\Livewire\Mobile;

use App\Models\Transfer\Transfer;
use Livewire\Component;

class RecentTransaction extends Component
{
    protected $listeners = [
        'resetErrors' => 'resetErrors'
    ];
    public function render()
    {
        $transfers = Transfer::where('channel', 'on')
            ->where('customer_id', session('customer_id'))
            ->orderBy('id', 'desc')->limit(5)->get();
        return view('livewire.mobile.recent-transaction', compact('transfers'));
    }
}
