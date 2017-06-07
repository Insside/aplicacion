<?php
define("PATH", dirname(__FILE__));
define('ROOT', PATH . "/../../../../../");
/** Librerias Requeridas * */
require_once(ROOT . "librerias/Configuracion.mob.php");
require_once(ROOT . "modulos/aplicacion/librerias/Aplicacion_Clientes.class.php");
Sesion::init();
/** Variables Declarables * */
$ac = new Aplicacion_Clientes();
$clientes = $ac->getList();
$j = new Mobile();
/**
 * Config "html" and "head" tag.
 */
$j->head()->title("Sesion");
/**
 * Create and config a jqmPage object.
 */
$p = new Page("sesion");
$p->setFullScreen(true);
$p->setDialog(true);
$p->theme("a");
$p->title("Insside 2017");
$p->addAttribute(new Attribute("data-dom-cache","false"));
$p->addAttribute(new Attribute("data-ajax","false"));
$p->addAttribute(new Attribute("data-transition", "slidedown"));
$p->addAttribute(new Attribute("data-close-button", "right"));
/** Encabezado * */
$p->header()->theme("a");
//$p->header()->addButton("Inicio", "./", "", "home");
$p->header()->position("fixed");
//$p->header()->items()->get(1)->attribute("data-iconpos", "notext")->attribute("rel", "external");
/** Cuerpo * */
$transaccion = Request::getValue("transaccion");
if (empty($transaccion)) {
    require_once(PATH . "/includes/formulario.inc.php");
} else {
    require_once(PATH . "/includes/procesador.inc.php");
}
/** Cuerpo * */
/** Add the page to jqmPhp object. */
$j->addPage($p);
/** Generate the HTML code. * */
echo($j);
?>