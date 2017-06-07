<?php

$ROOT = (!isset($ROOT)) ? "../../../../../../" : $ROOT;
require_once($ROOT . "modulos/aplicacion/librerias/Configuracion.cnf.php");
require_once($ROOT . "librerias/soap/nusoap.php");
$configuraciones = new Configuraciones();
$v = new Validaciones();
$afe=new Aplicacion_Framework_Estilos();
$clase=$v->recibir("clase");
/** Se reciben las variables * */
$count = $v->recibir("count");
$count++;
/** Se consulta el registro * */
$db = new MySQL(Sesion::getConexion());
$sql = "SELECT * FROM `aplicacion_framework_estilos`  WHERE(`clase`='".$clase."')  LIMIT " . $count . ",1;";
$consulta = $db->sql_query($sql);
$fila = $db->sql_fetchrow($consulta);
$db->sql_close();

/** Procedimiento de Sincronización* */
if ($configuraciones->modo == "desarrollo") {
  $cliente = new nusoap_client("http://" . $configuraciones->intranet . "/insside/sincronizacion.php");
  $error = $cliente->getError();
  $result = $cliente->call("Framework_Estilo", array("funcion" => $fila));
  if ($error) {
    $log = "Modo desarrollo: Sincronizando Clases: " . $error;
    $data["error"] = ($log);
  } else {
    $data["error"] = "";
  }
  $data["result"] = $result;
//  $data["request"] = htmlspecialchars($cliente->request, ENT_QUOTES);
//  $data["response"] = htmlspecialchars($cliente->response, ENT_QUOTES);
//  $data["debug"] = htmlspecialchars($cliente->getDebug());
}
// Datos retornados a la UI
$data["estilo"] = $fila["estilo"];
$data["clase"] = $fila["clase"];
$data["fecha"] = $fila["fecha"];
$data["hora"] = $fila["hora"];
$data["Peso"] = strlen($fila["css"]);


$json["data"] = $data;
header('Content-Type: application/json');
$json["time"] = date("H:i:s");
$json["count"] = $count;
$json["other"] = true;
if (($json["count"]) >=($afe->conteo($clase)-1)) {
  $json["other"] = false;
}
echo(json_encode($json));
?>