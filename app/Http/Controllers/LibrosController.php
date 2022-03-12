<?php

namespace App\Http\Controllers;

use App\Models\Libros;
use Illuminate\Http\Request;

class LibrosController extends Controller
{
    public function libros(){
        if(session()->has('user')){
            $libros = Libros::where('activo', '=', 1)->paginate(10);
            return view('libros.libros', compact('libros'));
        }else{
            return view('auth.login');
        }
    }

    public function eliminarLibro($id){
        if(session()->has('user')){
            $libro = Libros::find($id)->update([
                'activo' => 0,
            ]);
        }else{
            return view('auth.login');
        }
    }

    public function librosInactivos(){
        if(session()->has('user')){
            $libros = Libros::where('activo', '=', 0)->paginate(10);
            return view('libros.librosInactivos', compact('libros'));
        }else{
            return view('auth.login');
        }
    }

    public function activarLibro($id){
        if(session()->has('user')){
            $libro = Libros::find($id)->update([
                'activo' => 1,
            ]);
        }else{
            return view('auth.login');
        }
    }

    public function nuevoLibro(){
        if(session()->has('user')){
            return view('libros.nuevoLibro');
        }else{
            return view('auth.login');
        }
    }

    public function agregarLibro(Request $request){
        if(session()->has('user')){
            request()->validate(Libros::$rules);
            $libro = Libros::create($request->all());
        }else{
            return view('auth.login');
        }
    }

    public function editarLibro($id){
        if(session()->has('user')){
            $libro = Libros::find($id);
            return view('libros.editarLibro', compact('libro'));
        }else{
            return view('auth.login');
        }
    }

    public function editar(Request $request){
        if(session()->has('user')){
            $libro = Libros::find($request->id);
            $libro->update($request->all());
            return response()->json($libro);
        }else{
            return view('auth.login');
        }
    }
}
