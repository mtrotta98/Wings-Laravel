<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libros extends Model
{
    use HasFactory;

    static $rules= [
        'nombre' => 'required',
        'autor' => 'required',
        'editora' => 'required',
        'activo' => 'required',
    ];

    protected $fillable = [
        'nombre',
        'autor',
        'editora',
        'activo',
    ];
}
