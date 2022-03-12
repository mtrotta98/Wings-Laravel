<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutores extends Model
{
    use HasFactory;

    static $rules= [
        'dni' => 'required',
        'nombre' => 'required',
        'apellido' => 'required',
        'email' => 'required',
        'domicilio' => 'required',
        'activo' => 'required',
        'telefono' => 'required',
    ];

    protected $fillable = [
        'dni',
        'nombre',
        'apellido',
        'email',
        'domicilio',
        'activo',
        'telefono',
    ];

    public function scopeActivo($query){
        return $query->where('activo', 1);
    }

    public function scopeInactivo($query){
        return $query->where('activo', 0);
    }
}
