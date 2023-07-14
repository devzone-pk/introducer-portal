<?php

namespace App\Http\Livewire\Inner;

use Illuminate\Support\Facades\Request;
use Livewire\Component;

class Sidebar extends Component
{
    public function render()
    {
        $promotions = null;

        if (Request::segment(1) != 'dashboard') {
            $promotions = \App\Models\Promotion::where('channel', 'on')
                ->where('type', 'mobile')
                ->where('country_id', session('country_id'))
                ->where('company_id', config('app.company_id'))
                ->where('start_at', '<=', date('Y-m-d H:i:s'))
                ->where('expire_at', '>=', date('Y-m-d H:i:s'))
                ->get();
        }

        return view('livewire.inner.sidebar', compact('promotions'));
    }
}
