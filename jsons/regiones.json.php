<?php

$ROOT=(!isset($ROOT))?"../../../":$ROOT;
require_once($ROOT."modulos/aplicacion/librerias/Configuracion.cnf.php");

header('Content-Type: application/json');
$db = new MySQL(Sesion::getConexion());
if (isset($_REQUEST["pais"])) {
    $sql = "SELECT * FROM `aplicacion_paises_regiones` WHERE `pais` ='" . $_REQUEST["pais"] . "' ORDER BY `nombre`";
} else {
    $sql = "SELECT * FROM `aplicacion_paises_regiones` ORDER BY `nombre`";
}
//echo($sql);
$consulta = $db->sql_query($sql);
$regiones = array();
while ($fila = $db->sql_fetchrow($consulta)) {
    array_push($regiones, $fila);
}
echo(json_encode($regiones));
?>