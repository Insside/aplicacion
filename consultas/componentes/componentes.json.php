<?php
$ROOT=(!isset($ROOT))?"../../../../":$ROOT;
require_once($ROOT."modulos/aplicacion/librerias/Configuracion.cnf.php");
Sesion::init();
$modulos = new Aplicacion_Modulos();
$automatizaciones = new Automatizaciones();
$usuarios = new Aplicacion_Usuarios();
$cadenas = new Cadenas();
$validaciones=new Validaciones();
/** Variables Recibidas * */
$transaccion = Request::getValue('transaccion');
$estado = Request::getValue('estado');
$buscar = Request::getValue('buscar');
$herencia=Request::getValue('herencia');
/* * Variables Definidas * */
$tabla = "aplicacion_modulos_componentes";

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

if (!empty($buscar)) {
  $buscar = "WHERE(" . $automatizaciones->like($tabla, $buscar) . ")";
} elseif (!empty($estado)) {
  $buscar = "WHERE(`estado`='" . strtoupper($estado) . "' AND `herencia`='" .$herencia. "')";
} else {
  $buscar ="WHERE(`herencia`='" .$herencia. "')";
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
$sql = ("SELECT * FROM `" . $tabla . "` " . $buscar . " ORDER BY `peso` ASC " . $limit);
$consulta = $db->sql_query($sql);
$json= array();
$dato= array();
while ($fila = $db->sql_fetchrow($consulta)) {
  $dato["componente"]=  $fila['componente'];
  $dato["detalles"]="<b>".urldecode($fila['titulo'])."</b>: ".urldecode($fila['descripcion'])." <i>Función</i>: ";
  $dato["permiso"]=$fila["permiso"];
  $dato["fecha"]=$fila["fecha"];
  $dato["hora"]=$fila["hora"];
  array_push($json, $dato);
}
$db->sql_close();
echo json_encode(array("page" => $page, "total" => $total, "data" => $json));
?>