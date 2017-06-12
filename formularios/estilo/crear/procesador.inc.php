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
$datos['identidad']=urlencode(trim(Request::getValue("identidad")));
$datos['clase']=urlencode(trim(Request::getValue("clase")));
$datos['etiqueta']= urlencode(trim(Request::getValue("etiqueta")));
$datos['estado']=urlencode(trim(Request::getValue("estado")));
$datos['css']=Request::getValue("css");
$datos['css_firefox']=Request::getValue("css_firefox");
$datos['css_chrome']=Request::getValue("css_chrome");
$datos['css_iexplorer']=Request::getValue("css_iexplorer");
$datos['css_opera']=Request::getValue("css_opera");
$datos['descripcion']=Request::getValue("descripcion");
$datos['version']=Request::getValue("version");
$datos['fecha']=$fechas->hoy();
$datos['hora']=$fechas->ahora();
$datos['creador']=$usuario["usuario"];
$codigo=$clase->crear($datos);
/** JavaScripts **/
$itable=Request::getValue("itable");
$f->windowClose();
if(!empty($itable)){$f->JavaScript("if(".$itable."){".$itable.".refresh();}");}
?>