<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Relation table between movie and region
 */
class MovieRegion extends Pivot
{
    protected $table = 'movie_region';
    
}