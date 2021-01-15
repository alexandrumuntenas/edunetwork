<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Rutas E-Learning
Route::get('/elearning/inicio', [ App\Http\Controllers\HomeController::class, 'index'])->name('ol_home');
Route::get('/elearning/clase/', [App\Http\Controllers\ElearningController::class, 'classroom'])->name('ol_home');

//Rutas comunicaciones
Route::get('/comunicaciones/', [App\Http\Controllers\ComunicacionesController::class, 'index'])->name('comunicaciones_home');

//Rutas Agenda
Route::get('/agenda/', [App\Http\Controllers\AgendapersonalController::class, 'index'])->name('agenda_home');

//Rutas biblioteca
Route::redirect('biblioteca/', 'biblioteca/catalogo/')->name('biblio_home');
Route::get('/biblioteca/catalogo', [App\Http\Controllers\BibliotecaController::class, 'index'])->name('biblio_catalogo');
Route::get('/biblioteca/misprestamos', [App\Http\Controllers\BibliotecaController::class, 'misprestamos'])->name('biblio_misprestamos');
Route::get('/biblioteca/misestadisticas', [App\Http\Controllers\BibliotecaController::class, 'misestadisticas'])->name('biblio_misestadisticas');
Route::get('/biblioteca/misvaloraciones', [App\Http\Controllers\BibliotecaController::class, 'misvaloraciones'])->name('biblio_misvaloraciones');

//Rutas comunidades
Route::get('/comunidad/missuscripciones', [App\Http\Controllers\ComunidadController::class, 'missuscripciones'])->name('cm_missuscripciones');
Route::get('/comunidad/misprestamos', [App\Http\Controllers\Modulos\ComunidadController::class, 'index'])->name('cm_misprestamos');
Route::get('/comunidad/misestadisticas', [App\Http\Controllers\Modulos\ComunidadController::class, 'index'])->name('cm_misestadisticas');
Route::get('/comunidad/misvaloraciones', [App\Http\Controllers\Modulos\ComunidadController::class, 'index'])->name('cm_misvaloraciones');
