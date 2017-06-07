<?php
error_reporting(E_ALL);
if(!defined("ROOT")){define('ROOT', dirname(__FILE__) . '/../../../');}
//require_once(ROOT."librerias/Configuracion.cnf.php");

$codigo=urldecode("class+Colores+%7B%0D%0A++function+hextorgb%28%24hexvalue%29+%7B%0D%0A++++if+%28%24hexvalue%5B0%5D+%3D%3D+%27%23%27%29+%7B%0D%0A++++++%24hexvalue+%3D+substr%28%24hexvalue%2C+1%29%3B%0D%0A++++%7D+if+%28strlen%28%24hexvalue%29+%3D%3D+6%29+%7B%0D%0A++++++list%28%24r%2C+%24g%2C+%24b%29+%3D+array%28%24hexvalue%5B0%5D+.+%24hexvalue%5B1%5D%2C+%24hexvalue%5B2%5D+.+%24hexvalue%5B3%5D%2C+%24hexvalue%5B4%5D+.+%24hexvalue%5B5%5D%29%3B%0D%0A++++%7D+elseif+%28strlen%28%24hexvalue%29+%3D%3D+3%29+%7B%0D%0A++++++list%28%24r%2C+%24g%2C+%24b%29+%3D+array%28%24hexvalue%5B0%5D+.+%24hexvalue%5B0%5D%2C+%24hexvalue%5B1%5D+.+%24hexvalue%5B1%5D%2C+%24hexvalue%5B2%5D+.+%24hexvalue%5B2%5D%29%3B%0D%0A++++%7D+else+%7B%0D%0A++++++return+false%3B%0D%0A++++%7D+%24r+%3D+hexdec%28%24r%29%3B%0D%0A++++%24g+%3D+hexdec%28%24g%29%3B%0D%0A++++%24b+%3D+hexdec%28%24b%29%3B%0D%0A++++return+array%28%27R%27+%3D%3E+%24r%2C+%27G%27+%3D%3E+%24g%2C+%27B%27+%3D%3E+%24b%29%3B%0D%0A++%7D%0D%0A%0D%0A%7D ");
eval($codigo);

?>