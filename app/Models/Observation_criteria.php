<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observation_criteria extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'observation_id', 'criteria_id', 'score', 'weight', 'observation_category_id'
    ];

    public function observation_category()
    {
        return $this->belongsTo(Observation_category::class, 'observation_category_id');
    }

    public function criteria()
    {
        return $this->belongsTo(Criteria::class, 'criteria_id');
    }

    // public function observations()
    // {
    //     return $this->hasMany(Observation::class);
    // }

    public function observation()
    {
        return $this->belongsTo(Observation::class, 'observation_id');
    }

}
