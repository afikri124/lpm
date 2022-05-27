<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observation_criteria extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'observation_id', 'criteria_id', 'score',
    ];
}
