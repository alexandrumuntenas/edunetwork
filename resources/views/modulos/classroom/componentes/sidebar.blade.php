<div class="card" id="class_menu">
    <div class="card-header">
        Menú
    </div>
    <div class="card-body">
        <ul>
            <li><a href="{{ url('/elearning/c/' . $hash . '/') }}">Tablón de clase</a></li>
            <li><a href="{{ url('/elearning/c/' . $hash . '/trabajodeclase') }}">Trabajo de clase</a></li>
            @if (Auth::user()->hasRole('alumno'))
                <li><a href="{{ url('/elearning/c/' . $hash . '/companerosdeclase') }}">Compañeros de clase</a></li>
                <li><a href="{{ url('/elearning/c/' . $hash . '/miscalificaciones') }}">Mis calificaciones</a></li>
            @elseif(Auth::user()->hasRole('profesor'))
                <li><a href="{{ url('/elearning/c/' . $hash . '/alumnos') }}">Alumnos</a></li>
                <li><a href="{{ url('/elearning/c/' . $hash . '/cuadernodelprofesor') }}">Cuaderno del profesor</a></li>
            @endif
        </ul>
    </div>
</div>
<div class="card">
    <div class="card-header">
        Tareas pendientes
    </div>
    <div class="card-body">
        ¡Yuju! No tienes nada pendiente por hacer...
    </div>
</div>
