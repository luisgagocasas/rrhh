<form method="post" action="" class="frm_validate">
    <h2>Editando: <?=$cont['examen_nombre']; ?></h2>
<br/>
    <div class="form_control">
        <label for="txtName">Nombre</label>
        <input type="text" name="nombre" id="txtName" required placeholder="Ingrese el nombre" value="<?=$cont['nombre']; ?>">
    </div>
    <div class="form_control">
        <label for="txtName1">Dirección</label>
        <input type="text" name="direccion" id="txtName1" required placeholder="Ingrese la Dirección" value="<?=$cont['direccion']; ?>">
    </div>
    <div class="form_control">
        <label for="txtName2">Telefono</label>
        <input type="text" name="telefono" id="txtName2" required placeholder="Ingrese el Telefono" value="<?=$cont['telefono']; ?>">
    </div>
    <div class="form_control">
        <button type="submit" id="sbmSend" title="Enviar" class="btn">Guardar</button>
    </div>
</form>