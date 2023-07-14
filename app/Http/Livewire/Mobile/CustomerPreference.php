<?php

namespace App\Http\Livewire\Mobile;

use Livewire\Component;

class CustomerPreference extends Component
{
    public $preference = [
        'sms' => false,
        'phone' => false,
        'post' => false,
        'email' => false
    ];
    protected $listeners = [
        'resetErrors' => 'resetErrors'
    ];

    public function mount()
    {
        $preference = \App\Models\Customer\CustomerPreference::where('customer_id', session('customer_id'))->first();

        $this->preference['sms'] = optional($preference)->sms == '1' ? true : false;
        $this->preference['phone'] = optional($preference)->phone == '1' ? true : false;
        $this->preference['post'] = optional($preference)->post == '1' ? true : false;
        $this->preference['email'] = optional($preference)->email == '1' ? true : false;

    }

    public function render()
    {
        return view('livewire.mobile.customer-preference');
    }

    public function preferenceUpdate()
    {
        \App\Models\Customer\CustomerPreference::updateOrCreate(
            [
                'customer_id' => session('customer_id')
            ],
            [
                'sms' => $this->preference['sms'],
                'phone' => $this->preference['phone'],
                'post' => $this->preference['post'],
                'email' => $this->preference['email'],
            ]);
    }
}
