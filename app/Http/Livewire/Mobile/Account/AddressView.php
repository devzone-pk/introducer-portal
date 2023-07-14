<?php

namespace App\Http\Livewire\Mobile\Account;

use App\Models\Customer\Customer;
use Livewire\Component;

class AddressView extends Component
{
    public function render()
    {
        $customer = Customer::find(session('customer_id'));
        return view('livewire.mobile.account.address-view',compact('customer'));
    }
}
