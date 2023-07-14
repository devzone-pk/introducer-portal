<?php

namespace App\Http\Livewire\Outer;

use App\Models\Options\Option;
use App\Models\Transfer\Transfer;
use Livewire\Component;

class TrackTransfer extends Component
{

    public $transfer_code;
    public $success;
    public $success_status;
    public $error;

    protected $rules = [
        'transfer_code' => 'required'
    ];

    public function search()
    {
        $this->reset(['error', 'success']);
        $this->validate();
        $transfer = Transfer::where('company_id', config('app.company_id'))
            ->where('transfer_code', $this->transfer_code)->get();
        if ($transfer->isNotEmpty()) {
            $transfer = $transfer->first();
            $status = Option::where('option_type_id', 10)->where('key', $transfer->status)->first();
            $this->success = 'Your transaction status is ';
            $this->success_status = $status['secondary_name'];

        } else {
            $this->error = 'No record found.';
        }
    }

    public function render()
    {
        return view('livewire.outer.track-transfer');
    }
}
