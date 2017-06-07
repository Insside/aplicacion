<?php
define("PATH", dirname(__FILE__));
define("ROOT", PATH . '/../../../../../../');
require_once(ROOT . "modulos/aplicacion/librerias/Configuracion.cnf.php");

header('Content-Type: application/json');
$afe=new Aplicacion_Framework_Estilos();
$usuario = Sesion::usuario();
/** Variables Recibidas * */
$rgv["clase"]= Request::getValue("clase");
$rgv['criterio'] = Request::getValue("criterio");
$rgv['valor'] = Request::getValue("valor");
$rgv['inicio'] = Request::getValue("inicio");
$rgv['fin'] = Request::getValue("fin");
$rgv['transaccion'] = Request::getValue("transaccion");
$rgv['page'] = Request::getValue("page");
$rgv['perpage'] = Request::getValue("perpage");
/** Verificaciones * */
/**
 * Se evalua el comportamiento en caso de no recibir el periodo inicial y final de la consulta para lo 
 * cual se presuponen la fecha de la primera solicitud y la ultima que se hallan registrado por
 * el usuario activo en el sistema de atencion de solicitudes.
 */
$rgv['inicio'] = empty($rgv['inicio']) ? "0000-00-00" : $rgv['inicio'];
$rgv['fin'] = empty($rgv['fin']) ? "2018-01-01" : $rgv['fin'];

/* * Variables Definidas * */
if (!empty($rgv['page'])) {
  $pagination = true;
  $page = intval($rgv['page']);
  $perpage = intval($rgv['perpage']);
  $n = ( $page - 1 ) * $perpage;
  $limite = "LIMIT $n, $perpage";
} else {
  $pagination = false;
  $page = 1;
  $perpage = 20;
  $n = 0;
  $limite = "LIMIT $n, $perpage";
}
/**
 * En este segmento se evalua si se esta recibiendo o no un criterio y un valor a buscar segun el 
 * criterio adicionalmente se contempla la propiedad y responsabilidad del usuario activo sobre los 
 * registros visualizados. En terminos de criterios existe un criterio especial que se utiliza para
 * identificar una peticion en la que solo se desean ver aquellas solicitudes que se encuentran 
 * pendientes de respuesta, ese criterio es "estado", donde no existe ningun campo denominado 
 * estado pero se usa para definir si los registros se muestran como se hace habitualmente o 
 * solamente aquellos que correspondan a peticiones a la espera de respuesta.
 * */
if (!empty($rgv['criterio']) && !empty($rgv['valor']) && $rgv['criterio'] != "estado") {
  $buscar = "WHERE(`clase`='".$rgv["clase"]."' AND (`fecha` BETWEEN '" . $rgv['inicio'] . "' AND '" . $rgv['fin'] . "')AND(`" . $rgv['criterio'] . "` LIKE '%" . $rgv['valor'] . "%'))";
} else {
  $buscar = "WHERE(`clase`='".$rgv["clase"]."' AND `fecha` BETWEEN '" . $rgv['inicio'] . "' AND '" . $rgv['fin'] . "')";
}

$db = new MySQL(Router::getDefaultConexion());
$consulta = $db->sql_query("SELECT * FROM `aplicacion_framework_estilos` " . $buscar . " ORDER BY `clase`,`subclase`,`etiqueta` DESC;");
$total = $db->sql_numrows($consulta);
$sql = "SELECT * FROM `aplicacion_framework_estilos` " . $buscar . " ORDER BY `clase`,`subclase`,`etiqueta` DESC " . $limite;

$consulta = $db->sql_query($sql);
$ret = array();
while ($fila = $db->sql_fetchrow($consulta)) {
  $fila["detalles"]=$afe->nombre($fila);
  array_push($ret, $fila);
}

$db->sql_close();
echo json_encode(array("sql" => $sql, "uid" => $usuario['usuario'], "page" => $page, "total" => $total, "data" => $ret));
?>