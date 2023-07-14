<?php

namespace App\Http\Livewire\Outer;

use App\Models\Company;
use Livewire\Component;

class Footer extends Component
{
    public function render()
    {
        $company = Company::find(config('app.company_id'));
        return view('livewire.outer.footer', compact('company'));
    }
}
