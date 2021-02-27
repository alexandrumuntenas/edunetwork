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
    <div class="card" id="class_act_pte">
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
