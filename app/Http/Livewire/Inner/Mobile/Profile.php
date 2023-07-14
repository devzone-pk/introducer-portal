<?php

namespace App\Http\Livewire\Inner\Mobile;

use App\Models\Customer\Customer;
use Livewire\Component;

class Profile extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    public $dob;
    public $day;
    public $month;
    public $year;
    public $gender;
    public $phone;
    public $success;
    public $customer = [];

    protected $rules = [
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'dob' => 'required|date|date_format:Y-m-d',
        'day' => 'required|integer|min:1|max:31',
        'gender' => 'required|string|in:f,m',
        'phone' => 'required|string'
    ];

    public function mount()
    {
        $this->customer = Customer::find(session('customer_id'));
        $this->first_name = $this->customer['first_name'];
        $this->last_name = $this->customer['last_name'];
        $this->email = $this->customer['email'];
        $this->dob = $this->customer['dob'];
        if (!empty($this->dob)) {
            $date = explode('-', $this->dob);
            $this->year = $date[0];
            $this->month = $date[1];
            $this->day = $date[2];
        }

        $this->gender = $this->customer['gender'];
        $this->phone = $this->customer['phone'];
    }


    public function render()
    {
        return view('livewire.inner.mobile.profile');
    }

    public function profileUpdate()
    {
        $this->success = '';
        $this->validate();
        $data['phone'] = $this->phone;
        if (empty($this->customer['first_name'])) {
            $data['first_name'] = $this->first_name;
        }
        if (empty($this->customer['last_name'])) {
            $data['last_name'] = $this->last_name;
        }
        if (empty($this->customer['dob'])) {
            $data['dob'] = $this->dob;
        }
        if (empty($this->customer['gender'])) {
            $data['gender'] = $this->gender;
        }
        Customer::find($this->customer['id'])
            ->update($data);
        $this->success = 'Customer profile has been updated.';
        $this->customer = Customer::find($this->customer['id']);
    }

    public function updatedDay($value)
    {
        $this->validateOnly('day');
        $this->makeDOB();
    }

    private function makeDOB()
    {
        $this->dob = $this->year . '-' . str_pad($this->month, 2, "0", STR_PAD_LEFT) . '-' . str_pad($this->day, 2, "0", STR_PAD_LEFT);
    }

    public function updatedMonth($value)
    {
        $this->validateOnly('month');
        $this->makeDOB();
    }

    public function updatedYear($value)
    {
        $this->validateOnly('year');
        $this->makeDOB();
    }
}
