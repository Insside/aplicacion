<?php
$ROOT = (!isset($ROOT)) ? "../../../" : $ROOT;
require_once($ROOT . "modulos/aplicacion/librerias/Configuracion.cnf.php");
Sesion::init();
$fechas=new Fechas();
$usuario=Sesion::usuario();
require_once("modulo.inc.php");
require_once("permisos.inc.php");
?>