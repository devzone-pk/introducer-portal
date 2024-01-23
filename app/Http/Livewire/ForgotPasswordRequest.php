<?php

namespace App\Http\Livewire;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;
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
            $key = 'reset_attempts:' . Str::lower($this->email) . '|' . env('COMPANY_ID');
            $is_limit_exceeded = $this->limitExceeded($key);

            if ($is_limit_exceeded) {
                throw new Exception('You have exceeded the maximum limit of requests for password reset. You can try again after 30 minutes. Please contact customer support if the matter is necessary.');
            }

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
                $this->updateResetAttemptKey($key);
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
    public function updateResetAttemptKey($key)
    {
        $increment_attempt = 1;
        $no_of_attempts = Redis::get($key);
        $ttl = 1800;
        if (!empty($no_of_attempts)) {
            $ttl = Redis::ttl($key);
        }
        Redis::set($key, ($no_of_attempts + $increment_attempt), 'EX', $ttl);
    }

    public function limitExceeded($key): bool
    {
        $no_of_attempts = Redis::get($key);
        if ($no_of_attempts >= 3) {
            return true;
        }
        return false;
    }

    public function render()
    {
        return view('livewire.forgot-password-request');
    }
}
