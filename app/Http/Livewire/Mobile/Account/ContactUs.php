<?php

namespace App\Http\Livewire\Mobile\Account;

use App\Models\Company;
use Livewire\Component;

class ContactUs extends Component
{
    public function render()
    {
        $company = Company::find(config('app.company_id'));
        return view('livewire.mobile.account.contact-us', compact('company'));
    }
}
