<?php
/**
 * Este archivo recibe el nombre del archivo a eliminar y realiza la accion si valoraciones adiciones su
 * proceso implica dos acciones eliminar el registro de la base de datos y eliminar fisicamente el archivo
 * */

$itable=Request::getValue("itable");
$clase=Request::getValue("clase");
$afc=new Aplicacion_Framework_Clases();
$afc->eliminar($clase); 
$f->windowClose();
$f->JavaScript("if(".$itable."){".$itable.".refresh();}");
?>