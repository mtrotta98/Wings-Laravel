<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutoresAlumnos extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_tutor',
        'id_alumnos',
    ];
}
