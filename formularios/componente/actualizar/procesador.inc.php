<?php
$validaciones=new Validaciones();
$datos['componente']=Request::getValue('componente');
$datos['herencia']=Request::getValue('herencia');
$datos['titulo']=Request::getValue('titulo');
$datos['descripcion']=Request::getValue('descripcion');
$datos['funcion']=Request::getValue('funcion');
$datos['icono']=Request::getValue('icono');
$datos['peso']=Request::getValue('peso');
$datos['estado']=Request::getValue('estado');
$datos['permiso']=Request::getValue('permiso');
$datos['fecha']=Request::getValue('fecha');
$datos['hora']=Request::getValue('hora');
$datos['creador']=Request::getValue('creador');
$componentes= new Aplicacion_Modulos_Componentes();
$campos = array_keys($datos);
$valores = array_values($datos);
for ($i = 0; $i < count($campos); $i++) {
  $componentes->actualizar($datos['componente'], $campos[$i], $valores[$i]);
}
//echo("<pre>");
//print_r($datos);
//echo("</pre>");
/** JavScripts **/
$f->JavaScript("if(itable_componentes){itable_componentes.refresh();}");
$f->windowClose();
?>