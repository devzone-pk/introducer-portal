<?php

namespace App\Http\Livewire\Mobile\Account;

use App\Models\Country\Country;
use App\Models\Customer\Customer;
use App\Models\Customer\CustomerDocument;
use App\Models\Options\Option;
use App\Traits\Modals\DocumentMainTypes;
use App\Traits\Modals\DocumentTypes;
use App\Traits\Modals\Nationality;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadDocument extends Component
{
    use WithFileUploads, DocumentTypes, DocumentMainTypes, Nationality;

    public $success;
    public $error;
    public $customer_id;
    public $type = [];
    public $type_name;
    public $document_no;
    public $issuance;
    public $expiry;
    public $front;
    public $back;
    public $front_url;
    public $back_url;
    public $issuer_authority;
    public $issuer_city_id;
    public $issuer_country = [];
    public $options;
    public $primary;
    public $countries;
    public $cities = [];
    public $documents = [];
    public $document_count;
    public $modal;
    public $incomplete_profile = false;
    public $iteration = 0;
    protected $listeners = [
        'resetErrors' => 'resetErrors',
        'frontAdded',
        'backAdded',
    ];
    protected $rules = [
        'customer_id' => 'required|integer|exists:customers,id',
        'type.id' => 'required|integer',
        'issuance' => 'required|date|before_or_equal:today|date_format:d-m-Y',
        'expiry' => 'required|date|after:issuance|after:today|date_format:d-m-Y',

    ];
    protected $validationAttributes = [
        'type.id' => 'type',
        'issuer_country.id' => 'issuer_country',
    ];

    protected $messages = [
        'front.required' => 'Please upload document.'
    ];
    protected $skipLoading = ['front', 'back'];

    public function updatedFront($value)
    {
        $this->iteration++;
        $this->resetErrorBag('front');
        $this->front_url = '';
    }

    public function frontAdded($value)
    {
        $this->front = $value;
    }

    public function backAdded($value)
    {
        $this->back = $value;
    }

    public function updatedBack($value)
    {
        $this->iteration++;
        $this->resetErrorBag('back');
        $this->back_url = '';
    }

    public function mount($primary_id, $modal = false)
    {

        //$this->options = Option::whereNull('deleted_at')->where('option_type_id', 2)->get();
        //$this->countries = Country::whereNull('deleted_at')->get();
        $this->customer_id = $primary_id;
        $this->modal = $modal;

        $this->document_count = CustomerDocument::where('customer_id', $this->customer_id)->count();
        $this->document_types = Option::where('option_type_id', '2')
            ->groupBy('secondary_name')->select('secondary_name')->get()->toArray();
        $req = request()->all();
        if (!empty($req['incomplete'])) {
            $this->incomplete_profile = true;
        }

    }

    public function render()
    {
        $customer = Customer::find($this->customer_id);
        return view('livewire.mobile.account.upload-document', compact('customer'));
    }

    public function add()
    {

        $this->reset(['error', 'success']);
        $this->resetErrorBag();
        $this->withValidator(function (Validator $validator) {
            if ($validator->fails()) {
                $this->dispatchBrowserEvent('close-modal', ['model' => 'error-dialog']);
                $this->dispatchBrowserEvent('open-modal', ['model' => 'error-dialog']);
            }
        })->validate();


        if (empty($this->type['id'])) {
            $this->addError('type.id', 'The type field is required.');
            return;
        }

        $type_details = Option::find($this->type['id']);
        if ($type_details['additional_info'] == 'primary') {
            if (empty($this->document_no)) {
                $this->addError('document_no', 'Document no is required.');
                return;
            }
            CustomerDocument::where('customer_id', $this->customer_id)
                ->where('type', $this->type['id'])
                ->where('status', 't')->where('is_primary', 't')->update([
                    'status' => 'f',
                ]);
            $this->primary = 't';
        } else {
            $this->primary = 'f';
        }

        $issuance = null;
        $expiry = null;
        if (!empty($this->issuance)) {
            $issuance = Carbon::createFromFormat('d-m-Y', $this->issuance);
            $issuance = $issuance->toDateString();
        } else {
            $this->addError('issuance', 'The issuance field is required.');
            return;
        }

        if (!empty($this->expiry)) {
            $expiry = Carbon::createFromFormat('d-m-Y', $this->expiry);
            $expiry = $expiry->toDateString();
        } else {
            $this->addError('expiry', 'The expiry field is required.');
            return;
        }

        if (Redis::exists("document.front." . session('customer_id'))) {
            $this->front_url = Redis::get("document.front." . session('customer_id'));
        } else {
            $this->addError('front', 'The front document is required.');
            return;
        }


        if (Redis::exists("document.back." . session('customer_id'))) {
            $this->back_url = Redis::get("document.back." . session('customer_id'));
        }


        CustomerDocument::create([
            'customer_id' => $this->customer_id,
            'front' => $this->front_url,
            'back' => $this->back_url,
            'type' => $this->type['id'],
            'number' => $this->document_no,
            'issuer_authority' => $this->issuer_authority,
            'issuance' => $issuance,
            'expiry' => $expiry,
            'issuer_city_id' => $this->issuer_city_id,
            'issuer_country_id' => $this->issuer_country['id'] ?? null,
            'is_primary' => $this->primary,
            'status' => 't'
        ]);


        $this->reset(['front', 'front_url', 'back', 'back_url', 'document_no', 'issuance', 'expiry', 'issuer_authority', 'type', 'issuer_city_id', 'issuer_country', 'primary']);
        $this->success = 'Document has been added';
        if ($this->incomplete_profile) {
            return $this->redirect('/mobile/send/money');
        }
        if ($this->modal) {
            $this->emit('documentDone');
        }
        return $this->redirect('/mobile/documents');
        //

    }


    public function resetErrors()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

}
