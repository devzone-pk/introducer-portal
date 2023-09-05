<?php

namespace App\Http\Livewire;


use App\Models\Country\Country;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $error;
    public $success;
    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|string|min:8'
    ];

    public function render()
    {
        return view('livewire.login');
    }


    public function login()
    {
        $this->validate();
        try {
            $this->reset(['error', 'success']);
            $base_url = env('API_BASE_URL', "http://rms-online-api.test/");
            $headers = [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ];


            $response = Http::withHeaders($headers)->post($base_url . 'api/v1/login', [
                'email' => $this->email,
                'password' => $this->password,
                'company_id' => env('COMPANY_ID'),
                'iso2' => $_SERVER['HTTP_CF_IPCOUNTRY'] ?? null
            ]);

            if ($response->ok()) {
                $response = $response->json();


                if (!empty($response['success'])) {

                    if (empty(env('LOGIN_FROM_ANYWHERE'))) {
                        $iso2 = $_SERVER['HTTP_CF_IPCOUNTRY'] ?? null;
                        if ($response['data']['iso2'] != $iso2 && env('APP_ENV') == 'production') {
                            $country_name = Country::where('iso2', $iso2)->first();
                            if ($this->email != 'talha8018@gmail.com') {
                                throw new Exception('You cannot login from ' . optional($country_name)->name);
                            }

                        }
                    }
                    $this->success = $response['message'];
                    Session::put($response['data']);
                    return $this->redirect('/dashboard');

                } else {

                    if (empty($response['errors'])) {
                        throw new Exception($response['message']);
                    } else {
                        $this->error = $response['message'];
                        foreach ($response['errors'] as $key => $r) {
                            $this->addError($key, $r);
                        }
                    }
                }
            } else {
                $response->throw();
            }
        } catch (Exception $ex) {
            $this->error = $ex->getMessage();
        }
    }


}
