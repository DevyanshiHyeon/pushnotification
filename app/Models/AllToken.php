<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AllToken extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['application_id',
    'token',
    'is_used',
    'last_notification_status',
    'last_notification_time'];
}
