<?php
require_once($ROOT . "librerias/soap/nusoap.php");
$configuraciones = new Configuraciones();

if ($configuraciones->modo == "desarrollo") {
  echo("Sincronizando Estilo");
  $v = new Validaciones();
  $afe = new Aplicacion_Framework_Estilos();
  $estilo = $afe->consultar($v->recibir("estilo"));
  print_r($estilo);
  $cliente = new nusoap_client("http://" . $configuraciones->intranet . "/insside/sincronizacion.php");
  $error = $cliente->getError();
  $result = $cliente->call("Framework_Estilo", array("estilo" => $estilo));
  print_r($error);
  print_r($result);
}
?>