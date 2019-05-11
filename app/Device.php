<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    public function registerDevice(){
        return $this->hasOne('App\RegisterDevice');
    }
}
