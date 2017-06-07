<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Aplicacion_Estratos
 *
 * @author Insside
 */
if (!class_exists('Aplicacion_Estratos')) {

    class Aplicacion_Estratos {

        public function crear($datos = array()) {
            if (is_array($datos)) {
                $db = new MySQL(Sesion::getConexion());
                $sql = "INSERT INTO `aplicacion_estratos` SET "
                        . "`estrato`='" . $datos['estrato'] . "',"
                        . "`uso`='" . $datos['uso'] . "',"
                        . "`nombre`='" . $datos['nombre'] . "'"
                        . ";";
                $db->sql_query($sql);
                $db->sql_close();
            } else {
                echo("Error: Aplicacion_Estratos::crear se esperaba un vector.");
            }
        }

        public function actualizar($estrato, $campo, $valor) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "UPDATE `aplicacion_estratos` "
                    . "SET `" . $campo . "`='" . $valor . "' "
                    . "WHERE `estrato`='" . $estrato . "';";
            $db->sql_query($sql);
            $db->sql_close();
        }

        public function eliminar($estrato) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "DELETE FROM `aplicacion_estratos` "
                    . "WHERE `estrato`='" . $estrato . "';";
            $db->sql_query($sql);
            $db->sql_close();
        }

        public function consultar($estrato) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "SELECT * FROM `aplicacion_estratos` "
                    . "WHERE `estrato`='" . $estrato . "';";
            $consulta = $db->sql_query($sql);
            $fila = $db->sql_fetchrow($consulta);
            $db->sql_close();
            return($fila);
        }

    }

}
?>