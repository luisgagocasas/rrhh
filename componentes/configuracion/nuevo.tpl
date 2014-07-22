<form method="post" action="" class="frm_validate">
    <h2>Nuevo Permiso</h2>
<br/>
    <div class="form_control">
        <label for="txtName">Nombre</label>
        <input type="text" name="nombres" id="txtName" required placeholder="Ingrese el nombre">
    </div>
    <div class="form_control">
        <label for="txtdeparta">Niveles</label>
        <select name="niveles" size="5" id="txtdeparta" style="height: inherit;">
            <option value="1">Nivel 1</option>
            <option value="2">Nivel 2</option>
            <option value="3">Nivel 3</option>
            <option value="4">Nivel 4</option>
        </select>
    </div>
    <div class="form_control">
        <button type="submit" id="sbmSend" title="Enviar" class="btn">Guardar</button>
    </div>
</form>