<?php
$codigo.="\n\t\t\t /** Methods **/";

$codigo.="\n\t\t\t public function {$singular}(\$key){";
$codigo.="\n\t\t\t\t \$cb=new {$classname}();";
$codigo.="\n\t\t\t\t \$this->key=\$key;";
$codigo.="\n\t\t\t\t \$this->properties=\$cb->consultar(\$this->key);";
$codigo.="\n\t\t\t }";
?>