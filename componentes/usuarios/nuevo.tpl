<form method="post" action="" enctype="multipart/form-data" class="frm_validate">
    <h2>Nuevo Usuario</h2>
<br/>
<div class="grid grid-pad">
    <div class="col-1-3">
        <div class="form_control">
            <label for="txtName">Nombres</label>
            <input type="text" name="nombres" id="txtName" required placeholder="Ingrese su Nombre">
        </div>
        <div class="form_control">
            <label for="txtLastName">Apellido P.</label>
            <input type="text" name="apellidop" id="txtLastName" required placeholder="Ingrese su apellido paterno">
        </div>
        <div class="form_control">
            <label for="txtLastName">Apellido M.</label>
            <input type="text" name="apellidom" id="txtLastName" required placeholder="Ingrese su apellido materno">
        </div>
        <div class="form_control">
            <label for="txtEmail">Email</label>
            <input type="email" name="email" id="txtEmail" placeholder="Ingrese su Correo Electrónico">
        </div>
        <div class="form_control">
            <label for="txtcodigo">Código</label>
            <input type="text" name="codigo" id="txtcodigo" placeholder="Ingrese su codigo">
        </div>
        <div class="form_control">
            <label>Género</label>
            <div class="iopinline">
                <label for="radGener1" class="ioption">
                    <input id="radGener1" name="radGener" checked value="1" type="radio">Masculino
                </label>
                <label for="radGener2" class="ioption">
                    <input id="radGener2" name="radGener" value="0" type="radio">Femenino
                </label>
            </div>
        </div>
        <div class="form_control">
            <label for="txtDni">DNI</label>
            <input type="text" name="dni" id="txtDni" required placeholder="Ingrese su número de DNI">
        </div>
        <div class="form_control">
            <label for="txtdeparta">Departamento</label>
            <select name="departamento" id="txtdeparta">
                <option value="1">Amazonas</option>
                <option value="2">Ancash</option>
                <option value="3">Apurimac</option>
                <option value="4" selected>Arequipa</option>
                <option value="5">Ayacucho</option>
                <option value="6">Cajamarca</option>
                <option value="7">Callao</option>
                <option value="8">Cusco</option>
                <option value="9">Huancavelica</option>
                <option value="10">Huanuco</option>
                <option value="11">Ica</option>
                <option value="12">Junin</option>
                <option value="13">La Libertad</option>
                <option value="14">Lambayeque</option>
                <option value="15">Lima</option>
                <option value="16">Loreto</option>
                <option value="17">Madre De Dios</option>
                <option value="18">Moquegua</option>
                <option value="19">Pasco</option>
                <option value="20">Piura</option>
                <option value="21">Puno</option>
                <option value="22">San Martin</option>
                <option value="23">Tacna</option>
                <option value="24">Tumbes</option>
                <option value="25">Ucayali</option>
            </select>
        </div>
        <div class="form_control">
            <label for="txtgsanguineo">G. Sanguíneo</label>
            <input type="text" name="gsanguineo" id="txtgsanguineo" placeholder="Ingrese su grupo Sanguineo">
        </div>
        <div class="form_control">
            <label for="txtcargo">Cargo</label>
            <input type="text" name="cargo" id="txtcargo" placeholder="Ingrese el cargo">
        </div>
        <div class="form_control">
            <label for="txtcel">Celular</label>
            <input type="tel" name="cel" id="txtcel" placeholder="Ingrese su celular">
        </div>
        <div class="form_control">
            <label for="txtfcumple">Cumpleaños</label>
            <input type="date" name="cumpleanios" id="txtfcumple">
        </div>
        <div class="form_control">
            <label for="txtffempresa">F. Empresa</label>
            <input type="date" name="fempresa" id="txtffempresa">
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
                        echo "<option value=\"".$datapc['sede_id']."\">".$datapc['sede_nombre']."</option>\n";
                    }
                    ?>
            </select>
        </center>
        </div>
    </div>
    <div class="col-1-3">
        <div class="form_control">
            <label for="txtfoto">Foto</label>
            <input type="file" name="archivo" id="txtfoto">
        </div>
        <div class="form_control">
            <label for="txtpermisos"><u>Permisos</u></label>
            <select name="permisos" id="txtpermisos">
                <option value="1">Administrador</option>
                <option value="2">Supervisor</option>
                <option value="3">Asistencia</option>
                <option value="4" selected>Trabajador</option>
            </select>
        </div>
        <blockquote>
            <div class="form_control" id="m1">
                <label for="txtuser">Usuario</label>
                <input type="text" name="usuario" id="txtuser" placeholder="Usuario">
            </div>
            <div class="form_control" id="m2">
                <label for="txtpass">Contraseña</label>
                <input type="password" name="password" id="txtpass" placeholder="Contraseña">
            </div>
        </blockquote>
        <div class="form_control">
            <label for="txtMessage">Comentario</label>
            <textarea id="txtMessage" name="comentario" type="textarea" placeholder="Escríbenos sus comentarios..."></textarea>
        </div>
        <div class="form_control">
            <label class="ioption ck">
            <input name="estado" type="checkbox" value="1" checked="checked">Activar
            </label>
        </div>
        <div class="form_control">
            <center>
                <button type="submit" id="sbmSend" title="Enviar" class="btn">Guardar</button>
            </center>
        </div>
    </div>
</form>