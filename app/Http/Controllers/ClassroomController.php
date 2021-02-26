<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Schema\Blueprint;
use DB;
use Illuminate\Support\Facades\Schema;

class ClassroomController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $data = DB::table('classrooms')->where('classroom_teacher', '=', $user_id)->get();
        $datos = json_decode(json_encode($data), true);
        return view('modulos.classroom.index')->with(['classrooms' => $datos]);
    }
    public function classroom($hash)
    {
        $data = DB::table('classrooms')->where('classroom_hash', '=', $hash)->first();
        $datos = json_decode(json_encode($data), true);

        $anuncios = DB::table($hash.'_class_messages')->get();
        $anuncios = json_decode($anuncios, true);
        if ($datos != null) {
            return view('modulos.classroom.class')->with(['classroom' => $datos, 'anuncios' => $anuncios, 'hash' => $hash]);
        } else {
            return view('modulos.errores.404.classroom');
        }
    }
    public function misdeberes()
    {
    }

    //Zona de acciones
    public function crear(Request $request)
    {
        $asignatura = $request->input('asignatura');
        $clase = $request->input('clase');
        $seccion = $request->input('seccion');
        $aula = $request->input('aula');
        $user_id = Auth::user()->id;
        $user_name = Auth::user()->name;
        $randomizer = rand(0, 1000) + rand(0, 1000) * rand(0, 1000) / rand(0, 1000) * rand(0, 100) / rand(0, 10);
        $classroom_hash = hash('md5', "$asignatura$clase$seccion$aula$user_id$user_name$randomizer");
        $json_data = '[{"asignatura":"' . $asignatura . '", "clase":"' . $clase . '", "seccion":"' . $seccion . '", "aula":"' . $aula . '", "profesor_id":"' . $user_id . '", "profesor_name":"' . $user_name . '"}]';

        DB::table('classrooms')->insert([
            'classroom_teacher' => $user_id,
            'classroom_hash' => $classroom_hash,
            'classroom_config' => $json_data,
        ]);

        Schema::create($classroom_hash . "_class_messages", function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('author');
            $table->longText('message_data');
            $table->timestamps();
        });
        Schema::create($classroom_hash . "_class_activities", function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->longText('activity_data');
            $table->timestamps();
        });
        Schema::create($classroom_hash . "_class_topics", function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('topic_data');
        });
        Schema::create($classroom_hash . "_class_work", function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('topic_id');
            $table->longText('activity_id');
        });
        Schema::create($classroom_hash . "_class_grades", function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('student_id');
            $table->timestamps();
        });

        return redirect('/elearning/');
    }
    public function unirse()
    {
    }
    public function editar()
    {
    }
    public function meet()
    {
    }
    public function archivar()
    {
    }
    public function eliminar()
    {
    }

    //Funciones del tablón
    public function crearanuncio(Request $request, $hash){
        $contenido = trim(addslashes(preg_replace('/\s\s+/', ' ', $request->input('nuevomensaje'))));
        DB::table($hash.'_class_messages')->insert([
            'author' => Auth::user()->id,
            'message_data' => $contenido,
        ]);
        return redirect('/elearning/c/'.$hash);
    }

    public function eliminaranuncio(Request $request, $hash){

    }
}
