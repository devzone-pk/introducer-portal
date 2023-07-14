<?php

namespace App\Http\Livewire;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ForgotPasswordRequest extends Component
{

    public $email;
    public $error;
    public $success;


    protected $rules = [
        'email' => 'required|email'
    ];


    public function resetPassword()
    {
        $this->validate();
        try {

            $this->reset(['error', 'success']);
            $base_url = env('API_BASE_URL', "http://rms-online-api.test/");
            $headers = [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ];

            $response = Http::withHeaders($headers)->post($base_url . 'api/v1/request/password/reset', [
                'email' => $this->email,
                'company_id' => config('app.company_id')
            ]);


            if ($response->ok()) {
                $response = $response->json();

                if ($response['success']) {
                    $this->success = $response['data']['title'] . PHP_EOL . $response['data']['description'];
                } else {

                    throw new Exception($response['message']);
                }
            } else {
                $response->throw();
            }


        } catch (\Exception $exception) {

            $this->error = $exception->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.forgot-password-request');
    }
}
