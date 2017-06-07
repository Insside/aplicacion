<?php
/** procesador.inc.php Codigo fuente archivo procesador **/
$cadenas = new Cadenas();
$fechas = new Fechas();
$validaciones = new Validaciones();
/** Clase representativa Del Objeto **/
$funciones=new Funciones();


$cuerpo=$validaciones->recibir("cuerpo");
$descripcion=$validaciones->recibir("descripcion");
/** Campos Recibidos **/
echo("<pre>");
print_r($_REQUEST);
echo("</pre>");
$datos=array();
$funcion=$validaciones->recibir("funcion");
$datos['modulo']=$validaciones->recibir("modulo");
$datos['nombre']=$validaciones->recibir("nombre");
$datos['parametros']=$validaciones->recibir("parametros");
if(!empty($cuerpo)){$datos['cuerpo']=urlencode($cuerpo);}
if(!empty($descripcion)){$datos['descripcion']= urlencode($descripcion);}
$datos['version']=$validaciones->recibir("version")+ 0.001;
//$datos['creacion']=$validaciones->recibir("creacion");
$datos['modificacion']=$fechas->hoy();
//$datos['estado']=$validaciones->recibir("estado");
//$datos['creador']=$validaciones->recibir("creador");
//$datos['permiso']=$validaciones->recibir("permiso");
foreach ($datos as $campo => $valor) {
    $funciones->actualizar($funcion,$campo,$valor);
}
/** JavaScripts **/
$f->gridRefresh($v->recibir("grid"));
$f->JavaScript("MUI.closeWindow($('" . ($f->ventana) . "'));");
?>