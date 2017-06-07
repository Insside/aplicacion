<?php

$ROOT = (!isset($ROOT)) ? "../../../" : $ROOT;
require_once($ROOT . "modulos/aplicacion/librerias/Configuracion.cnf.php");
$tabla = "solicitudes_solicitudes";
$db = new MySQL(Sesion::getConexion());
$acentos = $db->sql_query("SET NAMES 'utf8'");
$consulta = $db->sql_query("DESCRIBE `$tabla`");
while ($fila = $db->sql_fetchrow($consulta)) {
  //echo("<br>\$v['" . $fila['Field'] . "']=@\$solicitud['" . $fila['Field'] . "'];");
  //echo("<br>\$f->campos['" . $fila['Field'] . "']=\$f->text(\"" . $fila['Field'] . "\",\$v['" . $fila['Field'] . "'], \"32\", \"\", true);");
  //echo("<br>\$f->celdas[\"" . $fila['Field'] . "\"] = \$f->celda(\"" . $fila['Field'] . ":\", \$f->campos['" . $fila['Field'] . "']);");
  $conteo++;
}$db->sql_close();
$db = new MySQL(Sesion::getConexion());
$acentos = $db->sql_query("SET NAMES 'utf8'");
$consulta = $db->sql_query("DESCRIBE `$tabla`");
while ($fila = $db->sql_fetchrow($consulta)) {
  echo("<br>\$proveedores->actualizar(\$proveedor,'" . $fila['Field'] . "',\$v['" . $fila['Field'] . "']);");
}$db->sql_close();
?>