<?php
$ROOT = (!isset($ROOT)) ? "../../../../../../" : $ROOT;
require_once($ROOT . "modulos/aplicacion/librerias/Configuracion.cnf.php");


$transaccion = isset($_REQUEST['transaccion']) ? $_REQUEST['transaccion'] : time();
$f = new Forms($transaccion);
//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
echo($f->apertura());
//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
if (!isset($_REQUEST['trasmision'])) {
  require_once($ROOT . "modulos/aplicacion/formularios/framework/codigo/eliminar/formulario.inc.php");
} else {
  require_once($ROOT . "modulos/aplicacion/formularios/framework/codigo/eliminar/procesador.inc.php");
}
//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
echo($f->generar());
echo($f->controles());
echo($f->cierre());
?>