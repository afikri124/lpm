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
        'subject_course',
        'topic',
        'class_type',
        'location',
        'study_program',
        'total_students',
        'practitioner'
    ];

    public function auditor()
    {
        return $this->belongsTo(User::class, 'auditor_id');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }

    public function observation_categories()
    {
        return $this->hasMany(Observation_category::class);
    }

    public function observation_criterias()
    {
        return $this->hasMany(Observation_criteria::class);
    }

    protected $appends = ['color'];

    public function getColorAttribute(){
        if($this->attendance == true){
            return "success";
        } else {
            return "danger";
        }
    }
}
