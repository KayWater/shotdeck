<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Relation table between movie and genre
 */
class MovieGenre extends Pivot
{
    protected $table = 'movie_genre';
    
}