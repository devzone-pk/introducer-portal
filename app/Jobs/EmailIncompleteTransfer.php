<?php

namespace App\Jobs;

use App\Mail\IncompleteTransfer;
use App\Models\Transfer\Transfer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EmailIncompleteTransfer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $sender;
    public $transfer_id;
    public $email;

    public function __construct($sender, $transfer_id, $email)
    {
        $this->sender = $sender;
        $this->transfer_id = $transfer_id;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $transfer = Transfer::where('id', $this->transfer_id)->select('transfer_code')->whereIn('status', ['PEN', 'INC'])->get();
        if ($transfer->isEmpty()) {
            return;
        }
        $transfer = $transfer->first()->toArray();

        //Mail::to($this->email)->send(new IncompleteTransfer($this->sender, $transfer));
    }
}
