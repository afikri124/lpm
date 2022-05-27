<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observation_category extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'observation_id', 'criteria_category_id', 'remark',
    ];
}
