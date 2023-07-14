<?php

namespace App\Http\Livewire\Outer;

use App\Mail\Register\VerifyEmail;
use App\Models\Company;
use Exception;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactUs extends Component
{

    public $name;
    public $contact;
    public $email;
    public $time;
    public $message;
    public $success;

    protected $rules = [
        'name' => 'required|string',
        'contact' => 'required|string',
        'email' => 'required|email',
        'time' => 'required|string',
        'message' => 'required|string',
    ];


    public function render()
    {
        return view('livewire.outer.contact-us');
    }

    public function sendMessage()
    {
        $this->reset(['success']);
        $this->validate();
        try {
            $company = Company::find(config('app.company_id'));
            Mail::to($company['email'])->send(new \App\Mail\ContactUs(
                [
                    'name' => $this->name,
                    'contact' => $this->contact,
                    'email' => $this->email,
                    'time' => $this->time,
                    'message' => $this->message
                ]

            ));
            $this->success = 'Thanks, Your request has been received.';
            $this->reset(['message', 'time', 'contact', 'email', 'name']);

        } catch (Exception $exception) {

            $this->addError('email', 'Please try again.');
        }

    }
}
