<?php

if (!class_exists('Aplicacion_Empresas')) {

    class Aplicacion_Empresas {

        public function crear($datos = array()) {
            if (is_array($datos)) {
                $db = new MySQL(Router::getDefaultConexion());
                $sql = "INSERT INTO `aplicacion_empresas` SET "
                        . "`empresa`='" . @$datos['empresa'] . "',"
                        . "`identificacion`='" . @$datos['identificacion'] . "',"
                        . "`digito`='" . @$datos['digito'] . "',"
                        . "`documento`='" . @$datos['documento'] . "',"
                        . "`razon`='" . @$datos['razon'] . "',"
                        . "`regimen`='" . @$datos['regimen'] . "',"
                        . "`direccion`='" . @$datos['direccion'] . "',"
                        . "`ciudad`='" . @$datos['ciudad'] . "',"
                        . "`region`='" . @$datos['region'] . "',"
                        . "`pais`='" . @$datos['pais'] . "',"
                        . "`telefono`='" . @$datos['telefono'] . "',"
                        . "`fax`='" . @$datos['fax'] . "',"
                        . "`movil`='" . @$datos['movil'] . "',"
                        . "`correo`='" . @$datos['correo'] . "',"
                        . "`actividad`='" . @$datos['actividad'] . "',"
                        . "`texterior`='" . @$datos['texterior'] . "',"
                        . "`autoretenedor`='" . @$datos['autoretenedor'] . "',"
                        . "`acreedor`='" . @$datos['acreedor'] . "',"
                        . "`deudor`='" . @$datos['deudor'] . "',"
                        . "`giro`='" . @$datos['giro'] . "',"
                        . "`consignacion`='" . @$datos['consignacion'] . "',"
                        . "`banco_entidad`='" . @$datos['banco_entidad'] . "',"
                        . "`banco_sucursal`='" . @$datos['banco_sucursal'] . "',"
                        . "`banco_cuenta`='" . @$datos['banco_cuenta'] . "',"
                        . "`banco_cuenta_titular_identificacion`='" . @$datos['banco_cuenta_titular_identificacion'] . "',"
                        . "`banco_cuenta_titular`='" . @$datos['banco_cuenta_titular'] . "',"
                        . "`nombre_tercero`='" . @$datos['nombre_tercero'] . "',"
                        . "`banco_tipo_cuenta`='" . @$datos['banco_tipo_cuenta'] . "',"
                        . "`sector_economico`='" . @$datos['sector_economico'] . "',"
                        . "`representante_identificacion`='" . @$datos['representante_identificacion'] . "',"
                        . "`representante_nombres`='" . @$datos['representante_nombres'] . "',"
                        . "`representante_apellidos`='" . @$datos['representante_apellidos'] . "',"
                        . "`nombre_externo_origen`='" . @$datos['nombre_externo_origen'] . "',"
                        . "`pago_unico`='" . @$datos['pago_unico'] . "',"
                        . "`centro_utilidad`='" . @$datos['centro_utilidad'] . "',"
                        . "`fecha`='" . @$datos['fecha'] . "',"
                        . "`hora`='" . @$datos['hora'] . "',"
                        . "`creador`='" . @$datos['creador'] . "',"
                        . "`gc`='" . @$datos['gc'] . "',"
                        . "`sgc`='" . @$datos['sgc'] . "',"
                        . "`imagen`='" . @$datos['imagen'] . "'"
                        . ";";
                $db->sql_query($sql);
                $db->sql_close();
            } else {
                echo("Error: Aplicacion_Empresas::crear se esperaba un vector.");
            }
            return($datos['empresa']);
        }

        public function actualizar($empresa, $campo, $valor) {
            $db = new MySQL(Router::getDefaultConexion());
            $sql = "UPDATE `aplicacion_empresas` "
                    . "SET `" . $campo . "`='" . $valor . "' "
                    . "WHERE `empresa`='" . $empresa . "';";
            $db->sql_query($sql);
            $db->sql_close();
        }

        public function eliminar($empresa) {
            $db = new MySQL(Router::getDefaultConexion());
            $sql = "DELETE FROM `aplicacion_empresas` "
                    . "WHERE `empresa`='" . $empresa . "';";
            $db->sql_query($sql);
            $db->sql_close();
        }

        public function consultar($empresa) {
            $db = new MySQL(Router::getDefaultConexion());
            $sql = "SELECT * FROM `aplicacion_empresas` "
                    . "WHERE `empresa`='" . $empresa . "';";
            $consulta = $db->sql_query($sql);
            $fila = $db->sql_fetchrow($consulta);
            $db->sql_close();
            return($fila);
        }
        /**
         * Consulta los datos de una empresa, utilizando como parametro de consulta
         * la razon social de la misma.
         * @param type $razon
         * @return type
         */
        public function razon($razon) {
            $db = new MySQL(Router::getDefaultConexion());
            $sql = "SELECT * FROM `aplicacion_empresas` "
                    . "WHERE `razon`='" . $razon . "';";
            $consulta = $db->sql_query($sql);
            $fila = $db->sql_fetchrow($consulta);
            $db->sql_close();
            return($fila);
        }

    }

}
?>