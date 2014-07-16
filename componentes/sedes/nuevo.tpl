<form method="post" action="" enctype="multipart/form-data" class="frm_validate">
    <h2>Nueva sede</h2>
<br/>
    <div class="form_control">
        <label for="txtName">Nombre</label>
        <input type="text" name="nombres" id="txtName" required placeholder="Ingrese el nombre">
    </div>
    <div class="form_control">
        <label for="txtLastName">N° Contrato</label>
        <input type="text" name="contrato" id="txtLastName" required placeholder="Ingrese N° contrato">
    </div>
    <div class="form_control">
        <label for="txtEmail">Codigo</label>
        <input type="text" name="codigo" id="txtEmail" required placeholder="Ingrese el codigo">
    </div>
    <div class="form_control">
        <label class="ioption ck">
        <input name="estado" type="checkbox" value="1" checked="checked">Activar
        </label>
    </div>
    <div class="form_control">
        <button type="submit" id="sbmSend" title="Enviar" class="btn">Guardar</button>
    </div>
</form>