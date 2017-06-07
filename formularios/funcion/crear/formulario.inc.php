<?php
$ROOT=(!isset($ROOT))?"../../../../":$ROOT;
require_once($ROOT."modulos/aplicacion/librerias/Configuracion.cnf.php");
$modulos = new Aplicacion_Modulos();
$v=new Validaciones();

$html = "<h1>Adjuntar Archivo del Proveedor.</h1>";
$html.="<p>En este formulario podrá adjuntar los archivos de la digitalización de los diferentes documentos físicos solicitados a los proveedores. Para adjuntar un documento deberá hacer clic en Adjuntar archivo local-Examinar. Recuerde que “no debe tener el archivo abierto” cuando lo vaya a adjuntar y debe verificar que el archivo esté guardado con un nombre “corto”.</p>";
$f->oculto("itable",$v->recibir("itable"));
$f->campos['modulo']=$modulos->combo("modulo","");
$f->campos['nombre'] = $f->text("nombre", "", 64, "required");
$f->campos['parametros'] = $f->text("parametros", "", 160, "");
$f->campos['descripcion'] = $f->textarea("descripcion", "", "textarea", 25, 80, false, false, false, 255);
$f->campos['registrar'] = $f->button("registrar" .$f->id, "submit", "Registrar");
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button", "Cancelar");
// Celdas
$f->celdas["modulo"] = $f->celda("Modulo:", $f->campos['modulo'],"","w150");
$f->celdas['nombre'] = $f->celda("Nombre Función:", $f->campos['nombre']);
$f->celdas['parametros'] = $f->celda("Parametros Requeridos:", $f->campos['parametros']);
$f->celdas['descripcion'] = $f->celda("Descripción:", $f->campos['descripcion']);
// Filas
$f->fila["nombre"] = $f->fila($f->celdas['modulo'].$f->celdas['nombre']);
$f->fila["parametros"] = $f->fila($f->celdas['parametros']);
$f->fila["descripcion"] = $f->fila($f->celdas['descripcion']);
//Compilacion
$f->filas($f->fila['nombre']);
$f->filas($f->fila['parametros']);
$f->filas($f->fila['descripcion']);
/** Botones **/
$f->botones($f->campos['registrar'],"inferior-derecha");
$f->botones($f->campos['cancelar'],"inferior-derecha");
/** JavaScripts **/
$f->windowTitle("Función / Crear ","1.2");
$f->windowResize(array("autoresize"=>false,"width"=>"480","height"=>"320"));
$f->windowCenter();
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
?>