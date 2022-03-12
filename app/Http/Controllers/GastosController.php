<?php

namespace App\Http\Controllers;

use App\Models\Gastos;
use App\Models\MediosPagos;
use Illuminate\Http\Request;

class GastosController extends Controller
{
    public function gastos(){
        if(session()->has('user')){
            $mediosP = MediosPagos::all();
            return view('gastos.gastos', compact('mediosP'));
        }else{ 
            return view('auth.login');
        }
    }

    public function agregarGasto(Request $request){
        if(session()->has('user')){
            request()->validate(Gastos::$rules);
            $gasto = Gastos::create($request->all());
        }else{ 
            return view('auth.login');
        }
    }
}
