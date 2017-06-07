<?php

$ROOT = (!isset($ROOT)) ? "../../../" : $ROOT;
require_once($ROOT . "modulos/aplicacion/librerias/Configuracion.cnf.php");
header('Content-Type: application/json');
$v = new Validaciones();
$request = $v->recibir("request");
// this will allow for a default of no results to be returned
$json = array();

if (!is_null($request) && !empty($request)) {
    $db = new MySQL(Router::getDefaultConexion());
    $sql = "SELECT * FROM `aplicacion_cargos` WHERE `titulo` LIKE '%{$request}%' ORDER BY `titulo`";
    $consulta = $db->sql_query($sql);
    while ($fila = $db->sql_fetchrow($consulta)) {
        // The JSON object that is being returned will expect a html property to 
        // be present if you are returning JSON objects.
        // which is used to display the text for each result. This could also be 
        // accomplished by
        // aliasing a Mysql field as html. I have done it this way in order to 
        // illustrate the need.
        $r['html'] = strtoupper($fila['titulo']);
        $r['value'] = $fila['cargo']; 
        $json[] = $r;
        //$empresa = array("empresa" => $fila["empresa"], "razon" => $fila["razon"]);
        //array_push($json, $empresa);
    }
}
echo(json_encode($json));
?>