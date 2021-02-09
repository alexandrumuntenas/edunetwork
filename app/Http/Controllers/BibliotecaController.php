<?php

namespace App\Http\Controllers;

use App\Models\Catalogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Catalogos;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AbiesImport;
use App\Imports\BibliowebImport;
use Desideratas;
use Illuminate\Support\Facades\Auth;

class BibliotecaController extends Controller
{
    public function index()
    {
        $datos = Catalogo::all();
        return view('modulos.biblioteca.index')->with('datos', $datos);
    }

    public function misprestamos()
    {
        $datos = DB::table('catalogos')
            ->where('prestadoa', '=', Auth::user()->email)
            ->where('disponibilidad', '=', '2')
            ->orWhere('disponibilidad', '=', '3')
            ->get();

        return view('modulos.biblioteca.misprestamos')->with('datos', $datos);
    }

    public function misestadisticas()
    {
        return view('modulos.biblioteca.misestadisticas');
    }
    public function misvaloraciones()
    {
        return view('modulos.biblioteca.misvaloraciones');
    }
    public function misdesideratas()
    {
        $pte = DB::table('desideratas')->where('estado', '=', '1')->where('usuario', '=', Auth::user()->id)->get();
        $rechazados = DB::table('desideratas')->where('estado', '=', '0')->where('usuario', '=', Auth::user()->id)->get();
        $aprobados = DB::table('desideratas')->where('estado', '=', '2')->where('usuario', '=', Auth::user()->id)->get();
        return view('modulos.biblioteca.misdesideratas')->with([
            'pte' => $pte,
            'rechazados' => $rechazados,
            'aprobados' => $aprobados,
        ]);
    }

    ##Funciones

    public function actualizar(Request $request)
    {
        $id = $request->input('id');
        $titulo = $request->input('titulo');
        $autor = $request->input('autor');
        $editorial = $request->input('editorial');
        $isbn = $request->input('isbn');
        $anopub = $request->input('anopub');
        $ejemplar = $request->input('ejemplar');
        $descripcion = $request->input('descripcion');

        $query = DB::table('catalogos')->where('id', $id)->update([
            'titulo' => $titulo,
            'autor' => $autor,
            'editorial' => $editorial,
            'isbn' => $isbn,
            'anopub' => $anopub,
            'ejemplar' => $ejemplar,
            'descripcion' => $descripcion,
        ]);
        return redirect('biblioteca/catalogo');
    }

    public function crear(Request $request)
    {
        $id = $request->input('id');
        $titulo = $request->input('titulo');
        $autor = $request->input('autor');
        $editorial = $request->input('editorial');
        $isbn = $request->input('isbn');
        $anopub = $request->input('anopub');
        $ejemplar = $request->input('ejemplar');
        $descripcion = $request->input('descripcion');
        DB::table('catalogos')->insert([
            'portada' => $request->input('titutlo'),
            'titulo' => $titulo,
            'autor' => $autor,
            'editorial' => $editorial,
            'isbn' => $isbn,
            'anopub' => $anopub,
            'ejemplar' => $ejemplar,
            'descripcion' => $descripcion,
        ]);

        return $request;
    }

    public function editar($id)
    {
        $parametros = DB::table('catalogos')->where('id', '=', $id)->get();
        return view('modulos.biblioteca.acciones.editor')->with('parametros', $parametros);
    }

    public function prestar($id)
    {
        $parametros = DB::table('catalogos')->where('id', '=', $id)->get();

        return view('modulos.biblioteca.acciones.prestar')->with(['parametros' => $parametros, 'id' => $id]);
    }

