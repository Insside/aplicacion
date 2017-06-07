<?php

$form = $p->addContent(new Form(), true);
$form->action("")->method("POST");
//$form->add("<img src=\"/framework/imagenes/logo-insside.png\" width=\"80%\"/>");
$form->add(new Input("transaccion", "transaccion", "hidden", time(), "", "", false));
$form->add(new Input("usuario", "usuario", "text", "", "Usuario:", "", true));
$form->add(new Input("clave", "clave", "password", "", "Contraseña:", "", true));
$select = new Select("empresa", "empresa", "Empresa:");
for ($i = 0; $i < count($clientes); $i++) {
    $select->add(new Option($clientes[$i]["nombre"], $clientes[$i]["empresa"], false));
}
$form->add($select);
$form->add(new Input("acceder", "acceder", "submit", "Acceder", "", "", true));
?>