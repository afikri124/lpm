<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule_history extends Model
{
    use HasFactory;
    protected $fillable = [
        'schedule_id',
        'description',
        'remark',
        'created_by',
    ];
}
