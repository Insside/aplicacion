<?php
/** procesador.inc.php Codigo fuente archivo procesador **/
$cadenas = new Cadenas();
$fechas = new Fechas();
$validaciones = new Validaciones();
/** Clase representativa Del Objeto **/
$funciones=new Funciones();


$cuerpo=Request::getValue("cuerpo");
$descripcion=Request::getValue("descripcion");
/** Campos Recibidos **/
echo("<pre>");
print_r($_REQUEST);
echo("</pre>");
$datos=array();
$funcion=Request::getValue("funcion");
$datos['modulo']=Request::getValue("modulo");
$datos['nombre']=Request::getValue("nombre");
$datos['parametros']=Request::getValue("parametros");
if(!empty($cuerpo)){$datos['cuerpo']=urlencode($cuerpo);}
if(!empty($descripcion)){$datos['descripcion']= urlencode($descripcion);}
$datos['version']=Request::getValue("version")+ 0.001;
//$datos['creacion']=Request::getValue("creacion");
$datos['modificacion']=$fechas->hoy();
//$datos['estado']=Request::getValue("estado");
//$datos['creador']=Request::getValue("creador");
//$datos['permiso']=Request::getValue("permiso");
foreach ($datos as $campo => $valor) {
    $funciones->actualizar($funcion,$campo,$valor);
}
/** JavaScripts **/
$f->gridRefresh($v->recibir("grid"));
$f->JavaScript("MUI.closeWindow($('" . ($f->ventana) . "'));");
?>