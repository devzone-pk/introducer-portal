<?php

namespace App\Http\Livewire\Inner;

use App\Models\Promotion;
use Livewire\Component;

class DashboardPromotion extends Component
{
    public function render()
    {

        $promotions = Promotion::where('channel','on')
            ->where('type','desktop')
            ->where('country_id',session('country_id'))
            ->where('company_id',config('app.company_id'))
            ->where('start_at','<=',date('Y-m-d H:i:s'))
            ->where('expire_at','>=',date('Y-m-d H:i:s'))
            ->get();



        return view('livewire.inner.dashboard-promotion',compact('promotions'));
    }
}
