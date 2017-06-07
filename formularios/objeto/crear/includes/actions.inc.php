<?php
$codigo.="\n\t\t\t /**"
        . "\n\t\t\t * (PHP 4 &gt;= 4.0.6, PHP 5, PHP 7)<br/>"
        . "\n\t\t\t * Method syncUp <<sincronizar>> "
        . "\n\t\t\t * Este metodo sincroniza los datos modificados en el objeto"
        . "\n\t\t\t * con la información almacenada en la base de datos."
        . "\n\t\t\t * Se ejecuta como una acción sin parametros adicionales."
        . "\n\t\t\t **/";
$codigo.="\n\t\t\t public function syncUp(){";
$codigo.="\n\t\t\t\t \$cb=new {$classname}();";
$codigo.="\n\t\t\t\t foreach (\$this->properties as \$key =>\$value){";
$codigo.="\n\t\t\t\t\t \$cb->actualizar(\$this->key,\$key,\$value);";
$codigo.="\n\t\t\t\t }";
$codigo.="\n\t\t\t}";
?>