    @foreach (json_decode($classroom['classroom_config']) as $i)
        <div class="col-12" id="class_header">
            <div class="card">
                <div class="card-body {{$i->aspecto}}">
                    <h4>{{ $i->asignatura }}</h4>
                    <p>{{ $i->clase }} · {{ $i->profesor_name }}</p>
                </div>
                <div class="card-footer" id="class_menu">
                    <ul>
                        <li><a href="{{ url('/elearning/c/' . $hash . '/') }}">Tablón</a></li>
                        <li><a href="{{ url('/elearning/c/' . $hash . '/trabajodeclase') }}">Trabajo de clase</a></li>
                        @if (Auth::user()->hasRole('alumno'))
                            <li><a href="{{ url('/elearning/c/' . $hash . '/companerosdeclase') }}">Compañeros de
                                    clase</a>
                            </li>
                            <li><a href="{{ url('/elearning/c/' . $hash . '/miscalificaciones') }}">Mis
                                    calificaciones</a>
                            </li>
                        @elseif(Auth::user()->hasRole('profesor'))
                            <li><a href="{{ url('/elearning/c/' . $hash . '/alumnos') }}">Alumnos</a></li>
                            <li><a href="{{ url('/elearning/c/' . $hash . '/cuadernodelprofesor') }}">Cuaderno del
                                    profesor</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
