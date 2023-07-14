<?php

namespace App\Mail;

use App\Models\Customer\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BeneficiaryCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $sender;
    public $receiver;

    public function __construct($receiver)
    {
        $this->receiver = $receiver;
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
        return $this->subject('New Receiver Created!')->view('emails.inner.new-receiver')
            ->with(['receiver' => $this->receiver, 'sender' => $this->sender]);
    }
}
