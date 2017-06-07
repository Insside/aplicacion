<?php

$ROOT = (!isset($ROOT)) ? "../../../" : $ROOT;
require_once($ROOT . "modulos/aplicacion/librerias/Configuracion.cnf.php");
$tabla = "proveedores_archivos";
$db = new MySQL(Sesion::getConexion());
$acentos = $db->sql_query("SET NAMES 'utf8'");
$consulta = $db->sql_query("DESCRIBE `$tabla`");
while ($fila = $db->sql_fetchrow($consulta)) {
  echo("<br>\$valor['" . $fila['Field'] . "']=@\$_REQUEST['_" . $fila['Field'] . "'];");
}$db->sql_close();
$db = new MySQL(Sesion::getConexion());
$acentos = $db->sql_query("SET NAMES 'utf8'");
$consulta = $db->sql_query("DESCRIBE `$tabla`");
while ($fila = $db->sql_fetchrow($consulta)) {
  echo("<br>\$proveedores->actualizar(\$proveedor,'" . $fila['Field'] . "',\$valor['" . $fila['Field'] . "']);");
}$db->sql_close();
?>