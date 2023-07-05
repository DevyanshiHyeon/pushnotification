<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model
{
    protected $table = 'feedbacks';
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'application_id',
        'title',
        'description',
    ];
}
