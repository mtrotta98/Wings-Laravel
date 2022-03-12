<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentasCorrientes extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_alumno',
        'anio',
        'cuota',
        'monto',
        'pago',
        'activo',
    ];

    public function scopePago($query){
        return $query->where('pago', 1);
    }
}
