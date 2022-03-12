<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefonos extends Model
{
    use HasFactory;

    protected $fillable = [
        'fijo',
        'celular',
        'id_alumno',
        'id_tutor',
        'id_docente',
    ];
}
