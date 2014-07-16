<form method="post" action="" enctype="multipart/form-data" class="frm_validate">
    <h2>Nuevo Perfil</h2>
<br/>
    <div class="form_control">
        <label for="txtName">Nombre</label>
        <input type="text" name="nombres" id="txtName" required placeholder="Ingrese el nombre">
    </div>
    <div class="form_control">
        <label for="txtdeparta1">Clinica</label>
        <select name="clinicas" id="txtdeparta1">
            <?php
            $respclinica = mysql_query("select * from com_examen_clinica");
            while($clinica = mysql_fetch_array($respclinica)) {
                echo "<option value=\"".$clinica['id_clinica']."\">".$clinica['nombre']."</option>\n";
            }
            ?>
        </select>
    </div>
    <div class="form_control">
        <label for="txtdeparta">Sedes</label>
        <select name="sedes" id="txtdeparta">
            <?php
            $resppc = mysql_query("select * from com_sedes where sede_estado='1'");
            while($datapc = mysql_fetch_array($resppc)) {
                echo "<option value=\"".$datapc['sede_id']."\">".$datapc['sede_nombre']."</option>\n";
            }
            ?>
        </select>
    </div>
    <div class="form_control">
        <button type="submit" id="sbmSend" title="Enviar" class="btn">Guardar</button>
    </div>
</form>