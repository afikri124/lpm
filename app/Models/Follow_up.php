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
    ];

    public function dean()
    {
        return $this->belongsTo(User::class, 'dean_id');
    }
}
