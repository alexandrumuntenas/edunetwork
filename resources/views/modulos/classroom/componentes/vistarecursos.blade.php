@foreach (json_decode($actividad->activity_data, true) as $data)
    <div class="card-header">
        @switch($actividad->type)
            @case('material')
            <i class="fas fa-file-alt"></i></h2>
            @break
            @case('pregunta')
            <i class="fas fa-question"></i>
            @break

            @default

        @endswitch
        <a href="{{ url('/elearning/c/' . $hash . '/trabajodeclase/v/' . $actividad->id) }}">
            {{ $data['titulo'] }}
        </a>
        @if (Auth::user()->id === $classroom['classroom_teacher'])
            <div class="card-tools dropwdown">
                <button type="button" class="btn btn-tool" id="dropdownMenuButton" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item"
                        href="{{ url('/elearning/c/' . $hash . '/trabajodeclase/e/' . $actividad->id) }}">Editar</a>
                    <a class="dropdown-item"
                        href="{{ url('/elearning/c/' . $hash . '/trabajodeclase/d/' . $actividad->id) }}">Eliminar</a>
                    <button class="dropdown-item" disabled>Copiar enlace</a>
                </div>
            </div>
        @endif
    </div>
@endforeach
