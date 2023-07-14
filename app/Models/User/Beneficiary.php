<?php

namespace App\Models\User;

use App\Models\Transfer\TransferBeneficiary;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function beneficiaryBank()
    {
        return $this->hasMany(BeneficiaryBank::class);
    }
}
