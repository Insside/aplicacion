<?php

$cadenas = new Cadenas();
$fechas = new Fechas();
$usuarios=new Aplicacion_Usuarios();

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

$itable=Request::getValue("itable");
/** Celdas **/
$usuario=Request::getValue("usuario");
$usuarios->actualizar($usuario,"empleado",Request::getValue("empleado"));
$usuarios->actualizar($usuario,"alias",Request::getValue("alias"));
$usuarios->actualizar($usuario,"clave",Request::getValue("clave"));
$usuarios->actualizar($usuario,"equipo",Request::getValue("equipo"));
$usuarios->actualizar($usuario,"creador",Request::getValue("creador"));
$usuarios->actualizar($usuario,"estado",Request::getValue("estado"));
/** JavaScripts **/
$f->JavaScript("if(".$itable."){".$itable.".refresh();}");
$f->windowClose();
?>