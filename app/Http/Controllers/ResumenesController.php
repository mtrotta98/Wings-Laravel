<?php

namespace App\Http\Controllers;

use App\Models\CuentasCorrientes;
use App\Models\Gastos;
use App\Models\MediosPagos;
use App\Models\Pagos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResumenesController extends Controller
{
    public function mensual(){
        if(session()->has('user')){
            $mesA = date('m');
            $añoA = date('Y');
            $cobros = DB::table('pagos')
            ->join('cuentas_corrientes', 'cuentas_corrientes.id', '=', 'pagos.id_cc')
            ->where('cuentas_corrientes.pago', '=', 1)
            ->where('pagos.activo', '=', 1)
            ->whereMonth('pagos.fecha', $mesA)
            ->whereYear('pagos.fecha', $añoA)
            ->select('pagos.id', 'pagos.medio', 'pagos.fecha', 'cuentas_corrientes.monto')
            ->paginate(7);
            $gastos = DB::table('gastos')->where('activo', '=', 1)->whereMonth('fecha', $mesA)->whereYear('fecha', $añoA)->paginate(7);
            $ingresos = DB::table('cuentas_corrientes')
            ->join('pagos', 'pagos.id_cc', '=', 'cuentas_corrientes.id')
            ->whereMonth('pagos.fecha', $mesA)
            ->whereYear('pagos.fecha', $añoA)
            ->sum('cuentas_corrientes.monto');
            $egresos = DB::table('gastos')->whereMonth('fecha', $mesA)->whereYear('fecha', $añoA)->sum('monto');
            $total = $ingresos - $egresos;
            return view('resumenes.mensual', compact('cobros', 'gastos', 'ingresos', 'egresos', 'total'));
        }else{
            return view('auth.login');
        }
    }

    public function porFecha(){
        if(session()->has('user')){
            return view('resumenes.seleccionFecha');
        }else{
            return view('auth.login');
        }
    }

    public function buscar($fechaD, $fechaH){
        if(session()->has('user')){
            $fechaD = date('Y-m-d', strtotime($fechaD));
            $fechaH = date('Y-m-d', strtotime($fechaH));
            $cobros = DB::table('pagos')
            ->join('cuentas_corrientes', 'cuentas_corrientes.id', '=', 'pagos.id_cc')
            ->where('cuentas_corrientes.pago', '=', 1)
            ->where('pagos.activo', '=', 1)
            ->whereDate('pagos.fecha', '>=', $fechaD)
            ->whereDate('pagos.fecha', '<=', $fechaH)
            ->select('pagos.id', 'pagos.medio', 'pagos.fecha', 'cuentas_corrientes.monto')
            ->paginate(7);
            $gastos = DB::table('gastos')
            ->where('activo', '=', 1)
            ->whereDate('fecha', '>=', $fechaD)
            ->whereDate('fecha', '<=', $fechaH)
            ->paginate(7);
            $ingresos = DB::table('cuentas_corrientes')
            ->join('pagos', 'pagos.id_cc', '=', 'cuentas_corrientes.id')
            ->whereDate('pagos.fecha', '>=', $fechaD)
            ->whereDate('pagos.fecha', '<=', $fechaH)
            ->sum('cuentas_corrientes.monto');
            $egresos = DB::table('gastos')
            ->whereDate('fecha', '>=', $fechaD)
            ->whereDate('fecha', '<=', $fechaH)
            ->sum('monto');
            $total = $ingresos - $egresos;
            return view('resumenes.porFecha', compact('cobros', 'gastos', 'ingresos', 'egresos', 'total'));
        }else{
            return view('auth.login');
        }
    }

    public function borrarIngreso($id){
        if(session()->has('user')){
            $ingreso = Pagos::find($id)->update([
                'activo' => 0,
            ]);
        }else{
            return view('auth.login');
        }
    }

    public function borrarEgreso($id){
        if(session()->has('user')){
            $ingreso = Gastos::find($id)->update([
                'activo' => 0,
            ]);
        }else{
            return view('auth.login');
        }
    }

    public function editarIngreso($id){
        if(session()->has('user')){
            $ingreso = DB::table('pagos')
            ->join('cuentas_corrientes', 'cuentas_corrientes.id', '=', 'pagos.id_cc')
            ->where('pagos.id', '=', $id)
            ->select('pagos.id', 'pagos.fecha', 'cuentas_corrientes.cuota', 'cuentas_corrientes.monto', 'pagos.medio')
            ->first();
            $mediosP = MediosPagos::all();
            return view('resumenes.editarIngreso', compact('ingreso', 'mediosP'));
        }else{
            return view('auth.login');
        }
    }

    public function editar(Request $request){
        if(session()->has('user')){
            $pago = Pagos::find($request->id)->update([
                'fecha' => $request["fecha"],
                'medio' => $request["medio"],
            ]);
            $pago = Pagos::find($request->id);
            $cc = CuentasCorrientes::where('id', '=', $pago->id_cc)->update([
                'monto' => $request["monto"],
            ]);
        }else{
            return view('auth.login');
        }
    }

    public function editarEgreso($id){
        if(session()->has('user')){
            $gasto = Gastos::find($id);
            $mediosP = MediosPagos::all();
            return view('resumenes.editarEgreso', compact('gasto', 'mediosP'));
        }else{
            return view('auth.login');
        }
    }

    public function editarE(Request $request){
        if(session()->has('user')){
            $gasto = Gastos::find($request->id)->update([
                'fecha' => $request["fecha"],
                'medio' => $request["medio"],
                'monto' => $request["monto"],
                'concepto' => $request["concepto"],
            ]);
        }else{
            return view('auth.login');
        }
    }

    public function editarIngresoPF($id){
        if(session()->has('user')){
            $ingreso = DB::table('pagos')
            ->join('cuentas_corrientes', 'cuentas_corrientes.id', '=', 'pagos.id_cc')
            ->where('pagos.id', '=', $id)
            ->select('pagos.id', 'pagos.fecha', 'cuentas_corrientes.cuota', 'cuentas_corrientes.monto', 'pagos.medio')
            ->first();
            $mediosP = MediosPagos::all();
            return view('resumenes.editarIngresoPF', compact('ingreso', 'mediosP'));
        }else{
            return view('auth.login');
        }
    }

    public function editarEgresoPF($id){
        if(session()->has('user')){
            $gasto = Gastos::find($id);
            $mediosP = MediosPagos::all();
            return view('resumenes.editarEgresoPF', compact('gasto', 'mediosP'));
        }else{
            return view('auth.login');
        }
    }
}
