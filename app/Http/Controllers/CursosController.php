<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CursosController extends Controller
{
    public function cursos(){
        if(session()->has('user')){
            $cursos = Cursos::select("*", Cursos::raw("CONCAT(cursos.desde,' y ',cursos.hasta) as dias"), Cursos::raw("CONCAT(cursos.horaInicio,' a ',cursos.horaFin) as horarios"))->where('activo', '=', 1)->paginate(10);
            return view('cursos.cursos', compact('cursos'));
        }else{
            return view('auth.login');
        }
    }

    public function eliminarCurso($id){
        if(session()->has('user')){
            $curso = Cursos::find($id)->update([
                'activo' => 0,
            ]);
        }else{
            return view('auth.login');
        }
    }

    public function cursosI(){
        if(session()->has('user')){
            $cursos = Cursos::select("*", Cursos::raw("CONCAT(cursos.desde,' y ',cursos.hasta) as dias"), Cursos::raw("CONCAT(cursos.horaInicio,' a ',cursos.horaFin) as horarios"))->where('activo', '=', 0)->paginate(10);
            return view('cursos.cursosInactivos', compact('cursos'));
        }else{
            return view('auth.login');
        }
    }

    public function activarCurso($id){
        if(session()->has('user')){
            $curso = Cursos::find($id)->update([
                'activo' => 1,
            ]);
        }else{
            return view('auth.login');
        }
    }

    public function editar($id){
        if(session()->has('user')){
            $curso = Cursos::find($id);
            return view('cursos.editarCurso', compact('curso'));
        }else{
            return view('auth.login');
        }
    }

    public function editarCurso(Request $request){
        if(session()->has('user')){
            request()->validate(Cursos::$rules);
            $curso = Cursos::find($request->id)->update($request->all());
        }else{
            return view('auth.login');
        }
    }

    public function nuevoCurso(){
        if(session()->has('user')){
            return view('cursos.newCurso');
        }else{
            return view('auth.login');
        }
    }

    public function agregarCurso(Request $request){
        if(session()->has('user')){
            request()->validate(Cursos::$rules);
            $curso = Cursos::create($request->all());
        }else{
            return view('auth.login');
        }
    }

    public function material($id){
        if(session()->has('user')){
            $libros = DB::table('cursos')
            ->join('cursos_docentes_alumnos', 'cursos_docentes_alumnos.id_curso', '=', 'cursos.id')
            ->join('libros', 'libros.id', '=', 'cursos_docentes_alumnos.id_libro')
            ->where('cursos.id', '=', $id)
            ->select('libros.nombre', 'libros.autor', 'libros.editora', 'libros.id')
            ->get();
            return view('cursos.material', compact('libros'));
        }else{
            return view('auth.login');
        }
    }

    public function alumnos($id){
        if(session()->has('user')){
            if(session()->has('user')){
                $alumnos = DB::table('cursos')
                ->join('cursos_docentes_alumnos', 'cursos_docentes_alumnos.id_curso', '=', 'cursos.id')
                ->join('alumnos', 'alumnos.id', '=', 'cursos_docentes_alumnos.id_alumno')
                ->where('cursos.id', '=', $id)
                ->select('alumnos.nombre', 'alumnos.apellido', 'alumnos.id', 'alumnos.ingreso')
                ->get();
                return view('cursos.alumnos', compact('alumnos'));
            }else{
                return view('auth.login');
            }
        }else{
            return view('auth.login');
        }
    }
}
