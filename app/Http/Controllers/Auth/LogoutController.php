<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    public function logout()
    {

        $data = request()->json()->all();
        request()->session()->flush();
        Session::flush();
        Redis::delete("user.auth." . $data['token']);
        return redirect('login');
    }
}
