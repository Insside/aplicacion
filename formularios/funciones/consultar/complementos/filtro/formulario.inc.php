<?php
$v=new Validaciones();
$am = new Aplicacion_Modulos();

$criterio=$v->recibir("criterio". $f->id);
$valor=$v->recibir("valor". $f->id);

$f->campos['criterio'] = $am->combo("criterio" . $f->id,$criterio);
$f->campos['valor'] = $f->text("valor" . $f->id,$valor, 64, "");
$f->campos['filtrar'] = $f->button("filtrar" . $f->id, "submit", "Filtrar");
// Celdas
$f->celdas['criterio'] = $f->celda("Módulo:", $f->campos['criterio']);
$f->celdas['valor'] = $f->celda("Buscar:", $f->campos['valor']);
// Filas
$f->fila["criterio"] = $f->fila($f->celdas['criterio']);
$f->fila["valor"] = $f->fila($f->celdas['valor']);
//Compilacion
$f->filas($f->fila['criterio']);
$f->filas($f->fila['valor']);
$f->botones($f->campos['filtrar']);
?>