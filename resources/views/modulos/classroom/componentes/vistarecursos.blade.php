@foreach (json_decode($actividad->activity_data, true) as $data)
    @switch($actividad->type)
        @case('material')
        <a href="{{url('/elearning/c/'.$hash.'/trabajodeclase/v/'.$actividad->id)}}">
            <div class="card-header">
                {{ $data['titulo']}}
            </div>
        </a>
        @break
        @case('')
        @break
        @default

    @endswitch
@endforeach
