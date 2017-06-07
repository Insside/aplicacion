<?php
/**
 * Este segmento crea y/o registra el modulo en la base de datos el codigo del modulo
 * se determina en forma arbitraria por parte del CTO de la plataforma.
 */
$modulo = array(
    "modulo" => "001",
    "nombre" => "Aplicacion",
    "titulo" => "Modulo Control Del Aplicativo",
    "descripcion" => "Modulo de control y autoprogramación del aplicativo.",
    "fecha" =>$fechas->hoy(),
    "hora" =>$fechas->ahora(),
    "creador" => $usuario["usuario"]
);
$am = new Aplicacion_Modulos();
$am->crear($modulo);
?>