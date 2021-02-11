<div class="row">
    <div class="col">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Tu Horario</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                The body of the card
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Últimas notificaciones</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @if ($notificaciones != null)
                <table class="table table-bordered">
                    <tbody>
                    @foreach ($notificaciones as $item)
                        @foreach (json_decode($item['json_data'], true) as $dato)
                            <tr>
                                <th style="font-weight: normal !important">{{ $dato['titulo'] }}, <em>publicado el {{ substr($item['created_at'], 0,10) }}</th>
                                <th style="font-weight: normal !important"><a href="{{url('notificaciones/v/'.$item['id'].'')}}"> Ver más</a></th>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
                @else
                <p>No hay notificaciones disponibles para mostrar...</p>
                @endif
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
