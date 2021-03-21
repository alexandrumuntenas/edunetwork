    @foreach (json_decode($classroom['classroom_config']) as $i)
        <div class="col-12" id="class_header">
            <div class="card">
                <div id="card_header_theme" class="card-body {{ $i->aspecto }}">
                    <div class="dropleft float-right">
                        <a type="button" id="configmenu" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="fas fa-cog"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="configmenu">
                            <a class="dropdown-item" data-toggle="modal" data-target="#configtheme">Cambiar tema</a>
                            <a class="dropdown-item" data-toggle="modal" data-target="#configcodigo">Ver código</a>
                            <a class="dropdown-item" data-toggle="modal" data-target="#configmodal">Something else
                                here</a>
                        </div>
                    </div>
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
        <div class="modal fade" id="configtheme" tabindex="-1" aria-labelledby="configtheme" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="configtheme">Cambiar tema</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <select class="form-control" name="color_scheme" id="color_scheme">
                            <option selected disabled>El tema actual es: {{ $i->aspecto }}</option>
                            <option value="blue">Azul (blue)</option>
                            <option value="orange">Naranja (orange)</option>
                            <option value="indigo">Indigo (indigo)</option>
                            <option value="purple">Morado (purple)</option>
                            <option value="cyan">Cian (cyan)</option>
                        </select>

                    </div>
                    <div class="modal-footer">
                        <p><small>Al cambiar el color, se actualizará automáticamente</small></p>
                        <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var selectedScheme = '{{ $i->aspecto }}';

            $('#color_scheme').change(function() {
                $('#card_header_theme').removeClass(selectedScheme).addClass($(this).val());
                selectedScheme = $(this).val();
                var csrf = "{{ csrf_token() }}";
                var theme = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{{ url('/elearning/c/' . $hash . '/config/u') }}",
                    data: {
                        aspecto:theme,
                        _token: csrf
                    },
                    success: function(html) {
                        $("#display").html(html).show();
                    },
                });
            });

        </script>
    @endforeach
