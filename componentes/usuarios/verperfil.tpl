<div class="tlcabecera">
    <a href="?lagc=usuarios" title="Lista de Usuarios" class="menucompo">
        <img src="plantillas/default/img/lista.png">Todos</a>
    <a href="?lagc=usuarios&id=1&ver=true" title="Lista de entradas" class="menucompo">
        <img src="plantillas/default/img/lista.png">Administradores</a>
    <a href="?lagc=usuarios&id=2&ver=true" title="Lista de entradas" class="menucompo">
        <img src="plantillas/default/img/lista.png">Trabajadores</a>
</div>
<br/>
<h3>Perfil de <?=$cont['nombres']." ".$cont['apellidop']." ".$cont['apellidom']; ?> <span style="margin: 0px;display: inline-block;"><?=Usuarios::estado($cont['estado']); ?></span></h3>
<div class="grid grid-pad">
    <div class="col-1-3">
        <ul>
            <li class="listap"><span>Nombre:</span> <?=$cont['nombres']; ?></li>
            <li class="listap"><span>Apellidos:</span> <?=$cont['apellidop']." ".$cont['apellidom']; ?></li>
            <li class="listap"><span>Email:</span> <?=$cont['email']; ?></li>
            <li class="listap"><span>Código:</span> <?=$cont['codigo']; ?></li>
            <li class="listap"><span>Género:</span> <?php if($cont['genero']==1){ echo "Masculino"; } else { echo "Femenino";} ?></li>
            <li class="listap"><span>DNI:</span> <?=$cont['dni']; ?></li>
            <li class="listap"><span>Departamento:</span>
            <?php
            if($cont['departamento']==1){ echo "Amazonas"; }
            else if($cont['departamento']==2){ echo "Ancash"; }
            else if($cont['departamento']==3){ echo "Apurimac"; }
            else if($cont['departamento']==4){ echo "Arequipa"; }
            else if($cont['departamento']==5){ echo "Ayacucho"; }
            else if($cont['departamento']==6){ echo "Cajamarca"; }
            else if($cont['departamento']==7){ echo "Callao"; }
            else if($cont['departamento']==8){ echo "Cusco"; }
            else if($cont['departamento']==9){ echo "Huancavelica"; }
            else if($cont['departamento']==10){ echo "Huanuco"; }
            else if($cont['departamento']==11){ echo "Ica"; }
            else if($cont['departamento']==12){ echo "Junin"; }
            else if($cont['departamento']==13){ echo "La Libertad"; }
            else if($cont['departamento']==14){ echo "Lambayeque"; }
            else if($cont['departamento']==15){ echo "Lima"; }
            else if($cont['departamento']==16){ echo "Loreto"; }
            else if($cont['departamento']==17){ echo "Madre De Dios"; }
            else if($cont['departamento']==18){ echo "Moquegua"; }
            else if($cont['departamento']==19){ echo "Pasco"; }
            else if($cont['departamento']==20){ echo "Piura"; }
            else if($cont['departamento']==21){ echo "Puno"; }
            else if($cont['departamento']==22){ echo "San Martin"; }
            else if($cont['departamento']==23){ echo "Tacna"; }
            else if($cont['departamento']==24){ echo "Tumbes"; }
            else if($cont['departamento']==25){ echo "Ucayali"; }
            ?>
            </li>
            <li class="listap"><span>G. Sanguíneo:</span> <?=$cont['gsanguineo']; ?></li>
            <li class="listap"><span>Cargo:</span> <?=$cont['cargo']; ?></li>
            <li class="listap"><span>Celular:</span> <?=$cont['celular']; ?></li>
            <li class="listap"><span>Cumpleaños:</span> <?=$cont['fechanacimiento']; ?></li>
            <li class="listap"><span>F. Empresa:</span> <?=$cont['fechaingresoempresa']; ?></li>
        </ul>
    </div>
    <div class="col-1-3">
        <?=LGlobal::foto_perfil($cont['id'], "fotop"); ?>
    </div>
    <div class="col-1-3">
        <ul>
            <li class="listap"><span>Se creo el:</span> <?=LGlobal::tiempohace($cont['creadoel']); ?></li>
            <li class="listap"><span>Como se creo:</span> <?=Usuarios::nombre_creadoen($cont['ascreated']); ?></li>
            <li class="listap"><span>Ultima modificación:</span> <?=LGlobal::tiempohace($cont['modificadoel']); ?></li>
            <li class="listap"><span>Comentario:</span> <?=$cont['comentario']; ?></li>
        </ul>
    </div>
</div>