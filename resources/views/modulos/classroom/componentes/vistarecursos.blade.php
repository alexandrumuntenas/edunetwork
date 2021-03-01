@foreach (json_decode($actividad->activity_data, true) as $data)
    @switch($actividad->type)
        @case('material')
        <div class="card collapsed-card">
            <div class="card-header">
                {{ $data['titulo']}}
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                {!! $data['contenido'] !!}
            </div>
        </div>
        @break
        @case('')

        @break
        @default

    @endswitch
@endforeach
