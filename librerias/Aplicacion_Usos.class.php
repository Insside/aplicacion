<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Suscriptores_Usos
 *
 * @author Insside
 */
if (!class_exists('Aplicacion_Usos')) {

    class Aplicacion_Usos {

        public function crear($datos = array()) {
            if (is_array($datos)) {
                $db = new MySQL(Sesion::getConexion());
                $sql = "INSERT INTO `aplicacion_usos` SET "
                        . "`uso`='" . $datos['uso'] . "',"
                        . "`codigo`='" . $datos['codigo'] . "',"
                        . "`nombre`='" . $datos['nombre'] . "'"
                        . ";";
                $db->sql_query($sql);
                $db->sql_close();
            } else {
                echo("Error: Aplicacion_Usos::crear se esperaba un vector.");
            }
        }

        public function actualizar($uso, $campo, $valor) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "UPDATE `aplicacion_usos` "
                    . "SET `" . $campo . "`='" . $valor . "' "
                    . "WHERE `uso`='" . $uso . "';";
            $db->sql_query($sql);
            $db->sql_close();
        }

        public function eliminar($uso) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "DELETE FROM `aplicacion_usos` "
                    . "WHERE `uso`='" . $uso . "';";
            $db->sql_query($sql);
            $db->sql_close();
        }

        public function consultar($uso) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "SELECT * FROM `aplicacion_usos` "
                    . "WHERE `uso`='" . $uso . "';";
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
        public function getList($parametros = array()) {
            if (is_array($parametros)) {
                $db = new MySQL(Sesion::getConexion());
                $sql = "SELECT * FROM `aplicacion_usos` ORDER BY `uso`;";
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