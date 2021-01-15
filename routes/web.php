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
Route::get('/elearning/inicio', [App\Http\Controllers\HomeController::class, 'index'])->name('ol_home');

//Rutas comunicaciones
Route::get('/comunicaciones/', [App\Http\Controllers\HomeController::class, 'index'])->name('comunicaciones_home');

//Rutas Agenda
Route::get('/agenda/', [App\Http\Controllers\HomeController::class, 'index'])->name('agenda_home');
//Rutas biblioteca
Route::get('/biblioteca/', [App\Http\Controllers\HomeController::class, 'index'])->name('biblio_home');
Route::get('/biblioteca/catalogo', [App\Http\Controllers\HomeController::class, 'index'])->name('biblio_catalogo');
Route::get('/biblioteca/misprestamos', [App\Http\Controllers\HomeController::class, 'index'])->name('biblio_misprestamos');
Route::get('/biblioteca/misestadisticas', [App\Http\Controllers\HomeController::class, 'index'])->name('biblio_misestadisticas');
Route::get('/biblioteca/misvaloraciones', [App\Http\Controllers\HomeController::class, 'index'])->name('biblio_misvaloraciones');

//Rutas comunidades
Route::get('/comunidad/missuscripciones', [App\Http\Controllers\HomeController::class, 'index'])->name('cm_missuscripciones');
Route::get('/comunidad/misprestamos', [App\Http\Controllers\HomeController::class, 'index'])->name('biblio_misprestamos');
Route::get('/comunidad/misestadisticas', [App\Http\Controllers\HomeController::class, 'index'])->name('biblio_misestadisticas');
Route::get('/comunidad/misvaloraciones', [App\Http\Controllers\HomeController::class, 'index'])->name('biblio_misvaloraciones');
