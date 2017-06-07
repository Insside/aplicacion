<?php

if (!class_exists('Aplicacion_Usuarios')) {

    require_once(ROOT . "modulos/aplicacion/librerias/Configuracion.cnf.php");
    require_once(ROOT . "modulos/usuarios/librerias/Usuarios.class.php");
    require_once(ROOT . "modulos/usuarios/librerias/Usuarios_Jerarquias.class.php");
    require_once(ROOT . "modulos/usuarios/librerias/Usuarios_Politicas.class.php");

    class Aplicacion_Usuarios extends Usuarios{ 
    }

}
?>