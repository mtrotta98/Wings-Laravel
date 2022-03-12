<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumnos extends Model
{
    use HasFactory;

    static $rules= [
        'nombre' => 'required',
        'apellido' => 'required',
        'dni' => 'required',
        'email' => 'required',
        'domicilio' => 'required',
        'activo' => 'required',
        'ingreso' => 'required',
    ];

    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'email',
        'domicilio',
        'activo',
        'ingreso',
        'observaciones',
    ];

    public function scopeActivo($query){
        return $query->where('activo', 1);
    }

    public function scopeInactivo($query){
        return $query->where('activo', 0);
    }
}
