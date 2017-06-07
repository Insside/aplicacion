<?php
$v=new Validaciones();
$criterio=$v->recibir("criterio".$f->id);
$valor=$v->recibir("valor".$f->id);
$f->JavaScript("MUI.Aplicacion_Funciones_Filtro(\"$criterio\",\"$valor\");");
?>