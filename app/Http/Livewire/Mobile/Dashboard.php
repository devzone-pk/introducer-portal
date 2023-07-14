<?php

namespace App\Http\Livewire\Mobile;

use App\Models\Promotion;
use Livewire\Component;

class Dashboard extends Component
{
    protected $listeners = [
        'resetErrors' => 'resetErrors'
    ];
    public function render()
    {
        $promotions = Promotion::where('channel','on')
            ->where('type','mobile')
            ->where('country_id',session('country_id'))
            ->where('company_id',config('app.company_id'))
            ->where('start_at','<=',date('Y-m-d H:i:s'))
            ->where('expire_at','>=',date('Y-m-d H:i:s'))
            ->get();
        return view('livewire.mobile.dashboard',compact('promotions'));
    }
}
