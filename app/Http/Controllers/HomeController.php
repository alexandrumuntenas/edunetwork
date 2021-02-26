<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Catalogo;
use App\Models\Notification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $notificaciones = Notification::all()->sortByDesc('id')->take(5);
        $notificaciones = json_decode(json_encode($notificaciones), true);

        $prestamos = DB::table('catalogos')
            ->where('prestadoa', '=', Auth::user()->email)
            ->where('disponibilidad', '=', '2')
            ->orWhere('disponibilidad', '=', '3')
            ->get();
        //Targetas de información
        $cantidad = Catalogo::all()->count();
        $prestados = DB::table('catalogos')->where('disponibilidad', '=', '2')->count();
        $devolucion = DB::table('catalogos')->where('disponibilidad', '=', '3')->count();
        $confinados = DB::table('catalogos')->where('disponibilidad', '=', '4')->count();
        return view('home')->with([
            'prestamos' => $prestamos,
            'cantidad' => $cantidad,
            'prestados' => $prestados,
            'devolucion' => $devolucion,
            'confinados' => $confinados,
            'notificaciones' => $notificaciones,
        ]);
    }
}
