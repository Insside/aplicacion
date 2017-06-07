<?php
error_reporting(E_ALL);
if(!defined("ROOT")){define('ROOT', dirname(__FILE__) . '/../../../');}
if(!defined("ROOT_MODULE_APLICACION")){define('ROOT_MODULE_APLICACION', dirname(__FILE__) . '/../');}
$ROOT = (!isset($ROOT)) ? ROOT:$ROOT;
require_once(ROOT . "librerias/Configuracion.cnf.php");
Sesion::init();
/** Librerias del Modulo **/
require_once(ROOT."modulos/aplicacion/librerias/Funciones.class.php");
require_once(ROOT."modulos/aplicacion/librerias/Aplicacion_Aplicacion.class.php");
require_once(ROOT."modulos/aplicacion/librerias/Aplicacion_Cargos.class.php");
require_once(ROOT."modulos/aplicacion/librerias/Aplicacion_Clientes.class.php");
require_once(ROOT."modulos/aplicacion/librerias/Aplicacion_Empresas.class.php");
require_once(ROOT."modulos/aplicacion/librerias/Aplicacion_Estilos.class.php");
require_once(ROOT."modulos/aplicacion/librerias/Aplicacion_Estructuras.class.php");
require_once(ROOT."modulos/aplicacion/librerias/Aplicacion_Usuarios.class.php");
require_once(ROOT."modulos/aplicacion/librerias/Aplicacion_Permisos.class.php");
require_once(ROOT."modulos/aplicacion/librerias/Aplicacion_Framework_Clases.class.php");
require_once(ROOT."modulos/aplicacion/librerias/Aplicacion_Framework_Estilos.class.php");
require_once(ROOT."modulos/aplicacion/librerias/Aplicacion_Framework_Codigos.class.php");
require_once(ROOT."modulos/aplicacion/librerias/Aplicacion_Framework_Funciones.class.php");
require_once(ROOT."modulos/aplicacion/librerias/Aplicacion_Funciones.class.php");
require_once(ROOT."modulos/aplicacion/librerias/Aplicacion_Menus.class.php");
require_once(ROOT."modulos/aplicacion/librerias/Aplicacion_Modulos.class.php");
require_once(ROOT."modulos/aplicacion/librerias/Aplicacion_Multimedia.class.php");
require_once(ROOT."modulos/aplicacion/librerias/Aplicacion_Modulos_Componentes.class.php");
require_once(ROOT."modulos/aplicacion/librerias/Aplicacion_Permisos.class.php");
require_once(ROOT."modulos/aplicacion/librerias/Aplicacion_Usuarios.class.php");
require_once(ROOT."modulos/aplicacion/librerias/Aplicacion_Usos.class.php");
require_once(ROOT."modulos/aplicacion/librerias/Aplicacion_Estratos.class.php");
require_once(ROOT."modulos/aplicacion/librerias/Aplicacion_Profesiones.class.php");
require_once(ROOT."modulos/aplicacion/librerias/Aplicacion.class.php");
?>