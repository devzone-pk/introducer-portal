<?php

namespace App\Http\Livewire\Inner;

use App\Models\User\User;
use Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class UpdatePassword extends Component
{
    public $current_password = '';
    public $new_password = '';
    public $repeat_password = '';
    public $success;



    protected function rules()
    {
        return
            [
                'current_password' => ['required'],
                'new_password' => ['required', Password::min(8)->mixedCase()->numbers()],
                'repeat_password' => ['required', 'same:new_password'],
            ];
    }
    protected $validationAttributes = [
        'repeat_password' => 'confirm password',
    ];

    public function render()
    {
        return view('livewire.inner.update-password');
    }

    public function updatePassword()
    {
        $this->reset(['success']);
        $this->validate();
        $result = User::find(session('user_id'));

        if ($this->new_password != $this->repeat_password) {
            $this->addError('new_password', 'New password does not match with repeat password.');
            return;
        }

        if (!Hash::check($this->current_password, $result->password)) {
            $this->addError('current_password', 'Current password does not match.');
            return;
        };

        $result->update(['password' => Hash::make($this->new_password)]);
        $this->reset(['current_password', 'new_password', 'repeat_password']);
        $this->success = 'Password has been updated.';
        $this->dispatchBrowserEvent('close-modal', ['model' => 'password-change-modal']);
    }
}
