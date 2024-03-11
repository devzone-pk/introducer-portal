<?php

namespace App\Http\Middleware;

use App\Models\Country\Country;
use Closure;
use Illuminate\Http\Request;

class UserCountryCheck
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (empty(env('LOGIN_FROM_ANYWHERE'))) {
            $data = session()->all();
            $iso2 = $_SERVER['HTTP_CF_IPCOUNTRY'] ?? null;

            if (env('APP_ENV') == 'production' && $data['iso2'] != $iso2) {
                if ($data['email'] != 'talha8018@gmail.com') {
                    $countries = Country::whereIn('iso2', [$data['iso2'], $iso2])->get();
                    abort('401',  'Your login attempt is coming from the <b>' . optional($countries->where('iso2', $iso2)->first())->name . ' </b>, but your account was registered in <b> ' . optional($countries->where('iso2', $data['iso2'])->first())->name . '</b>. Please be aware that our services can only be accessed from the country where you initially registered, which is <b>' . optional($countries->where('iso2', $data['iso2'])->first())->name . ' </b>. Thank you for your understanding');
                }
            }
        }
        return $next($request);
    }
}
