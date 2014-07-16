<form method="post" action="" class="frm_validate">
    <h2>Editando: <?=$cont['examen_nombre']; ?></h2>
<br/>
    <div class="form_control">
        <label for="txtName">Nombre</label>
        <input type="text" name="nombres" id="txtName" required placeholder="Ingrese el nombre" value="<?=$cont['examen_nombre']; ?>">
    </div>
    <div class="form_control">
        <label for="txtdeparta1">Clinica</label>
        <select name="clinica" id="txtdeparta1">
            <?php
            $respclinica = mysql_query("select * from com_examen_clinica");
            while($clinica = mysql_fetch_array($respclinica)) {
                if($clinica['id_clinica']==$cont['id_clinica']){
                    echo "<option value=\"".$clinica['id_clinica']."\" selected>".$clinica['nombre']."</option>\n";
                }
                else {
                    echo "<option value=\"".$clinica['id_clinica']."\">".$clinica['nombre']."</option>\n";
                }
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
                if($datapc['sede_id']==$cont['sede_id']){
                    echo "<option value=\"".$datapc['sede_id']."\" selected>".$datapc['sede_nombre']."</option>\n";
                }
                else {
                    echo "<option value=\"".$datapc['sede_id']."\">".$datapc['sede_nombre']."</option>\n";
                }
            }
            ?>
        </select>
    </div>
    <div class="form_control">
        <button type="submit" id="sbmSend" title="Enviar" class="btn">Guardar</button>
    </div>
</form>