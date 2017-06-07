<?php

if (!class_exists('Aplicacion_Paises_Regiones')) {

    class Aplicacion_Paises_Regiones {

        public function crear($datos = array()) {
            if (is_array($datos)) {
                $db = new MySQL(Sesion::getConexion());
                $sql = "INSERT INTO `aplicacion_paises_regiones` SET "
                        . "`region`='" . $datos['region'] . "',"
                        . "`pais`='" . $datos['pais'] . "',"
                        . "`nombre`='" . $datos['nombre'] . "'"
                        . ";";
                $db->sql_query($sql);
                $db->sql_close();
            } else {
                echo("Error: Aplicacion_Paises_Regiones::crear se esperaba un vector.");
            }
        }

        public function actualizar($region, $campo, $valor) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "UPDATE `aplicacion_paises_regiones` "
                    . "SET `" . $campo . "`='" . $valor . "' "
                    . "WHERE `region`='" . $region . "';";
            $db->sql_query($sql);
            $db->sql_close();
        }

        public function eliminar($region) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "DELETE FROM `aplicacion_paises_regiones` "
                    . "WHERE `region`='" . $region . "';";
            $db->sql_query($sql);
            $db->sql_close();
        }

        public function consultar($region) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "SELECT * FROM `aplicacion_paises_regiones` "
                    . "WHERE `region`='" . $region . "';";
            $consulta = $db->sql_query($sql);
            $fila = $db->sql_fetchrow($consulta);
            $db->sql_close();
            return($fila);
        }
        
        /**
         * Retorna el listado de usos especificados en la base de datos.
         * @param type $parametros
         * @return type
         */
        public function getList($p= array()) {
            if (is_array($p)) {
                $p["pais"]=!isset($p["pais"])?"CO":$p["pais"];
                $db = new MySQL(Sesion::getConexion());
                $sql = "SELECT * FROM `aplicacion_paises_regiones` WHERE(`pais`='{$p["pais"]}') ORDER BY `nombre`;";
                $consulta = $db->sql_query($sql);
                $regiones= array();
                while ($fila = $db->sql_fetchrow($consulta)) {
                    array_push($regiones, $fila);
                }
                return($regiones);
            } else {
                echo("Error: Usos::getList() esperava un vector de parametros.");
            }
        }

    }

}
?>