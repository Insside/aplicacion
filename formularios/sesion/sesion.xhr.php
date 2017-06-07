<?php

define("PATH", dirname(__FILE__));
define('ROOT', PATH . "/../../../../");
require_once(ROOT . "modulos/aplicacion/librerias/Configuracion.cnf.php");
Sesion::init();
$transaccion = Request::getValue("transaccion");
$trasmision = Request::getValue("trasmision");

$f = new Forms($transaccion);
echo($f->apertura());

if (empty($trasmision)) {
    require_once(PATH . "/formulario.inc.php");
} else {
    require_once(PATH . "/procesador.inc.php");
}

echo($f->generar());
echo($f->controles());
echo($f->cierre());
?>
