<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observation extends Model
{
    use HasFactory;
    protected $fillable = [
        'schedule_id',
        'auditor_id',
        'attendance',
        'remark',
        'image_path',
    ];
}
