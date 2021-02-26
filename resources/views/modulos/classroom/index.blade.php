@extends('adminlte::page')

@section('title', 'Classroom < Edunetwork') @section('content_header') <h1>Classroom @if (Auth::user()->hasRole('profesor')) <a class="btn btn-success btn-sm" data-toggle="modal"
            data-target="#crearclase" href=""><i class="fas fa-chalkboard-teacher "></i> Crear clase</a></h1>
    @endif
    </h1>
</h1> @stop

@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <img class="classbg"
                    src="https://cdn.duoestudios.es/wp-content/uploads/2021/01/monastery-569368_1920.jpg">
                <div class="text-block">
                    <h4>Actividades pendientes</h4>
                    <p>
                    <ul>
                        <li>Presentación Powerpoint UE</li>
                        <li>Actividades Tema 3</li>
                        <li>La narración - Tema 1</li>
                    </ul>
                    </p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <img class="classbg"
                    src="https://cdn.duoestudios.es/wp-content/uploads/2021/02/pexels-elina-krima-3309968-scaled.jpg">
                <div class="text-block">
                    <h4>Lengua Castellana y Literatura</h4>
                    <p>3F · Profesor Facherito Refacherito</p>
                </div>
            </div>
        </div>
    </div>
    @if (Auth::user()->hasRole('profesor'))
        <div class="modal fade" id="crearclase" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <form class="modal-content" method="post" action="{{ url('/notificaciones/acciones/crear') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="crearclase">Crear nueva clase</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="asignatura">Asignatura</label>
                            <input id="asignatura" name="asignatura" class="form-control form-control-sm" type="text"
                                maxlength="255" value="" />
                        </div>
                        <div class="form-group">
                            <label for="clase">Clase</label>
                            <input id="clase" name="clase" class="form-control form-control-sm" type="text"
                                maxlength="255" value="" required />
                        </div>
                        <div class="form-group">
                            <label for="seccion">Sección</label>
                            <input id="seccion" name="seccion" class="form-control form-control-sm" type="text"
                                maxlength="255" value="" />
                        </div>
                        <div class="form-group">
                            <label for="aula">Aula</label>
                            <input id="aula" name="aula" class="form-control form-control-sm" type="text"
                                maxlength="255" value="" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Añadir</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
@stop

@section('css')
    <style>
        .card {
            max-width: 350px;
            min-width: 300px;
            height: auto;
            transition: transform .2s;
        }

        .card:hover {
            box-shadow: 2px 2px 20px #000;
            transform: scale(1.025);
        }

        .text-block {
            position: absolute;
            left: 10px;
            top: 20px;
            color: white;
            padding-left: 20px;
            padding-right: 20px;
        }

        .card h4 {
            font-weight: bold;
        }

        .classbg {
            filter: brightness(0.25);
            height: 197.75px;
            object-fit: cover;
        }

    </style>
@stop

@section('js')
    <script>
    </script>
@stop

@section('footer')
    Edunetwork v1.0
</> by duoestudios
@endsection
