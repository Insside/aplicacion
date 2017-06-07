<?php
$ROOT = (!isset($ROOT)) ? "../../../../../" : $ROOT;
require_once($ROOT . "modulos/aplicacion/librerias/Configuracion.cnf.php");
header('Content-Type: application/json');
/* * Variables Definidas * */
$sesion = new Sesion();
$modulos = new Aplicacion_Modulos();
$automatizaciones = new Automatizaciones();
$usuarios = new Aplicacion_Usuarios();
$cadenas = new Cadenas();
$tabla = "aplicacion_funciones";
/** Variables Recibidas * */
$transaccion = @$_REQUEST['transaccion'];
$criterio = @$_REQUEST['criterio'];
$valor = @$_REQUEST['valor'];



$page = 1;
$perpage = 50;
$n = 0;
$pagination = false;

if (isset($_REQUEST["page"])) {
    $pagination = true;
    $page = intval($_REQUEST["page"]);
    $perpage = intval($_REQUEST["perpage"]);
    $n = ( $page - 1 ) * $perpage;
}

if (!empty($criterio)) {
    $buscar = "WHERE(`modulo`='$criterio' AND `nombre` LIKE '%$valor%')";
} else {
    $buscar = "";
}

$db = new MySQL(Router::getDefaultConexion());
$sql['sql'] = "SELECT * FROM `" . $tabla . "` " . $buscar . " ;";
//echo($sql['sql']);
$consulta = $db->sql_query($sql['sql']);
$fila = $db->sql_fetchrow($consulta);
$total = $db->sql_numrows();

$limit = "";

if ($pagination) {
    $limit = "LIMIT $n, $perpage";
}

$consulta = $db->sql_query("SELECT * FROM `" . $tabla . "` " . $buscar . " ORDER BY  `modulo` DESC,`nombre` ASC " . $limit);

$ret = array();
$funcion = array();
while ($fila = $db->sql_fetchrow($consulta)) {
    $modulo = $modulos->consultar($fila['modulo']);
    $creador = $usuarios->consultar($fila['creador']);
    $funcion['funcion'] = $fila["funcion"];
    $funcion['nombre'] = ((!empty($modulo['nombre'])) ? $modulo['nombre'] . "_" . $fila["nombre"] : $fila["nombre"]);
//    $funcion['modulo'] = $modulo['nombre'];
    $funcion['detalles'] = "<b>" . $funcion['nombre'] . "</b><i>(" . $fila['parametros'] . ")</i>: ";
    $funcion['creador'] =$fila["creador"];
    $funcion['creacion']=$fila["creacion"];
    $funcion['modificacion']=$fila["modificacion"];
    array_push($ret, $funcion);
}
$db->sql_close();
echo json_encode(array("page" => $page, "total" => $total, "data" => $ret, "sql" => $sql['sql']));
?>