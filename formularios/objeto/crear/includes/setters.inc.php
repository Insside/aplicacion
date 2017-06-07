<?php
$codigo.="\n\t\t\t /** Setters **/";
$codigo.="\n\t\t\t private function setValue(\$key,\$value){"
        . "\$this->properties[\$key]=\$value;"
        . "}";
for($i=0;$i<count($campos);$i++){
  $field=$campos[$i]['Field'];
  $codigo.="\n\t\t\t public function set". Cadenas::capitalizar($field)."(\$value){"
          . "\$this->setValue(\"{$field}\",\$value);"
          . "}";
}
?>