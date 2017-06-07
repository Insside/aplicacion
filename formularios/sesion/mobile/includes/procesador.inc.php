<?php

$usuario = Request::getValue("usuario");
$clave = Request::getValue("clave");
$empresa = Request::getValue("empresa");
$tid =time();
if ((!empty($usuario) && !empty($clave) && !empty($empresa))) {
    Sesion::Iniciar($usuario, $clave, $empresa);
    if (Sesion::Iniciada()) {
        $alias=Sesion::getValue("alias");
        $p->addContent("<h2>Bienvenido {$alias}!</h2>");
        $p->addContent("<a href=\"/framework/modulos/mobile.php?tid={$tid}\" data-prefetch=\"true\" data-role=\"button\" data-ajax=\"false\">Continuar</a>");
        $p->addContent(session_id());
    } else {
        $p->addContent("<h2>Error</h2>");
        $p->addContent("<p>Usuario: {$usuario}<br>Clave: {$clave}<br>Empresa: {$empresa}</p>");
        $p->addContent("<a href=\"sesion.php?tid={$tid}\" data-prefetch=\"true\" data-role=\"button\" data-ajax=\"false\">Continuar</a>");
    }
}
?>