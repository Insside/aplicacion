<?php
/** Variables * */
/** Valores * */
$message= "<p>La sesión ha finalizado por favor ingrese nuevamente. "
        . "Es posible que esta notificación se produzca por fallos en la conexión con el servidor corporativo, "
        . "por su seguridad y la de la entidad, o debido a reiteradas desconexiones el sistema ha "
        . "determinado que deberá iniciar sesión nuevamente. Si este mensaje se torna persistente por "
        . "favor contacte al departamento de sistemas e indique que está presentando problemas de "
        . "conectividad y requiere que su conexión con la intranet sea verificada.</p>";
/** Campos * */
$f->campos['continuar'] = $f->button("continuar" . $f->id, "button", "Reconectarse");
/** Celdas * */
/** Filas * */
$f->fila["info"] =$f->getNotification(array("image"=>"cancel","message"=>$message));
/** Compilando * */
$f->filas($f->fila['info']);
/** Botones * */
$f->botones($f->campos['continuar'], "inferior-derecha");
/** JavaScripts * */
$f->windowTitle("Notificación Critica","1.1");
$f->windowResize(array("autoresize"=>false,"width"=>"480","height"=>"200"));
$f->windowCenter();
$f->setAudio(array("src"=>"modulos/aplicacion/multimedia/audios/sesion-desconexion.mp3","autoplay"=>true));
$f->eClick("continuar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));location.reload(true);");
?>