<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AllMessage extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'application_id',
        'title',
        'message',
        'send_time',
        'status',
        'perent_id',
        'is_instant',
        'sent_instant',
        'is_active'
    ];
}
