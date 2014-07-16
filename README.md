# Configuración #

Sistema de RRHH

### config.php ###

* var $lagcnombre = 'RRHH'; //Nombre de la aplición
* var $lagcmail = 'luisgago@maestro21.com'; //correo de soporte
* var $lagcurl = 'http://localhost:8080/rrhh/'; //URL de la aplición

## Base de datos ##
* var $lagclocal = 'localhost'; //servidor
* var $lagcbd = 'rrhh'; //Nombre de la Base de Datos
* var $lagcuser = 'luisgago'; //Usuario mysql
* var $lagcpass = ''; //Contraseña mysql

## Otros ##
* var $lagctemplsite = 'default'; //Plantilla

### /Componentes/ ###
Todos las aplicaciones del sistema como:
* Personal
* Sedes
* Examenes Medicos
* Seguro de Riesgo

### /archivos_* ###
Donde se guardan los archivos que se adjunta de el personal

### /funciones/ ###
Aqui se encuentran las funciones nativas del sistema

### /imagenes/ ###
Foto de perfil del personal

### /plantillas/ ###
Donde se debe guardar las plantillas desarrolladas por el front-end

### index.php y /funciones/componentes.php ###
Se encargan de generar el entorno de la aplición