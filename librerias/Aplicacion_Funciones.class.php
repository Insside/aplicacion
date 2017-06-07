<?php

if (!class_exists('Aplicacion_Funciones')) {

    class Aplicacion_Funciones {

        function Aplicacion_Funciones() {
            
        }

        /**
         * Permite consultar y obtener los datos que conforman una función.
         * @param type $funcion
         * @return type
         */
        function consultar($funcion) {
            $db = new MySQL(Router::getDefaultConexion());
            $sql = "SELECT * FROM `aplicacion_funciones` WHERE `funcion`='" . $funcion . "';";
            $consulta = $db->sql_query($sql);
            $fila = $db->sql_fetchrow($consulta);
            $db->sql_close();
            return($fila);
        }

        /**
         * Este metodo permite crear una función JavaScript y almacenarla en la base de datos, que 
         * posteriormente sera cargada como componente de la interfaz grafica
         * @param type $parametros
         */
        function crear($parametros = array()) {
            if (is_array($parametros)) {
                $db = new MySQL(Router::getDefaultConexion());
                $sql = "INSERT INTO `aplicacion_funciones` SET "
                        . "`funcion`='" . $parametros["funcion"] . "',"
                        . "`modulo`='" . $parametros["modulo"] . "',"
                        . "`nombre`='" . $parametros["nombre"] . "',"
                        . "`cuerpo`='" . $parametros["cuerpo"] . "',"
                        . "`parametros`='" . $parametros["parametros"] . "',"
                        . "`descripcion`='" . $parametros["descripcion"] . "',"
                        . "`version`='" . $parametros["version"] . "',"
                        . "`creacion`='" . $parametros["creacion"] . "',"
                        . "`modificacion`='" . $parametros["modificacion"] . "',"
                        . "`estado`='" . $parametros["estado"] . "',"
                        . "`creador`='" . $parametros["creador"] . "';";
                $db->sql_query($sql);
                $db->sql_close();
            } else {
                
            }
        }

        /**
         * Este metodo permite actualizar el contenido JavaScript de una función
         * registrada en la base de datos.
         * @param type $funcion
         * @param type $campo
         * @param type $valor
         */
        function actualizar($funcion, $campo, $valor) {
            $db = new MySQL(Router::getDefaultConexion());
            $sql = "UPDATE `aplicacion_funciones` "
                    . "SET `" . $campo . "`='" . $valor . "' "
                    . "WHERE `funcion`='" . $funcion . "';";
            $db->sql_query($sql);
            $db->sql_close();
        }

        /**
         * Este metodo permite eliminar una función registrada en la base de datos.
         * @param type $funcion
         */
        function eliminar($funcion) {
            $db = new MySQL(Router::getDefaultConexion());
            $sql = "DELETE FROM `aplicacion_funciones` "
                    . "WHERE `funcion`='" . $funcion . "';";
            $db->sql_query($sql);
            $db->sql_close();
        }

        /**
         * Este metodo permite verificar la existencia de una funcion, si la funcion existe el metodo 
         * retornara verdadero(TRUE) de lo contrario retornara falso(FALSE).
         * @param type $funcion
         * @return type
         */
        function existe($funcion) {
            $f = $this->consultar($funcion);
            if (isset($f["funcion"]) && $f["funcion"] == $funcion) {
                $existe = true;
            } else {
                $existe = false;
            }
            return($existe);
        }

        /**
         * Este metodo permite sincronizar una función si la funcion no existe el metodo la creara, si la
         * funcion existe el metodo actualizara los datos actualizables. Cuando se produce una actualizacion
         * el versionamiento de la funcion se incrementa en 0.001.
         * @param type $parametros
         */
        function sincronizar($parametros = array()) {
            //print_r($parametros);
            if (is_array($parametros)) {
                $funcion = $parametros["funcion"];
                if (!$this->existe($funcion)) {
                    $this->crear($parametros);
                } else {
                    $funcion = $this->consultar($funcion);
                    $version = $funcion['version'] + 0.001;
                    $this->actualizar($parametros["funcion"], "modulo", $parametros["modulo"]);
                    $this->actualizar($parametros["funcion"], "nombre", $parametros["nombre"]);
                    $this->actualizar($parametros["funcion"], "cuerpo", $parametros["cuerpo"]);
                    $this->actualizar($parametros["funcion"], "parametros", $parametros["parametros"]);
                    $this->actualizar($parametros["funcion"], "descripcion", $parametros["descripcion"]);
                    $this->actualizar($parametros["funcion"], "modificacion", date('Y-m-d', time()));
                    $this->actualizar($parametros["funcion"], "version", $version);
                }
            } else {
                
            }
        }

    }

}
?>