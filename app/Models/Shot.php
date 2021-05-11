<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shot extends Model
{
    //
    const ALLOWED_MIMETYPES = ['video/mp4'];

    protected $casts = [
        'attributes' => 'array',
    ];

    // public function getAttributesStrAttribute($value)
    // {
    //     return $value;
    // }

    public function setAttributesStrAttribute($value)
    {
        $this->attributes['attributes_str'] = $value;
    }

    public function people()
    {
        return $this->belongsToMany('App\Models\Person', 'shot_person')
            ->using('App\Models\ShotPerson');
    }

    public function movie() 
    {
        return $this->belongsTo('App\Models\Movie');
    }

    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'taggable');
    }

}
