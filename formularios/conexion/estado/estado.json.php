<?php
$ROOT = (!isset($ROOT)) ? "../../../../../" : $ROOT;
require_once($ROOT . "modulos/aplicacion/librerias/Configuracion.cnf.php");
Sesion::init();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$fechas=new Fechas();
$fecha["dia"]=$fechas->hoy();
$fecha["hora"]=$fechas->ahora();
echo(json_encode($fecha));
?>