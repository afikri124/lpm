<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyProgram extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'name', 'degree_level', 'certificate', 'acreditation_id'
    ];

    public function acreditation()
    {
        return $this->belongsTo(Acreditation::class, 'acreditation_id');
    }
}
