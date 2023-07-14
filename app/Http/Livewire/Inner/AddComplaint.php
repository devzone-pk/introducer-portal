<?php

namespace App\Http\Livewire\Inner;

use App\Models\Admin;
use App\Models\Complaint;
use App\Models\Options\Option;
use App\Models\Transfer\Transfer;
use App\Models\Transfer\TransferNote;
use App\Notifications\CustomerSupportNotification;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Notification;

class AddComplaint extends Component
{
    public $options;
    public $payment_types;
    public $complaint;
    public $show_payment_type = true;
    public $success;
    public $error;
    public $type;
    protected $rules = [
        'complaint.complain_type' => 'required|integer',
        'complaint.message' => 'required|string',
    ];
    protected $validationAttributes = [
        'complaint.complain_type' => 'Complain Type',
        'complaint.message' => 'Message',
    ];

    public function mount($type, $transfer_id = null, $category = null)
    {
        $this->options = Option::where('option_type_id', 15)->get();
        $this->payment_types = Transfer::join('transfer_beneficiaries as tb', 'tb.transfer_id', '=', 'transfers.id')
            ->where('transfers.customer_id', session('customer_id'))
            ->select(['transfers.id', 'tb.id as tb_id', 'transfers.receiving_amount', 'transfers.transfer_code', \DB::raw('CONCAT(tb.first_name, " ", tb.last_name) as beneficiary_name')])
            ->groupBy('transfers.transfer_code')
            ->get();

        $this->complaint['complain_type'] = $category;
        $this->complaint['payment_number'] = $transfer_id;
        if (!empty($transfer_id)) {
            $transfer = Transfer::find($transfer_id);
            $this->complaint['status'] = $transfer->status;
        }
        $this->type = $type;
    }

    public function render()
    {
        return view('livewire.inner.add-complaint');
    }

    public function submitComplaint()
    {
        $this->validate();

        try {
            DB::beginTransaction();
            if (!empty($this->complaint['payment_number'])) {
                $transfer = Transfer::find($this->complaint['payment_number']);



                if ($this->complaint['complain_type'] == '171') {
                    TransferNote::create([
                        'transfer_id' => $this->complaint['payment_number'],
                        'type' => $this->complaint['complain_type'],
                        'description' => 'As per request from customer to cancel the transfer. Status has been change to cancelling.',
                        'added_by' => '1',
                        'is_private' => 't'
                    ]);


                    $data_update = [
                        'alert' => 't'
                    ];

                    Transfer::where('id', $this->complaint['payment_number'])->whereNotIn('status', ['REF','CAN','PAI','CMH'])->update(
                        $data_update
                    );
                } else {
                    Transfer::where('id', $this->complaint['payment_number'])
                        ->update([
                            'alert' => 't',
                        ]);
                }

            }

            $response = Complaint::create([
                'option_id' => $this->complaint['complain_type'],
                'customer_id' => session('customer_id'),
                'transfer_id' => !empty($this->complaint['payment_number']) ? $this->complaint['payment_number'] : null,
                'description' => $this->complaint['message'],
                'status' => 'open'
            ]);

            $users = Admin::where('company_id', config('app.company_id'))->where('status', 't')->get();
            Notification::send($users, new CustomerSupportNotification($response->toArray()));


            if (!$response) return $this->error = 'Something went wrong. Please try again.';

            $this->success = 'Complaint submitted successfully.';
            $this->reset('complaint');
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $this->addError('error', $e->getMessage());
        }

    }

    public function updatedComplaintComplainType($value)
    {
        $option = $this->getOptions($value);
        if (strtolower(trim($option->name)) == 'other') {
            $this->show_payment_type = false;
            $this->complaint['payment_number'] = '';
        } else {
            $this->show_payment_type = true;
        }
    }

    public function getOptions($value): Option
    {
        return Option::where('id', $value)->first('name');
    }
}
