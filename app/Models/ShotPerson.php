<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Relation table between shot and person
 */
class ShotPerson extends Pivot
{
    protected $table = 'shot_person';
    

    
}