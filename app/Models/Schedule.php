<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'lecturer_id',
        'date_start',
        'date_end',
        'status_id',
        'remark',
        'created_by',
    ];
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function lecturer()
    {
        return $this->belongsTo(User::class, 'lecturer_id');
    }

    public function observations()
    {
        return $this->hasMany(Observation::class);
    }

    public function created_user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function histories()
    {
        return $this->hasMany(Schedule_history::class);
    }
}