    public function prestamo(Request $request)
    {
        $identificador = $request->input('identificador');
        $correousuario = $request->input('correousuario');
        $fechadev = $request->input('fechadev');
        if ($fechadev == null) {
            $fechadev = date('Y-m-d', strtotime(date('Y-m-d') . '+ 15 days'));
        }
        DB::table('catalogos')->where('id', '=', $identificador)->update([
            'prestadoa' => $correousuario,
            'disponibilidad' => 2,
            'fechadev' => $fechadev,
        ]);
        return redirect('biblioteca/prestamos');
    }
    public function prorrogar($id)
    {
        $fechaantigua = DB::table('catalogos')->where('id', '=', $id)->get();
        $fecha = $fechaantigua[0]->fechadev;
        $fechanueva = date('Y-m-d', strtotime($fecha . '+ 15 days'));
        DB::table('catalogos')->where('id', '=', $id)->update(['fechadev' => $fechanueva]);
        return redirect('biblioteca/prestamos');
    }

    public function devolver($id)
    {
        $fechaantigua = DB::table('catalogos')->where('id', '=', $id)->get();
        $fecha = $fechaantigua[0]->fechadev;
        $fechanueva = date('Y-m-d', strtotime($fecha . '+ 15 days'));
        DB::table('catalogos')->where('id', '=', $id)->update(['prestadoa' => '', 'fechadev' => $fechanueva, 'disponibilidad' => 4]);
        return redirect('biblioteca/prestamos');
    }

    public function eliminar($id)
    {
        DB::table('catalogos')->where('id', '=', $id)->delete();
        return redirect('biblioteca/');
    }
    public function desiderata_aprobar($id)
    {
        DB::table('desideratas')->where('id', '=', $id)->update(['estado' => '2']);
        return redirect('biblioteca/desideratas');
    }

    public function desiderata_denegar($id)
    {
        DB::table('desideratas')->where('id', '=', $id)->update(['estado' => '0']);
        return redirect('biblioteca/desideratas');
    }

    #Todo lo relacionado con zonas admin

    public function prestamos()
    {
        $datos = DB::table('catalogos')
            ->where('disponibilidad', '=', '2')
            ->orWhere('disponibilidad', '=', '3')
            ->get();

        return view('modulos.biblioteca.prestamos')->with('datos', $datos);
    }
    public function desideratas()
    {
        $pte = DB::table('desideratas')->where('estado', '=', '1')->get();
        $rechazados = DB::table('desideratas')->where('estado','=','0')->get();
        $aprobados = DB::table('desideratas')->where('estado','=','2')->get();
        return view('modulos.biblioteca.desideratas')
        ->with([
            'pte' => $pte,
            'rechazados' => $rechazados,
            'aprobados' => $aprobados,
        ]);
    }

    public function valoraciones(){
        return view('modulos.biblioteca.valoraciones');
    }
    # Todo lo relacionado con el consultorio

    public function consultorio_usuarios(Request $request)
    {
        $correo = $request->input('correousuario');
        $founddata = DB::table('users')->where('email', '=', $correo)->get();
        return $founddata;
    }

    # Todo lo relacionado con la configuración
    public function configuracion()
    {
        $cantidad = Catalogo::all()->count();
        $prestados = DB::table('catalogos')->where('disponibilidad', '=', '2')->count();
        $devolucion = DB::table('catalogos')->where('disponibilidad', '=', '3')->count();
        $confinados = DB::table('catalogos')->where('disponibilidad', '=', '4')->count();
        return view('modulos.biblioteca.configuracion')->with(['cantidad' => $cantidad, 'prestados' => $prestados, 'devolucion' => $devolucion, 'confinados' => $confinados]);
    }

    public function subirabies(Request $request)
    {
        Excel::import(new AbiesImport, $request->file('filename'));
        return redirect('biblioteca/configuracion')->with('status', 'success');
    }

    public function subirbiblioweb(Request $request)
    {
        Excel::import(new BibliowebImport, $request->file('filename'));
        return redirect('biblioteca/configuracion')->with('status', 'success');
    }

    public function borrarcatalogo(Request $request)
    {
        Catalogo::truncate();
        return redirect('biblioteca/configuracion');
    }
}
