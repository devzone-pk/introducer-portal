<?php

namespace App\Http\Livewire\Mobile;

use App\Models\Transfer\Transfer;
use Livewire\Component;

class TrackTransfer extends Component
{
    public $transaction_code;
    public $error;
    public $transfer = [];

    protected $rules = [
        'transaction_code' => 'required'
    ];

    public function render()
    {

        return view('livewire.mobile.track-transfer');
    }

    public function track()
    {
        $this->reset(['transfer', 'error']);

        $this->validate();

        $transfer = Transfer::where('company_id', config('app.company_id'))
            ->where('transfer_code', $this->transaction_code)
            ->select('status', 'beneficiary_id', 'id','transfer_code')
            ->orderBy('id', 'asc')->get();

        if ($transfer->isNotEmpty()) {
            $this->transfer = $transfer->first();
        } else {
            $this->error = 'No record found.';
        }


    }


    public function resetData()
    {
        $this->reset(['transaction_code', 'transfer', 'error']);
    }

}
