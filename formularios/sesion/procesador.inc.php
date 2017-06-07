<?php
$usuarios = new Aplicacion_Usuarios();
$validaciones = new Validaciones();
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
$usuario = $validaciones->recibir("usuario");
$clave = $validaciones->recibir("clave");
$empresa = $validaciones->recibir("empresa");

if ((!empty($usuario) && !empty($clave) && !empty($empresa))) {
    Sesion::Iniciar($usuario, $clave, $empresa);
    if (Sesion::Iniciada()) {
        echo("\n<!-- Clave Correcta //-->");
        echo("<div class=\"succes\"><b>Notificación</b>: Bienvenido. </div>");
        //print_r($_SESSION);
        $f->windowClose();
        $f->JavaScript("window.location.href=\"index.php?id={$f->id}\";");
    } else {
        echo("\n<!-- Clave Incorrecta //-->");
        echo("<div class=\"error\"><b>Advertencia</b>: Clave incorrecta. </div>");
        require_once(PATH . "/formulario.inc.php");
    }
}
?>
