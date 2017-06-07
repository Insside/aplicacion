<?php
$ROOT = (!isset($ROOT)) ? "../../../../../../../" : $ROOT;
require_once($ROOT . "modulos/tesoreria/librerias/Configuracion.cnf.php");
$v=new Validaciones();
$tsc = new Tesoreria_Solicitudes_Cheques();
$usuario=Sesion::usuario();
$conteo['solicitudes'] = $tsc->conteo("");
?>
<form action="complementos.xhr.php" name="fomulario" id="formulario" method="post" target="_self">
  <input name="accion" type="hidden" value="establecer-filtro" />
  <table align="center" width="100%" style="border:1px; border-color:#666 " border="1">
    <tr><td align="center" bgcolor="#CCCCCC"><b>Solicitudes</b></td></tr>
    <tr><td height="55" valign="middle">
    <p align="center" style="font-size:55px; color:#33C; font-weight:bold">
      <?php echo($conteo['solicitudes']) ?>
    </p></td></tr>
  </table>
  <hr>
    <p>
    Esta cifra representa la totalidad de las solicitudes gestionadas 
    en el sistema, incluyendo la información histórica importada 
    desde la antigua plataforma, la cual es actualmente accesible mediante 
    este módulo y refleja todos los movimientos en tiempo real hasta la fecha.
    </p>
</form>