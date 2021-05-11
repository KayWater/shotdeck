<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Relation table between movie and person
 */
class MoviePerson extends Pivot
{
    protected $table = 'movie_person';
    
}