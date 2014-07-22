<form method="post" action="" class="frm_validate">
    <h2>Editando: <?=$cont['nombre']; ?></h2>
<br/>
    <div class="form_control">
        <label for="txtName">Nombre</label>
        <input type="text" name="nombres" id="txtName" required placeholder="Ingrese el nombre" value="<?=$cont['nombre']; ?>">
    </div>
    <div class="form_control">
        <label for="txtdeparta">Sedes</label>
        <select name="niveles" size="5" id="txtdeparta" style="height: inherit;">
            <option value="1"<?=lagc::select($cont['nivel'], "1"); ?>>Administrador</option>
            <option value="2"<?=lagc::select($cont['nivel'], "2"); ?>>Supervisor</option>
            <option value="3"<?=lagc::select($cont['nivel'], "3"); ?>>Asistencia</option>
            <option value="4"<?=lagc::select($cont['nivel'], "4"); ?>>Trabajador</option>
        </select>
    </div>
    <div class="form_control">
        <button type="submit" id="sbmSend" title="Enviar" class="btn">Guardar</button>
    </div>
</form>