<?php
/*
 * Copyright (c) 2016, Alexis
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
$v['inicio']=Request::getValue("inicio");
$v['final']=Request::getValue("final");
$v['transaccion']=Request::getValue("transaccion");
$v['url']="modulos/aplicacion/formularios/instaladores/modulos/consultar.json.php?"
        . "uid=".$v['uid']
        . "&criterio=".$v['criterio']
        . "&valor=".$v['valor']
        . "&inicio=".$v['inicio']
        . "&final=".$v['final']
        . "&transaccion=".$v['transaccion']."&time=".time();

/** Creación de la tabla **/
$tabla = new Grid(array("id" =>"Grid_". time(), "url" => $v['url']));
$tabla->boton('btnInstalar', 'Instalar', 'modulo', "MUI.Aplicacion_Instalador_Modulo", "instalacion");
//$tabla->boton('btnCrear', 'Registrar', '', "MUI.Aplicacion_Empresa_Crear", "new");
//$tabla->boton('btnModificar', 'Modificar', 'solicitud', "MUI.Aplicacion_Empresa_Modificar", "edit");
////$tabla->boton('btnTrasferir', 'Trasferir', 'solicitud', "MUI.Solicitudes_Trasferir", "edit");
//$tabla->boton('btnEliminar', 'Eliminar', 'solicitud', "MUI.Aplicacion_Empresa_Eliminar", "pEliminar");
//$tabla->boton('btnFiltrar', 'Filtrar', '', "MUI.Tesoreria_Solicitudes_Filtrar_General", "pBuscar");
//$tabla->boton('btnResponsables', 'Información', 'solicitud', "MUI.Solicitudes_Responsables", "pInformacion");

$tabla->columna('cModulo', 'Modulo', 'modulo', 'string', '90', 'center', 'false');
$tabla->columna('cDeatalles', 'Detalles', 'detalles', 'string', '450', 'left', 'false');
//$tabla->columna('cUsuarios', 'Usuarios', 'usuarios', 'string', '90', 'right', 'false');
//$tabla->columna('cDetalles', 'Detalles', 'detalles', 'string', '570', 'left', 'false');
$tabla->columna('cFecha', 'Fecha', 'fecha', 'date', '90', 'center', 'false');
$tabla->columna('cHora', 'Hora', 'hora', 'date', '90', 'center', 'false');
$tabla->columna('cCreador', 'Creador', 'creador', 'string', '90', 'center', 'false');
$tabla->generar();
?>