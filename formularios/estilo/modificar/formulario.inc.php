<?php
/** Variables * */
$ae=new Aplicacion_Estilos();
/** Valores * */
$d=$ae->consultar($v->recibir("estilo"));
$d['css']=urldecode($d['css']);

$itable=$v->recibir("itable");
if(!empty($itable)){$f->oculto("itable",$itable);}



/** Filas * */
$_PATH=dirname(__FILE__);
require_once($_PATH."/segmentos/general.inc.php");
require_once($_PATH."/segmentos/firefox.inc.php");
require_once($_PATH."/segmentos/chrome.inc.php");
require_once($_PATH."/segmentos/opera.inc.php");
require_once($_PATH."/segmentos/iexplorer.inc.php");

$f->fila["tabs"] = ""
        . "<ul id=\"tabs\" class=\"TabbedPane\">"
        . "<li><a class=\"tab\" href=\"#\" id=\"it1\">CSS General</a></li>"
        . "<li><a class=\"tab\" href=\"#\" id=\"it3\">Firefox</a></li>"
        . "<li><a class=\"tab\" href=\"#\" id=\"it4\">Chrome</a></li>"
        . "<li><a class=\"tab\" href=\"#\" id=\"it5\">Opera</a></li>"
        . "<li><a class=\"tab\" href=\"#\" id=\"it6\">IExplorer</a></li>"
        . "</ul>";
$f->fila["home"] = ""
        . "<div id=\"home\">"
        . "<div class=\"feature\">" . $f->fila["css_general"] . "</div>"
        . "<div class=\"feature\">" . $f->fila["css_firefox"] . "</div>"
        . "<div class=\"feature\">" . $f->fila["css_chrome"] . "</div>"
        . "<div class=\"feature\">" . $f->fila["css_opera"] . "</div>"
        . "<div class=\"feature\">" . $f->fila["css_iexplorer"] . "</div>"
        . "</div>";
/** Compilando * */
$f->filas($f->fila['tabs']);
$f->filas($f->fila['home']);
/** Botones * */
$f->botones($f->campos['ayuda'], "inferior-izquierda");
$f->botones($f->campos['cancelar'], "inferior-derecha");
$f->botones($f->campos['continuar'], "inferior-derecha");
/** JavaScripts * */
$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'),\"Publicar / Compartir\");");
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'),{width: 750,height:460});");
$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
?>
<script type="text/javascript">
  var tabs = new MUI.TabbedPane('.tab', '.feature', {
    autoplay: false,
    transitionDuration: 500,
    slideInterval: 3000,
    hover: true
  });
</script>