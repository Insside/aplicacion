<?php
/**
 * Este archivo recibe el nombre del archivo a eliminar y realiza la accion si valoraciones adiciones su
 * proceso implica dos acciones eliminar el registro de la base de datos y eliminar fisicamente el archivo
 * */

$itable=$validaciones->recibir("itable");
$estilo=$validaciones->recibir("estilo");
$afe=new Aplicacion_Framework_Estilos();
$afe->eliminar($estilo); 
$f->windowClose();
$f->JavaScript("if(".$itable."){".$itable.".refresh();}");
?>