<?php

namespace App\Http\Livewire\Mobile;

use App\Models\User\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use Livewire\Component;

class ChangePassword extends Component
{
    public $current_password = '';
    public $new_password = '';
    public $repeat_password = '';
    public $success;

    protected $rules = [
        'current_password' => 'required',
        'new_password' => 'required|min:8',
        'repeat_password' => 'required|same:new_password'
    ];
    protected $listeners = [
        'resetErrors' => 'resetErrors'
    ];

    public function render()
    {
        return view('livewire.mobile.change-password');
    }

    public function updatePassword()
    {

        $this->reset(['success']);
        $this->withValidator(function (Validator $validator) {
            if ($validator->fails()) {
                $this->dispatchBrowserEvent('close-modal', ['model' => 'error-dialog']);
                $this->dispatchBrowserEvent('open-modal', ['model' => 'error-dialog']);
            }
        })->validate();
        $result = User::find(session('user_id'));

        if ($this->new_password != $this->repeat_password) {
            $this->addError('new_password', 'New password does not match with repeat password.');
            return;
        };
        if (!Hash::check($this->current_password, $result->password)) {
            $this->addError('current_password', 'Current password does not match.');
            return;
        };

        $result->update(['password' => Hash::make($this->new_password)]);

        $this->reset(['current_password', 'new_password', 'repeat_password']);
        $this->success = 'Password has been updated.';
        //return redirect()->to('logout');
    }
}
