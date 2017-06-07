<?php
$codigo.="\n\t\t\t /** Getters **/";
$codigo.="\n\t\t\t private function getValue(\$key){return(\$this->properties[\$key]);}";
for($i=0;$i<count($campos);$i++){
  $field=$campos[$i]['Field'];
  $codigo.="\n\t\t\t public function get". Cadenas::capitalizar($field)."(){"
          . "return(\$this->getValue(\"{$field}\"));"
          . "}";
}

$codigo.="\n\t\t\t public function getAll(){return(\$this->properties);}";
?>