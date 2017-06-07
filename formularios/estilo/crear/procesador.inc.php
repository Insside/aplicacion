<?php
/** procesador.inc.php Codigo fuente archivo procesador **/
$cadenas = new Cadenas();
$fechas = new Fechas();
$validaciones = new Validaciones();
$usuario=Sesion::usuario();
/** Clase representativa Del Objeto **/
$clase=new Aplicacion_Estilos();
/** Campos Recibidos **/
$datos=array();
$datos['estilo']=time();
$datos['identidad']=urlencode(trim($validaciones->recibir("identidad")));
$datos['clase']=urlencode(trim($validaciones->recibir("clase")));
$datos['etiqueta']= urlencode(trim($validaciones->recibir("etiqueta")));
$datos['estado']=urlencode(trim($validaciones->recibir("estado")));
$datos['css']=$validaciones->recibir("css");
$datos['css_firefox']=$validaciones->recibir("css_firefox");
$datos['css_chrome']=$validaciones->recibir("css_chrome");
$datos['css_iexplorer']=$validaciones->recibir("css_iexplorer");
$datos['css_opera']=$validaciones->recibir("css_opera");
$datos['descripcion']=$validaciones->recibir("descripcion");
$datos['version']=$validaciones->recibir("version");
$datos['fecha']=$fechas->hoy();
$datos['hora']=$fechas->ahora();
$datos['creador']=$usuario["usuario"];
$codigo=$clase->crear($datos);
/** JavaScripts **/
$itable=$validaciones->recibir("itable");
$f->windowClose();
if(!empty($itable)){$f->JavaScript("if(".$itable."){".$itable.".refresh();}");}
?>