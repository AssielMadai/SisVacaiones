<?php

use App\Http\Controllers\AopController;
use App\Http\Controllers\AsignarController;
use App\Http\Controllers\IrapController;
use App\Http\Controllers\RepresentanteController;
use App\Http\Controllers\RevisionJefeController;
use App\Http\Controllers\RevisionLegalController;
use App\Http\Controllers\RevisionTecnicoController;
use App\Http\Controllers\SubSectorController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VacacionController;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/verListaUsuario', [UsuarioController::class,'verListaUsuario'])->name('verListaUsuario');
Route::get('/mostrarEditarRegistro/{id}', [UsuarioController::class,'mostrarEditarRegistro'])->name('mostrarEditarRegistro');
Route::put('/editarUsuario/{id}', [UsuarioController::class,'editarUsuario'])->name('editarUsuario');
Route::get('/eliminarUsuario/{id}', [UsuarioController::class,'eliminarUsuario'])->name('eliminarUsuario');
Route::post('/registrarUsuario',[UsuarioController::class,'registrarUsuario'])->name('registrarUsuario');
Route::get('/vistaCrearUsuario', [UsuarioController::class,'vistaCrearUsuario'])->name('vistaCrearUsuario');
Route::get('/mostrarAsignados', [AsignarController::class,'mostrarAsignados'])->name('mostrarAsignados');

Route::get('/registrarVacacionVista/{id}', [VacacionController::class,'registrarVacacionVista'])->name('registrarVacacionVista');
Route::post('/registrarVacacion/{id}',[VacacionController::class,'registrarVacacion'])->name('registrarVacacion');
Route::get('/vistaRecibo/{id}', [VacacionController::class,'vistaRecibo'])->name('vistaRecibo');
Route::get('/VerUsuariosVacaciones', [VacacionController::class,'VerUsuariosVacaciones'])->name('VerUsuariosVacaciones');
Route::get('/recibo', [VacacionController::class,'recibo'])->name('recibo');
