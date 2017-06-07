<?php
if(!isset($ROOT)){
  $ROOT='../../';
}$opcion=@$_REQUEST['opcion'];
if($opcion=="funciones"){
  require_once($ROOT."modulos/aplicacion/funciones/funciones.xhr.php");
}elseif($opcion=="funcion"){
  require_once($ROOT."modulos/aplicacion/funciones/funcion.xhr.php");
}elseif($opcion=="crear"){
  require_once($ROOT."modulos/aplicacion/funciones/acciones/crear.xhr.php");
}else{
  ?><table width="100%" height="100%"><tr><td width="100%" height="100%" align="center" valign="middle" background="imagenes/fondos/fondo-claro-1000x1000.jpg"><img src="imagenes/640x380/mAplicacion.fw.png" width="640" height="380" /></td></tr></table><?php
}?>