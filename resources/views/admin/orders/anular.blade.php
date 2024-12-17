<div class="modal fade" id="modalAnular" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form id="form_anular" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddBillTitle">Ingrese una nota para cancelar el pedido (Al presionar 'Aceptar' se anulará la orden)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-12 mb-3">
                        <label class="form-label" for="note">Nota de anulación</label>
                        <input required class="form-control" id="note" type="text" name="note" value="" />
                        <div class="invalid-feedback">El campo no debe estar vacío.</div>
                    </div>
                    <div class="col-12 text-end">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button class="btn btn-primary btn-confirm-note">
                            <span class="text-save">Aceptar</span>
                            <span class="spinner-border spinner-border-sm me-1 d-none text-saving" role="status"
                                aria-hidden="true"></span>
                            <span class="text-saving d-none">Procesando...</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
