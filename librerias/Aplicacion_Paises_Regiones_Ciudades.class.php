<?php

if (!class_exists('Aplicacion_Paises_Regiones_Ciudades')) {

    class Aplicacion_Paises_Regiones_Ciudades {

        public function crear($datos = array()) {
            if (is_array($datos)) {
                $db = new MySQL(Sesion::getConexion());
                $sql = "INSERT INTO `aplicacion_paises_regiones_ciudades` SET "
                        . "`ciudad`='" . $datos['ciudad'] . "',"
                        . "`region`='" . $datos['region'] . "',"
                        . "`pais`='" . $datos['pais'] . "',"
                        . "`nombre`='" . $datos['nombre'] . "'"
                        . ";";
                $db->sql_query($sql);
                $db->sql_close();
            } else {
                echo("Error: Aplicacion_Paises_Regiones_Ciudades::crear se esperaba un vector.");
            }
        }

        public function actualizar($ciudad, $campo, $valor) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "UPDATE `aplicacion_paises_regiones_ciudades` "
                    . "SET `" . $campo . "`='" . $valor . "' "
                    . "WHERE `ciudad`='" . $ciudad . "';";
            $db->sql_query($sql);
            $db->sql_close();
        }

        public function eliminar($ciudad) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "DELETE FROM `aplicacion_paises_regiones_ciudades` "
                    . "WHERE `ciudad`='" . $ciudad . "';";
            $db->sql_query($sql);
            $db->sql_close();
        }

        public function consultar($ciudad) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "SELECT * FROM `aplicacion_paises_regiones_ciudades` "
                    . "WHERE `ciudad`='" . $ciudad . "';";
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
                $p["region"]=!isset($p["region"])?"076":$p["region"];
                $db = new MySQL(Sesion::getConexion());
                $sql = "SELECT * FROM `aplicacion_paises_regiones_ciudades` WHERE(`pais`='{$p["pais"]}' AND `region`='{$p["region"]}') ORDER BY `nombre`;";
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