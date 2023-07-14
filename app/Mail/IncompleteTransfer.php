<?php

namespace App\Mail;

use App\Models\Transfer\Transfer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IncompleteTransfer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $sender;
    public $transfer;

    public function __construct($sender, $transfer)
    {
        $this->sender = $sender;
        $this->transfer = $transfer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject('Incomplete Transfer')->view('emails.inner.incomplete-transfer')
            ->with(['sender' => $this->sender, 'transfer' => $this->transfer]);
    }
}
