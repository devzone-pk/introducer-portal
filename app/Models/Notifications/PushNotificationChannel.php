<?php

namespace App\Models\Notifications;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PushNotificationChannel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
}
