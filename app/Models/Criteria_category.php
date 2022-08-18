<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria_category extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'id', 'title', 'description', 'is_required',
    ];

    public function criterias()
    {
        return $this->hasMany(Criteria::class);
    }
}
