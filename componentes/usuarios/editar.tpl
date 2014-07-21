<div class="tlcabecera">
    <a href="?lagc=usuarios" title="Lista de Usuarios" class="menucompo">
        <img src="plantillas/default/img/lista.png">Todos</a>
    <a href="?lagc=usuarios&id=1&ver=true" title="Lista de entradas" class="menucompo">
        <img src="plantillas/default/img/lista.png">Administradores</a>
    <a href="?lagc=usuarios&id=2&ver=true" title="Lista de entradas" class="menucompo">
        <img src="plantillas/default/img/lista.png">Trabajadores</a>
</div>
<form method="post" action="" enctype="multipart/form-data" class="frm_validate">
    <input type="hidden" name="id" value="<?=$cont['id']; ?>" />
    <input type="hidden" name="fotohid" value="<?=$cont['imagen']; ?>" />
    <h2>Editando: <?=$cont['nombres']." ".$_POST['apellidop']." ".$_POST['apellidom']; ?></h2>
<br/>
<div class="grid grid-pad">
    <div class="col-1-3">
        <div class="form_control">
            <label for="txtName">Nombres</label>
            <input type="text" name="nombres" id="txtName" required placeholder="Ingrese su Nombre" value="<?=$cont['nombres']; ?>">
        </div>
        <div class="form_control">
            <label for="txtLastName">Apellido P.</label>
            <input type="text" name="apellidop" id="txtLastName" required placeholder="Ingrese su apellido paterno" value="<?=$cont['apellidop']; ?>">
        </div>
        <div class="form_control">
            <label for="txtLastName">Apellido M.</label>
            <input type="text" name="apellidom" id="txtLastName" required placeholder="Ingrese su apellido materno" value="<?=$cont['apellidom']; ?>">
        </div>
        <div class="form_control">
            <label for="txtEmail">Email</label>
            <input type="email" name="email" id="txtEmail" placeholder="Ingrese su Correo Electrónico" value="<?=$cont['email']; ?>">
        </div>
        <div class="form_control">
            <label for="txtcodigo">Código</label>
            <input type="text" name="codigo" id="txtcodigo" placeholder="Ingrese el código" value="<?=$cont['codigo']; ?>">
        </div>
        <div class="form_control">
            <label>Género</label>
            <div class="iopinline">
                <label for="radGener1" class="ioption">
                    <input id="radGener1" name="radGener"<?=Usuarios::check($cont['genero'], "1"); ?> value="1" type="radio">Masculino
                </label>
                <label for="radGener2" class="ioption">
                    <input id="radGener2" name="radGener"<?=Usuarios::check($cont['genero'], "0"); ?> value="0" type="radio">Femenino
                </label>
            </div>
        </div>
        <div class="form_control">
            <label for="txtDni">DNI</label>
            <input type="text" name="dni" id="txtDni" required placeholder="Ingrese su número de DNI" value="<?=$cont['dni']; ?>">
        </div>
        <div class="form_control">
            <label for="txtdeparta">Departamento</label>
            <select name="departamento" id="txtdeparta">
                <option value="1"<?=Usuarios::select($cont['departamento'], "1"); ?>>Amazonas</option>
                <option value="2"<?=Usuarios::select($cont['departamento'], "2"); ?>>Ancash</option>
                <option value="3"<?=Usuarios::select($cont['departamento'], "3"); ?>>Apurimac</option>
                <option value="4"<?=Usuarios::select($cont['departamento'], "4"); ?>>Arequipa</option>
                <option value="5"<?=Usuarios::select($cont['departamento'], "5"); ?>>Ayacucho</option>
                <option value="6"<?=Usuarios::select($cont['departamento'], "6"); ?>>Cajamarca</option>
                <option value="7"<?=Usuarios::select($cont['departamento'], "7"); ?>>Callao</option>
                <option value="8"<?=Usuarios::select($cont['departamento'], "8"); ?>>Cusco</option>
                <option value="9"<?=Usuarios::select($cont['departamento'], "9"); ?>>Huancavelica</option>
                <option value="10"<?=Usuarios::select($cont['departamento'], "10"); ?>>Huanuco</option>
                <option value="11"<?=Usuarios::select($cont['departamento'], "11"); ?>>Ica</option>
                <option value="12"<?=Usuarios::select($cont['departamento'], "12"); ?>>Junin</option>
                <option value="13"<?=Usuarios::select($cont['departamento'], "13"); ?>>La Libertad</option>
                <option value="14"<?=Usuarios::select($cont['departamento'], "14"); ?>>Lambayeque</option>
                <option value="15"<?=Usuarios::select($cont['departamento'], "15"); ?>>Lima</option>
                <option value="16"<?=Usuarios::select($cont['departamento'], "16"); ?>>Loreto</option>
                <option value="17"<?=Usuarios::select($cont['departamento'], "17"); ?>>Madre De Dios</option>
                <option value="18"<?=Usuarios::select($cont['departamento'], "18"); ?>>Moquegua</option>
                <option value="19"<?=Usuarios::select($cont['departamento'], "19"); ?>>Pasco</option>
                <option value="20"<?=Usuarios::select($cont['departamento'], "20"); ?>>Piura</option>
                <option value="21"<?=Usuarios::select($cont['departamento'], "21"); ?>>Puno</option>
                <option value="22"<?=Usuarios::select($cont['departamento'], "22"); ?>>San Martin</option>
                <option value="23"<?=Usuarios::select($cont['departamento'], "23"); ?>>Tacna</option>
                <option value="24"<?=Usuarios::select($cont['departamento'], "24"); ?>>Tumbes</option>
                <option value="25"<?=Usuarios::select($cont['departamento'], "25"); ?>>Ucayali</option>
            </select>
        </div>
        <div class="form_control">
            <label for="txtgsanguineo">G. Sanguíneo</label>
            <input type="text" name="gsanguineo" id="txtgsanguineo" placeholder="Ingrese su grupo Sanguineo" value="<?=$cont['gsanguineo']; ?>">
        </div>
        <div class="form_control">
            <label for="txtcargo">Cargo</label>
            <input type="text" name="cargo" id="txtcargo" placeholder="Ingrese el cargo" value="<?=$cont['cargo']; ?>">
        </div>
        <div class="form_control">
            <label for="txtcel">Celular</label>
            <input type="tel" name="cel" id="txtcel" placeholder="Ingrese su celular" value="<?=$cont['celular']; ?>">
        </div>
        <div class="form_control">
            <label for="txtfcumple">Cumpleaños</label>
            <input type="date" name="cumpleanios" id="txtfcumple" value="<?=$cont['fechanacimiento']; ?>">
        </div>
        <div class="form_control">
            <label for="txtffempresa">F. Empresa</label>
            <input type="date" name="fempresa" id="txtffempresa" value="<?=$cont['fechaingresoempresa']; ?>">
        </div>
    </div>
    <div class="col-1-3">
        <div class="form_control">
            <label for="txtMessage">Sedes</label>
            <center>
                <select name="sedes[]" size="10" style="min-width: 50%;height: 200px;" multiple="multiple">
                    <?php
                    $resppc = mysql_query("select * from com_sedes where sede_estado='1'");
                    while($datapc = mysql_fetch_array($resppc)) {
                        $aSubcads=split("[|.-]", $cont['sede_id']);//sacar las |
                        $var1 = 0;
                        for($k=0;$k<count($aSubcads);$k++)//separar una a una
                            if ($aSubcads[$k] == $datapc['sede_id']) {
                                $var1 = 1;
                                break;
                            }
                        if ($var1 == 1)
                            echo "<option value=\"".$datapc['sede_id']."\" selected=\"selected\">".$datapc['sede_nombre']."</option>\n";
                        else {
                            echo "<option value=\"".$datapc['sede_id']."\">".$datapc['sede_nombre']."</option>\n";
                        }
                    }
                    ?>
            </select>
        </center>
        </div>
    </div>
    <div class="col-1-3">
        <div class="form_control">
            <label for="txtfoto">Foto</label>
            <?=LGlobal::foto_perfil($cont['id'], "fotoperfil"); ?>
            <div style="display: inline;margin: 5px 0px 0px 0px;">
                <input type="file" name="archivo" id="txtfoto">
            </div>
        </div>
        <div class="form_control">
            <label for="txtpermisos"><u>Permisos</u></label>
            <select name="permisos" id="txtpermisos">
                <option value="1"<?=Usuarios::select($cont['permisos'], "1"); ?>>Administrador</option>
                <option value="2"<?=Usuarios::select($cont['permisos'], "2"); ?>>Supervisor</option>
                <option value="3"<?=Usuarios::select($cont['permisos'], "3"); ?>>Asistencia</option>
                <option value="4"<?=Usuarios::select($cont['permisos'], "4"); ?>>Trabajador</option>
            </select>
        </div>
        <blockquote>
            <div class="form_control" id="m1">
                <label for="txtuser">Usuario</label>
                <input type="text" name="usuario" id="txtuser" placeholder="Usuario"<?php if(!empty($cont['usuario'])){ echo " disabled readonly=\"readonly\""; } ?> value="<?=$cont['usuario']; ?>">
            </div>
            <div class="form_control" id="m2">
                <label for="txtpass">Contraseña</label>
                <input type="password" name="password" id="txtpass" placeholder="Contraseña">
            </div>
        </blockquote>
        <div class="form_control">
            <label for="txtMessage">Comentario</label>
            <textarea id="txtMessage" name="comentario" type="textarea" placeholder="Escríbenos sus comentarios..."><?=$cont['comentario']; ?></textarea>
        </div>
        <div class="form_control">
            <label class="ioption ck">
                <input name="estado" type="checkbox" value="1"<?=Usuarios::check($cont['estado'], "1"); ?>>Activar
            </label>
        </div>
        <center>
            <div class="form_control">
                <button type="submit" id="sbmSend" title="Enviar" class="btn">Guardar</button>
            </div>
        </center>
    </div>
</div>
</form>