<?php

namespace App\Http\Middleware;

use App\Models\Customer\Customer;
use Carbon\Carbon;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Laravel\Sanctum\PersonalAccessToken;

class IsUserLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function handle(Request $request, Closure $next)
    {
        try {

            $token = $this->getToken($request);

            $tk = PersonalAccessToken::findToken($token);

            if (empty($tk) || $tk->status == 'f') {
                throw new Exception('Unauthorized.');
            }

            if (Redis::exists("user.auth.{$token}")) {

                $last_used_at = Carbon::parse($tk->last_used_at);
                $inactivity = $last_used_at->diffInMinutes(Carbon::now());

                if ($inactivity >= 30) {
                    throw new Exception('Timed Out.');
                }

                $login_detail = Redis::get("user.auth.{$token}");
                $request->json()->add(json_decode($login_detail, true));
                if (!Session::has('email')) {
                    Session::put(json_decode($login_detail, true));
                }

                PersonalAccessToken::where('tokenable_id', $tk->tokenable_id)
                    ->where('status', 't')
                    ->update([
                        'last_used_at' => now(),
                    ]);

                return $next($request);
            }

            $login = $tk->tokenable()->first();
            $user = Customer::from('customers as c')
                ->join('countries as ct', 'ct.id', '=', 'c.country_id')
                ->where('c.user_id', $login->id)->where('c.status', 't')->where('c.type', 'on')
                ->select(['c.*', 'ct.name as country_name', 'ct.iso3', 'ct.iso2', 'ct.currency'])
                ->get();
            if ($user->isEmpty()) {
                throw new Exception('Unauthorized.');
            }

            $user = $user->first()->toArray();
            $details = $this->userDetails($login, $user, $token);

         
            Session::flush();
            Session::put($details);
           
            $request->json()->add($details);
            Redis::set("user.auth.{$token}", json_encode($details), 'EX', 36000);

            return redirect($_SERVER['REQUEST_URI']);
        } catch (\Exception $e) {

            $user_id = $request->session()->get('user_id');
            if (!empty($user_id)) {
                PersonalAccessToken::where('tokenable_id', $user_id)
                    ->where('status', 't')
                    ->update([
                        'status' => 'f'
                    ]);
            }

            $request->session()->flush();
            Session::flush();
            if (!empty($token)) {
                Redis::del("user.auth.{$token}");
            }

            return redirect('login');
        }
    }

    private function getToken($request)
    {
        try {
            $token = $request->header('Authorization');
            if (!empty($token)) {
                $token = explode(" ", $token, 2);
                return $token[1];
            } else if (!empty($request->session()->has('token'))) {
                return $request->session()->get('token');
            } else {
                throw new Exception('Unauthorized.');
            }
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function userDetails($login, $user, $token)
    {
        return [
            'token' => $token,
            'user_id' => $login['id'],
            'customer_id' => $user['id'],
            'name' => $user['first_name'] . '  ' . $user['middle_name'] . ' ' . $user['last_name'],
            'email' => $login['email'],
            'country' => $user['country_name'],
            'country_name' => $user['country_name'],
            'country_id' => $user['country_id'],
            'currency' => $user['currency'],
            'iso2' => $user['iso2'],
            'iso3' => $user['iso3'],
            'user_agent_id' => $user['user_agent_id']
        ];
    }
}
