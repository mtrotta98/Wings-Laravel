<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagosController extends Controller
{
    public function cobros(){
        if(session()->has('user')){
            $pagos = DB::table('cuentas_corrientes')
            ->join('pagos', 'cuentas_corrientes.id', '=', 'pagos.id_cc')
            ->join('alumnos', 'cuentas_corrientes.id_alumno', '=', 'alumnos.id')
            ->where('cuentas_corrientes.pago', '=', 1)
            ->select('cuentas_corrientes.id', 'cuentas_corrientes.monto', 'cuentas_corrientes.cuota', 'pagos.medio', 'pagos.fecha', 'alumnos.nombre', 'alumnos.apellido', 'alumnos.dni')->distinct()
            ->paginate(10);
            return view('pagos.cobros', compact('pagos'));
        }else{
            return view('auth.login');
        }
    }
}
