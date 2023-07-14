<?php

namespace App\Http\Livewire;


use App\Models\Customer\Customer;
use App\Models\User;
use App\Models\User\PasswordReset;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class VerifyOtp extends Component
{
    public $email;
    public $user_id;
    public $otp;
    public $error;
    public $success;

    public function mount()
    {
        $this->user_id = (Request::segment(2));
        $this->email = (Request::segment(3));
    }

    public function render()
    {

        return view('livewire.verify-otp');
    }


    public function verify()
    {
        if (empty($this->otp)) {
            return $this->error = "Please enter valid OTP.";
        }

        $user = User::find($this->user_id);
        if ($user['email'] != $this->email) {
            return $this->error = "This link has been expired.";
        }
        if (!empty($user['email_verified_at'])) {
            return $this->error = "This email has already verified.";
        }
        if (!PasswordReset::where('email', $this->email)->where('company_id', config('app.company_id'))
            ->where('2fa_code', $this->otp)->exists()) {
            return $this->error = "Please enter valid OTP.";
        }

        $user->update([
            'email_verified_at' => date('Y-m-d h:i:s')
        ]);

        PasswordReset::where('email', $this->email)
            ->where('company_id', config('app.company_id'))
            ->where('2fa_code', $this->otp)->delete();

        $this->reset('otp');
        $this->success = true;
    }

}
