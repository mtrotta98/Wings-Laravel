<?php

namespace App\Http\Controllers;

use App\Models\Alumnos;
use App\Models\Tutores;
use App\Models\TutoresAlumnos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TutoresController extends Controller
{
    public function tutores(){
        if(session()->has('user')){
            $tutores = Tutores::activo()->paginate(10);
            return view('tutores.tutores', compact('tutores'));
        }else{
            return view('auth.login');
        }
    }

    public function nuevoTutor(){
        if(session()->has('user')){
            return view('tutores.nuevoTutor');
        }else{
            return view('auth.login');
        }
    }

    public function agregarTutor(Request $request){
        if(session()->has('user')){
            request()->validate(Tutores::$rules);
            $tutor = Tutores::create($request->all());
            $alumno = Alumnos::where('dni', '=', $request['dniA'])->first();
            $lastIdT= Tutores::latest('id')->first();
            $ta = TutoresAlumnos::create([
                'id_alumnos' => $alumno->id,
                'id_tutor' => $lastIdT->id,
            ]);
        }else{
            return view('auth.login');
        }
    }

    public function editarTutor($id){
        if(session()->has('user')){
            $tutor = Tutores::find($id);
            return view('tutores.editarTutor', compact('tutor'));
        }else{
            return view('auth.login');
        }
    }

    public function actualizar(Request $request){
        if(session()->has('user')){
            $tutor = Tutores::find($request->id);
            $tutor->update($request->all());
            return response()->json($tutor);
        }else{
            return view('auth.login');
        }
    }

    public function eliminarTutor($id){
        if(session()->has('user')){
            $tutor = Tutores::find($id)->update([
                'activo' => 0,
            ]);
        }else{
            return view('auth.login');
        }
    }

    public function tutoresInactivos(){
        if(session()->has('user')){
            $tutoresI = Tutores::inactivo()->paginate(10);
            return view('tutores.tutoresInactivos', compact('tutoresI'));
        }else{
            return view('auth.login');
        }
    }

    public function activar($id){
        if(session()->has('user')){
            $tutor = Tutores::find($id)->update([
                'activo' => 1,
            ]);
        }else{
            return view('auth.login');
        }
    }

    public function alumnosACargo($id){
        if(session()->has('user')){
            $alumnos = DB::table('tutores')
            ->join('tutores_alumnos', 'tutores_alumnos.id_tutor', '=', 'tutores.id')
            ->join('alumnos', 'alumnos.id', '=', 'tutores_alumnos.id_alumnos')
            ->where('tutores.id', '=', $id)
            ->select('alumnos.id', 'alumnos.nombre', 'alumnos.apellido', 'alumnos.ingreso')->distinct()
            ->get();
            return view('tutores.alumnosCargo', compact('alumnos'));
        }else{
            return view('auth.login');
        }
    }

    public function busqueda($buscar){
        if(session()->has('user')){
            if(strpos($buscar, " ") == true){
                $partes = explode(" ", $buscar);
                $tutores = Tutores::activo()
                ->where('nombre', 'LIKE', '%'. $partes[0] .'%')
                ->orWhere('apellido', 'LIKE', '%'. $partes[0] .'%')
                ->orWhere('nombre', 'LIKE', '%'. $partes[1] .'%')
                ->orWhere('apellido', 'LIKE', '%'. $partes[1] .'%')
                ->paginate(10);
            }else{
                $tutores = Tutores::activo()
                ->where('nombre', 'LIKE', '%'. $buscar .'%')
                ->orWhere('apellido', 'LIKE', '%'. $buscar .'%')
                ->paginate(10);
            }
            return view('tutores.tutores', compact('tutores'));
        }else{
            return view('auth.login');
        }
    }
}
