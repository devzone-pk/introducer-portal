<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Laravel\Sanctum\PersonalAccessToken;

class LogoutController extends Controller
{
    public function logout()
    {

       
        $data = request()->json()->all();

        if (!empty($data['user_id'])) {
            PersonalAccessToken::where('tokenable_id', $data['user_id'])
                ->where('status', 't')
                ->update([
                    'status' => 'f'
                ]);
        }

        request()->session()->flush();
        Session::flush();
        Redis::del("user.auth." . $data['token']);

        return redirect('login');
    }
}
