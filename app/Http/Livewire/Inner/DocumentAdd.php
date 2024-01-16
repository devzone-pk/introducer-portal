<?php

namespace App\Http\Livewire\Inner;

use App\Models\City;
use App\Models\Country\Country;
use App\Models\Customer\Customer;
use App\Models\Customer\CustomerDocument;
use App\Models\Options\Option;
use Livewire\Component;
use Livewire\WithFileUploads;

class DocumentAdd extends Component
{

    use WithFileUploads;

    public $success;
    public $error;
    public $customer_id;
    public $type;
    public $document_no;
    public $document_types;
    public $doc_type;
    public $issuance;
    public $expiry;
    public $front;
    public $back;
    public $front_url;
    public $back_url;
    public $issuer_authority;
    public $issuer_city_id;
    public $issuer_country_id;
    public $options;
    public $primary;
    public $countries;
    public $cities = [];
    public $documents = [];
    public $document_count;
    public $incomplete_profile = false;


    protected $rules = [
        'customer_id' => 'required|integer|exists:customers,id',
        'type' => 'required|integer',
        'issuance' => 'required|date|before_or_equal:today|date_format:Y-m-d',
        'expiry' => 'required|date|after:issuance|after:today|date_format:Y-m-d',
        'front' => 'required|file|mimes:pdf,jpg,jpeg,png,bmp,svg,webp',
        'back' => 'nullable|file|mimes:pdf,jpg,jpeg,png,bmp,svg,webp',
        'issuer_country_id' => 'required',
        'doc_type' => 'required'
    ];
    protected $validationAttributes = [
        'type.id' => 'type',
        'issuer_country.id' => 'issuer_country',
        'doc_type' => 'document type'
    ];

    protected $messages = [
        'type.required' => 'Document name is required',
        'issuance.required' => 'Document issuance date is required',
        'expiry.required' => 'Document expiry date is required',
        'front.required' => 'Please upload front side of document.',
        'issuer_country_id.required' => 'Please select issuer country of document.',
        'front.size' => 'File must be less than 12MB in size',
        'back.size' => 'File must be less than 12MB in size',
        'doc_type.required' => 'Document type is required',
    ];


    public function updatedFront($value)
    {
        $this->resetErrorBag('front');
        $this->front_url = '';
    }

    public function updatedBack($value)
    {
        $this->resetErrorBag('back');
        $this->back_url = '';
    }

    public function mount($primary_id)
    {
        $this->document_count = CustomerDocument::where('customer_id', $this->customer_id)->count();
        $this->countries = Country::whereNull('deleted_at')->get();
        $this->customer_id = $primary_id;

        $this->document_types = Option::where('option_type_id', '2')
            ->groupBy('secondary_name')->select('secondary_name')->get()->toArray();

        $req = request()->all();
        if (!empty($req['incomplete'])) {
            $this->incomplete_profile = true;
        }
    }

    public function updatedDocType($val)
    {
        if (!empty($val)) {
            $this->options = Option::where('option_type_id', '2')
                ->where('secondary_name', $val)
                ->orderBy('additional_info')->get();
        } else {
            $this->type = null;
        }
    }

    public function render()
    {
        $customer = Customer::find($this->customer_id);
        return view('livewire.inner.document-add', compact('customer'));
    }

    public function add()
    {
        $this->reset(['error', 'success']);
        $this->resetErrorBag();
        $this->validate();

        if (empty($this->front_url)) {
            $this->front_url = ($this->front->storePublicly('documents', 's3'));
        }

        if ($this->back && empty($this->back_url)) {
            $this->back_url = ($this->back->storePublicly('documents', 's3'));
        }

        $type_details = Option::find($this->type);
        if ($type_details['additional_info'] == 'primary') {
            if (empty($this->document_no)) {
                $this->addError('document_no', 'Document no is required.');
                return ;
            }
            CustomerDocument::where('customer_id', $this->customer_id)
                ->where('type', $this->type)
                ->where('status', 't')->where('is_primary', 't')->update([
                    'status' => 'f',
                ]);
            $this->primary = 't';
        } else {
            $this->primary = 'f';
        }

        CustomerDocument::create([
            'customer_id' => $this->customer_id,
            'front' => $this->front_url,
            'back' => $this->back_url,
            'type' => $this->type,
            'number' => $this->document_no,
            'issuer_authority' => $this->issuer_authority,
            'issuance' => !empty($this->issuance) ? date('Y-m-d', strtotime($this->issuance)) : '',
            'expiry' => !empty($this->expiry) ? date('Y-m-d', strtotime($this->expiry)) : '',
            'issuer_city_id' => $this->issuer_city_id,
            'issuer_country_id' => $this->issuer_country_id,
            'is_primary' => $this->primary,
            'status' => 't'
        ]);
        $this->emit('documentDone');
        $this->reset(['front', 'front_url', 'back', 'back_url', 'document_no', 'issuance', 'expiry', 'issuer_authority', 'issuer_city_id', 'issuer_country_id', 'type', 'primary']);
        $this->success = 'Document has been added';
        if ($this->incomplete_profile) {
            return $this->redirect('/send/money');
        }
    }

}
