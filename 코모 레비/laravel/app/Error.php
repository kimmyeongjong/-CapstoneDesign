<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Error extends Model
{
    public function errorList()
    {
        return $this->hasMany('App\Error');
    }
}
