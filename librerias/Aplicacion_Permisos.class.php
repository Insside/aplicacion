<?php


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

/**
 * Description of Aplicacion_Permisos
 *
 * @author Alexis
 */
if (!class_exists('Aplicacion_Permisos')) {

    class Aplicacion_Permisos {

        private $conexion;

        public function Aplicacion_Permisos() {
            $this->conexion = Router::getDefaultConexion();
        }

        public function crear($datos = array()) {
            if (is_array($datos)) {
                $db = new MySQL($this->conexion);
                $sql = "INSERT INTO `aplicacion_permisos` SET "
                        . "`modulo`='" . $datos['modulo'] . "',"
                        . "`permiso`='" . $datos['permiso'] . "',"
                        . "`nombre`='" . $datos['nombre'] . "',"
                        . "`descripcion`='" . $datos['descripcion'] . "',"
                        . "`fecha`='" . $datos['fecha'] . "',"
                        . "`hora`='" . $datos['hora'] . "',"
                        . "`creador`='" . $datos['creador'] . "'"
                        . ";";
                $db->sql_query($sql);
                $db->sql_close();
            } else {
                echo("Error: Aplicacion_Permisos::crear se esperaba un vector.");
            }
        }

        public function actualizar($modulo, $campo, $valor) {
            $db = new MySQL($this->conexion);
            $sql = "UPDATE `aplicacion_permisos` "
                    . "SET `" . $campo . "`='" . $valor . "' "
                    . "WHERE `modulo`='" . $modulo . "';";
            $db->sql_query($sql);
            $db->sql_close();
        }

        public function eliminar($modulo) {
            $db = new MySQL($this->conexion);
            $sql = "DELETE FROM `aplicacion_permisos` "
                    . "WHERE `modulo`='" . $modulo . "';";
            $db->sql_query($sql);
            $db->sql_close();
        }

        public function consultar($modulo) {
            $db = new MySQL($this->conexion);
            $sql = "SELECT * FROM `aplicacion_permisos` "
                    . "WHERE `modulo`='" . $modulo . "';";
            $consulta = $db->sql_query($sql);
            $fila = $db->sql_fetchrow($consulta);
            $db->sql_close();
            return($fila);
        }

        function inicializar() {
            $sql = "create table permisos(permiso char(32) not null,descripcion blob not null,fecha date not null,hora time not null,creador char(11),primary key(permiso));";
            $db = new MySQL($this->conexion);
            if (!$db->sql_tablaexiste("permisos")) {
                $db->sql_query($sql);
            }$db->sql_close();
        }

        //\\//\\//\\//\\//\\//\\ Estadisticas & Conteos //\\//\\//\\//\\//\\//\\
        function conteo() {
            $db = new MySQL($this->conexion);
            $consulta = $db->sql_query("SELECT Count(*) AS `conteo` FROM `aplicacion_permisos`;");
            $fila = $db->sql_fetchrow($consulta);
            $db->sql_close();
            return($fila['conteo']);
        }

        /** Tendencia a Desaparecer * */
        function combo($name, $selected) {
            $db = new MySQL($this->conexion);
            $sql = "SELECT * FROM `aplicacion_permisos` ORDER BY `modulo`,`permiso` DESC";
            $consulta = $db->sql_query($sql);
            $html = ('<select name="' . $name . '"id="' . $name . '">');
            $conteo = 0;
            while ($fila = $db->sql_fetchrow($consulta)) {
                $html .= ('<option value="' . $fila['permiso'] . '"' . (($selected == $fila['permiso']) ? "selected" : "") . '>' . $fila['modulo'] . ": " . $fila['permiso'] . '</option>');
                $conteo++;
            } $db->sql_close();
            $html .= ("</select>");
            return($html);
        }

        /**
         * Retorna el listado de usos especificados en la base de datos.
         * @param type $parametros
         * @return type
         */
        public function getList($parametros = array()) {
            if (is_array($parametros)) {
                $db = new MySQL($this->conexion);
                $sql = "SELECT * FROM `aplicacion_permisos` ORDER BY `modulo`,`permiso` DESC";
                $consulta = $db->sql_query($sql);
                $permisos = array();
                while ($fila = $db->sql_fetchrow($consulta)) {
                    array_push($permisos, $fila);
                }
                return($permisos);
            } else {
                echo("Error: Aplicacion_Permisos::getList() esperava un vector de parametros.");
            }
        }

        function politicas($permiso) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "SELECT  `usuarios_politicas`.`rol`,`usuarios_roles`.`nombre` ";
            $sql .= "FROM `usuarios_roles`";
            $sql .= "INNER JOIN `usuarios_politicas` ON `usuarios_politicas`.`rol` = `usuarios_roles`.`rol` ";
            $sql .= "WHERE `permiso` = '" . $permiso . "' ";
            $sql .= "GROUP BY `usuarios_politicas`.`rol`,`usuarios_roles`.`nombre`; ";
            $consulta = $db->sql_query($sql);
            $html = ('<p style="padding-left: 10px !important;">');
            $conteo = 0;
            while ($fila = $db->sql_fetchrow($consulta)) {
                $html .= ('<br><b><a href="#" onClick="MUI.Usuarios_Roles_Rol_Permisos(\'' . $fila['rol'] . '\');">' . $fila['rol'] . '</a></b>: ' . $fila['nombre'] . '');
                $conteo++;
            } $db->sql_close();
            $html .= ("</p>");
            return($html);
        }

        /**
         * Elimina todos los permisos asociados a un modulo, sin afectar las
         * relaciones establecidas en la politica.
         * @param type $modulo
         */
        public function deleteAll($modulo) {
            $db = new MySQL($this->conexion);
            $sql = "DELETE FROM `aplicacion_permisos` "
                    . "WHERE `modulo`='" . $modulo . "';";
            $db->sql_query($sql);
            $db->sql_close();
        }

    }

}
