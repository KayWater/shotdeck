<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyValue extends Model
{
    //
    
    public function property()
    {
        return $this->belongsTo('App\Models\Property');
    }
}
