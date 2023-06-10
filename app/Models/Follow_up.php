<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow_up extends Model
{
    use HasFactory;
    protected $fillable = [
        'schedule_id',
        'dean_id',
        'date_start',
        'date_end',
        'remark',
        'image_path',
        'created_by',
        'location',
    ];

    public function dean()
    {
        return $this->belongsTo(User::class, 'dean_id');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }

    protected $appends = ['color'];

    public function getColorAttribute(){
        if($this->remark != null){
            return "success";
        } else {
            return "danger";
        }
    }

}
