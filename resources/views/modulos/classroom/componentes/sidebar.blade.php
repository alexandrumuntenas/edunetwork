    @if (Auth::user()->hasRole('profesor'))
        <div class="card collapsed-card" id="class_code">
            <div class="card-header">
                <h3 class="card-title">Código de acceso</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body" style="display: none">
                <p>{{ $classroom['access_code'] }}</p>
            </div>
            <div class="card-footer" style="display: none">
                Invitar
            </div>
        </div>
    @endif
    <div class="card" id="class_menu">
        <div class="card-header">
            <h3 class="card-title">Menú</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <ul>
                <li><a href="{{ url('/elearning/c/' . $hash . '/') }}">Tablón de clase</a></li>
                <li><a href="{{ url('/elearning/c/' . $hash . '/trabajodeclase') }}">Trabajo de clase</a></li>
                @if (Auth::user()->hasRole('alumno'))
                    <li><a href="{{ url('/elearning/c/' . $hash . '/companerosdeclase') }}">Compañeros de clase</a>
                    </li>
                    <li><a href="{{ url('/elearning/c/' . $hash . '/miscalificaciones') }}">Mis calificaciones</a>
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
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tareas pendientes</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body" style="display: block;">
            ¡Yuju! No tienes nada pendiente por hacer...
        </div>
        <!-- /.card-body -->
    </div>
