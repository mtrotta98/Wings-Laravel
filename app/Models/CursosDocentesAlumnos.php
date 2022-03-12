<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursosDocentesAlumnos extends Model
{
    use HasFactory;

    static $rules= [
        'id_docente' => 'required',
        'id_libro' => 'required',
        'id_alumno' => 'required',
        'id_curso' => 'required',
    ];

    protected $fillable = [
        'id_docente',
        'id_libro',
        'id_alumno',
        'id_curso',
    ];
}
