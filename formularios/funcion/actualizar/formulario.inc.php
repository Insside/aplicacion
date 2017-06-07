<?php
$ROOT = (!isset($ROOT)) ? "../../../../" : $ROOT;
require_once($ROOT . "modulos/aplicacion/librerias/Configuracion.cnf.php");
/** Variables * */
$v=new Validaciones();
$cadenas = new Cadenas();
$fechas = new Fechas();
$funciones = new Funciones();
$modulos = new Aplicacion_Modulos();

$funcion = $funciones->consultar($v->recibir("funcion"));
/** Valores * */
$valores = $funcion;
/** Campos * */
$f->oculto("grid",$v->recibir("grid"));
$f->campos['funcion']=$f->dynamic(array("field"=>"funcion","value"=>$valores["funcion"],"readonly"=>true,"class"=>"codigo"));
$f->campos['modulo']=$modulos->combo("modulo", $valores['modulo']);
$f->campos['nombre']=$f->dynamic(array("field"=>"nombre","value"=>$valores["nombre"]));
$f->campos['parametros']=$f->dynamic(array("field"=>"parametros","value"=>$valores["parametros"]));
$f->campos['cuerpo']=$f->dynamic(array("field"=>"cuerpo","value"=>$valores["cuerpo"],"height"=>"330"));
$f->campos['descripcion']=$f->dynamic(array("field"=>"descripcion","value"=>$valores["descripcion"]));
$f->campos['version']=$f->dynamic(array("field"=>"version","value"=>$valores["version"]));
$f->campos['creacion']=$f->dynamic(array("field"=>"creacion","value"=>$valores["creacion"]));
$f->campos['modificacion']=$f->dynamic(array("field"=>"modificacion","value"=>$valores["modificacion"]));
$f->campos['estado']=$f->dynamic(array("field"=>"estado","value"=>$valores["estado"]));
$f->campos['creador']=$f->dynamic(array("field"=>"creador","value"=>$valores["creador"]));
$f->campos['permiso']=$f->dynamic(array("field"=>"permiso","value"=>$valores["permiso"]));
$f->campos['ayuda']=$f->button("ayuda".$f->id, "button","Ayuda");
$f->campos['cancelar']=$f->button("cancelar".$f->id, "button","Cancelar");
$f->campos['continuar']=$f->button("continuar".$f->id, "submit","Continuar");
/** Celdas * */
$f->celdas["funcion"] = $f->celda("Función:", $f->campos['funcion'], "", "w90px");
$f->celdas["modulo"] = $f->celda("Modulo:", $f->campos['modulo'], "", "w200px");
$f->celdas["nombre"] = $f->celda("Nombre:", $f->campos['nombre'], "", "w200px");
$f->celdas["parametros"] = $f->celda("Parametros:", $f->campos['parametros']);
$f->celdas["cuerpo"] = $f->celda("Cuerpo:", $f->campos['cuerpo']);
$f->celdas["descripcion"] = $f->celda("Descripción:", $f->campos['descripcion']);
$f->celdas["version"] = $f->celda("Versión:", $f->campos['version'], "", "w50px");
$f->celdas["creacion"] = $f->celda("Creación:", $f->campos['creacion']);
$f->celdas["modificacion"] = $f->celda("Modificacion:", $f->campos['modificacion']);
$f->celdas["estado"] = $f->celda("Estado:", $f->campos['estado']);
$f->celdas["creador"] = $f->celda("Creador:", $f->campos['creador']);
/** Filas * */
$f->fila["fila1"] = $f->fila($f->celdas["funcion"] . $f->celdas["modulo"] . $f->celdas["nombre"] . $f->celdas["parametros"] . $f->celdas["version"]);
$f->fila["fila2"] = $f->fila($f->celdas["cuerpo"]);
//$f->fila["fila2"] = $f->fila($f->celdas["cuerpo"] . $f->celdas["descripcion"]);
//$f->fila["fila3"] = $f->fila($f->celdas["creacion"] . $f->celdas["modificacion"] . $f->celdas["estado"]);
//$f->fila["fila4"] = $f->fila($f->celdas["creador"]);
//$f->fila["fila5"] = "<pre id=\"editor" . $f->id . "\">" . urldecode(($valores['cuerpo'])) . "</pre>";
/** Compilando * */
$f->filas($f->fila['fila1']);
$f->filas($f->fila['fila2']);
//$f->filas($f->fila['fila3']);
//$f->filas($f->fila['fila4']);
//$f->filas($f->fila['fila5']);

$f->botones($f->campos['continuar'],"inferior-derecha");
$f->botones($f->campos['cancelar'],"inferior-derecha");
/** Controlando Eventos * */
//$f->windowTitle("Función / Modificar / {$funcion["funcion"]} ","1.1");
//$f->windowResize(array("autoresize"=>false,"width"=>"800","height"=>"480"));
//$f->windowCenter();
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
?>