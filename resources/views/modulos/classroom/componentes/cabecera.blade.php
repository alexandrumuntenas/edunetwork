    @foreach (json_decode($classroom['classroom_config']) as $i)
        <div class="col-12" id="class_header">
            <div class="card">
                <div id="card_header_theme" class="card-body {{ $i->aspecto }}">
                    @if (Auth::user()->id === $classroom['classroom_teacher'])
                        <div class="dropleft float-right">
                            <a type="button" id="configmenu" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fas fa-cog"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="configmenu">
                                <a class="dropdown-item" data-toggle="modal" data-target="#configtheme">Cambiar tema</a>
                                <a class="dropdown-item" data-toggle="modal" data-target="#configcodigo">Ver código</a>
                                <a class="dropdown-item" data-toggle="modal"
                                    data-target="#configmodal">Configuración</a>
                            </div>
                        </div>
                    @endif
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
        @if (Auth::user()->id === $classroom['classroom_teacher'])
            <div class="modal fade" id="configmodal" tabindex="-1" aria-labelledby="configmodal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                    <form class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="configmodal">Configuración</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="classconfig">
                                <h4>Detalles de la clase</h4>
                                <div class="form-group">
                                    <label for="asignatura">Asignatura</label>
                                    <input id="asignatura" name="asignatura" class="form-control form-control-sm"
                                        type="text" maxlength="255" value="{{ $i->asignatura }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="clase">Clase</label>
                                    <input id="clase" name="clase" class="form-control form-control-sm" type="text"
                                        maxlength="255" value="{{ $i->clase }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="seccion">Sección</label>
                                    <input id="seccion" name="seccion" class="form-control form-control-sm" type="text"
                                        maxlength="255" value="{{ $i->seccion }}" />
                                </div>
                                <div class="form-group">
                                    <label for="aula">Aula</label>
                                    <input id="aula" name="aula" class="form-control form-control-sm" type="text"
                                        maxlength="255" value="{{ $i->aula }}" />
                                </div>
                            </div>
                            <div class="generalconfig">
                                <h4>General</h4>
                                <h5>Códigos de invitación</h5>
                                <div class="form-group">
                                    <label for="invitation_settings">Gestionar códigos de invitación</label>
                                    <select class="form-control" name="codigosinvitacion" id="codigosinvitacion">
                                        @if ($i->cdginvitacion == 'activado')
                                            <option value="activado" selected>Activado</option>
                                            <option value="desactivado">Desactivado</option>
                                        @else
                                            <option value="activado">Activado</option>
                                            <option value="desactivado" selected>Desactivado</option>
                                        @endif
                                    </select>
                                    <p><small>Los ajustes se aplican a los enlaces de invitación y códigos de
                                            clase</small></p>
                                </div>
                                @if ($i->cdginvitacion == 'activado')
                                    <div id="invitation_settings_div">
                                        <div class="form-group">
                                            <label for="codigoclase">Código de la clase</label>
                                            <input class="form-control" id="codigoclase" type="text"
                                                value="{{ $classroom['access_code'] }}" readonly />
                                            <p><small></small></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="enlaceclase">Enlace de invitación</label>
                                            <input class="form-control" id="enlaceclase" type="text"
                                                value="{{ url('/elearning/j/' . $classroom['access_code']) }}"
                                                readonly />
                                            <p><small></small></p>
                                        </div>
                                    </div>
                                @endif
                                <h5>Tablón</h5>
                                <div class="form-group">
                                    <label for="tablon_settings">Publicaciones</label>
                                    <select class="form-control" name="tablon_settings" id="tablon_settings">
                                        <option value="activado">Los alumnos pueden publicar en el tablón</option>
                                        <option value="desactivado">Los alumnos no pueden publicar en el tablón</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tablon_settings">Comentarios</label>
                                    <select class="form-control" name="tablon_settings" id="tablon_settings">
                                        <option value="activado">Permitir</option>
                                        <option value="desactivado">Prohibir</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tablon_settings">Elementos eliminados</label>
                                    <select class="form-control" name="tablon_settings" id="tablon_settings">
                                        <option value="directo">Eliminar directamente</option>
                                        <option value="espera">Eliminar tras 30 días</option>
                                    </select>
                                    <p><small>Solo los profesores pueden ver los elementos eliminados.</small></p>
                                </div>
                            </div>
                            <div class="classthemeconfig">
                                <h4>Aspecto</h4>
                                <div class="form-group">
                                    <label for="color_scheme">Aspecto de la clase</label>
                                    <select class="form-control" name="color_scheme" id="color_scheme">
                                        <option selected disabled>El tema actual es: {{ $i->aspecto }}</option>
                                        <option value="blue">Azul (blue)</option>
                                        <option value="orange">Naranja (orange)</option>
                                        <option value="indigo">Indigo (indigo)</option>
                                        <option value="purple">Morado (purple)</option>
                                        <option value="cyan">Cian (cyan)</option>
                                    </select>
                                    <p><small>Al cambiar el color, se actualizará automáticamente en el servidor</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <p><small>¡Recuerda guardar los cambios!</small></p>
                            <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
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
                            aspecto: theme,
                            _token: csrf
                        },
                        success: function() {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'info',
                                title: 'Se han guardado los ajustes'
                            })
                        },
                    });
                });
                $('#codigosinvitacion').change(function() {
                    var csrf = "{{ csrf_token() }}";
                    var codigosinvitacion = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: "{{ url('/elearning/c/' . $hash . '/config/u') }}",
                        data: {
                            codigosinvitacion: codigosinvitacion,
                            _token: csrf
                        },
                        success: function() {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'info',
                                title: 'Se han guardado los ajustes'
                            })
                        },
                    });
                });
                $('#codigosinvitacion').change(function() {
                    if ($(this).val() == 'desactivado') {
                        $(this).next('div#invitation_settings_div').remove();
                    } else {
                        $(this).next('div#invitation_settings_div').remove();
                        $(this).after(
                            '<div id="invitation_settings_div"> <div class="form-group"> <label for="codigoclase">Código de la clase</label> <input class="form-control" id="codigoclase" type="text" value="{{ $classroom['access_code'] }}" readonly /> <p><small></small></p> </div> <div class="form-group"> <label for="enlaceclase">Enlace de invitación</label> <input class="form-control" id="enlaceclase" type="text" value="{{ url('/elearning/j/' . $classroom['access_code']) }}" readonly /> <p><small></small></p> </div> </div>'
                        );
                    }
                });

            </script>
        @endif
    @endforeach
