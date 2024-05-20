<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    public $incrementing = false; // Indica que el modelo no usa IDs autoincrementales
    protected $keyType = 'string'; // Indica que el tipo de la clave primaria es string
    protected $primaryKey = 'id'; // Indica que la columna de la clave primaria es 'id'
    
    protected $fillable = [
        'id', 'name', 'alternate_names', 'species', 'gender', 'house',
        'dateOfBirth', 'yearOfBirth', 'wizard', 'ancestry', 'eyeColour',
        'hairColour', 'wand', 'patronus', 'hogwartsStudent', 'hogwartsStaff',
        'actor', 'alternate_actors', 'alive', 'image'
    ];

    protected $casts = [
        'alternate_names' => 'array',
        'wand' => 'array',
        'alternate_actors' => 'array',
        'wizard' => 'boolean',
        'hogwarts_student' => 'boolean',
        'hogwarts_staff' => 'boolean',
        'alive' => 'boolean'
    ];
}
