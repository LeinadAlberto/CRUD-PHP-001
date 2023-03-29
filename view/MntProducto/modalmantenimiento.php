<div id="modalmantenimiento" class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" id="producto_form">
        <div class="modal-header">
          <h5 class="modal-title" id="mdltitulo"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <input type="hidden" id="prod_id" name="prod_id">

          <div class="form-group">
            <label class="form-label" for="prod_nom">Nombre</label>
            <input type="text" class="form-control" id="prod_nom" name="prod_nom" placeholder="Ingrese Nombre" required>
          </div>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" name="action" id="#" value="add"class="btn btn-rounded btn-info">Guardar</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->