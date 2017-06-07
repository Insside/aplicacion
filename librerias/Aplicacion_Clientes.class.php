<?php

if (!class_exists('Aplicacion_Clientes')) {

    class Aplicacion_Clientes {

        public function crear($datos) {
            $db = new MySQL(Router::getDefaultConexion());
            $sql = "INSERT INTO `aplicacion_clientes` SET "
                    . "`empresa`='" . $datos['empresa'] . "',"
                    . "`nombre`='" . $datos['nombre'] . "',"
                    . "`fecha`='" . $datos['fecha'] . "',"
                    . "`hora`='" . $datos['hora'] . "',"
                    . "`usuarios_maximo`='" . $datos['usuarios_maximo'] . "',"
                    . "`servidor`='" . $datos['servidor'] . "',"
                    . "`puerto`='" . $datos['puerto'] . "',"
                    . "`usuario`='" . $datos['usuario'] . "',"
                    . "`clave`='" . $datos['clave'] . "',"
                    . "`db`='" . $datos['db'] . "'"
                    . ";";
            $db->sql_query($sql);
            $db->sql_close();
        }

        public function actualizar($empresa, $campo, $valor) {
            $db = new MySQL(Router::getDefaultConexion());
            $sql = "UPDATE `aplicacion_clientes` "
                    . "SET `" . $campo . "`='" . $valor . "' "
                    . "WHERE `empresa`='" . $empresa . "';";
            $db->sql_query($sql);
            $db->sql_close();
        }

        public function eliminar($empresa) {
            $db = new MySQL(Router::getDefaultConexion());
            $sql = "DELETE FROM `aplicacion_clientes` "
                    . "WHERE `empresa`='" . $empresa . "';";
            $db->sql_query($sql);
            $db->sql_close();
        }

        public function consultar($empresa) {
            $db = new MySQL(Router::getDefaultConexion());
            $sql = "SELECT * FROM `aplicacion_clientes` "
                    . "WHERE `empresa`='" . $empresa . "';";
            $consulta = $db->sql_query($sql);
            $fila = $db->sql_fetchrow($consulta);
            $db->sql_close();
            return($fila);
        }

        /**
         * Retorna el listado total de clientes (empresas) registradas en la base de datos, como
         * un vector. Por defecto solo retornara aquellas empresas que figuren como activas 
         * en la plataforma.
         * @param String $acceso {ACTIVO,DENEGADO} determina el resultado segun el estado de acceso de las empresas listadas.
         * @return array con el listado de empresas activas.
         */
        public function getList($acceso = "ACTIVO") {
            $db = new MySQL(Router::getDefaultConexion());
            $sql = ""
                    . "SELECT "
                    . "`empresa`,`nombre` "
                    . "FROM `aplicacion_clientes`"
                    . "WHERE `acceso` = '" . $acceso . "' "
                    . "ORDER BY `nombre`;";
            $consulta = $db->sql_query($sql);
            $empresas = array();
            while ($fila = $db->sql_fetchrow($consulta)) {
                array_push($empresas, $fila);
            }
            $db->sql_close();
            /** Limpiando Memoria **/
            unset($db);
            unset($sql);
            unset($consulta);
            unset($fila);
            /** Retornando Valor **/
            return($empresas);
        }

        /**
         * Retorna la información necesaria para conectarse a la base de datos
         * de una empresa especifica
         * @return type
         */
        public static function getConexion($empresa) {
            $db = new MySQL(Router::getDefaultConexion());
            $sql = ""
                    . "SELECT "
                    . "     `aplicacion_clientes`.`empresa` AS `business`,"
                    . "        `aplicacion_clientes`.`servidor` AS `server`,"
                    . "        `aplicacion_clientes`.`puerto` AS `port`,"
                    . "        `aplicacion_clientes`.`usuario` AS `user`,"
                    . "        `aplicacion_clientes`.`clave` AS `password`,"
                    . "        `aplicacion_clientes`.`db` AS `db` "
                    . "FROM `aplicacion_clientes`"
                    . "WHERE(`empresa` = '$empresa') "
                    . "LIMIT 1;";
            $consulta = $db->sql_query($sql);
            $fila = $db->sql_fetchrow($consulta);
            $db->sql_close();
            return($fila);
        }

        /** Funciones que se conservan por compatibilidad * */
        public function empresas($acceso = "ACTIVO") {
           $this->getList($acceso);
        }

    }

}
?>