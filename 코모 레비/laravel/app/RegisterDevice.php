<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisterDevice extends Model
{
    public function measurement(){
        return $this->hasMany('App\Measurement');
    }

    public function errorList(){
        return $this->hasMany('errorList');
    }
}