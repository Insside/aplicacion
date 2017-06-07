<?php
$v=new Validaciones();
$fechas=new Fechas();
$ae=new Aplicacion_Estilos();
$itable=$v->recibir("itable");
$dato["estilo"]= urlencode(trim($v->recibir("estilo")));
$dato["identidad"]=urlencode(trim($v->recibir("identidad")));
$dato["clase"]=urlencode(trim($v->recibir("clase")));
$dato["subclase"]=urlencode(trim($v->recibir("subclase")));
$dato["etiqueta"]=urlencode(trim($v->recibir("etiqueta")));
$dato["estado"]=urlencode(trim($v->recibir("estado")));
$dato["css"]=urlencode(stripslashes($v->recibir("css")));
$dato["css_firefox"]=urlencode(stripslashes($v->recibir("css_firefox")));
$dato["css_chrome"]=urlencode(stripslashes($v->recibir("css_chrome")));
$dato["css_iexplorer"]=urlencode(stripslashes($v->recibir("css_iexplorer")));
$dato["css_opera"]=urlencode(stripslashes($v->recibir("css_opera")));
$dato["descripcion"]=urlencode(stripslashes($v->recibir("descripcion")));
$dato["version"]=$v->recibir("version");
$dato["fecha"]=$fechas->hoy();
$dato["hora"]=$fechas->ahora();
$dato["creador"]=$usuario["usuario"];

foreach ($dato as $campo=>$valor){
  $ae->actualizar($dato["estilo"],$campo,$valor);
}
require_once($ROOT . "modulos/aplicacion/formularios/estilo/modificar/sincronizador.inc.php");
/** JavaScripts **/
$f->windowClose();
$f->JavaScript("if(".$itable."){".$itable.".refresh();}");
?>