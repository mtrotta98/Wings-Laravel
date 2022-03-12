<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    use HasFactory;

    static $rules= [
        'nombre' => 'required',
        'descripcion' => 'required',
        'desde' => 'required',
        'hasta' => 'required',
        'activo' => 'required',
        'horaInicio' => 'required',
        'horaFin' => 'required',
    ];

    protected $fillable = [
        'nombre',
        'descripcion',
        'desde',
        'hasta',
        'activo',
        'horaInicio',
        'horaFin',
    ];
}
