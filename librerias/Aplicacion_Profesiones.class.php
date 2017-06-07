<?php

if (!class_exists('Aplicacion_Profesiones')) {

    class Aplicacion_Profesiones {

        public function crear($datos = array()) {
            if (is_array($datos)) {
                $db = new MySQL(Sesion::getConexion());
                $sql = "INSERT INTO `aplicacion_profesiones` SET "
                        . "`profesion`='" . $datos['profesion'] . "',"
                        . "`nombre`='" . $datos['nombre'] . "'"
                        . ";";
                $db->sql_query($sql);
                $db->sql_close();
            } else {
                echo("Error: Aplicacion_Profesiones::crear se esperaba un vector.");
            }
        }

        public function actualizar($profesion, $campo, $valor) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "UPDATE `aplicacion_profesiones` "
                    . "SET `" . $campo . "`='" . $valor . "' "
                    . "WHERE `profesion`='" . $profesion . "';";
            $db->sql_query($sql);
            $db->sql_close();
        }

        public function eliminar($profesion) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "DELETE FROM `aplicacion_profesiones` "
                    . "WHERE `profesion`='" . $profesion . "';";
            $db->sql_query($sql);
            $db->sql_close();
        }

        public function consultar($profesion) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "SELECT * FROM `aplicacion_profesiones` "
                    . "WHERE `profesion`='" . $profesion . "';";
            $consulta = $db->sql_query($sql);
            $fila = $db->sql_fetchrow($consulta);
            $db->sql_close();
            return($fila);
        }

        public function getList($parametros = array()) {
            if (is_array($parametros)) {
                $db = new MySQL(Sesion::getConexion());
                $sql = "SELECT * FROM `aplicacion_profesiones` ORDER BY `nombre`;";
                $consulta = $db->sql_query($sql);
                $usos = array();
                while ($fila = $db->sql_fetchrow($consulta)) {
                    array_push($usos, $fila);
                }
                return($usos);
            } else {
                echo("Error: Usos::getList() esperava un vector de parametros.");
            }
        }

    }

}
?>