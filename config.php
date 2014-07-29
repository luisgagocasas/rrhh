<?php
class LagcConfig {
    //Datos del Sitio
    var $lagcmail = 'luisgago@maestro21.com';
    var $lagcurl = 'http://localhost:8080/rrhh/';

    //Mysql
    var $lagclocal = 'localhost';
    var $lagcbd = 'rrhh';
    var $lagcuser = 'luisgago';
    var $lagcpass = '';

    //Sitio
    var $lagccompopri = '2';

    //Plantillas
    var $lagctemplsite = 'default';
}
$config = new LagcConfig();
$con = mysql_connect($config->lagclocal,$config->lagcuser,$config->lagcpass);
mysql_select_db($config->lagcbd,$con) or die("<center>No hay conexion.</center>");
mysql_set_charset('utf8');
$respconfig = mysql_query("select * from configuracion"); $bdconfig = mysql_fetch_array($respconfig);
?>