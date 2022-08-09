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

    public function observation_criterias()
    {
        return $this->hasMany(Observation_criteria::class);
    }

    public function criteria_category()
    {
        return $this->belongsTo(Criteria_category::class, 'criteria_category_id');
    }
}
