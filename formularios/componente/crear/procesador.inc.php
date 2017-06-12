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
$componentes->crear($datos);
/** JavScripts **/
$f->JavaScript("if(itable_componentes){itable_componentes.refresh();}");
$f->windowClose();
?>