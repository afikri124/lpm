<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class User_role extends Pivot
{
    use HasFactory;
    public $timestamps = false;
    // public $incrementing = false;
    protected $table='user_roles';
    protected $fillable = [
        'id','user_id', 'role_id',
    ];
    public static $role_attach_roles = [
        'roles' => 'required|array|min:1|exists:roles,id'
    ];

    public function user(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function role(){
        return $this->hasOne('App\Models\Role', 'id', 'role_id');
    }
}
