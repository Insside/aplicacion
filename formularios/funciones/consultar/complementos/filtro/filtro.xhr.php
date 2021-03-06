<?php
$ROOT = (!isset($ROOT)) ? "../../../../../../../" : $ROOT;
require_once($ROOT."modulos/aplicacion/librerias/Configuracion.cnf.php");
Sesion::init();
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
$usuario = Sesion::usuario();
$validaciones = new Validaciones();
$transaccion = Request::getValue("transaccion");
$trasmision = Request::getValue("trasmision");
$url['reconexion'] = $ROOT . "modulos/aplicacion/formularios/sesion/reconexion/formulario.inc.php";
$url['formulario']=$ROOT . "modulos/aplicacion/formularios/funciones/consultar/complementos/filtro/formulario.inc.php";
$url['procesador']=$ROOT . "modulos/aplicacion/formularios/funciones/consultar/complementos/filtro/procesador.inc.php";
$f = new Forms($transaccion);
echo($f->apertura());
if (Sesion::Iniciada()) {
  if (empty($trasmision)) {
    require_once($url['formulario']);
  } else {
    require_once($url['procesador']);
    require_once($url['formulario']);
  }
} else {
  require_once($url['reconexion']);
}
echo($f->generar());
echo($f->controles());
echo($f->cierre());
?>