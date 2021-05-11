<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    //
    const MOVIE_DIRECTOR = 0;
    const MOVIE_ACTOR = 1;
    const MOVIE_VOICE = 2;

    const ALLOWED_MIMETYPES = ['image/jpeg', 'image/png', 'image/jpg'];

    public function genres()
    {
        return $this->belongsToMany('App\Models\Genre', 'movie_genre')->using('App\Models\MovieGenre');
    }

    public function regions()
    {
        return $this->belongsToMany('App\Models\Region', 'movie_region')->using('App\Models\MovieRegion');
    }

    public function people()
    {
        return $this->belongsToMany('App\Models\Person', 'movie_person')
            ->using('App\Models\MoviePerson')
            ->withPivot([
                'role_type',
                'character',
                'character_description',
            ]);
    }
}
