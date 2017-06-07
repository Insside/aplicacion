<?php
$ROOT = (!isset($ROOT)) ? "../../../../" : $ROOT;
require_once($ROOT . "modulos/usuarios/librerias/Configuracion.cnf.php");
$aplicacion = new Aplicacion_Aplicacion();

$fechas = new Fechas();
$ae = new Aplicacion_Clientes();

$uu = new Usuarios_Usuario(Sesion::getUsuario());
$up = new Usuarios_Perfil($uu->getPerfil());

$empresa = $ae->consultar(Sesion::getValue("empresa"));
/**
 * Foto pequeña
 */
$foto = $up->getFoto();
if (!empty($foto)) {
    $uri = "{$empresa["empresa"]}/002/{$foto}";
    $src = "archivos/imagen.php?image={$uri}&width=52&height=52";
    $foto = "<img src=\"{$src}\" alt=\"Usuario\"/>";
} else {
    $uri = "{$empresa["empresa"]}/002/{$foto}";
    $foto = "<div class=\"i048x048_user\"></div>";
}
?>
<div id="desktopTitlebarWrapper">
    <div id="desktopTitlebar">
        <!-- Logotipos & MArcas //--> 
        <div class="marca">
            <div class="logo_insside_64x52 o50"></div>
            <div class="plataforma o50">INSSIDE FRAMEWORK</div>
            <div class="aplicativo o90">v<?php echo($aplicacion->getVersion()); ?></div>
            <div class="plataforma o50">ERP-CRM-SRM</div>
        </div>
        <!-- Reloj //-->
        <div class="reloj">
            <div class="etiqueta">FECHA & HORA</div>
            <div id="divLocalClock" class="MUI clock"><?php echo($fechas->ahora()); ?></div>
            <div class="etiqueta"><?php echo($fechas->hoy()); ?></div>
        </div>

        <!--centro--//-->
        <div class="corporativo">
            <div class="etiqueta rut"><?php echo($empresa["rut"]); ?></div>
            <div class="empresa"><b><?php echo($empresa["nombre"]); ?></b></div>            
            <div class="etiqueta vpn"><?php echo($empresa["vpn"]); ?></div>
        </div>
        <!--/centro--//-->


        <!-- Usuario //-->
        <div class="perfil">
            <a href="#" onclick="MUI.Aplicacion_Opciones('<?php echo($usuario["usuario"]); ?>');">
                <div class="foto"><?php echo($foto); ?></div>
                <div class="etiqueta">USUARIO</div>
                <div class="nombre"><?php echo($up->getNombre()); ?></div>
                <div class="etiqueta"><?php echo(Sesion::getIP()); ?></div>
            </a>
        </div>
        <!-- Usuario //-->
        <div class="notificaciones">
            <a href="#" onclick="MUI.Comunicaciones_Mensajes();">
                <div class="i048x048_gmail"></div>
                <span class="jewelCount">
                    <span class="ugh">99</span> 
                </span>
            </a>
            <a href="#" onclick="">
                <div class="i048x048_news"></div>
                <span class="jewelCount">
                    <span class="ugh">99</span> 
                </span>
            </a>
        </div>



        <!-- Conector //-->
        <div class="reloj_remoto">
            <div class="etiqueta">ULTIMA CONEXIÓN  </div>
            <div id="divRemoteClock" class="MUI Clock"><?php echo($fechas->ahora()); ?></div>
            <div class="etiqueta"><?php echo($fechas->hoy()); ?></div>
        </div>



        <!--
        <h1 class="applicationTitle">INSSIDE 2015</h1>
        <h2 class="tagline">AGUAS DE BUGA <span class="taglineEm">S.A. E.S.P. 2015</span></h2>
        <div id="topNav">
          <ul class="menu-right">
            <li>Bienvenido! <a href="#" onclick="InssideUI.notification('Do Something');
                return false;"><?php echo($usuario['alias']); ?></a></li>
            <li><a href="<?php echo(basename(__FILE__)); ?>?accion=finalizar">Salir</a></li>
          </ul>
        </div>
        -->


    </div>
</div>
<!-- JavaScript v0.1 //-->
<script type="text/javascript">
    var localClock = new MUI.Clock($("divLocalClock"), {});
    //var remoteClock= new MUI.Clock($("divRemoteClock"), {"callBackTime ":30,"callBack":"alert('hola');"});
    MUI.NotificationManager = new MUI.Notification();
//  var title="Bienvenid@.";
//  var message="Ésta es una notificación de ejemplo, para demostrar la sencillez de uso.";
//  MUI.NotificationManager.show({"title":title,"message":message});
</script>
