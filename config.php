<?php
class LagcConfig {
    //Datos del Sitio
    var $lagcnombre = 'RRHH';
    var $lagcmail = 'luisgago@maestro21.com';
    var $lagcurl = 'http://localhost:8080/rrhh/';

    //Mysql
    var $lagclocal = 'localhost';
    var $lagcbd = 'rrhh';
    var $lagcuser = 'luisgago';
    var $lagcpass = '';

    //Sitio
    var $lagckeywords = '';
    var $lagcdescription = '';
    var $lagcactivmensaje = 'En un momento estaremos activando la pagina web Vuelva en unos momentos.';
    var $lagccompopri = '2';

    //Plantillas
    var $lagctemplsite = 'default';
}
$config = new LagcConfig();
$con = mysql_connect($config->lagclocal,$config->lagcuser,$config->lagcpass);
mysql_select_db($config->lagcbd,$con) or die("<center>No hay conexion.</center>");
mysql_set_charset('utf8');
?>