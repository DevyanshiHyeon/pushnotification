<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Device extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'token',
        'is_used',
        'notification_info',
        'last_notification_status',
        'last_notification_time'
    ];
}
