<?php

namespace App\Http\Livewire\Inner;

use App\Models\Customer\Customer;
use App\Models\Customer\CustomerDocument;
use Livewire\Component;

class DashboardAccountAlert extends Component
{
    public $alert = false;
    public $link = '#';

    public function render()
    {
        $customer = Customer::find(session('customer_id'));

        if ((empty($customer['first_name']) && empty($customer['last_name'])) || empty($customer['dob']) || empty($customer['gender'])) {
            $this->alert = true;
            $this->link = url('mobile/profile');
        } else if (empty($customer['house_no']) || empty($customer['street_name']) || empty($customer['postal_code'])) {
            $this->alert = true;
            $this->link = url('mobile/address');
        } else if (!CustomerDocument::where('customer_id', session('customer_id'))->exists()) {
            $this->alert = true;
            $this->link = url('mobile/documents');
        }


        return view('livewire.inner.dashboard-account-alert');
    }
}
