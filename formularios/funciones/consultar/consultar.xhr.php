<?php
$ROOT = (!isset($ROOT)) ? "../../../../../" : $ROOT;
require_once($ROOT . "modulos/aplicacion/librerias/Configuracion.cnf.php");
Sesion::init();
$validaciones=new Validaciones();
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
$usuario=Sesion::usuario();
$v['uid']=$usuario['usuario'];
$v['criterio']=Request::getValue("criterio");
$v['valor']=Request::getValue("valor");
$v['fechainicial']=Request::getValue("fechainicial");
$v['fechafinal']=Request::getValue("fechafinal");
$v['transaccion']=Request::getValue("transaccion");
$v['url']="modulos/aplicacion/formularios/funciones/consultar/consultar.json.php?"
        . "uid=".$v['uid']
        . "&criterio=".$v['criterio']
        . "&valor=".$v['valor']
        . "&fechainicial=".$v['fechainicial']
        . "&fechafinal=".$v['fechafinal']
        . "&transaccion=".$v['transaccion'];

/** Creación de la tabla **/
$tabla = new Grid(array("id" =>"Grid_". time(), "url" => $v['url'],"perPageOptions"=>array("100","200","400","800","1600"))); 
$tabla->boton('btnCrear', 'Crear', '', "MUI.Aplicacion_Funcion_Crear", "new");
$tabla->boton('btnModificar', 'Modificar', 'funcion', "MUI.Aplicacion_Funcion_Modificar", "edit");
$tabla->boton('btnEliminar', 'Eliminar', 'funcion', "MUI.Aplicacion_Funcion_Eliminar", "delete");
$tabla->boton('btnBuscar', 'Buscar', '', "MUI.Aplicacion_Funciones_Filtrar", "search");
$tabla->boton('btnSincronizar', 'Sincronizar', 'funcion', "MUI.Aplicacion_Funcion_Sincronizar", "uploader");
$tabla->columna('cFuncion', 'Función', 'funcion', 'string', '90', 'center', 'false');
//$tabla->columna('cNombre', 'Nombre', 'nombre', 'string', '350', 'left', 'false');
$tabla->columna('cDetalle', 'Detalles', 'detalles', 'string', '650', 'left', 'false');
$tabla->columna('cFecha', 'Creacion', 'creacion', 'date', '75', 'center', 'false');
$tabla->columna('cModificacion', 'Modificación', 'modificacion', 'date', '90', 'center', 'false');

$tabla->generar();
?>