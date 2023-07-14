<?php

namespace App\Http\Livewire\Inner;

use App\Models\Complaint;
use Livewire\Component;

class CustomerSupport extends Component
{
    public $contact_data;
    public $complaints_data;
    public $type;

    public function mount($type)
    {
        $response = \DB::table('companies')->where('id', env('COMPANY_ID', 1))->exists();
        if ($response) $this->contact_data = json_decode(json_encode(\DB::table('companies')->find(1)), true);

        $this->complaints_data = Complaint::where('customer_id', session('customer_id'))
            ->with(['customer', 'option', 'transfer'])->orderByDesc('id')->get();
        $this->type = $type;
    }

    public function render()
    {
        return view('livewire.inner.customer-support');
    }
}
