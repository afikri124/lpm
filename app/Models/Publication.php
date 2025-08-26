<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'id', 'name', 'year', 'doc_link', 'user_id'
    ];
        public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
