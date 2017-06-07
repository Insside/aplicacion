<?php
$ROOT = (!isset($ROOT)) ? "../../../../../../" : $ROOT;
require_once($ROOT . "modulos/aplicacion/librerias/Configuracion.cnf.php");
$v = new Validaciones();
$transaccion = Request::getValue("transaccion");
$clase=$v->recibir("clase");
?>
<div id="diviSynchrony" class="iSynchrony"></div>
<script>
  var synchrony = new iSynchrony($("diviSynchrony"), {
    'debug': true,
    'url': 'modulos/aplicacion/formularios/framework/estilos/sincronizar/sincronizar.json.php?clase=<?php echo($clase);?>'
  });
</script>