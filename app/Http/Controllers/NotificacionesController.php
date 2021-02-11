<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class NotificacionesController extends Controller
{
    public function index()
    {
        $query = Notification::orderBy('id', 'desc')->paginate(15);
        $datos = json_decode(json_encode($query), true);
        $autor = Auth::user()->name;
        return view('modulos.notificaciones.index')->with([
            'datos' => $datos, 'links' => $query, 'autor' => $autor,
        ]);
    }
    public function crear(Request $request)
    {
        $titulo = $request->input('titulo');
        $autor = $request->input('autor');

        $contenido = trim(preg_replace('/\s\s+/', ' ', $request->input('contenido')));
        $json_data = '[{"titulo":"'.$titulo.'", "contenido":"'.$contenido.'", "autor":"'.$autor.'"}]';
        DB::table('notifications')->insert([
            'json_data' => $json_data,
        ]);

        return redirect('/notificaciones/');
    }
    public function leer($id)
    {
        $query = Notification::all()->where('id', '=', $id);
        $datos = json_decode(json_encode($query), true);
        foreach($datos as $item){
            return view('modulos.notificaciones.acciones.ver')->with([
                'datos' => $item,
                'id' => $id,
            ]);
        }

    }
    public function editar($id)
    {
        return view('modulos.notificaciones.acciones.editor');
    }
    public function actualizar($id)
    {
        return redirect('notificaciones_home');
    }
    public function remover($id)
    {
        return redirect('notificaciones_home');
    }
}
