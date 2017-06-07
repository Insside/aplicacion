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
$funcion=$v->recibir("funcion");
$f->oculto("funcion",$funcion);
$f->oculto("grid",$v->recibir("grid"));
$html = "<div class=\"i100x100_irreversible\" style=\"float: left;\"></div>";
$html.="<div class=\"notificacion\"><p><b>Eliminar Función.</b><br>";
$html.="Se dispone a eliminar una función se le solicita considere que esta ";
$html.="acción es irreversible antes de proceder, confirme o cancele la presente notificación para poder continuar.";
$html.="<b>Funcion</b>: " . $funcion;
$html.="</p></div>";
$f->campos['eliminar'] = $f->button("eliminar", "submit", "Confirmar");
$f->campos['cancelar'] = $f->button("cancelar" .$f->id, "button", "Cancelar");
// Celdas
$f->celdas['info'] = $f->celda("", $html, "", "notificacion");
// Filas
$f->fila["info"] = $f->fila($f->celdas['info'], "notificacion");
//Compilacion
$f->filas($f->fila['info']);
/** Botones **/
$f->botones($f->campos['eliminar'],"inferior-derecha");
$f->botones($f->campos['cancelar'],"inferior-derecha");
/** JavaScripts **/
$f->windowTitle("Función / Modificar ","1.2");
$f->windowResize(array("autoresize"=>false,"width"=>"320","height"=>"200"));
$f->windowCenter();
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
?>
