<?php

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

/**
 * Description of Modulos
 *
 * @author Alexis
 */
if (!class_exists('Aplicacion_Modulos')) {

    class Aplicacion_Modulos {

        var $depurador = null;
        var $class = null;

        function Aplicacion_Modulos() {
            
        }

        /**
         * Con sulta los datos de un modulo en la base de datos.
         * @param type $modulo
         * @return type
         */
        function consultar($modulo) {
            $db = new MySQL(Router::getDefaultConexion());
            $sql = ""
                    . "SELECT * "
                    . "FROM `aplicacion_modulos` "
                    . "WHERE `modulo` ='" . $modulo . "' "
                    . "ORDER BY `modulo`;";
            $consulta = $db->sql_query($sql);
            $fila = $db->sql_fetchrow($consulta);
            $db->sql_close();

            return($fila);
        }

        /**
         * Permite registrar un modulo en la base de datos.
         * @param type Vector de parametros.
         * @return type
         */
        function crear($p) {
            if (is_array($p)) {
                $consulta = $this->consultar($p["modulo"]);
                if (!isset($consulta["modulo"])) {
                    $sql = "INSERT INTO `aplicacion_modulos` SET ";
                    $sql .= "`modulo` = '" . $p["modulo"] . "', ";
                    $sql .= "`nombre` = '" . $p["nombre"] . "', ";
                    $sql .= "`titulo` = '" . $p["titulo"] . "', ";
                    $sql .= "`descripcion` = '" . $p["descripcion"] . "', ";
                    $sql .= "`fecha` = '" . $p["fecha"] . "', ";
                    $sql .= "`hora` = '" . $p["hora"] . "', ";
                    $sql .= "`creador` = '" . $p["creador"] . "';";
                    $db = new MySQL(Router::getDefaultConexion());
                    $consulta = $db->sql_query($sql);
                    $db->sql_close();
                } else {
                    
                }
            } else {
                
            }
        }

        function combo($name, $selected) {
            $db = new MySQL(Router::getDefaultConexion());
            $sql = "SELECT * FROM `aplicacion_modulos` ORDER BY `modulo`";
            $consulta = $db->sql_query($sql);
            $html = ('<select name="' . $name . '"id="' . $name . '">');
            $conteo = 0;
            while ($fila = $db->sql_fetchrow($consulta)) {
                $html .= ('<option value="' . $fila['modulo'] . '"' . (($selected == $fila['modulo']) ? "selected" : "") . '>' . $fila['modulo'] . ": " . $fila['nombre'] . '</option>');
                $conteo++;
            } $db->sql_close();
            $html .= ("</select>");
            return($html);
        }

    }

}
?>