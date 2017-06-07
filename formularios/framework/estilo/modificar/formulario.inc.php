<?php
/** Variables * */
$validaciones = new Validaciones();
$afe=new Aplicacion_Framework_Estilos();
$estilo=$afe->consultar($validaciones->recibir("estilo"));
/** Valores * */
$v=$estilo;
//$v['css']=$afe->expresion($estilo);
$v['css']=urldecode($v['css']);
/** Campos * */
$f->oculto("itable", $validaciones->recibir("itable"));
$f->campos['estilo'] = $f->text("estilo", $v['estilo'], "10", "required codigo", true);
$f->campos['clase'] = $f->text("clase", $v['clase'], "64", "required codigo", true);
$f->campos['subclase'] = $f->text("subclase", $v['subclase'], "64", "", false);
$f->campos['etiqueta'] = $f->text("etiqueta", $v['etiqueta'], "64", "", false);
$f->campos['estado'] = $f->text("estado", $v['estado'], "64", "", false);
$f->campos['css'] = $f->iAreaCode("css", "css", $v['css']);
$f->campos['css_firefox'] =$f->iAreaCode("css_firefox", "css", $v['css_firefox']);
$f->campos['css_chrome'] = $f->iAreaCode("css_chrome", "css", $v['css_chrome']);
$f->campos['css_iexplorer'] =$f->iAreaCode("css_iexplorer", "css", $v['css_iexplorer']);
$f->campos['css_opera'] =$f->iAreaCode("css_opera", "css", $v['css_opera']);
$f->campos['descripcion'] = $f->text("descripcion", $v['descripcion'], "lo", "", true);
$f->campos['version'] = $f->text("version", $v['version'], "oubl", "", true);
$f->campos['fecha'] = $f->text("fecha", $v['fecha'], "10", "", true);
$f->campos['hora'] = $f->text("hora", $v['hora'], "8", "", true);
$f->campos['creador'] = $f->text("creador", $v['creador'], "10", "", true);
$f->campos['ayuda'] = $f->button("ayuda" . $f->id, "button", "Ayuda");
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button", "Cancelar");
$f->campos['continuar'] = $f->button("continuar" . $f->id, "submit", "Continuar");
/** Celdas * */
$f->celdas["estilo"] = $f->celda("Estilo:", $f->campos['estilo']);
$f->celdas["clase"] = $f->celda("Clase:", $f->campos['clase']);
$f->celdas["subclase"] = $f->celda("Subclase:", $f->campos['subclase']);
$f->celdas["etiqueta"] = $f->celda("Etiqueta:", $f->campos['etiqueta']);
$f->celdas["estado"] = $f->celda("Estado:", $f->campos['estado']);
$f->celdas["css"] = $f->celda("Código CSS Generico:", $f->campos['css']);
$f->celdas["css_firefox"] = $f->celda("Css_Firefox:", $f->campos['css_firefox']);
$f->celdas["css_chrome"] = $f->celda("Css_Chrome:", $f->campos['css_chrome']);
$f->celdas["css_iexplorer"] = $f->celda("Css_Iexplorer:", $f->campos['css_iexplorer']);
$f->celdas["css_opera"] = $f->celda("Css_Opera:", $f->campos['css_opera']);
$f->celdas["descripcion"] = $f->celda("Descripcion:", $f->campos['descripcion']);
$f->celdas["version"] = $f->celda("Version:", $f->campos['version']);
$f->celdas["fecha"] = $f->celda("Fecha:", $f->campos['fecha']);
$f->celdas["hora"] = $f->celda("Hora:", $f->campos['hora']);
$f->celdas["creador"] = $f->celda("Creador:", $f->campos['creador']);
/** Filas * */
require_once($ROOT."modulos/aplicacion/formularios/framework/estilo/modificar/segmentos/general.inc.php");
require_once($ROOT."modulos/aplicacion/formularios/framework/estilo/modificar/segmentos/firefox.inc.php");
require_once($ROOT."modulos/aplicacion/formularios/framework/estilo/modificar/segmentos/chrome.inc.php");
require_once($ROOT."modulos/aplicacion/formularios/framework/estilo/modificar/segmentos/opera.inc.php");
require_once($ROOT."modulos/aplicacion/formularios/framework/estilo/modificar/segmentos/iexplorer.inc.php");
/** <TabbedPane> **/
$tp = new TabbedPane(array("pagesHeight" => "370px"));
$tp->addTab("CSS General",null, $f->fila["css_general"]);
$tp->addTab("Firefox",null, $f->fila["css_firefox"]);
$tp->addTab("Chrome",null, $f->fila["css_chrome"]);
$tp->addTab("Opera",null, $f->fila["css_opera"]);
$tp->addTab("IExplorer",null, $f->fila["css_iexplorer"]);
/** Compilando * */
$f->filas($tp->getPane());
/** </TabbedPane> **/
/** Compilando * */
/** Botones * */
$f->botones($f->campos['ayuda'], "inferior-izquierda");
$f->botones($f->campos['cancelar'], "inferior-derecha");
$f->botones($f->campos['continuar'], "inferior-derecha");
/** JavaScripts * */
$f->windowTitle("Modificar Estilo","1.1");
$f->windowResize(array("autoresize"=>false,"width"=>"750","height"=>"460"));
$f->windowCenter();
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
?>