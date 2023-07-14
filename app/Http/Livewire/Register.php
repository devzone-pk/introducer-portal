<?php

namespace App\Http\Livewire;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use Livewire\Component;

class Register extends Component
{
    public $countries = [];
    public $email;
    public $password;
    public $country;
    public $error;
    public $title;
    public $description;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|string|min:8',
        'country' => 'required'
    ];

    public function mount()
    {
        $this->fetchCountries();
    }

    private function fetchCountries()
    {
        $base_url = env('API_BASE_URL', "http://rms-online-api.test/");
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];

        $response = Http::withHeaders($headers)->get($base_url . 'api/v1/countries/sending', [
            'company_id' => env('COMPANY_ID')
        ]);

        if ($response->ok()) {
            $response = $response->json();
            if ($response['success']) {
                $this->countries = $response['data']['countries'];
            }
        }
    }

    public function render()
    {
        return view('livewire.register');
    }

    public function register()
    {
        $this->validate();
        try {
            $this->reset(['error', 'title', 'description']);
            $base_url = env('API_BASE_URL', "http://rms-online-api.test/");
            $headers = [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ];

            $response = Http::withHeaders($headers)->post($base_url . 'api/v1/register', [
                'email' => $this->email,
                'password' => $this->password,
                'country' => $this->country,
                'company_id' => env('COMPANY_ID')
            ]);


            if ($response->ok()) {
                $response = $response->json();
                if ($response['success']) {
                    $this->title = $response['data']['title'];
                    $this->description = $response['data']['description'];

                    $this->reset(['email', 'password', 'country']);
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
