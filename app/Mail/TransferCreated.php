<?php

namespace App\Mail;

use App\Models\Customer\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TransferCreated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $transfer;
    public $sender;

    public function __construct($transfer)
    {
        $this->transfer = $transfer;
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
        return $this->subject($this->transfer['transfer_code'] . ' Transfer has been created.')
            ->view('emails.inner.transfer-created')->with(['transfer' => $this->transfer, 'sender' => $this->sender]);
    }
}
