<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    //
    
    public function values()
    {
        return $this->hasMany('App\Models\PropertyValue');
    }
}
