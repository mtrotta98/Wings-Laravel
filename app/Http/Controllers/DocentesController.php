<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Models\Docentes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocentesController extends Controller
{
    public function docentes(){
        if(session()->has('user')){
            $docentes = Docentes::where('activo', '=', 1)->paginate(10);
            return view('docentes.docentes', compact('docentes'));
        }else{
            return view('auth.login');
        }
    }

    public function eliminarDocente($id){
        if(session()->has('user')){
            $docente = Docentes::find($id)->update([
                'activo' => 0,
            ]);
        }else{
            return view('auth.login');
        }
    }

    public function docentesInactivos(){
        if(session()->has('user')){
            $docentesI = Docentes::where('activo', '=', 0)->paginate(10);
            return view('docentes.docentesInactivos', compact('docentesI'));
        }else{
            return view('auth.login');
        }
    }

    public function activarDocente($id){
        if(session()->has('user')){
            $docente = Docentes::find($id)->update([
                'activo' => 1,
            ]);
        }else{
            return view('auth.login');
        }
    }

    public function editarDocente($id){
        if(session()->has('user')){
            $docente = Docentes::find($id);
            return view('docentes.editarDocente', compact('docente'));
        }else{
            return view('auth.login');
        }
    }

    public function editarD(Request $request){
        if(session()->has('user')){
            $docente = Docentes::find($request->id);
            $docente->update($request->all());
            return response()->json($docente);
        }else{
            return view('auth.login');
        }
    }

    public function agregarDocente(){
        if(session()->has('user')){
            return view('docentes.newDocente');
        }else{
            return view('auth.login');
        }
    }

    public function agregar(Request $request){
        if(session()->has('user')){
            request()->validate(Docentes::$rules);
            $docente = Docentes::create($request->all());
        }else{
            return view('auth.login');
        }
    }

    public function cursos($id){
        if(session()->has('user')){
            $cursos = DB::table('docentes')
            ->join('cursos_docentes_alumnos', 'cursos_docentes_alumnos.id_docente', '=', 'docentes.id')
            ->join('cursos', 'cursos.id', '=', 'cursos_docentes_alumnos.id_curso')
            ->where('docentes.id', '=', $id)
            ->select('cursos.id', 'cursos.nombre', Cursos::raw("CONCAT(cursos.desde,' y ',cursos.hasta) as dias"), Cursos::raw("CONCAT(cursos.horaInicio,' a ',cursos.horaFin) as horarios"))
            ->get();
            return view('docentes.cursos', compact('cursos'));
        }else{
            return view('auth.login');
        }
    }

    public function busqueda($buscar){
        if(session()->has('user')){
            if(strpos($buscar, " ") == true){
                $partes = explode(" ", $buscar);
                $docentes = Docentes::activo()
                ->where('nombre', 'LIKE', '%'. $partes[0] .'%')
                ->orWhere('apellido', 'LIKE', '%'. $partes[0] .'%')
                ->orWhere('nombre', 'LIKE', '%'. $partes[1] .'%')
                ->orWhere('apellido', 'LIKE', '%'. $partes[1] .'%')
                ->paginate(10);
            }else{
                $docentes = Docentes::activo()
                ->where('nombre', 'LIKE', '%'. $buscar. '%')
                ->orWhere('apellido', 'LIKE', '%'. $buscar. '%')
                ->paginate(10);
            }
            return view('docentes.docentes', compact('docentes'));
        }else{
            return view('auth.login');
        }
    }
}
