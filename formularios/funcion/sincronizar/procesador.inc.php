<?php
$ROOT = (!isset($ROOT)) ? "../../../../" : $ROOT;
require_once($ROOT . "modulos/aplicacion/librerias/Configuracion.cnf.php");
require_once($ROOT . "librerias/soap/nusoap.php");
/** Clases **/
$usuarios=new Aplicacion_Usuarios();
$empresas=new Aplicacion_Clientes();
$funciones=new Aplicacion_Funciones();
/** Recibiendo / Recopilando **/
$usuario=$usuarios->consultar(Sesion::getUsuario());
$empresa=$empresas->consultar($v->recibir("empresa"));
$funcion=$funciones->consultar($v->recibir("funcion"));
/** Recopilando **/
$conexion= Router::getDefaultRemoteConexion();
$nc=new nusoap_client($conexion["url"]."sincronizacion.php");
$error= $nc->getError();
$result= $nc->call("funcion", array("funcion" =>$funcion));
echo("<pre>");
echo("Resultados:");
print_r($funcion);
print_r($error);
print_r($result);
echo("</pre>");
/** JavaScripts **/
$f->windowClose();
?>