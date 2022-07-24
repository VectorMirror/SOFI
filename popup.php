
<!--Codigo ventana destinatario-->
<div class="modal fade" id="dest">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Mensaje de Alerta</h4>
      </div>
      <div class="modal-body">
        <form role="form" id="form-destinatario" name="dest-interno">
          <p>Nombre del nuevo destinatario: <input type="text" class="form-control" placeholder="Nombre Destinatario" name="destinatario" id="t-dest"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button class="btn btn-primary" id="btn-addDest">Agregar</button>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--Codigo ventana remitente-->
<div class="modal fade" id="remitente">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Mensaje de Alerta</h4>
      </div>
      <div class="modal-body">
        <form role="form" id="form-remitente" name="rem-interno" autocomplete="off">
          <p>Nombre del nuevo remitente: <input type="text" class="form-control" palceholder="Nombre Remitente" name="remitente" id="t-rem"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button class="btn btn-primary" id="btn-addRem">Agregar</button>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--Codigo ventana empresa-->
<div class="modal fade" id="emp">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Mensaje de Alerta</h4>
      </div>
      <div class="modal-body">
        <form role="form" id="form-empresa" name="form-empresa">
          <p>Nombre de la nueva empresa: <input type="text" class="form-control" placeholder="Nombre Empresa" name="empresa" id="t-emp"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button class="btn btn-primary" id="btn-addEmp">Agregar</button>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
