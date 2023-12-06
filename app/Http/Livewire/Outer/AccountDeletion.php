<?php

namespace App\Http\Livewire\Outer;

use Livewire\Component;
use App\Models\Customer\Customer;
use App\Models\User\User;
use Exception;
use Illuminate\Support\Facades\RateLimiter;

class AccountDeletion extends Component
{
    public $email, $customerId, $reason,$success=null;

    protected $rules = [
        'email' => 'required',
        'reason' => 'required',

    ];
    protected $validationAttributes = [
        'email' => 'Email',
        'reason' => 'Reason',

    ];

    public function deleteAccount()
    {    
       $this->success = null;
       $this->resetErrorBag();
       if (RateLimiter::remaining('account-delete', $perMinute = 3)) {
        RateLimiter::hit('account-delete');
    
        $this->validate();
        try {

            $customer = Customer::join('users as u','u.id','=','customers.user_id')
                ->where('customers.email', $this->email)
                ->where('u.company_id', config('app.company_id'))
                ->select('customers.id','user_id')
                ->first();

            $email_already_exists = \App\Models\AccountDeletion::where('email',$this->email)->where('reason',$this->reason);

            if(!$email_already_exists->exists()){
                \App\Models\AccountDeletion::create([
                    'user_id' => optional($customer)->user_id,
                    'customer_id' => optional($customer)->id,
                    'email' => $this->email,
                    'company_id' => config('app.company_id'),
                    'reason' => $this->reason,
                ]);
            }else{
                $email_already_exists->update([
                    'user_id' => optional($customer)->user_id,
                    'customer_id' => optional($customer)->id
                ]);
            }

                    $this->success = 'Your request for deletion of this account is being processed... ';
                    $this->reset('email','reason');
            

        } catch (Exception $ex) {
            $this->addError('email',$ex->getMessage());
        }
    }
    }
    public function render()
    {
        return view('livewire.outer.account-deletion');
    }
}
