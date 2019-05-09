<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    public function management()
    {
        return $this->hasMany('App\User');
    }
}
