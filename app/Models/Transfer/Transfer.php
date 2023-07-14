<?php

namespace App\Models\Transfer;



use App\Models\Country\Country;
use App\Models\Options\Option;
use App\Models\Partner\Payer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function beneficiary()
    {
        return $this->hasOne(TransferBeneficiary::class);
    }

    public function transferDetails()
    {
        return $this->hasOne(TransferDetail::class);
    }

    public function sender()
    {
        return $this->hasOne(TransferCustomer::class);
    }

    public function senderTransferCountry()
    {
        return $this->hasOneThrough(Country::class, TransferCustomer::class, 'transfer_id', 'id', 'id', 'country_id');
    }

    public function beneficiaryCountry()
    {
        return $this->hasOne(Country::class,  'id', 'receiving_country_id');
    }

    public function paymentStatus()
    {
        return $this->hasOne(Option::class, 'key', 'status');
    }

    public function payer()
    {
        return $this->hasOne(Payer::class, 'id', 'payer_id');
    }

    public function sendingReason()
    {
        return $this->hasOne(Option::class, 'id', 'sending_reason');
    }
    public function sendingMethod()
    {
        return $this->hasOne(Option::class, 'id', 'sending_method_id');
    }
    public function receivingMethod()
    {
        return $this->hasOne(Option::class, 'id', 'receiving_method_id');
    }

}
