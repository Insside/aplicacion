<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Aplicacion_Multimedia
 *
 * @author Insside
 */
if (!class_exists('Aplicacion_Multimedia')) {

    class Aplicacion_Multimedia {
        public function getAudio($codigo){
            $r["002-001"]="modulos/aplicacion/multimedia/audios/advertencia-sincronizacion.mp3";
            return($r[$codigo]);
        }
    }

}
