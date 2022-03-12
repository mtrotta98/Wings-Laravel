<?php

namespace App\Http\Controllers;

use App\Models\Alumnos;
use App\Models\CuentasCorrientes;
use App\Models\Cursos;
use App\Models\CursosDocentesAlumnos;
use App\Models\Docentes;
use App\Models\Libros;
use App\Models\MediosPagos;
use App\Models\Pagos;
use App\Models\Recibos;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade as PDFL;

class AlumnosController extends Controller
{
    public function editarAlumno(Request $request, $id){
        if(session()->has('user')){
            $alumno = Alumnos::find($id);
            return view('alumnos.editarAlumno', compact('alumno'));
        }else{
            return view('auth.login');
        }
    }

    public function actualizarAlumno(Request $request){
        if(session()->has('user')){
            $alumno = Alumnos::find($request->id);
            $alumno->update($request->all());
            return response()->json($alumno);
        }else{
            return view('auth.login');
        }
    }

    public function borrarAlumno($id){
        if(session()->has('user')){
            $alumno = Alumnos::find($id);
            $alumno->activo = 0;
            $alumno->save();
        }else{
            return view('auth.login');
        }
    }

    public function nuevoAlumno(){
        return view('alumnos.nuevoAlumno');
    }

    public function agregarAlumno(Request $request){
        if(session()->has('user')){
            request()->validate(Alumnos::$rules);
            $alumno = Alumnos::create($request->all());
            $date = new DateTime($request['ingreso']);
            $now = new DateTime("30-12-" . date("Y"));
            $cuotas = $now->diff($date)->format('%m');
            $desde = 12 - (int)$cuotas;
            $lastId = Alumnos::latest('id')->first();

            $cca = CuentasCorrientes::create([
                'id_alumno' => $lastId->id,
                'anio' => (int)date("Y"),
                'cuota' => 0,
                'monto' => 0,
                'pago' => 0,
                'activo' => 1,
            ]);

            for ($i = $desde; $i <= 12; $i++) {
                $cca = CuentasCorrientes::create([
                    'id_alumno' => $lastId->id,
                    'anio' => (int)date("Y"),
                    'cuota' => $i,
                    'monto' => 0,
                    'pago' => 0,
                    'activo' => 1,
                ]);
            }
            return "agregado";
        }else{
            return view('auth.login');
        }
    }

    public function asignarCurso($id){
        if(session()->has('user')){
            $alumno = Alumnos::find($id);
            $docentes = Docentes::all();
            $cursos = Cursos::all();
            $libros = Libros::all();
            return view('alumnos.asignarCurso', compact('alumno', 'docentes', 'cursos', 'libros'));
        }else{
            return view('auth.login');
        }
    }

    public function asignar(Request $request){
        if(session()->has('user')){
            request()->validate(CursosDocentesAlumnos::$rules);
            $cda = CursosDocentesAlumnos::create($request->all());
            return "agregado";
        }else{
            return view('auth.login');
        }
    }

    public function agregarPago($id){
        if(session()->has('user')){
            $alumno = Alumnos::find($id);
            $cuotasSinPagar = CuentasCorrientes::where('id_alumno', '=', $id)->where('pago', '=', 0)->get();
            $mediosP = MediosPagos::all();
            return view('alumnos.agregarPago', compact('alumno', 'cuotasSinPagar', 'mediosP'));
        }else{
            return view('auth.login');
        }
    }

    public function pago(Request $request){
        if(session()->has('user')){
            $cc = CuentasCorrientes::where('id_alumno', '=', $request['id_alumno'])->where('cuota', '=', $request['cuota'])->update([
                'monto' => $request['monto'],
                'pago' => 1,
            ]);
            $cc = CuentasCorrientes::where('id_alumno', '=', $request['id_alumno'])->where('cuota', '=', $request['cuota'])->first();
            $pago = Pagos::create([
                'fecha' => $request['fecha'],
                'medio' => $request['medio'],
                'id_alumno' => $request['id_alumno'],
                'id_cc' => $cc->id,
                'activo' => $request['activo'],
            ]);
        }else{
            return view('auth.login');
        }
    }

    public function alumnosInactivos(){
        if(session()->has('user')){
            $alumnosI = Alumnos::inactivo()->paginate(10);
            return view('alumnos.alumnosInactivos', compact('alumnosI'));
        }else{
            return view('auth.login');
        }
    }

    public function activarAlumnos($id){
        if(session()->has('user')){
            $alumnoI = Alumnos::find($id)->update([
                'activo' => 1,
            ]);
        }else{
            return view('auth.login');
        }
    }

    public function historial($id){
        if(session()->has('user')){
            $alumno = Alumnos::find($id);
            $pagos = DB::table('cuentas_corrientes')
            ->join('pagos', 'cuentas_corrientes.id', '=', 'pagos.id_cc')
            ->where('cuentas_corrientes.pago', '=', 1)
            ->where('pagos.id_alumno', '=', $id)
            ->select('cuentas_corrientes.id', 'cuentas_corrientes.monto', 'cuentas_corrientes.cuota', 'pagos.medio', 'pagos.fecha')->distinct()
            ->paginate(10);
            return view('alumnos.Historial', compact('alumno', 'pagos'));
        }else{
            return view('auth.login');
        }
    }

    public function recibo($id){
        $cant = Recibos::count();
        $cc = CuentasCorrientes::find($id);
        $pago = Pagos::where('id_cc', '=', $cc->id)->first();
        $alumno = Alumnos::where('id', '=', $cc->id_alumno)->first();
        $recibo = Recibos::create([
            'nro_recibo' => $cant + 1,
            'id_pago' => $pago->id,
            'activo' => 1,
            'id_cc' => $cc->id,
            'id_alumno' => $alumno->id,
        ]);
        $detalles = [
            'cant' => $cant + 1,
            'alumno' => $alumno,
            'cc' => $cc,
            'remitente' => 'Instituto Wings',
            'telefono' => 'Telefono: 473-3694',
            'direccion' => 'Calle 8 1879, B1894GJK Villa Elisa, Provincia de Buenos Aires',
        ];
        $pdf = PDFL::loadview('recibos.generar', $detalles);
        return $pdf->download('reciboNro' . $cant+1 . $alumno->nombre . $alumno->apellido .  '.pdf');
    }

    public function busqueda($buscar){
        if(session()->has('user')){
            if(strpos($buscar, " ") == true){
                $partes = explode(" ", $buscar);
                $alumnos = Alumnos::activo()
                ->where('nombre', 'LIKE', '%'. $partes[0] .'%')
                ->orWhere('apellido', 'LIKE', '%'. $partes[0] .'%')
                ->orWhere('nombre', 'LIKE', '%'. $partes[1] .'%')
                ->orWhere('apellido', 'LIKE', '%'. $partes[1] .'%')
                ->paginate(10);
            }else{
                $alumnos = Alumnos::activo()
                ->where('nombre', 'LIKE', '%'. $buscar .'%')
                ->orWhere('apellido', 'LIKE', '%'. $buscar .'%')
                ->paginate(10);
            }
            return view('home', compact('alumnos'));
        }else{
            return view('auth.login');
        }
    }
}
