<?php

/**
 * Debo tener una estructura que tenga alojadas las referencias de las tablas
 * que conforman el modulo especificado, de esta forma leerlas de la Db original
 * y clonarlas en la base de datos del cliente, pero esto es complicado ya que 
 * dicha estructura tratese de un vector deberia ser actualizada constantemente
 * por tal motivo se debe crear un metodo que sea capas de leer todas las tablas
 * de la base de datos original y seleccionar ella aquellas que contengan el nombre
 * del modulo a manera de prefijo.
 */
/** Clases * */
error_reporting(-1);
$v = new Validaciones();
$ae = new Aplicacion_Clientes();
$am = new Aplicacion_Modulos();
/** Variables * */
$modulo = $am->consultar($v->recibir("modulo"));
$empresa = $ae->consultar($v->recibir("empresa"));
/** Leo las tablas * */
echo("<b>CONECTANDO CON ORIGEN</b>...<br>");
$db = new MySQL(Router::getDefaultConexion());
$sql = ""
        . "SELECT "
        . "`TABLE_SCHEMA` AS `schema`,"
        . "`TABLE_NAME` AS `name` FROM `INFORMATION_SCHEMA`.`tables` "
        . "WHERE("
        . "(`TABLE_SCHEMA` = '" . $db->getDB() . "')AND"
        . "(`TABLE_NAME` LIKE '" . strtolower($modulo["nombre"]) . "_%'))"
        . ";";
$consulta = $db->sql_query($sql);
$tablas = array();
while ($fila = $db->sql_fetchrow($consulta)) {
    array_push($tablas, $fila);
}
$db->sql_close();
/** Obtengo el codigo de las tablas * */
$total_tablas = count($tablas);
echo("<b>TABLAS LOCALIZADAS</b>: " . $total_tablas . "<br>");

for ($x = 0; $x < $total_tablas; $x++) {
    $db = new MySQL(Router::getDefaultConexion());
    $tabla = $tablas[$x]; //Array ( [schema] => insside [name] => social_facebook_tokens )
    $sql = "SHOW CREATE TABLE `" . $tabla["name"] . "`;";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta); //[Table] => social_facebook_grupos [Create Table] 
    dbInstalador($fila["Create Table"],$empresa["empresa"]);
    $db->sql_close();
}
echo("<b>PROCESANDO INSTALACIÓN</b>...<br>");

// Se verifica la existencia de las tablas en la empresa destino
function dbInstalador($sql,$empresa) {
    $ae = new Aplicacion_Clientes();
    $db = new MySQL($ae->getConexion($empresa));
    $consulta = $db->sql_query($sql);
    print_r($db->sql_error($consulta));
    $db->sql_close();
}

/** JavaScripts **/
$itable=$v->recibir("itable");
$f->windowClose();
if(!empty($itable)){$f->JavaScript("if(".$itable."){".$itable.".refresh();}");}
?>