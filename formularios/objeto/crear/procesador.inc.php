<?php

$ROOT = (!isset($ROOT)) ? "../../../" : $ROOT;
require_once($ROOT . "modulos/aplicacion/librerias/Configuracion.cnf.php");
$cadenas = new Cadenas();
$fechas = new Fechas();
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
$transaccion = Request::getValue("transaccion");
$tabla = $v->recibir("tabla");


$db = new MySQL(Sesion::getConexion());
$consulta = $db->sql_query("DESCRIBE `$tabla`");
$campos = array();
while ($fila = $db->sql_fetchrow($consulta)) {
    array_push($campos, $fila);
}
$db->sql_close();

$classname = $cadenas->capitalizar($tabla);
$dtemp = explode("_", $classname);
$package = $dtemp[0];
$modulo = strtolower($dtemp[0]);
$plural = $classname . ".class.php";

$singular = substr($classname, 0, strlen($classname) - 1);



$codigo = "&lt;?php";
$codigo .= "\n\t \$ROOT = (!isset(\$ROOT)) ? \"../../../\":\$ROOT;";
$codigo .= "\n\t /**";
$codigo .= "\n\t * @Package /" . strtolower($package);
$codigo .= "\n\t * @Category Object";
$codigo .= "\n\t * @Author Jose Alexis Correa Valencia <jalexiscv@gmail.com>";
$codigo .= "\n\t * @Copyright 2012 - 2022 www.insside.com";
$codigo .= "\n\t * @license    http://www.insside.com/licenses/cluf.txt    CLUF";
$codigo .= "\n\t * @Version 1.0.0 " . $fechas->hoy() . " - " . $fechas->ahora();
$codigo .= "\n\t **/";
$codigo .= "\n\t if (!class_exists(\"{$singular}\")) {";
require_once(PATH . '/includes/require.inc.php');
$codigo .= "\n\t\t class " . $singular . "{";
require_once(PATH . '/includes/properties.inc.php');
require_once(PATH . '/includes/methods.inc.php');
require_once(PATH . '/includes/getters.inc.php');
require_once(PATH . '/includes/setters.inc.php');
require_once(PATH . '/includes/actions.inc.php');
$codigo .= "\n\t\t\t}";
$codigo .= "\n\t\t}";
$codigo .= "\n?>\n";
/** Campos * */
$f->campos['editor'] = $f->iAreaCode("codigo", "php", $codigo, $clase = "", $height = "440");
/** celdas * */
$f->celdas['editor'] = $f->celda("Código Generado Automáticamente", $f->campos['editor']);
/** Filas * */
$f->fila['editor'] = $f->fila($f->celdas['editor']);
/** Final * */
$f->filas($f->fila['editor']);
/** JavaScripts * */
$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'), \"Crear Clase - Entidad v1.0\");");
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'), {width:640, height:480});");
$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
?>