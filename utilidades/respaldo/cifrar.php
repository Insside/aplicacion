<?php $ROOT = (!isset($ROOT)) ? "../../../../" : $ROOT;require_once($ROOT . "librerias/Encriptar.class.php");$archivo = "1380539859.rsa";$e =new imis\Encriptar();$e->descifrar_archivo($archivo);?>