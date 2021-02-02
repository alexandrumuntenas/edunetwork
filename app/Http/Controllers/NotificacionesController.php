<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificacionesController extends Controller
{
    public function index(){
        return view('modulos.notificaciones.index');
    }
}
