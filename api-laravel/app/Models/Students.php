<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $fillable = [
        'id',
        'name',
        'alternate_names',
        'species',
        'gender',
        'house',
        'date_of_birth',
        'year_of_birth',
        'wizard',
        'ancestry',
        'eye_colour',
        'hair_colour',
        'wand',
        'patronus',
        'hogwarts_student',
        'hogwarts_staff',
        'actor',
        'alternate_actors',
        'alive',
        'image',
    ];
}
