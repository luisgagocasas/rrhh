<form method="post" action="" class="frm_validate">
    <h2>Editando: <?=$cont['sede_nombre']; ?></h2>
<br/>
    <div class="form_control">
        <label for="txtName">Nombre</label>
        <input type="text" name="nombres" id="txtName" required placeholder="Ingrese el nombre" value="<?=$cont['sede_nombre']; ?>">
    </div>
    <div class="form_control">
        <label for="txtLastName">N° Contrato</label>
        <input type="text" name="contrato" id="txtLastName" required placeholder="Ingrese N° contrato" value="<?=$cont['sede_ncontrato']; ?>">
    </div>
    <div class="form_control">
        <label for="txtEmail">Codigo</label>
        <input type="text" name="codigo" id="txtEmail" required placeholder="Ingrese el codigo" value="<?=$cont['sede_codigo']; ?>">
    </div>
    <div class="form_control">
        <label class="ioption ck">
        <input name="estado" type="checkbox" value="1"<?=Sedes::check($cont['sede_estado'], "1"); ?>>Activar
        </label>
    </div>
    <div class="form_control">
        <button type="submit" id="sbmSend" title="Enviar" class="btn">Guardar</button>
    </div>
</form>