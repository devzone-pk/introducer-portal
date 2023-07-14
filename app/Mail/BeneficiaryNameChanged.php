<?php

namespace App\Mail;

use App\Models\Customer\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BeneficiaryNameChanged extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $old;
    public $new;
    public $sender;

    public function __construct($old, $new)
    {
        $this->old = $old;
        $this->new = $new;
        $customer = Customer::find(session('customer_id'));
        $this->sender = optional($customer)->first_name;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Receiver Profile Update!')->view('emails.inner.beneficiary-name-changed')
            ->with(['old' => $this->old, 'sender' => $this->sender, 'new' => $this->new]);
    }
}
