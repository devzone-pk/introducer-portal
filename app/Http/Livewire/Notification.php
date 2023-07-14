<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Notification extends Component
{
    public function render()
    {
        $user = User::find(session('user_id'));
        return view('livewire.notification', compact('user'));
    }

    public function markAsRead($id, $link = null)
    {
        DB::table('notifications')->where('id', $id)->update([
            'read_at' => now()
        ]);

        if (!empty($link)) {
            return $this->redirect($link);
        }


    }
}
