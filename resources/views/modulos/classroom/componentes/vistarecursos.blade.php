@foreach (json_decode($actividad->activity_data, true) as $data)
    @switch($actividad->type)
        @case('material')
        <div class="card-header">
            <a href="{{ url('/elearning/c/' . $hash . '/trabajodeclase/v/' . $actividad->id) }}">
                {{ $data['titulo'] }}
            </a>

            <div class="card-tools dropwdown">
                <button type="button" class="btn btn-tool" id="dropdownMenuButton" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ url('/elearning/c/' . $hash . '/trabajodeclase/e/' . $actividad->id) }}">Editar</a>
                    <a class="dropdown-item" href="{{ url('/elearning/c/' . $hash . '/trabajodeclase/d/' . $actividad->id) }}">Eliminar</a>
                    <button class="dropdown-item" disabled>Copiar enlace</a>
                </div>
            </div>
        </div>
        @break
        @case('')
        @break
        @default

    @endswitch
@endforeach
