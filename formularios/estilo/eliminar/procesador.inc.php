<?php
/**
 * Este archivo recibe el nombre del archivo a eliminar y realiza la accion si valoraciones adiciones su
 * proceso implica dos acciones eliminar el registro de la base de datos y eliminar fisicamente el archivo
 * */

$itable=Request::getValue("itable");
$estilo=Request::getValue("estilo");
$ae=new Aplicacion_Estilos();
$ae->eliminar($estilo); 
/** JavaScripts **/
$itable=Request::getValue("itable");
if(!empty($itable)){$f->JavaScript("if(".$itable."){".$itable.".refresh();}");}
$f->windowClose();
?>