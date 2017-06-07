<?php

if (!class_exists('Aplicacion_Cargos')) {

    class Aplicacion_Cargos {

        public function crear($datos = array()) {
            if (is_array($datos)) {
                $db = new MySQL(Router::getDefaultConexion());
                $sql = "INSERT INTO `aplicacion_cargos` SET "
                        . "`cargo`='" . $datos['cargo'] . "',"
                        . "`titulo`='" . $datos['titulo'] . "',"
                        . "`cno`='" . @$datos['cno'] . "',"
                        . "`creador`='" . $datos['creador'] . "',"
                        . "`fecha`='" . $datos['fecha'] . "',"
                        . "`hora`='" . $datos['hora'] . "'"
                        . ";";
                $db->sql_query($sql);
                $db->sql_close();
            } else {
                echo("Error: Aplicacion_Cargos::crear se esperaba un vector.");
            }
            return($datos['cargo']);
        }

        public function actualizar($cargo, $campo, $valor) {
            $db = new MySQL(Router::getDefaultConexion());
            $sql = "UPDATE `aplicacion_cargos` "
                    . "SET `" . $campo . "`='" . $valor . "' "
                    . "WHERE `cargo`='" . $cargo . "';";
            $db->sql_query($sql);
            $db->sql_close();
        }

        public function eliminar($cargo) {
            $db = new MySQL(Router::getDefaultConexion());
            $sql = "DELETE FROM `aplicacion_cargos` "
                    . "WHERE `cargo`='" . $cargo . "';";
            $db->sql_query($sql);
            $db->sql_close();
        }

        public function consultar($cargo) {
            $db = new MySQL(Router::getDefaultConexion());
            $sql = "SELECT * FROM `aplicacion_cargos` "
                    . "WHERE `cargo`='" . $cargo . "';";
            $consulta = $db->sql_query($sql);
            $fila = $db->sql_fetchrow($consulta);
            $db->sql_close();
            return($fila);
        }
        /**
         * Consulta los datos de un cargo a partir de su titulo.
         * @param type $titulo
         * @return type
         */
        public function titulo($titulo) {
            $db = new MySQL(Router::getDefaultConexion());
            $sql = "SELECT * FROM `aplicacion_cargos` "
                    . "WHERE `titulo`='" . $titulo . "';";
            $consulta = $db->sql_query($sql);
            $fila = $db->sql_fetchrow($consulta);
            $db->sql_close();
            return($fila);
        }

        /**
         * Retorna un codigo valido apra asignar al siguiente cargo a crear
         * @return type
         */
        public function nextCargo() {
            $db = new MySQL(Router::getDefaultConexion());
            $sql = "SELECT * FROM `aplicacion_cargos` ORDER BY `cargo` DESC LIMIT 1;";
            $consulta = $db->sql_query($sql);
            $fila = $db->sql_fetchrow($consulta);
            $db->sql_close();
            return($fila["cargo"] + 1);
        }

    }

}
?>