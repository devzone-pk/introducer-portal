<?php

namespace App\Http\Livewire\Mobile;

use App\Models\Transfer\Transfer;
use Livewire\Component;

class TransferHistory extends Component
{
    protected $listeners = [
        'resetErrors' => 'resetErrors'
    ];

    public function render()
    {
        $input = request()->all();
        $transfers = Transfer::where('channel', 'on')
            ->where('customer_id', session('customer_id'))
            ->where('status', '!=', 'REF')
            ->when(!empty($input['incomplete']), function ($q) {
                $q->where('status', 'INC');
            })
            ->orderBy('id', 'desc')->paginate(40);

        return view('livewire.mobile.transfer-history', compact('transfers'));
    }

    public function continue($url){
        //href="{{ url('gateway/trust/payment') }}/{{$transfer->transfer_code}}"

          return $this->redirect($url);
    }
}
