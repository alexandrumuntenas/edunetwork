@extends('adminlte::page')

@section('title', 'Classroom < Edunetwork') @section('content_header') <h1>Classroom @if (Auth::user()->hasRole('profesor')) <a class="btn btn-success btn-sm" data-toggle="modal"
            data-target="#crearclase" href=""><i class="fas fa-chalkboard-teacher "></i> Crear una clase</a></h1>
    @elseif(Auth::user()->hasRole('alumno')) <a class="btn btn-success btn-sm" data-toggle="modal"
            data-target="#unirseclase" href=""><i class="fas fa-chalkboard-teacher "></i> Unirse a una clase</a></h1>
    @endif
</h1> @stop

@section('content')

    <div class="row">
        @foreach ($classrooms as $classroom)
            @if (isset($classroom))
                @foreach (json_decode($classroom['classroom_config']) as $i)
                    <div class="col" id="class_presentation">
                        <div class="card">
                            <a href="{{ url('/elearning/c/' . $classroom['classroom_hash']) }}">
                                <img class="classbg"
                                    src="https://cdn.duoestudios.es/wp-content/uploads/2021/02/pexels-elina-krima-3309968-scaled.jpg">
                                <div class="text-block">
                                    <h4>{{ $i->asignatura }}</h4>
                                    <p>{{ $i->clase }} · {{ $i->profesor_name }}</p>
                                </div>
                            </a>
                        </div>
                    </div>

                @endforeach
            @endif
        @endforeach
    </div>
    @if (Auth::user()->hasRole('profesor'))
        <div class="modal fade" id="crearclase" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <form class="modal-content" method="post" action="{{ url('/elearning/acciones/crear') }}">
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
                                maxlength="255" value="" required />
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
    @if (Auth::user()->hasRole('alumno'))
        <div class="modal fade" id="unirseclase" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <form class="modal-content" method="post" action="{{ url('/elearning/acciones/unirme') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="unirseclase">Crear nueva clase</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="codigo">Código de clase</label>
                            <input id="codigo" name="codigo" class="form-control form-control-sm" type="text"
                                maxlength="255" value="" required />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Acceder</button>
                        </div>
                </form>
            </div>

        </div>
    @endif
    </div>
@stop

@section('footer')
    Edunetwork v1.0
</> by duoestudios
@endsection
