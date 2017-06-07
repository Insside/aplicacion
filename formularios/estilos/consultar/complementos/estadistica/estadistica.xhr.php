<?php
$ROOT = (!isset($ROOT)) ? "../../../../../../../" : $ROOT;
require_once($ROOT . "modulos/usuarios/librerias/Configuracion.cnf.php");
$ae=new Aplicacion_Estilos();

$complemento="complemento".time();
echo("<div id=\"".$complemento."\"></div>");
echo("<script>");
$title="<b>Estilos Definidos</b>";
$number=$ae->conteo();
$total=$ae->conteo();
echo("new MUI.Score('$complemento',{'title':'$title','number':'$number','total':'$total'});");
echo("</script>");
?>