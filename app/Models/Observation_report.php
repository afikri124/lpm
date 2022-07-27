<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observation_report extends Model
{
    use HasFactory;
    protected $fillable = [
        'schedule_id',
        'date_time',
        'location',
        'study_program',
        'created_by',
    ];
}
