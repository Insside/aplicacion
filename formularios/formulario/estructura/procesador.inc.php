<?php
$ROOT = (!isset($ROOT)) ? "../../../" : $ROOT;
require_once($ROOT . "modulos/aplicacion/librerias/Configuracion.cnf.php");
/*
 * Copyright (c) 2013, Alexis
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * * Redistributions of source code must retain the above copyright notice, this
 *   list of conditions and the following disclaimer.
 * * Redistributions in binary form must reproduce the above copyright notice,
 *   this list of conditions and the following disclaimer in the documentation
 *   and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */
$validaciones=new Validaciones();
$transaccion = Request::getValue('transaccion');
$tabla =  Request::getValue('tabla');
$cadenas = new Cadenas();

$db = new MySQL(Sesion::getConexion());
$consulta = $db->sql_query("DESCRIBE `$tabla`");
$campos=array();
while ($fila = $db->sql_fetchrow($consulta)) {
  array_push($campos, $fila);
}
$db->sql_close();




$conteo = 0;
$codigo = "&lt;?php\n";
$codigo.= "\n/** Tabla de Datos **/";
$codigo.= "\n\$f->table=\"{$tabla}\";";
$codigo.= "\n/** Variables **/";
$codigo.= "\n\$cadenas = new Cadenas();";
$codigo.= "\n\$fechas = new Fechas();";
$codigo.= "\n\$r= new Request();";
$codigo.= "\n/** Valores **/\n";
$codigo.= "\$grid=\$r->getValue(\"grid\");\n";
for($i=0;$i<count($campos);$i++){
  $codigo.=("\$d['" . $campos[$i]['Field'] . "']=\$r->getValue(\"_" . $campos[$i]['Field'] . "\");\n");
}
$codigo.= "/** Campos **/\n";
$codigo.= "if(!empty(\$grid)){\$f->oculto(\"grid\",\$grid);}\n";
for($i=0;$i<count($campos);$i++){
  $inicial = stripos($campos[$i]['Type'], "(");
  $final = stripos($campos[$i]['Type'], ")");
  $largo = $final - $inicial;
  if (strcmp($campos[$i]['Type'], "date") == 0) {
    $size = "10";
  } elseif (strcmp($campos[$i]['Type'], "time") == 0) {
    $size = "8";
  } elseif (strstr($campos[$i]['Type'], "enum")) {
    $size = "128";
  } else {
    $size = substr($campos[$i]['Type'], $inicial + 1, $largo - 1);
  }
  if (strcmp($campos[$i]['Null'], "NO") == 0) {
    $required = "required";
  } else {
    $required = "";
  }
  
  $codigo.=("\$f->campos['". $campos[$i]['Field'] . "']=\$f->dynamic(array(\"field\"=>\"" . $campos[$i]['Field']."\",\"value\"=>\$d[\"".$campos[$i]['Field'] ."\"]));\n");
  //$codigo.=("\$f->campos['". $campos[$i]['Field'] . "']=\$f->text(\"" . $campos[$i]['Field']."\",\$valores['".$campos[$i]['Field'] ."'],\"" . $size . "\",\"". $required ."\",true);\n");
}
$codigo.=("\$f->campos['ayuda']=\$f->button(\"ayuda\".\$f->id, \"button\",\"Ayuda\");\n");
$codigo.=("\$f->campos['cancelar']=\$f->button(\"cancelar\".\$f->id, \"button\",\"Cancelar\");\n");
$codigo.=("\$f->campos['continuar']=\$f->button(\"continuar\".\$f->id, \"submit\",\"Continuar\");\n");

$codigo.= "/** Celdas **/\n";
for($i=0;$i<count($campos);$i++){
  $codigo.=("\$f->celdas[\"" .$campos[$i]['Field'] . "\"]=\$f->celda(\"" . $cadenas->capitalizar($campos[$i]['Field']) . ":\",\$f->campos['" .$campos[$i]['Field'] . "']);\n");
}

$codigo.= "/** Filas **/\n";
$conteo = 0;
$ciclo = 0;
for($i=0;$i<count($campos);$i++){
    $conteo++;
  if ($conteo == 1) {
    $ciclo++;
    $codigo.=("\$f->fila[\"fila" . $ciclo . "\"]=\$f->fila(" . "\$f->celdas[\"" . $campos[$i]['Field'] . "\"].");
  } elseif ($conteo== 2||$conteo== 3) {
    $codigo.="\$f->celdas[\"" . $campos[$i]['Field'] . "\"].";
  } elseif ($conteo==4) {
    $codigo.=("\$f->celdas[\"" . $campos[$i]['Field'] . "\"]);\n");
    $conteo = 0;
  }
}

$codigo.= "\n/** Compilando **/\n";
$conteo=0;
$ciclo=0;
for($i=0;$i<count($campos);$i++){
    $conteo++;
  if ($conteo == 1) {
    $ciclo++;
    $codigo.=("\$f->filas(\$f->fila['fila" . $ciclo . "']);\n");
  } elseif ($conteo == 4) {
    $conteo = 0;
  }
}

$codigo.= "/** Botones **/\n";
$codigo.= "\n\$f->botones(\$f->campos['ayuda'], \"inferior-izquierda\");";
$codigo.= "\n\$f->botones(\$f->campos['cancelar'], \"inferior-derecha\");";
$codigo.= "\n\$f->botones(\$f->campos['continuar'], \"inferior-derecha\");";
$codigo.= "\n/** JavaScripts **/\n";
$codigo.= "\n\$f->windowTitle(\"Formulario / Crear\",\"1.0\");";
$codigo.= "\n\$f->windowResize(array(\"autoresize\"=>false,\"width\"=>\"320\",\"height\"=>\"240\"));";
$codigo.= "\n\$f->windowCenter();";
$codigo.= "\n\$f->eClick(\"cancelar\".\$f->id,\"MUI.closeWindow(\$('\".\$f->ventana.\"'));\");";
$codigo.= "\n";
$codigo.= "?>\n";

$f->fila["editor"] = "<pre id=\"editor" . $transaccion . "\">" . $codigo . "</pre>";
$f->filas($f->fila['editor']);
/** JavaScripts **/
$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'), \"Código PHP\");");
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'), {width: 750, height:480});");
$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
?>
<script type="text/javascript">
  var editor<?php echo($transaccion) ?> = ace.edit("editor<?php echo($transaccion) ?>");
  editor<?php echo($transaccion) ?>.setTheme("ace/theme/twilight");
  editor<?php echo($transaccion) ?>.getSession().setMode("ace/mode/php");
</script>
<style type="text/css" media="screen">
  #editor<?php echo($transaccion) ?> {margin: 0;position: relative;top: 0;bottom: 0;left: 0;right: 0;height: 435px;}
</style>