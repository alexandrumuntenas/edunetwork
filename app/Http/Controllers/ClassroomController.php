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
            if (isset($esta_en_esta_clase->user_id)) {
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
            if (isset($esta_en_esta_clase->user_id)) {
                $categorias = array();
                if (isset($data->classroom_topics_order)) {
                    foreach (json_decode($data->classroom_topics_order) as $i) {
                        $datos = json_decode(json_encode($data), true);
                        $categorias[] = DB::table($hash . '_class_topics')->where('id', '=', $i)->first();
                    }
                } else {
                    $datos = json_decode(json_encode($data), true);
                }
                $actividades = DB::table($hash . '_class_activities')->get();
                if (Auth::user()->hasRole('alumno')) {
                    $notas = DB::table($hash . '_class_activities_response')->where('student_id', '=', Auth::user()->id)->where('mark','!=',null)->get();
                }
                return view('modulos.classroom.trabajodeclase')->with(['classroom' => $datos, 'categorias' => $categorias, 'actividades' => $actividades, 'hash' => $hash, 'notas' => $notas ?? null]);
            } else {
                return view('modulos.errores.404.classroom');
            }
        } else {
            return view('modulos.errores.404.classroom');
        }
    }

    public function class_work_view($hash, $id)
    {
        $data = DB::table('classrooms')->where('classroom_hash', '=', $hash)->first();
        if (isset($data->id)) {
            $esta_en_esta_clase = DB::table('user_classrooms')->where('class_id', '=', $data->id)->where('user_id', '=', Auth::user()->id)->first();
            if (isset($esta_en_esta_clase->user_id)) {
                $datos = json_decode(json_encode($data), true);
                if ($datos['classroom_teacher'] === Auth::user()->id) {
                    $alumnos = DB::table('user_classrooms')->where('class_id', '=', $data->id)->get();
                    $listadoalumnos = array();
                    foreach ($alumnos as $alumno) {
                        $listadoalumnos[] = DB::table('users')->where('id', '=', $alumno->user_id)->first();
                    }
                    $respuestas = DB::table($hash . '_class_activities_response')->where('activity_id', '=', $id)->get();
                    $respuestasconnota = DB::table($hash . '_class_activities_response')->where('activity_id', '=', $id)->where('mark', '!=', null)->get();
                    $respuestascontadas = array();
                    foreach ($respuestas as $respuesta) {
                        $respuestascontadas[] = $respuesta->student_id;
                    }
                    if (isset($respuestascontadas)) {
                        $respuestasconnotas = count($respuestasconnota);
                        $respuestascontadas = array_count_values($respuestascontadas);
                        $nopresentado = count($alumnos) - count($respuestascontadas) - 1; //Restamos 1, ya que contamos también al profesor.
                        $presentado = count($respuestascontadas) - $respuestasconnotas;
                        $devuelto = $respuestasconnotas;
                    } else {
                        $nopresentado = count($alumnos) - 1; //Restamos 1, ya que contamos también al profesor.
                        $presentado = 0;
                        $devuelto = 0;
                    }
                    //Valores
                } else {
                    $respuestasalumno = DB::table($hash . '_class_activities_response')->where('student_id', '=', Auth::user()->id)->where('activity_id', '=', $id)->get();
                    $nrespuestasalumno = count($respuestasalumno);
                }
                $actividad = DB::table($hash . '_class_activities')->where('id', '=', $id)->first();
                return view('modulos.classroom.trabajodeclase.ver')->with(['classroom' => $datos, 'actividad' => $actividad, 'hash' => $hash, 'respuestas' => $respuestas ?? null, 'listadoalumnos' => $listadoalumnos ?? null, 'nopresentado' => $nopresentado ?? 0, 'presentado' => $presentado ?? 0, 'devuelto' => $devuelto ?? 0, 'respuestasalumno' => $respuestasalumno ?? null, 'nrespuestasalumno' => $nrespuestasalumno ?? null]);
            } else {
                return view('modulos.errores.404.classroom');
            }
        } else {
            return view('modulos.errores.404.classroom');
        }
    }

    public function class_students($hash)
    {
        $companeros = array();
        $data = DB::table('classrooms')->where('classroom_hash', '=', $hash)->first();
        if (isset($data->id)) {
            $esta_en_esta_clase = DB::table('user_classrooms')->where('class_id', '=', $data->id)->where('user_id', '=', Auth::user()->id)->first();
            if (isset($esta_en_esta_clase->user_id)) {
                $datos = json_decode(json_encode($data), true);
                $alumnos = DB::table('user_classrooms')->where('class_id', '=', $data->id)->get();
                foreach ($alumnos as $alumno) {
                    $conseguirdatoscompaneros = DB::table('users')->where('id', '=', $alumno->user_id)->first();
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
            if (isset($esta_en_esta_clase->user_id)) {
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
        $aspectos = array("orange", "blue", "indigo", "purple", "cyan");
        $aspecto = array_rand($aspectos, 1);
        $aspecto = $aspectos[$aspecto];
        $json_data = '[{"asignatura":"' . $asignatura . '", "clase":"' . $clase . '", "seccion":"' . $seccion . '", "aula":"' . $aula . '", "profesor_id":"' . $user_id . '", "profesor_name":"' . $user_name . '", "aspecto":"' . $aspecto . '"}]';
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

        Schema::create($classroom_hash . "_class_activities_response", function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('activity_id');
            $table->integer('student_id');
            $table->longText('response_data');
            $table->integer('mark')->nullable();
            $table->timestamp('created_at')->useCurrent();
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
        if (isset($datos_clase_solicitada)) {
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
        } else {
            return view('modulos.errores.404.classroom');
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
    public function eliminar($hash)
    {
        Schema::dropIfExists($hash . "_class_activities_response");
        Schema::dropIfExists($hash . "_class_activities");
        Schema::dropIfExists($hash . "_class_grades");
        Schema::dropIfExists($hash . "_class_topics");
        Schema::dropIfExists($hash . "_class_messages");
        DB::table('classrooms')->where('classroom_hash', '=', $hash)->delete();
        return redirect('/elearning/');
    }
    //Configuración de clase
    public function class_u_config(Request $request, $hash){
        $datanatiguo = DB::table('classrooms')->where('classroom_hash','=',$hash)->first();
        foreach(json_decode($datanatiguo->classroom_config,true) as $i){
            $asignatura = $i['asignatura'];
            $clase = $i['clase'];
            $seccion = $i['seccion'];
            $aula = $i['aula'];
            $profesor_id = $i['profesor_id'];
            $profesor_name = $i['profesor_name'];
            $aspecto = $request->input('aspecto');
            $json_data = '[{"asignatura":"' . $asignatura . '", "clase":"' . $clase . '", "seccion":"' . $seccion . '", "aula":"' . $aula . '", "profesor_id":"' . $profesor_id . '", "profesor_name":"' . $profesor_name . '", "aspecto":"' . $aspecto . '"}]';
            DB::table('classrooms')->where('classroom_hash', '=', $hash)->update(['classroom_config' => $json_data]);
        }
        return '200';
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

    //Funciones de "trabajo de clase"
    public function class_work_save_ord(Request $request, $hash)
    {
        $data = DB::table('classrooms')->where('classroom_hash', '=', $hash)->first();
        if ($data->classroom_teacher === Auth::user()->id) {
            DB::table('classrooms')->where('classroom_hash', '=', $hash)->update(['classroom_topics_order' => $request->input('data'),]);
            return '¡Orden guardado!';
        }
    }

    public function class_work_crear(Request $request, $hash)
    {
        $referer = $request->headers->get('referer');
        $referer = explode('/', $referer);
        switch ($referer[10]) {
            case "material":
                $titulo = $request->input('titulo');
                $contenido = trim(addslashes(preg_replace('/\s\s+/', ' ', $request->input('contenido'))));
                $tema = $request->input('tema');
                $json_data = '[{"titulo": "' . $titulo . '","contenido": "' . $contenido . '"}]';
                DB::table($hash . '_class_activities')->insert(['topic_id' => $tema, 'type' => 'material', 'activity_data' => $json_data]);
                return redirect('/elearning/c/' . $hash . '/trabajodeclase');
                break;
            case "tarea":
                break;

            case "pregunta":
                $pregunta = $request->input('pregunta');
                $masrespuestas = $request->input('masrespuestas');
                if (isset($masrespuestas)) {
                    $masrespuestas = 1;
                } else {
                    $masrespuestas = 0;
                }
                $puntos = $request->input('puntos');
                $tipo = $request->input('tipo');
                $contenido = trim(addslashes(preg_replace('/\s\s+/', ' ', $request->input('contenido'))));
                $tema = $request->input('tema');
                if ($tipo === 'number') {
                    $min = $request->input('min');
                    $max = $request->input('max');
                    $json_data = '[{"titulo": "' . $pregunta . '", "puntos":"' . $puntos . '","atributo":"' . $tipo . '","masrespuestas": "' . $masrespuestas . '","min":"' . $min . '","max":"' . $max . '","contenido": "' . $contenido . '"}]';
                } else {
                    $json_data = '[{"titulo": "' . $pregunta . '", "puntos":"' . $puntos . '","atributo":"' . $tipo . '","masrespuestas": "' . $masrespuestas . '","contenido": "' . $contenido . '"}]';
                }
                DB::table($hash . '_class_activities')->insert(['topic_id' => $tema, 'type' => 'pregunta', 'activity_data' => $json_data]);
                return redirect('/elearning/c/' . $hash . '/trabajodeclase');
                break;

            case "h5p":
                break;

            case "examen":
                break;
        }
        /*$array = DB::Table('classrooms')->where('classroom_hash', '=', $hash)->first();
        $id = DB::table($hash . '_class_topics')->insertGetId(['topic_data' => $request->input('tema')]);
        $order = json_decode($array->classroom_topics_order);
        $order[] = $id;
        DB::table('classrooms')->where('id', '=', $array->id)->update(['classroom_topics_order' => $order]);
        return redirect('/elearning/c/' . $hash . '/trabajodeclase');*/
    }
    public function class_work_e_activity($hash, $id)
    {
        $data = DB::table('classrooms')->where('classroom_hash', '=', $hash)->first();
        if ($data->classroom_teacher === Auth::user()->id) {
            $activity = DB::table($hash . '_class_activities')->where('id', '=', $id)->first();
            $topics = DB::table($hash . '_class_topics')->get();
            $datos = json_decode(json_encode($data), true);
            switch ($activity->type) {
                case ('material'):
                    return view('modulos.classroom.trabajodeclase.editar')->with(['type' => 'material', 'classroom' => $datos, 'temas' => $topics, 'data' => $activity, 'hash' => $hash]);
                    break;

                case ('tarea'):
                    return 'Tarea';
                    break;

                case ('pregunta'):
                    return 'Pregunta';
                    break;

                case ('h5p'):
                    return 'H5P';
                    break;

                case ('examen'):
                    return 'Examen';
                    break;

                default:
                    return 'Ha habido un error en la solicitud';
                    break;
            }
        }
    }
    public function class_work_u_activity(Request $request, $hash)
    {
        $url = explode('/', $request->server('HTTP_REFERER'));
        $activity = DB::table($hash . '_class_activities')->where('id', '=', $url[10])->first();
        switch ($activity->type) {
            case ('material'):
                $titulo = $request->input('titulo');
                $contenido = trim(addslashes(preg_replace('/\s\s+/', ' ', $request->input('contenido'))));
                $tema = $request->input('tema');
                $json_data = '[{"titulo": "' . $titulo . '","contenido": "' . $contenido . '"}]';
                DB::table($hash . '_class_activities')->where('id', '=', $activity->id)->update(['topic_id' => $tema, 'activity_data' => $json_data]);
                return redirect('/elearning/c/' . $hash . '/trabajodeclase/v/' . $activity->id);
                break;

            case ('tarea'):
                return 'Tarea';
                break;

            case ('pregunta'):
                return 'Pregunta';
                break;

            case ('h5p'):
                return 'H5P';
                break;

            case ('examen'):
                return 'Examen';
                break;

            default:
                return 'Ha habido un error en la solicitud';
                break;
        }
    }

    public function class_work_d_activity($hash, $id)
    {
        $data = DB::table('classrooms')->where('classroom_hash', '=', $hash)->first();
        if ($data->classroom_teacher === Auth::user()->id) {
            DB::table($hash . '_class_activities')->where('id', '=', $id)->delete();
            return redirect('/elearning/c/' . $hash . '/trabajodeclase');
        }
    }

    //Funciones trabajo de clase, crear actividad
    public function class_work_c_material($hash)
    {
        $data = DB::table('classrooms')->where('classroom_hash', '=', $hash)->first();
        if (isset($data->id)) {
            $esta_en_esta_clase = DB::table('user_classrooms')->where('class_id', '=', $data->id)->where('user_id', '=', Auth::user()->id)->first();
            if (isset($esta_en_esta_clase->user_id)) {
                $topics = DB::table($hash . '_class_topics')->get();
                $datos = json_decode(json_encode($data), true);
                return view('modulos.classroom.trabajodeclase.crear.material')->with(['classroom' => $datos, 'temas' => $topics, 'hash' => $hash]);
            } else {
                return view('modulos.errores.404.classroom');
            }
        } else {
            return view('modulos.errores.404.classroom');
        }
    }

    public function class_work_c_tema(Request $request, $hash)
    {
        $array = DB::Table('classrooms')->where('classroom_hash', '=', $hash)->first();
        $id = DB::table($hash . '_class_topics')->insertGetId(['topic_data' => $request->input('tema')]);
        $order = json_decode($array->classroom_topics_order);
        $order[] = $id;
        DB::table('classrooms')->where('id', '=', $array->id)->update(['classroom_topics_order' => $order]);
        return redirect('/elearning/c/' . $hash . '/trabajodeclase');
    }

    public function class_work_c_pregunta(Request $request, $hash)
    {
        $data = DB::table('classrooms')->where('classroom_hash', '=', $hash)->first();
        if (isset($data->id)) {
            $esta_en_esta_clase = DB::table('user_classrooms')->where('class_id', '=', $data->id)->where('user_id', '=', Auth::user()->id)->first();
            if (isset($esta_en_esta_clase->user_id)) {
                $topics = DB::table($hash . '_class_topics')->get();
                $datos = json_decode(json_encode($data), true);
                return view('modulos.classroom.trabajodeclase.crear.pregunta')->with(['classroom' => $datos, 'temas' => $topics, 'hash' => $hash]);
            } else {
                return view('modulos.errores.404.classroom');
            }
        } else {
            return view('modulos.errores.404.classroom');
        }
    }

    //Funciones de trabajo de clase, pero per cápita (actividad)

    public function entregar_actividad(Request $request, $hash)
    {
        $referer = $request->headers->get('referer');
        $referer = explode('/', $referer);
        $activity = DB::table($hash . '_class_activities')->where('id', '=', $referer[10])->first();
        $respuesta = trim(addslashes(preg_replace('/\s\s+/', ' ', $request->input('respuesta'))));
        switch ($activity->type) {
            case ('pregunta'):
                $response_data = $respuesta;
                DB::table($hash . '_class_activities_response')->insert([
                    'activity_id' => $activity->id,
                    'student_id' => Auth::user()->id,
                    'response_data' => $response_data
                ]);
                return redirect('/elearning/c/' . $hash . '/trabajodeclase/v/' . $referer[10]);
                break;
        }
    }

    public function evaluar_actividad(Request $request, $hash, $id)
    {
        $puntuacion = json_decode($request->input('puntuacion'));
        $usuario = $request->input('usuario');
        $actividad = $request->input('actividad');
        $respuesta = $request->input('respuesta');
        DB::table($hash . "_class_activities_response")->where('id', '=', $respuesta)->where('student_id', '=', $usuario)->where('activity_id', '=', $actividad)->update(['mark' => $puntuacion]);
        return '';
    }
}
