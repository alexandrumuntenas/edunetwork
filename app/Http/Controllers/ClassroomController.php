<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Schema\Blueprint;
use DB;
use Illuminate\Support\Facades\Schema;

class ClassroomController extends Controller
{
    //Páginas
    public function index()
    {
        $clases = array();
        $user_id = Auth::user()->id;
        $ver_donde_usuario = DB::table('user_classrooms')->where('user_id', '=', $user_id)->get();
        foreach ($ver_donde_usuario as $item) {
            $clase = DB::table('classrooms')->where('id', '=', $item->class_id)->first();
            $clases[] = $clase;
        }
        $clases = json_decode(json_encode($clases), true);
        return view('modulos.classroom.index')->with(['classrooms' => $clases]);
    }
    public function classroom($hash)
    {

        $data = DB::table('classrooms')->where('classroom_hash', '=', $hash)->first();
        if (isset($data->id)) {
            $esta_en_esta_clase = DB::table('user_classrooms')->where('class_id', '=', $data->id)->where('user_id', '=', Auth::user()->id)->first();
            if ($esta_en_esta_clase->user_id == Auth::user()->id) {
                $datos = json_decode(json_encode($data), true);
                $anuncios = DB::table($hash . '_class_messages')->get();
                $anuncios = json_decode($anuncios, true);
                return view('modulos.classroom.class')->with(['classroom' => $datos, 'anuncios' => $anuncios, 'hash' => $hash]);
            } else {
                return view('modulos.errores.404.classroom');
            }
        } else {
            return view('modulos.errores.404.classroom');
        }
    }
    public function class_work($hash)
    {
        $data = DB::table('classrooms')->where('classroom_hash', '=', $hash)->first();
        if (isset($data->id)) {
            $esta_en_esta_clase = DB::table('user_classrooms')->where('class_id', '=', $data->id)->where('user_id', '=', Auth::user()->id)->first();
            if ($esta_en_esta_clase->user_id == Auth::user()->id) {
                $datos = json_decode(json_encode($data), true);
                $categorias = DB::table($hash . '_class_topics')->get();
                $actividades = DB::table($hash . '_class_activities')->get();
                return view('modulos.classroom.trabajodeclase')->with(['classroom' => $datos, 'categorias' => $categorias, 'actividades' => $actividades, 'hash' => $hash]);
            } else {
                return view('modulos.errores.404.classroom');
            }
        } else {
            return view('modulos.errores.404.classroom');
        }
    }
    public function class_students($hash){
        $companeros = array();
        $data = DB::table('classrooms')->where('classroom_hash', '=', $hash)->first();
        if (isset($data->id)) {
            $esta_en_esta_clase = DB::table('user_classrooms')->where('class_id', '=', $data->id)->where('user_id', '=', Auth::user()->id)->first();
            if ($esta_en_esta_clase->user_id == Auth::user()->id) {
                $datos = json_decode(json_encode($data), true);
                $alumnos = DB::table('user_classrooms')->where('class_id', '=', $data->id)->get();
                foreach($alumnos as $alumno){
                    $conseguirdatoscompaneros = DB::table('users')->where('id','=',$alumno->user_id)->first();
                    $companeros[] = $conseguirdatoscompaneros;
                }
                return view('modulos.classroom.classmates')->with(['classroom' => $datos, 'alumnos' => $companeros, 'hash' => $hash]);
            } else {
                return view('modulos.errores.404.classroom');
            }
        } else {
            return view('modulos.errores.404.classroom');
        }
    }
    public function misdeberes()
    {
        $esta_en_esta_clase = DB::table('user_classrooms')->where('class_id', '=', $data->id)->first();
        if (isset($data->id)) {
            $esta_en_esta_clase = DB::table('user_classrooms')->where('class_id', '=', $data->id)->where('user_id', '=', Auth::user()->id)->first();
            if ($esta_en_esta_clase->user_id == Auth::user()->id) {
            } else {
                return view('modulos.errores.404.classroom');
            }
        } else {
            return view('modulos.errores.404.classroom');
        }
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
        $randomizer = rand(1, 1000) + rand(1, 1000) * rand(1, 1000) / rand(1, 1000) * rand(1, 100) / rand(1, 10);
        $classroom_hash = hash('md5', "$asignatura$clase$seccion$aula$user_id$user_name$randomizer");
        $json_data = '[{"asignatura":"' . $asignatura . '", "clase":"' . $clase . '", "seccion":"' . $seccion . '", "aula":"' . $aula . '", "profesor_id":"' . $user_id . '", "profesor_name":"' . $user_name . '"}]';
        $access_code = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10 / strlen($x)))), 1, 10);
        DB::table('classrooms')->insert([
            'classroom_teacher' => $user_id,
            'classroom_hash' => $classroom_hash,
            'classroom_config' => $json_data,
            'access_code' => $access_code,
        ]);

        Schema::create($classroom_hash . "_class_messages", function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('author');
            $table->longText('message_data');
            $table->timestamp('created_at')->useCurrent();
        });
        Schema::create($classroom_hash . "_class_activities", function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('topic_id');
            $table->string('type');
            $table->longText('activity_data');
            $table->timestamps();
        });
        Schema::create($classroom_hash . "_class_topics", function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('topic_data');
        });

        Schema::create($classroom_hash . "_class_grades", function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('student_id');
            $table->timestamps();
        });

        $id_class = DB::table('classrooms')->where('classroom_hash', '=', $classroom_hash)->first();

        DB::table('user_classrooms')->insert([
            'user_id' => Auth::user()->id,
            'class_id' => $id_class->id,
        ]);
        return redirect('/elearning/');
    }
    public function unirme(Request $request)
    {
        $user_id = Auth::user()->id;
        $clase_solicitada = $request->input('codigo');
        $datos_clase_solicitada = DB::table('classrooms')->where('access_code', '=', $clase_solicitada)->first();
        $comprobar_si_ya_en_clase = DB::table('user_classrooms')->where('class_id', '=', $datos_clase_solicitada->id)->where('user_id', '=', Auth::user()->id)->first();
        if (isset($comprobar_si_ya_en_clase)) {
            return redirect('/elearning/c/' . $datos_clase_solicitada->classroom_hash);
        } else {
            DB::table('user_classrooms')->insert([
                'user_id' => $user_id,
                'class_id' => $datos_clase_solicitada->id
            ]);

            return redirect('/elearning/c/' . $datos_clase_solicitada->classroom_hash);
        }
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
    public function crearanuncio(Request $request, $hash)
    {
        $contenido = trim(addslashes(preg_replace('/\s\s+/', ' ', $request->input('nuevomensaje'))));
        DB::table($hash . '_class_messages')->insert([
            'author' => Auth::user()->name,
            'message_data' => $contenido,
        ]);
        return redirect('/elearning/c/' . $hash);
    }

    public function eliminaranuncio(Request $request, $hash)
    {
    }
}
