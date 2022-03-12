<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gastos extends Model
{
    use HasFactory;

    static $rules= [
        'fecha' => 'required',
        'medio' => 'required',
        'concepto' => 'required',
        'monto' => 'required',
        'activo' => 'required',
    ];

    protected $fillable = [
        'fecha',
        'medio',
        'concepto',
        'monto',
        'activo',
    ];
}
