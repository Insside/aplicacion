<?php

$v = new Validaciones();
$fechas = new Fechas();
$afe = new Aplicacion_Framework_Estilos();
$itable = $v->recibir("itable");
$p["estilo"] = $v->recibir("estilo");
$p["clase"] = $v->recibir("clase");
$p["subclase"] = $v->recibir("subclase");
$p["etiqueta"] = $v->recibir("etiqueta");
$p["estado"] = $v->recibir("estado");
$p["css"] = urlencode(stripslashes($v->recibir("css")));
$p["css_firefox"] = urlencode(stripslashes($v->recibir("css_firefox")));
$p["css_chrome"] = urlencode(stripslashes($v->recibir("css_chrome")));
$p["css_iexplorer"] = urlencode(stripslashes($v->recibir("css_iexplorer")));
$p["css_opera"] = urlencode(stripslashes($v->recibir("css_opera")));
$p["descripcion"] = urlencode(stripslashes($v->recibir("descripcion")));
$p["version"] = $v->recibir("version");
$p["fecha"] = $fechas->hoy();
$p["hora"] = $fechas->ahora();
$p["creador"] = $usuario["usuario"];
$afe->crear($p);
require_once($ROOT . "modulos/aplicacion/formularios/framework/estilo/crear/sincronizador.inc.php");
/** JavaScripts * */
$f->windowClose();
$f->gridRefresh($itable);
?>