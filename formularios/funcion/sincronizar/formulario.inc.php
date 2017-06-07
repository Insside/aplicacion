<?php
/*
 * Copyright (c) 2017, Jose Alexis Correa Valencia
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
//if(!isset($f)){$f=new Forms(time());}
$funcion=$v->recibir("funcion");
$f->oculto("funcion",$funcion);
$f->oculto("grid",$v->recibir("grid"));
$html="<p>Advertencia: se dispone a sincronizar una función, con una versión remota del sistema, la versión remota evaluara la sincronización del procedimiento.</p>";
$f->campos['icono']="<div class=\"i128x128_sincro\"></div>";
$f->campos['info']=$html;
$f->campos['funcion']=$f->getText(array("id"=>"funcion","value"=>$funcion,"class"=>"codigo require","readonly"=>true));
$f->campos['empresa'] = $f->getSelect(array("id" => "empresa", "values" => $ae->empresas(), "option" => "empresa", "label" => "nombre", "class" => "empresa campo", "selected" => "9010221950"));
$f->campos['eliminar'] = $f->button("eliminar", "submit", "Confirmar");
$f->campos['cancelar'] = $f->button("cancelar" .$f->id, "button", "Cancelar");
// Celdas
$f->celdas['icono'] = $f->celda("",$f->campos['icono']);
$f->celdas['info'] = $f->celda("",$f->campos['info']);
$f->celdas['funcion'] = $f->celda("Función a sincronizar:",$f->campos['funcion']);
$f->celdas['empresa'] = $f->celda("Servidor Destino:",$f->campos['empresa']);
// Filas
$f->fila["f1"] = $f->fila($f->celdas['icono'].$f->celdas['info']);
$f->fila["f2"] = $f->fila($f->celdas['funcion']);
$f->fila["f3"] = $f->fila($f->celdas['empresa']);

/** Filas **/
$f->filas($f->fila['f1']);
$f->filas($f->fila['f2']);
$f->filas($f->fila['f3']);
/** Botones **/
$f->botones($f->campos['eliminar'],"inferior-derecha");
$f->botones($f->campos['cancelar'],"inferior-derecha");
/** JavaScripts **/
$f->windowTitle("Función / Sincronización ","1.2");
$f->windowResize(array("autoresize"=>false,"width"=>"320","height"=>"320"));
$f->windowCenter();
$f->setAudio(array("src"=>$am->getAudio("002-001"),"autoplay"=>true));
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
?>
