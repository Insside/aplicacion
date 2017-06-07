<?php
$ROOT = (!isset($ROOT)) ? "../../../../../../" : $ROOT;
require_once($ROOT . "modulos/aplicacion/librerias/Configuracion.cnf.php");
$v = new Validaciones();
$transaccion = Request::getValue("transaccion");
?>
<style>
  .synchrony{width: 100%;border-style: outset;border: 1px solid #cccccc;}
  .synchrony .header{font-weight: bold;text-align: center; text-transform:capitalize;}
  .synchrony .row{display: table-row;border: 1px solid #cccccc;}
  .synchrony .column {
    display: table-cell;
    border: 1px solid #cccccc;
    padding-left: 4px;
    padding-right:4px;
    float: none;
  }
</style>
<div id="synchrony" class="synchrony"></div>

<script>
  var synchrony = new iSynchrony($("synchrony"), {
    'debug': true,
    'url': 'modulos/aplicacion/formularios/framework/clases/sincronizar/sincronizar.json.php'
  });
</script>