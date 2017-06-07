<?php

$ROOT = (!isset($ROOT)) ? "../../../" : $ROOT;
require_once($ROOT . "modulos/aplicacion/librerias/Configuracion.cnf.php");
/** Variables **/
$ap = new Aplicacion_Permisos();
/** APLICACION-MODULO-ACCEDER **/
$permiso="APLICACION-MODULO-ACCEDER";
$nombre="Acceso Modulo Aplicación";
$descripcion="Este permiso se utiliza para conceder acceso al modulo de aplicación.";
$ap->crear(array("modulo"=>$modulo["modulo"],"permiso"=>$permiso,"nombre"=>$nombre,"descripcion"=>$descripcion,"fecha"=>$fechas->hoy(),"hora"=>$fechas->ahora(),"creador"=>$usuario["usuario"]));
/** APLICACION-FUNCIONES-VISUALIZAR **/
$permiso="APLICACION-FUNCIONES-VISUALIZAR";
$nombre="Consede acceso a la visualización del listado de funciones.";
$descripcion="Este permiso se utiliza para conceder acceso al modulo de aplicación.";
$ap->crear(array("modulo"=>$modulo["modulo"],"permiso"=>$permiso,"nombre"=>$nombre,"descripcion"=>$descripcion,"fecha"=>$fechas->hoy(),"hora"=>$fechas->ahora(),"creador"=>$usuario["usuario"]));
/** APLICACION-FUNCION-CREAR **/
$permiso="APLICACION-FUNCION-CREAR";
$nombre="Permite crear nuevas funciones.";
$descripcion="Este permiso permite crear nuevas funciones en el framework.";
$ap->crear(array("modulo"=>$modulo["modulo"],"permiso"=>$permiso,"nombre"=>$nombre,"descripcion"=>$descripcion,"fecha"=>$fechas->hoy(),"hora"=>$fechas->ahora(),"creador"=>$usuario["usuario"]));
/** APLICACION-FUNCION-MODIFICAR **/
$permiso="APLICACION-FUNCION-MODIFICAR";
$nombre="Modificar Funciones Propias";
$descripcion="Permite modificar las funciones propias.";
$ap->crear(array("modulo"=>$modulo["modulo"],"permiso"=>$permiso,"nombre"=>$nombre,"descripcion"=>$descripcion,"fecha"=>$fechas->hoy(),"hora"=>$fechas->ahora(),"creador"=>$usuario["usuario"]));
/** APLICACION-FUNCION-ELIMINAR **/
$permiso="APLICACION-FUNCION-ELIMINAR";
$nombre="Eliminar Funciones Propias";
$descripcion="Permite eliminar las funciones propias.";
$ap->crear(array("modulo"=>$modulo["modulo"],"permiso"=>$permiso,"nombre"=>$nombre,"descripcion"=>$descripcion,"fecha"=>$fechas->hoy(),"hora"=>$fechas->ahora(),"creador"=>$usuario["usuario"]));
/** APLICACION-FUNCIONES-MODIFICAR **/
$permiso="APLICACION-FUNCIONES-MODIFICAR";
$nombre="Modificar cualquier función";
$descripcion="Permite modificar cualquier función existente en el sistema.";
$ap->crear(array("modulo"=>$modulo["modulo"],"permiso"=>$permiso,"nombre"=>$nombre,"descripcion"=>$descripcion,"fecha"=>$fechas->hoy(),"hora"=>$fechas->ahora(),"creador"=>$usuario["usuario"]));
/** APLICACION-FUNCIONES-ELIMINAR **/
$permiso="APLICACION-FUNCIONES-ELIMINAR";
$nombre="Eliminar cualquier función.";
$descripcion="Permite eliminar cualquier funcion registrada en el sistema.";
$ap->crear(array("modulo"=>$modulo["modulo"],"permiso"=>$permiso,"nombre"=>$nombre,"descripcion"=>$descripcion,"fecha"=>$fechas->hoy(),"hora"=>$fechas->ahora(),"creador"=>$usuario["usuario"]));
/** APLICACION-EMPRESA-VISUALIZAR **/
$permiso="APLICACION-EMPRESA-VISUALIZAR";
$nombre="Visualizar Empresa";
$descripcion="Permite visualizar los datos de una empresa que halla sido registrada por el usuario activo.";
$ap->crear(array("modulo"=>$modulo["modulo"],"permiso"=>$permiso,"nombre"=>$nombre,"descripcion"=>$descripcion,"fecha"=>$fechas->hoy(),"hora"=>$fechas->ahora(),"creador"=>$usuario["usuario"]));
/** APLICACION-EMPRESAS-VISUALIZAR **/
$permiso="APLICACION-EMPRESAS-VISUALIZAR";
$nombre="Visualizar cualquier empresa.";
$descripcion="Permite visualizar los datos de cualquier empresa registrada en el sistema.";
$ap->crear(array("modulo"=>$modulo["modulo"],"permiso"=>$permiso,"nombre"=>$nombre,"descripcion"=>$descripcion,"fecha"=>$fechas->hoy(),"hora"=>$fechas->ahora(),"creador"=>$usuario["usuario"]));
/** APLICACION-EMPRESA-CREAR **/
$permiso="APLICACION-EMPRESA-CREAR";
$nombre="Permite crear empresas.";
$descripcion="Permite registrar nuevas empresas en el sistema.";
$ap->crear(array("modulo"=>$modulo["modulo"],"permiso"=>$permiso,"nombre"=>$nombre,"descripcion"=>$descripcion,"fecha"=>$fechas->hoy(),"hora"=>$fechas->ahora(),"creador"=>$usuario["usuario"]));
/** APLICACION-EMPRESA-MODIFICAR **/
$permiso="APLICACION-EMPRESA-MODIFICAR";
$nombre="Modificar Empresa.";
$descripcion="Permite modificar los datos de una empresa que el usuario activo halla registrado en el sistema.";
$ap->crear(array("modulo"=>$modulo["modulo"],"permiso"=>$permiso,"nombre"=>$nombre,"descripcion"=>$descripcion,"fecha"=>$fechas->hoy(),"hora"=>$fechas->ahora(),"creador"=>$usuario["usuario"]));
/** APLICACION-EMPRESAS-MODIFICAR **/
$permiso="APLICACION-EMPRESAS-MODIFICAR";
$nombre="Eliminar cualquier función.";
$descripcion="Permite modificar la información de cualquier empresa registrada en el sistema.";
$ap->crear(array("modulo"=>$modulo["modulo"],"permiso"=>$permiso,"nombre"=>$nombre,"descripcion"=>$descripcion,"fecha"=>$fechas->hoy(),"hora"=>$fechas->ahora(),"creador"=>$usuario["usuario"]));
/** APLICACION-EMPRESA-ELIMINAR **/
$permiso="APLICACION-EMPRESA-ELIMINAR";
$nombre="Eliminar empresa.";
$descripcion="Permite eliminar una empresa que el usuario activo halla registrado en el sistema.";
$ap->crear(array("modulo"=>$modulo["modulo"],"permiso"=>$permiso,"nombre"=>$nombre,"descripcion"=>$descripcion,"fecha"=>$fechas->hoy(),"hora"=>$fechas->ahora(),"creador"=>$usuario["usuario"]));
/** APLICACION-EMPRESAS-ELIMINAR **/
$permiso="APLICACION-EMPRESAS-ELIMINAR";
$nombre="Eliminar empresas.";
$descripcion="Permite eliminar cualquier empresa registrada en el sistema.";
$ap->crear(array("modulo"=>$modulo["modulo"],"permiso"=>$permiso,"nombre"=>$nombre,"descripcion"=>$descripcion,"fecha"=>$fechas->hoy(),"hora"=>$fechas->ahora(),"creador"=>$usuario["usuario"]));
?>