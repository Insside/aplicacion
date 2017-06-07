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
/** Variables * */
$cadenas = new Cadenas();
$fechas = new Fechas();
$validaciones = new Validaciones();
$ae = new Aplicacion_Clientes();
/** Valores * */
$valores['usuario'] = "";
$valores['clave'] = "";
/** Campos * */
$f->campos['logo'] = "<img class=\"avatar\" src=\"imagenes/logo-insside.png\" />";
$f->campos['facebook'] = "<img class=\"\" src=\"modulos/aplicacion/imagenes/facebook-login-button.png\" width=\"100%\" />";
$f->campos['usuario'] = $f->getText(array("id" => "usuario", "type" => "text", "value" => $valores['usuario'], "maxlength" => "64", "class" => "user required campo", "placeholder" => "Usuario / Alias"));
$f->campos['clave'] = $f->getText(array("id" => "clave", "type" => "password", "value" => $valores['clave'], "maxlength" => "64", "class" => "password required campo", "placeholder" => "Contraseña / Clave"));
$f->campos['empresa'] = $f->getSelect(array("id" => "empresa", "values" => $ae->getList(), "option" => "empresa", "label" => "nombre", "class" => "empresa campo", "selected" => ""));
$f->campos['ayuda'] = $f->button("ayuda" . $f->id, "button", "Ayuda");
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button", "Cancelar");
$f->campos['continuar'] = $f->button("continuar" . $f->id, "submit", "Continuar", "signing");
/** Celdas * */
$f->celdas["logo"] = $f->celda("", $f->campos['logo'], "", "sinfondo");
$f->celdas["facebook"] = $f->celda("", $f->campos['facebook'], "", "sinfondo");
$f->celdas["usuario"] = $f->celda("", $f->campos['usuario'], "", "sinfondo");
$f->celdas["clave"] = $f->celda("", $f->campos['clave'], "", "sinfondo");
$f->celdas["empresa"] = $f->celda("", $f->campos['empresa'], "", "sinfondo");
/** Filas * */
$f->fila["fila0"] = $f->fila($f->celdas["logo"]);
$f->fila["fila1"] = $f->fila($f->celdas["facebook"]);
$f->fila["fila2"] = $f->fila($f->celdas["usuario"]);
$f->fila["fila3"] = $f->fila($f->celdas["clave"]);
$f->fila["fila4"] = $f->fila($f->celdas["empresa"]);
$f->fila["fila5"] = $f->fila($f->campos['continuar']);
$f->fila["fila6"] = $f->fila("<a href=\"#\" class=\"requestpassword\" id=\"requestpassword" . $f->id . "\">¿Has olvidado tu contraseña?</a>");

/** Compilando * */
$f->filas("<div class=\"sesion\">");
$f->filas($f->fila['fila0']);
//$f->filas($f->fila['fila1']);
$f->filas($f->fila['fila2']);
$f->filas($f->fila['fila3']);
$f->filas($f->fila['fila4']);
$f->filas($f->fila['fila5']);
$f->filas($f->fila['fila6']);
$f->filas("</div>");
/** Botones * */
//$f->botones($f->campos['ayuda'], "inferior-izquierda");
//$f->botones($f->campos['cancelar'], "inferior-derecha");
//$f->botones($f->campos['continuar'], "inferior-derecha");
/** JavaScript * */
$f->windowTitle("Iniciar Sesión","3.1");
$f->windowResize(array("autoresize"=>false,"width"=>"350","height"=>"500"));
$f->windowCenter();

$f->setAudio(array("src"=>"modulos/aplicacion/multimedia/audios/sesion-bienvenido.mp3","autoplay"=>true));
$f->eClick("requestpassword" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));MUI.Usuarios_Recuperar_Clave();");
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
?>