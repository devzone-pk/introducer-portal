<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferReference extends Model
{
    use HasFactory;
    protected $table = 'transfer_references';
    protected $guarded = ['id'];
}
