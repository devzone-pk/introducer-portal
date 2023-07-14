<?php

namespace App\Http\Livewire\Mobile\Account;

use App\Models\Complaint;
use Livewire\Component;

class CustomerSupport extends Component
{
    public function render()
    {
        $complaints = Complaint::where('customer_id', session('customer_id'))
            ->with(['customer', 'option', 'transfer'])->orderByDesc('id')->get();
        return view('livewire.mobile.account.customer-support', compact('complaints'));
    }
}
