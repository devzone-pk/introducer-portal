<?php

namespace App\Http\Livewire\Mobile\Account;

use App\Models\Admin;
use App\Models\Complaint;
use App\Models\Options\Option;
use App\Models\Transfer\Transfer;
use App\Models\Transfer\TransferNote;
use App\Notifications\CustomerSupportNotification;
use App\Traits\Modals\ComplainTypes;
use App\Traits\Modals\CustomerTransfer;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Validator;
use Livewire\Component;

class AddCustomerSupport extends Component
{
    use ComplainTypes, CustomerTransfer;

    public $success;
    public $alert;
    public $type = [];
    public $transfer = [];
    public $message;

    protected $rules = [
        'type.id' => 'required|integer',
        'message' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
    ];
    protected $validationAttributes = [
        'type.id' => 'Complain Type',
        'message' => 'Message',
    ];

    protected $listeners = [
        'resetErrors' => 'resetErrors'
    ];
    protected $messages=[
        'message.regex' => 'Message must contain only alphabets and digits',

    ];

    public function mount($transfer_id = null, $category = null)
    {
        if (!empty($transfer_id)) {
            $transfer = Transfer::find($transfer_id);
            $this->transfer = [
                'id' => $transfer->id,
                'status' => $transfer->status,
                'receiving_amount' => $transfer->receiving_amount,
                'transfer_code' => $transfer->transfer_code,
                'beneficiary_name' => $transfer->beneficiary->first_name . ' ' . $transfer->beneficiary->last_name
            ];
        }

        if (!empty($category)) {
            $this->type = Option::find($category)->toArray();
        }
    }

    public function render()
    {
        return view('livewire.mobile.account.add-customer-support');
    }


    public function submitComplaint()
    {
        $this->success = '';
        $this->withValidator(function (Validator $validator) {
            if ($validator->fails()) {
                $this->dispatchBrowserEvent('close-modal', ['model' => 'error-dialog']);
                $this->dispatchBrowserEvent('open-modal', ['model' => 'error-dialog']);
            }
        })->validate();

        try {


            DB::beginTransaction();


            if (!empty($this->transfer['id'])) {

                if ($this->type['id'] == '171') {
                    TransferNote::create([
                        'transfer_id' => $this->transfer['id'],
                        'type' => $this->type['id'],
                        'description' => 'As per request from customer to cancel the transfer. Status has been change to cancelling.',
                        'added_by' => '1',
                        'is_private' => 't'
                    ]);
                    $data_update = [
                        'alert' => 't'
                    ];

                    Transfer::where('id', $this->transfer['id'])->whereNotIn('status',  ['REF','CAN','PAI','CMH'])->update(
                        $data_update
                    );
                } else {
                    Transfer::where('id', $this->transfer['id'])
                        ->update([
                            'alert' => 't',
                        ]);
                }


            }


            $response = Complaint::create([
                'option_id' => $this->type['id'],
                'customer_id' => session('customer_id'),
                'transfer_id' => !empty($this->transfer['id']) ? $this->transfer['id'] : null,
                'description' => $this->message,
                'status' => 'open'
            ]);

            $users = Admin::where('company_id', config('app.company_id'))->where('status', 't')->get();
            Notification::send($users, new CustomerSupportNotification($response->toArray()));


            if (!$response) return $this->alert = 'Something went wrong. Please try again.';

            $this->success = 'Ticket has been created.';
            $this->reset('transfer', 'type', 'message');
            DB::commit();

        } catch (Exception $exception) {
            DB::rollBack();
            $this->addError('alert', $exception->getMessage());
        }
    }

    public function resetErrors()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
