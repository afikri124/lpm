<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'nidn',
        'department',
        'study_program',
        'phone',
        'job',
        'gender',
        'google_id',
        'front_title',
        'back_title',
    ];

    protected $appends = ['user_avatar','name_with_title'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getNameWithTitleAttribute()
    { 
      $name_with_title = ($this->front_title==null?"":$this->front_title." ").ucwords(strtolower($this->name)).($this->back_title==null?"":", ".$this->back_title);
      if(strlen($name_with_title) > 36){
        $nama = explode(" ",ucwords(strtolower($this->name)));
        if(count($nama) > 1){ 
          $nama[count($nama)-1] = substr($nama[count($nama)-1],0,1)."."; //singkat nama belakang
          $nick = implode(" ",$nama);
          $name_with_title = ($this->front_title==null?"":$this->front_title." ").$nick.($this->back_title==null?"":", ".$this->back_title);
        }
      }
      return $name_with_title;
    }

    public function getUserAvatarAttribute()
    { 
      $hash = md5(strtolower(trim($this->email)));
      $has_valid_avatar = false;
      if(env('APP_ENV') != 'local'){
        $uri = "https://www.gravatar.com/avatar/$hash".'?d=404';
        $headers = @get_headers($uri);
        if($headers != false){
          if (preg_match("|200|", $headers[0])) {
            $has_valid_avatar = true;
          }
        }
      }

      if($has_valid_avatar){
        return $uri;
      } else {
        if($this->gender == 'F'){
          return asset('assets/images/user/user-f.png');
        } else {
          return asset('assets/images/user/user.png');
        }
      }
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    } 

    public function hasRole($role) 
    {
      return $this->roles()->where('role_id', $role)->count() == 1;
    }
}
