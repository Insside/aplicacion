<?php

if (!class_exists('Aplicacion_Paises')) {

    class Aplicacion_Paises {

        public function crear($datos = array()) {
            if (is_array($datos)) {
                $db = new MySQL(Sesion::getConexion());
                $sql = "INSERT INTO `aplicacion_paises` SET "
                        . "`pais`='" . $datos['pais'] . "',"
                        . "`nombre`='" . $datos['nombre'] . "',"
                        . "`_iso3`='" . $datos['_iso3'] . "',"
                        . "`codigo`='" . $datos['codigo'] . "'"
                        . ";";
                $db->sql_query($sql);
                $db->sql_close();
            } else {
                echo("Error: Aplicacion_Paises::crear se esperaba un vector.");
            }
        }

        public function actualizar($pais, $campo, $valor) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "UPDATE `aplicacion_paises` "
                    . "SET `" . $campo . "`='" . $valor . "' "
                    . "WHERE `pais`='" . $pais . "';";
            $db->sql_query($sql);
            $db->sql_close();
        }

        public function eliminar($pais) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "DELETE FROM `aplicacion_paises` "
                    . "WHERE `pais`='" . $pais . "';";
            $db->sql_query($sql);
            $db->sql_close();
        }

        public function consultar($pais) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "SELECT * FROM `aplicacion_paises` "
                    . "WHERE `pais`='" . $pais . "';";
            $consulta = $db->sql_query($sql);
            $fila = $db->sql_fetchrow($consulta);
            $db->sql_close();
            return($fila);
        }
        
                /**
         * Retorna el listado de los paises registrados en la base de datos.
         * @param type $parametros
         * @return type
         */
        public function getList($parametros = array()) {
            if (is_array($parametros)) {
                $db = new MySQL(Sesion::getConexion());
                $sql = "SELECT * FROM `aplicacion_paises` ORDER BY `nombre`;";
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