<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recibos extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_cc',
        'id_alumno',
        'nro_recibo',
        'activo',
        'id_pago',
    ];
}
