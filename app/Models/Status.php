<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'id', 'title',
    ];
    protected $appends = ['color'];

    public function getColorAttribute(){
        $x = "";
        if($this->id == "S00"){
            $x = "muted";
        } else if($this->id == "S01"){
            $x = "dark";
        } else if($this->id == "S02"){
            $x = "warning";
        } else if($this->id == "S03"){
            $x = "warning mark";
        } else if($this->id == "S04"){
            $x = "danger";
        } else if($this->id == "S05"){
            $x = "info";
        }else if($this->id == "S06"){
            $x = "success";
        }else if($this->id == "S07"){
            $x = "success mark";
        }else if($this->id == "S08"){
            $x = "danger mark";
        } else {
            $x = "secondary";
        }
        return $x;
    }
}
