<?php

$ROOT = (!isset($ROOT)) ? "../../../../../" : $ROOT;
require_once($ROOT . "modulos/aplicacion/librerias/Configuracion.cnf.php");
header('Content-Type: application/json');
Sesion::init();

$automatizaciones = new Automatizaciones();
$usuarios = new Aplicacion_Usuarios();
$validaciones = new Validaciones();
$cadenas = new Cadenas();
$fechas = new Fechas();
$moneda = new Moneda();
/*
 * Copyright (c) 2013, Alexis
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
/** Variables Recibidas * */
$v['criterio'] = Request::getValue("criterio");
$v['valor'] = Request::getValue("valor");
$v['inicio'] = Request::getValue("inicio");
$v['final'] = Request::getValue("final");
$v['transaccion'] = Request::getValue("transaccion");
$v['page'] = Request::getValue("page");
$v['perpage'] = Request::getValue("perpage");
$tabla = "aplicacion_clientes";
/** Verificaciones * */
/**
 * Se evalua el comportamiento en caso de no recibir el periodo inicio y final de la consulta para lo 
 * cual se presuponen la fecha de la primera solicitud y la ultima que se hallan registrado por
 * el usuario activo en el sistema de atencion de solicitudes.
 */
$v['inicio'] = empty($v['inicio']) ? "0000-00-00" : $v['inicio'];
$v['final'] = empty($v['final']) ? $fechas->hoy() : $v['final'];

/* * Variables Definidas * */
if (!empty($v['page'])) {
    $pagination = true;
    $page = intval($v['page']);
    $perpage = intval($v['perpage']);
    $n = ( $page - 1 ) * $perpage;
    $limite = "LIMIT $n, $perpage";
} else {
    $pagination = false;
    $page = 1;
    $perpage = 20;
    $n = 0;
    $limite = "LIMIT $n, $perpage";
}

$db = new MySQL(Sesion::getConexion());

/**
 * En este segmento se evalua si se esta recibiendo o no un criterio y un valor a buscar segun el 
 * criterio adicionalmente se contempla la propiedad y responsabilidad del usuario activo sobre los 
 * registros visualizados. En terminos de criterios existe un criterio especial que se utiliza para
 * identificar una peticion en la que solo se desean ver aquellas solicitudes que se encuentran 
 * pendientes de respuesta, ese criterio es "estado", donde no existe ningun campo denominado 
 * estado pero se usa para definir si los registros se muestran como se hace habitualmente o 
 * solamente aquellos que correspondan a peticiones a la espera de respuesta.
 * Nota: $where debe existir ya que en un segmento posterior a este se una como criterio para
 * establecer el numero total de registros que se obtendran establecida la estructura de la
 * consulta.
 * */
if (!empty($v['criterio']) && !empty($v['valor'])) {
    $where = "WHERE("
            . "(`fecha` BETWEEN '" . $v['inicio'] . "' AND '" . $v['final'] . "')AND"
            . "(`" . $v['criterio'] . "` LIKE '%" . $v['valor'] . "%')"
            . ")";
} else {
    $where = "WHERE("
            . "(`fecha` BETWEEN '" . $v['inicio'] . "' AND '" . $v['final'] . "')"
            . ")";
}

/**
 * En este segmento se realiza una consulta para obtener un preconteo del numero de datos 
 * totales, que se retornara como resultado. Este dato se visualiza en la parte inferior de la tabla 
 * grafica generada, y debe ser retornado en el JSON bajo el indice "total".
 */
$sql['preconteo'] = ("SELECT * FROM `" . $tabla . "` " . $where . ";");
$preconteo = $db->sql_query($sql['preconteo']);
$total = $db->sql_numrows($preconteo);
/**
 * Consulta real que generara resultados
 * 
 */
$sql['consulta'] = "SELECT * FROM `" . $tabla . "` " . $where . " ORDER BY `empresa` DESC " . $limite . ";";
$consulta = $db->sql_query($sql['consulta']);
$ret = array();
while ($fila = $db->sql_fetchrow($consulta)) {
    /**
     * Cada fila representa una solicitud y cada solicitud se le evaluan multiples datos cuyo resultado
     * repercute en los elementos graficos visualizados a manera de estados. En primera instancia se 
     * debe de evaluar el estado general de la solicitud en los indicadores S.R.N.T.A. los datos de esta 
     * evaluación se depositaran en un vector de estados "$e[]" donde su analisis determina el estado
     * general de la solicitud, del cual se asume en primera instancia que es "pendiente" de solucionar
     * es decir ($e['general']=false;) o notificar, pero segun los indicadores recibidos se puede asumir 
     * como "resuelta" ($e['general']=true;).
     */
    $json['empresa'] = $fila['empresa'];
    $json['razon'] = $fila['razon'];
    $json['usuarios'] = $fila['usuarios_maximo'];
    $json['fecha'] = $fila['fecha'];
    $json['hora'] = $fila['hora'];
    $json['creador'] = $fila['creador'];
    array_push($ret, $json);
}

$db->sql_close();
echo json_encode(array("sql" => $cadenas->condenzar($sql['consulta']), "uid" => $usuario['usuario'], "page" => $page, "total" => $total, "data" => $ret));
?>