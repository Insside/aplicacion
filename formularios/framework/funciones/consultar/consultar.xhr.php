<?php
$ROOT = (!isset($ROOT)) ? "../../../../../../" : $ROOT;
require_once($ROOT . "modulos/aplicacion/librerias/Configuracion.cnf.php");
$validaciones=new Validaciones();
/*
 * Copyright (c) 2015, Alexis
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
$usuario=Sesion::usuario();
$clase= Request::getValue('clase');

$v['uid']=$usuario['usuario'];
$v['criterio']=Request::getValue("criterio");
$v['valor']=Request::getValue("valor");
$v['inicio']=Request::getValue("inicio");
$v['fin']=Request::getValue("fin");
$v['transaccion']=Request::getValue("transaccion");
$v['url']="modulos/aplicacion/formularios/framework/funciones/consultar/consultar.json.php?"
        . "clase=".$clase
        . "&uid=".$v['uid']
        . "&criterio=".$v['criterio']
        . "&valor=".$v['valor']
        . "&inicio=".$v['inicio']
        . "&fin=".$v['fin']
        . "&transaccion=".$v['transaccion'];

/** Creación de la tabla **/
$tabla = new Grid(array("id" =>"Grid_". time(), "url" => $v['url'],"perPageOptions"=>array(100,200)));
$tabla->boton('btnCrear', 'Crear',array("indice"=>"","directo"=>$clase), "MUI.Aplicacion_Framework_Funcion_Crear", "new");
$tabla->boton('btnExtraer', 'Procesar',array("indice"=>"","directo"=>$clase), "MUI.Aplicacion_Framework_Funcion_Procesador", "extraer");
$tabla->boton('btnExplorar', 'Explorar', 'funcion', "MUI.Aplicacion_Framework_Funcion_Explorar", "explorar");
$tabla->boton('btnEliminar', 'Eliminar', 'funcion', "MUI.Aplicacion_Framework_Funcion_Eliminar", "pEliminar");
$tabla->boton('btnModificar', 'Modificar', 'funcion', "MUI.Aplicacion_Framework_Funcion_Modificar", "edit");
$tabla->columna('cFuncion', 'Funcion', 'funcion', 'string', '90', 'center', 'false');
$tabla->columna('cDetalles', 'Detalles', 'detalles', 'string', '640', 'left', 'false');
$tabla->columna('cFecha', 'Fecha', 'fecha', 'date', '90', 'center', 'false');
$tabla->columna('cHora', 'Hora', 'hora', 'string', '80', 'center', 'false');
$tabla->generar();
?>