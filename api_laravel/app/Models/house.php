<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class house extends Model
{
    public $incrementing = false; // Indica que el modelo no usa IDs autoincrementales
    protected $keyType = 'string'; // Indica que el tipo de la clave primaria es string
    protected $primaryKey = 'id'; // Indica que la columna de la clave primaria es 'id'
    
    protected $fillable = [
        'id','name','puntos','image'
    ];
}
