<?php

/** Tabla de Datos **/
$f->table="aplicacion_formularios";
/** Variables **/
$cadenas = new Cadenas();
$fechas = new Fechas();
$validaciones = new Validaciones();
/** Valores **/
$itable=Request::getValue("itable");
$valores['formulario']=time();
$valores['nombre']=Request::getValue("_nombre");
$valores['descripcion']=Request::getValue("_descripcion");
$valores['creador']= Sesion::getUsuario();
$valores['fecha']=$fechas->hoy();
$valores['hora']=$fechas->ahora();
/** Campos **/
if(!empty($itable)){$f->oculto("itable",$itable);}
$f->campos['formulario']=$f->dynamic(array("field"=>"formulario","value"=>$valores["formulario"],"class"=>"codigo","readonly"=>"true"));
$f->campos['nombre']=$f->dynamic(array("field"=>"nombre","value"=>$valores["nombre"]));
$f->campos['descripcion']=$f->dynamic(array("field"=>"descripcion","value"=>$valores["descripcion"]));
$f->campos['creador']=$f->dynamic(array("field"=>"creador","value"=>$valores["creador"],"readonly"=>true,"class"=>"automatico"));
$f->campos['fecha']=$f->dynamic(array("field"=>"fecha","value"=>$valores["fecha"],"readonly"=>true,"class"=>"automatico","type"=>"varchar"));
$f->campos['hora']=$f->dynamic(array("field"=>"hora","value"=>$valores["hora"],"readonly"=>true,"class"=>"automatico"));
$f->campos['ayuda']=$f->button("ayuda".$f->id, "button","Ayuda");
$f->campos['cancelar']=$f->button("cancelar".$f->id, "button","Cancelar");
$f->campos['continuar']=$f->button("continuar".$f->id, "submit","Continuar");
/** Celdas **/
$f->celdas["formulario"]=$f->celda("Formulario:",$f->campos['formulario']);
$f->celdas["nombre"]=$f->celda("Nombre:",$f->campos['nombre']);
$f->celdas["descripcion"]=$f->celda("Descripcion:",$f->campos['descripcion']);
$f->celdas["creador"]=$f->celda("Creador:",$f->campos['creador']);
$f->celdas["fecha"]=$f->celda("Fecha:",$f->campos['fecha']);
$f->celdas["hora"]=$f->celda("Hora:",$f->campos['hora']);
/** Filas **/
$f->fila["fila1"]=$f->fila($f->celdas["formulario"].$f->celdas["nombre"]);
$f->fila["fila2"]=$f->fila($f->celdas["descripcion"]);
$f->fila["fila3"]=$f->fila($f->celdas["fecha"].$f->celdas["hora"].$f->celdas["creador"]);
/** Compilando **/
$f->filas($f->fila['fila1']);
$f->filas($f->fila['fila2']);
$f->filas($f->fila['fila3']);
/** Botones **/

$f->botones($f->campos['ayuda'], "inferior-izquierda");
$f->botones($f->campos['cancelar'], "inferior-derecha");
$f->botones($f->campos['continuar'], "inferior-derecha");/** JavaScripts **/

$f->windowTitle("Formulario / Crear","1.0");
$f->windowResize(array("autoresize"=>false,"width"=>"640","height"=>"480"));
$f->windowCenter();
$f->eClick("cancelar".$f->id,"MUI.closeWindow($('".$f->ventana."'));");
?>
