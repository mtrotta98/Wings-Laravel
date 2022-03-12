<?php

namespace App\Http\Controllers;

use App\Models\Alumnos;
use App\Models\Cursos;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade as PDFL;
use Illuminate\Support\Facades\DB;

class ListadosController extends Controller
{
    public function elegir(){
        if (session()->has('user')){
            $cursos = Cursos::where('activo', '=', 1)->get();
            return view('listados.seleccion', compact('cursos'));
        }else{
            return view('auth.login');
        }
    }

    public function Lalumnos($valor){
        if($valor == 1){
            $alumnos = DB::table('alumnos')
            ->leftJoin('cursos_docentes_alumnos', 'cursos_docentes_alumnos.id_alumno', '=', 'alumnos.id')
            ->leftJoin('cursos', 'cursos.id', '=', 'cursos_docentes_alumnos.id_curso')
            ->where('alumnos.activo', '=', 1)
            ->select('alumnos.id', 'alumnos.nombre', 'alumnos.apellido', 'cursos.nombre AS curso')
            ->get();
            $detalles = [
                'alumnos' => $alumnos,
                'activos' => 1,
            ];
        }else{
            $alumnos = DB::table('alumnos')
            ->leftJoin('cursos_docentes_alumnos', 'cursos_docentes_alumnos.id_alumno', '=', 'alumnos.id')
            ->leftJoin('cursos', 'cursos.id', '=', 'cursos_docentes_alumnos.id_curso')
            ->where('alumnos.activo', '=', 0)
            ->select('alumnos.id', 'alumnos.nombre', 'alumnos.apellido', 'cursos.nombre AS curso')
            ->get();
            $detalles = [
                'alumnos' => $alumnos,
                'activos' => 0,
            ];
        }
        $pdf = PDFL::loadview('listados.alumnos', $detalles);
        return $pdf->download('listadoAlumnos.pdf');
    }

    public function Lcurso($curso){
        $alumnos = DB::table('cursos')
        ->join('cursos_docentes_alumnos', 'cursos_docentes_alumnos.id_curso', '=', 'cursos.id')
        ->join('alumnos', 'alumnos.id', '=', 'cursos_docentes_alumnos.id_alumno')
        ->where('cursos.id', '=', $curso)
        ->select('alumnos.nombre', 'alumnos.apellido', 'alumnos.id')
        ->get();
        $docente = DB::table('cursos')
        ->join('cursos_docentes_alumnos', 'cursos_docentes_alumnos.id_curso', '=', 'cursos.id')
        ->join('docentes', 'docentes.id', '=', 'cursos_docentes_alumnos.id_docente')
        ->where('cursos.id', '=', $curso)
        ->select('docentes.nombre', 'docentes.apellido')
        ->first();
        $libro = DB::table('cursos')
        ->join('cursos_docentes_alumnos', 'cursos_docentes_alumnos.id_curso', '=', 'cursos.id')
        ->join('libros', 'libros.id', '=', 'cursos_docentes_alumnos.id_docente')
        ->where('cursos.id', '=', $curso)
        ->select('libros.nombre')
        ->first();
        $curso = Cursos::find($curso);
        $detalles = [
            'alumnos' => $alumnos,
            'curso' => $curso,
            'docente' => $docente,
            'libro' => $libro,
        ];
        $pdf = PDFL::loadview('listados.curso', $detalles);
        return $pdf->download('listadoCurso' . $curso->nombre . '.pdf');
    }

    public function Lpagos($fechaD, $fechaH){
        $pagos = DB::table('cuentas_corrientes')
        ->join('pagos', 'pagos.id_cc', '=', 'cuentas_corrientes.id')
        ->join('alumnos', 'alumnos.id', '=', 'pagos.id_alumno')
        ->whereDate('pagos.fecha', '>=', $fechaD)
        ->whereDate('pagos.fecha', '<=', $fechaH)
        ->select('alumnos.id', 'alumnos.nombre', 'alumnos.apellido', 'cuentas_corrientes.monto', 'cuentas_corrientes.cuota', 'pagos.fecha')
        ->get();
        $detalles = [
            'pagos' => $pagos,
        ];
        $pdf = PDFL::loadview('listados.pagos', $detalles);
        return $pdf->download('pagos' . $fechaD . $fechaH . '.pdf');
    }
}
