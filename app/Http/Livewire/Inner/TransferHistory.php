<?php

namespace App\Http\Livewire\Inner;

use App\Models\Options\Option;
use App\Models\Transfer\Transfer;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class TransferHistory extends Component
{
    use WithPagination;

    public $detail = [];
    public $type;
    public $portal;
    public $from;
    public $to;
    public $status;
    public $statuses = [];

    protected $paginationTheme = 'bootstrap';

    public function mount($type = null, $portal = 'web')
    {
        if ($type == 'dashboard') {
            $this->type = 'dashboard';
        }
        $this->portal = $portal;
        $this->from = Carbon::now()->subMonth()->toDateString();
        $this->to = date('Y-m-d');
        $req = request()->all();
        if (!empty($req['status'])) {
            $this->status = $req['status'];
        }
        $this->statuses = Option::where('option_type_id', 10)->where('key', '!=', 'CMR')
            ->orderBy('order', 'asc')
            ->get()->toArray();
    }

    public function render()
    {
        $transfers = Transfer::where('channel', 'on')
            ->where('customer_id', session('customer_id'))
            ->where('status', '!=', 'REF')
            ->when($this->type == 'dashboard', function ($q) {
                $q->orderBy('id', 'desc')->limit(5);
            })
            ->when(!empty($this->from), function ($q) {
                $q->whereDate('created_at', '>=', $this->from);
            })
            ->when(!empty($this->to), function ($q) {
                $q->whereDate('created_at', '<=', $this->to);
            })
            ->when(!empty($this->status), function ($q) {
                if($this->status == 'PRC'){
                    $q->whereIn('status', ['PRC','STP']);
                } else {
                    $q->where('status', $this->status);
                }

            })
            ->orderBy('id', 'desc')
            ->paginate(7);

        return view('livewire.inner.transfer-history', compact('transfers'));
    }

    public function setDetails($array)
    {

        $this->detail = json_decode($array, true);
        $this->dispatchBrowserEvent('open-modal', ['model' => 'transaction-detail']);
    }
}
