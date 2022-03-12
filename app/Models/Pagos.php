<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'medio',
        'id_alumno',
        'id_cc',
        'activo',
    ];

    public function scopeActivo($query){
        return $query->where('activo', 1);
    }
}
