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

/**
 * Description of Aplicacion_Framework_Codigos
 *
 * @author Alexis
 */
class Aplicacion_Framework_Codigos {

  function crear($datos) {
    $db = new MySQL(Router::getDefaultConexion());
    $sql = "INSERT INTO `aplicacion_framework_codigos` SET "
            . "`codigo`='" . $datos['codigo'] . "',"
            . "`funcion`='" . $datos['funcion'] . "',"
            . "`contenido`='" . $datos['contenido'] . "',"
            . "`descripcion`='" . $datos['descripcion'] . "',"
            . "`version`='" . $datos['version'] . "',"
            . "`fecha`='" . $datos['fecha'] . "',"
            . "`hora`='" . $datos['hora'] . "'"
            . ";";
    $db->sql_query($sql);
    $db->sql_close();
  }

  function actualizar($codigo, $campo, $valor) {
    $db = new MySQL(Router::getDefaultConexion());
    $sql = "UPDATE `aplicacion_framework_codigos` "
            . "SET `" . $campo . "`='" . $valor . "' "
            . "WHERE `codigo`='" . $codigo . "';";
    $db->sql_query($sql);
    $db->sql_close();
  }

  function eliminar($codigo) {
    $db = new MySQL(Router::getDefaultConexion());
    $sql = "DELETE FROM `aplicacion_framework_codigos` "
            . "WHERE `codigo`='" . $codigo . "';";
    $db->sql_query($sql);
    $db->sql_close();
  }

  function consultar($codigo) {
    $db = new MySQL(Router::getDefaultConexion());
    $sql = "SELECT * FROM `aplicacion_framework_codigos` "
            . "WHERE `codigo`='" . $codigo . "';";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    $db->sql_close();
    return($fila);
  }

  /**
   * Retona el numero consecutivo asignable a la nueva version del código de la función.
   * @param type $funcion
   * @return type
   */
  function version($funcion) {
    $db = new MySQL(Router::getDefaultConexion());
    $sql = "SELECT * FROM `aplicacion_framework_codigos`  WHERE `funcion`='" . $funcion . "' ORDER BY `codigo` DESC;";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    $db->sql_close();
    return($fila['version'] + 1);
  }

  /**
   * Esta funcion retorna el ultimo codigo almacenado para una función el cua 
   * puede ser la base para la modificación
   * o posterior versionamiento.
   * @param type $funcion
   * @return type
   */
  function ultimo($funcion) {
    $db = new MySQL(Router::getDefaultConexion());
    $sql = "SELECT * FROM `aplicacion_framework_codigos`  WHERE `funcion`='" . $funcion . "' ORDER BY `codigo` DESC;";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    $db->sql_close();
    return(urldecode($fila['contenido']));
  }

  /**
   * Retorna el numero total de funciones asociado a una clase especifica.
   * @param type $clase
   * @return type
   */
  function conteo($funcion) {
    $db = new MySQL(Router::getDefaultConexion());
    $sql = "SELECT COUNT(*) AS  `conteo` FROM `aplicacion_framework_codigos` "
            . "WHERE `funcion`='" . $funcion . "';";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    $db->sql_close();
    return($fila["conteo"]);
  }

}
