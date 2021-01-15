<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgendapersonalController extends Controller
{
    public function index(){
        return view('modulos.agendapersonal.index');
    }
}
