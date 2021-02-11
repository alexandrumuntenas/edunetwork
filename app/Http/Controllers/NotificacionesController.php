<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificacionesController extends Controller
{
    public function index()
    {
        $query = Notification::paginate(15);
        $datos = json_decode(json_encode($query), true);

        return view('modulos.notificaciones.index')->with([
            'datos' => $datos, 'links' => $query,
        ]);
    }
    public function crear()
    {
        return redirect('notificaciones_home');
    }
    public function leer($id)
    {
        $query = Notification::all()->where('id', '=', $id);
        $datos = json_decode(json_encode($query), true);
        $datos = $datos[$id-1];
        return view('modulos.notificaciones.acciones.ver')->with([
            'datos' => $datos,
            'id' => $id,
        ]);
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
