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

/** Variables **/
$sesion=new Sesion();
$cadenas = new Cadenas();
$fechas = new Fechas();
$v = new Validaciones();
$ae=new Aplicacion_Clientes();
$am=new Aplicacion_Modulos();
/** Valores **/
$modulo=$am->consultar($v->recibir("modulo"));
$usuario=Sesion::usuario();
$info="<div class=\"i128x128_instalador float-left\"></div><p class=\"padding-left-10px\">Por favor elija la empresa a la cual le será instalado el modulo que "
        . "ha seleccionado, una vez definida la empresa presione continuar para "
        . "concluir el procedimiento. La instalación relaciona la creación de "
        . "las estructuras de datos necesarias para soportar el modulo en la base "
        . "de datos del cliente, y se realiza de forma totalmente automatizada.</p>";
/** Campos **/
$f->oculto("itable",$v->recibir("itable"));
$f->oculto("modulo",$modulo["modulo"]);
$f->campos['modulo'] = $f->campo("modulo","<b>".$modulo["modulo"]."</b> - ".$modulo["titulo"],"");
$f->campos['empresa'] = $f->getSelect(array("id" => "empresa", "values" => $ae->empresas(), "option" => "empresa", "label" => "nombre", "class" => "empresa campo", "selected" => ""));
$f->campos['ayuda']=$f->button("ayuda".$f->id, "button","Ayuda");
$f->campos['cancelar']=$f->button("cancelar".$f->id, "button","Cancelar");
$f->campos['continuar']=$f->button("continuar".$f->id, "submit","Continuar");
/** Celdas **/
$f->celdas["info"]=$f->celda("",$info);
$f->celdas["modulo"]=$f->celda("Módulo Seleccionado:",$f->campos['modulo']);
$f->celdas["empresa"]=$f->celda("Empresa Contratante:",$f->campos['empresa']);
/** Filas **/
$f->fila["fila1"]=$f->fila($f->celdas["info"]);
$f->fila["fila2"]=$f->fila($f->celdas["modulo"]);
$f->fila["fila3"]=$f->fila($f->celdas["empresa"]);
/** Compilando **/
$f->filas($f->fila['fila1']);
$f->filas($f->fila['fila2']);
$f->filas($f->fila['fila3']);
/** Botones **/
$f->botones($f->campos['ayuda'], "inferior-izquierda");
$f->botones($f->campos['cancelar'], "inferior-derecha");
$f->botones($f->campos['continuar'], "inferior-derecha");
/** JavaScripts **/
$f->JavaScript("MUI.titleWindow($('".($f->ventana)."'),'Instalación de Modulos <span class=\"version\">v1.0</span>');");
$f->JavaScript("MUI.resizeWindow($('".($f->ventana)."'),{width:480,height:400});");
$f->JavaScript("MUI.centerWindow($('".$f->ventana."'));");$f->eClick("cancelar".$f->id,"MUI.closeWindow($('".$f->ventana."'));");
?>