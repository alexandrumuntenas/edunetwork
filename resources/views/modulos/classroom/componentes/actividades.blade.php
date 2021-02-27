<div class="col">
    <a class="card" href="{{url('/elearning/c/'.$hash.'/trabajodeclase/c/material')}}">
        <div class="card-body">
            <h2><i class="fas fa-file-alt"></i></h2>
        </div>
        <div class="card-footer">
            Material
        </div>
    </a>
</div>
<div class="col">
    <a class="card" href="{{url('/elearning/c/'.$hash.'/trabajodeclase/c/tarea')}}">
        <div class="card-body">
            <h2><i class="fas fa-tasks"></i></h2>
        </div>
        <div class="card-footer">
            Tarea
        </div>
    </a>
</div>
<div class="col">
    <a class="card" href="{{url('/elearning/c/'.$hash.'/trabajodeclase/c/pregunta')}}">
        <div class="card-body">
            <h2><i class="fas fa-question"></i>
        </div>
        <div class="card-footer">
            Pregunta
        </div>
    </a>
</div>
<div class="col">
    <a class="card" href="{{url('/elearning/c/'.$hash.'/trabajodeclase/c/h5p')}}">
        <div class="card-body">
            <h2><i class="fab fa-html5"></i></h2>
        </div>
        <div class="card-footer">
            H5P
        </div>
    </a>
</div>
<div class="col">
    <a class="card" href="{{url('/elearning/c/'.$hash.'/trabajodeclase/c/examen')}}">
        <div class="card-body">
            <h2><i class="fas fa-clipboard-check"></i></h2>
        </div>
        <div class="card-footer">
            Examen
        </div>
    </a>
</div>
<div class="col">
    <a class="card" data-toggle="modal" data-target="#creartema">
        <div class="card-body">
            <h2><i class="fas fa-shapes"></i></h2>
        </div>
        <div class="card-footer">
            Tema
        </div>
    </a>
    @include('modulos.classroom.trabajodeclase.tema')
</div>
