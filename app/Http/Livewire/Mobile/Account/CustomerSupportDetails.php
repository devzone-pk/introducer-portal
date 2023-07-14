<?php

namespace App\Http\Livewire\Mobile\Account;

use App\Models\Customer\Complaint;
use App\Models\Customer\ComplaintDetail;
use App\Models\Transfer\Transfer;
use Illuminate\Validation\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerSupportDetails extends Component
{
    use WithPagination;

    public $complain_id;
    public $complain = [];
    public $description;
    public $success;
    protected $listeners = [
        'resetErrors' => 'resetErrors'
    ];
    protected $rules = [
        'description' => 'required|string'
    ];


    public function mount($complain_id)
    {
        $this->complain_id = $complain_id;
        $this->complain = Complaint::from('complaints as c')
            ->join('options as o', 'o.id', '=', 'c.option_id')
            ->leftJoin('transfers as t', 't.id', '=', 'c.transfer_id')
            ->where('c.id', $complain_id)->select('c.*', 'o.name', 't.transfer_code')->first();

    }
    public function render()
    {
        $comments = ComplaintDetail::where('complain_id', $this->complain_id)->orderBy('id')->paginate(20);
        return view('livewire.mobile.account.customer-support-details',compact('comments'));
    }

    public function postComment()
    {
        $this->withValidator(function (Validator $validator) {
            if ($validator->fails()) {
                $this->dispatchBrowserEvent('close-modal', ['model' => 'error-dialog']);
                $this->dispatchBrowserEvent('open-modal', ['model' => 'error-dialog']);
            }
        })->validate();


        ComplaintDetail::create([
            'complain_id' => $this->complain_id,
            'description' => $this->description,
            'user_id' => session('user_id'),
            'type' => 'customer'
        ]);
        if (!empty($this->complain['transfer_id'])) {
            Transfer::find($this->complain['transfer_id'])->update([
                'alert' => 't'
            ]);
        }

        $this->description = '';
        $this->success = 'Your comment has been posted.';
    }

    public function resetErrors()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }


}
