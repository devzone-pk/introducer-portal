<?php

namespace App\Http\Livewire\Outer;

use App\Models\Company;
use Livewire\Component;

class TopHeader extends Component
{

    public function render()
    {
        $company = Company::find(config('app.company_id'));
        return view('livewire.outer.top-header', compact('company'));
    }
}
