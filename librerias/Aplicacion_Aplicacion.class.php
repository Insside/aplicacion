<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Aplicacion_Aplicacion
 *
 * @author Insside
 */
if (!class_exists('Aplicacion_Aplicacion')) {

    class Aplicacion_Aplicacion {

        public function getFunciones() {
            $db = new MySQL(Router::getDefaultConexion());
            $conteo = $db->sql_query(""
                    . "SELECT Count(*) AS `conteo` "
                    . "FROM `aplicacion_funciones`;");
            $resultado = $db->sql_fetchrow($conteo);
            $db->sql_close();
            return($resultado["conteo"]);
        }

        /**
         * Retorna la sumatoria absoluta de todas las versiones de las funciones
         * registradas
         * @return type
         */
        public function getVersiones() {
            $db = new MySQL(Router::getDefaultConexion());
            $suma = $db->sql_query(""
                    . "SELECT Sum(`aplicacion_funciones`.`version`) AS `suma` "
                    . "FROM `aplicacion_funciones`"
                    . "");
            $resultado = $db->sql_fetchrow($suma);
            $db->sql_close();
            return($resultado["suma"]);
        }

        public function getVersion() {
            $suma = $this->getVersiones();
            return($suma / 10);
        }

        public function getCompilacion() {
            $suma = $this->getVersiones();
            $conteo = $this->getFunciones();
            return($suma / conteo);
        }

    } 

}