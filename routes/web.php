<?php

use App\Http\Controllers\AlumnosController;
use App\Http\Controllers\CursosController;
use App\Http\Controllers\DocentesController;
use App\Http\Controllers\GastosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LibrosController;
use App\Http\Controllers\ListadosController;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\ResumenesController;
use App\Http\Controllers\TutoresController;
use App\Models\Alumnos;
use App\Models\Docentes;
use App\Models\Libros;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/nuevoAlumno', [AlumnosController::class, 'nuevoAlumno'])->name('nuevoAlumno');

Route::post('/nuevoAlumno/agregar', [AlumnosController::class, 'agregarAlumno']);

Route::get('/editarAlumno/{id}', [AlumnosController::class, 'editarAlumno']);

Route::get('/asignarCurso/{id}', [AlumnosController::class, 'asignarCurso']);

Route::post('/asignarCurso/asignar', [AlumnosController::class, 'asignar']);

Route::get('/agregarPago/{id}', [AlumnosController::class, 'agregarPago']);

Route::post('/agregarPago', [AlumnosController::class, 'pago']);

Route::post('/actualizarAlumno', [AlumnosController::class, 'actualizarAlumno']);

Route::post('/borrarAlumno/{id}', [AlumnosController::class, 'borrarAlumno']);

Route::get('/alumnosInactivos', [AlumnosController::class, 'alumnosInactivos'])->name('alumnosInactivos');

Route::post('/activarAlumnos/{id}', [AlumnosController::class, 'activarAlumnos']);

Route::get('/tutores', [TutoresController::class, 'tutores'])->name('tutores');

Route::get('/nuevoTutor', [TutoresController::class, 'nuevoTutor'])->name('nuevoTutor');

Route::post('/nuevoTutor/agregar', [TutoresController::class, 'agregarTutor']);

Route::get('/tutores/editarTutor/{id}', [TutoresController::class, 'editarTutor']);

Route::post('/tutores/editarTutores/actualizar', [TutoresController::class, 'actualizar']);

Route::post('/tutores/eliminarTutor/{id}', [TutoresController::class, 'eliminarTutor']);

Route::get('/tutoresInactivos', [TutoresController::class, 'tutoresInactivos'])->name('tutoresInactivos');

Route::post('/tutoresInactivos/activar/{id}', [TutoresController::class, 'activar']);

Route::get('/docentes', [DocentesController::class, 'docentes'])->name('docentes');

Route::post('/docente/eliminar/{id}', [DocentesController::class, 'eliminarDocente']);

Route::get('/docentesInactivos', [DocentesController::class, 'docentesInactivos'])->name('docentesInactivos');

Route::post('/docentesInactivos/activar/{id}', [DocentesController::class, 'activarDocente']);

Route::get('/docentes/editarDocente/{id}', [DocentesController::class, 'editarDocente']);

Route::post('/docentes/editarDocente/editar', [DocentesController::class, 'editarD']);

Route::get('/agregarDocente', [DocentesController::class, 'agregarDocente'])->name('agregarDocente');

Route::post('/agregarDocente/agregar', [DocentesController::class, 'agregar']);

Route::get('/cursos', [CursosController::class, 'cursos'])->name('cursos');

Route::post('/cursos/eliminar/{id}', [CursosController::class, 'eliminarCurso']);

Route::get('/cursosInactivos', [CursosController::class, 'cursosI'])->name('cursosInactivos');

Route::post('/cursosInactivos/activar/{id}', [CursosController::class, 'activarCurso']);

Route::get('/cursos/editar/{id}', [CursosController::class, 'editar']);

Route::post('/cursos/editar/editarCurso', [CursosController::class, 'editarCurso']);

Route::get('/nuevoCurso', [CursosController::class, 'nuevoCurso'])->name('nuevoCurso');

Route::post('/nuevoCurso/agregar', [CursosController::class, 'agregarCurso']);

Route::get('/libros', [LibrosController::class, 'libros'])->name('libros');

Route::post('/libros/eliminar/{id}', [LibrosController::class, 'eliminarLibro']);

Route::get('/librosInactivos', [LibrosController::class, 'librosInactivos'])->name('librosInactivos');

Route::post('/librosInactivos/activar/{id}', [LibrosController::class, 'activarLibro']);

Route::get('/nuevoLibro', [LibrosController::class, 'nuevoLibro'])->name('nuevoLibro');

Route::post('/newLibro/agregar', [LibrosController::class, 'agregarLibro']);

Route::get('/libros/editarLibro/{id}', [LibrosController::class, 'editarLibro']);

Route::post('/libros/editarLibro/editar', [LibrosController::class, 'editar']);

Route::get('/historialDePago/{id}', [AlumnosController::class, 'historial']);

Route::get('/gastos', [GastosController::class, 'gastos'])->name('gastos');

Route::post('/gastos/agregar', [GastosController::class, 'agregarGasto']);

Route::get('/cobros', [PagosController::class, 'cobros'])->name('cobros');

Route::get('/tutores/alumnosACargo/{id}', [TutoresController::class, 'alumnosACargo']);

Route::get('/docentes/cursos/{id}', [DocentesController::class, 'cursos']);

Route::get('/cursos/material/{id}', [CursosController::class, 'material']);

Route::get('/cursos/alumnos/{id}', [CursosController::class, 'alumnos']);

Route::get('/resumenMensual', [ResumenesController::class, 'mensual'])->name('resumenMensual');

Route::get('/resumenPorFecha', [ResumenesController::class, 'porFecha'])->name('resumenPorFecha');

Route::get('/resumenPorFecha/buscar/{fecha}/{fecha2}', [ResumenesController::class, 'buscar']);

Route::post('/resumen/borrarIngreso/{id}', [ResumenesController::class, 'borrarIngreso']);

Route::post('/resumen/borrarEgreso/{id}', [ResumenesController::class, 'borrarEgreso']);

Route::get('/resumen/editar/{id}', [ResumenesController::class, 'editarIngreso']);

Route::post('/resumen/editar/editarIngreso', [ResumenesController::class, 'editar']);

Route::get('/resumen/editarE/{id}', [ResumenesController::class, 'editarEgreso']);

Route::get('/resumen/editarPF/{id}', [ResumenesController::class, 'editarIngresoPF']);

Route::post('/resumen/editarE/editarEgreso', [ResumenesController::class, 'editarE']);

Route::get('/resumen/editarEPF/{id}', [ResumenesController::class, 'editarEgresoPF']);

Route::get('/historialDePago/recibo/{id}', [AlumnosController::class, 'recibo']);

Route::get('/listados', [ListadosController::class, 'elegir'])->name('listados');

Route::get('/listados/alumnos/{valor}', [ListadosController::class, 'Lalumnos']);

Route::get('/listados/cursos/{curso}', [ListadosController::class, 'Lcurso']);

Route::get('/listados/pagos/{fechaD}/{fechaH}', [ListadosController::class, 'Lpagos']);

Route::get('/{buscar}', [AlumnosController::class, 'busqueda']);

Route::get('/tutores/{buscar}', [TutoresController::class, 'busqueda']);

Route::get('docentes/{buscar}', [DocentesController::class, 'busqueda']);

Auth::routes();

