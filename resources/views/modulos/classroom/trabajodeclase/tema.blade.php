<div class="modal fade" id="creartema" tabindex="-1" aria-labelledby="creartema" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <form class="modal-content" action="{{ url('/elearning/c/' . $hash . '/trabajodeclase/c/tema') }}"
            method="POST">
            <div class="modal-header">
                <h5 class="modal-title" id="creartema">Añadir tema</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @csrf
                <input type="text" name="tema" id="tema" class="form-control" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Añadir</button>
            </div>
        </form>
    </div>
</div>
