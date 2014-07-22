<form method="post" action="" class="frm_validate">
    <h2>Nuevo Permiso</h2>
<br/>
    <div class="form_control">
        <label for="txtName">Nombre</label>
        <input type="text" name="nombres" id="txtName" required placeholder="Ingrese el nombre">
    </div>
    <div class="form_control">
        <label for="txtdeparta">Niveles</label>
        <select name="niveles" id="txtdeparta">
            <option value="1">Administrador</option>
            <option value="2">Supervisor</option>
            <option value="3">Asistencia</option>
            <option value="4">Trabajador</option>
        </select>
    </div>
    <div class="form_control">
        <button type="submit" id="sbmSend" title="Enviar" class="btn">Guardar</button>
    </div>
</form>