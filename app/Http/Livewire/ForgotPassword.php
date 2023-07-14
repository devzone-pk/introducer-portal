<?php

namespace App\Http\Livewire;

use App\Models\User\PasswordReset;
use App\Models\User\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class ForgotPassword extends Component
{
    public $token;
    public $details = [];
    public $email;
    public $password;
    public $confirm_password;
    public $success;


    protected function rules()
    {
        return [
            'token' => 'required',
            'confirm_password' => 'required|same:password',
            'password' => ['required', Password::min(8)->mixedCase()->numbers()],
        ];
    }

    public function mount($token)
    {
        $this->token = $token;
        $valid = PasswordReset::where('token', $token)->where('company_id', config('app.company_id'))->get();
        if ($valid->isNotEmpty()) {
            $this->details = $valid->first()->toArray();
            $this->email = $this->details['email'];
        }
    }

    public function render()
    {
        return view('livewire.forgot-password');
    }


    public function resetPassword()
    {
        $this->validate();

        if (PasswordReset::where('company_id', config('app.company_id'))
            ->where('email', $this->email)
            ->where('token', $this->token)->exists()) {
            $update = User::where('email', $this->email)
                ->where('company_id', config('app.company_id'))
                ->where('type', 'on')->update([
                    'password' => Hash::make($this->password)
                ]);
            if ($update) {
                PasswordReset::where('company_id', config('app.company_id'))->where('email', $this->email)->where('token', $this->token)->delete();
                $this->success = 'Password has been updated.';
                //return $this->redirect('/sign-in');
                //$this->reset(['email', 'details', 'token', 'password', 'confirm_password']);
            }
        } else {
            $this->addError('email', 'Error! Invalid reset link.');
        }
    }
}
