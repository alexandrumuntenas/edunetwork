<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BibliotecaController extends Controller
{
    public function index()
    {
        return view('modulos.biblioteca.index');
    }

    public function misprestamos()
    {
        return view('modulos.biblioteca.misprestamos');
    }

    public function misestadisticas()
    {
        return view('modulos.biblioteca.misestadisticas');
    }
    public function misvaloraciones()
    {
        return view('modulos.biblioteca.misvaloraciones');
    }
}
