<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevelopmentPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'priority',
        'uraian',
        'rencana',
        'tercapai',
        'link',
        'is_numeric',
        'sort_order'
    ];

    protected $casts = [
        'is_numeric' => 'boolean',
        'tercapai' => 'decimal:2',
        'sort_order' => 'integer'
    ];
}
