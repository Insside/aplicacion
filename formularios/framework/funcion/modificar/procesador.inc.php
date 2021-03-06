<?php

/*
 * Copyright (c) 2014, Jose Alexis Correa Valencia
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
/** procesador.inc.php Codigo fuente archivo procesador * */
$cadenas = new Cadenas();
$fechas = new Fechas();
$v = new Validaciones();
$aff = new Aplicacion_Framework_Funciones();
/** Campos Recibidos * */
$p = array();
$p['funcion'] = $v->recibir("funcion");
$p['clase'] = $v->recibir("clase");
$p['tipo'] = $v->recibir("tipo");
$p['nombre'] = $v->recibir("nombre");
$p['parametros'] = $v->recibir("parametros");
$p['descripcion'] = urlencode($v->recibir("descripcion"));
$p['fecha'] = $fechas->hoy();
$p['hora'] = $fechas->ahora();
$p['creador'] = $v->recibir("creador");
foreach ($p as $campo => $valor) {
  $aff->actualizar($p["funcion"], $campo, $valor);
}
//require_once($ROOT."modulos/aplicacion/formularios/framework/funcion/modificar/sincronizador.inc.php");
/** JavaScripts * */
$f->windowClose();
$f->gridRefresh($v->recibir("itable"));
?>