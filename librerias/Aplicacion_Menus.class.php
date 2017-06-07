<?php

if (!class_exists('Aplicacion_Menus')) {
    require_once(ROOT . "modulos/aplicacion/librerias/Aplicacion_Modulos_Componentes.class.php");
    require_once(ROOT . "modulos/aplicacion/librerias/Aplicacion_Usuarios.class.php");

    if (!class_exists("Aplicacion_Menus")) {

        class Aplicacion_Menus {

            var $sesion;
            var $usuarios;

            function Aplicacion_Menus() {
                $this->sesion = new Sesion();
                $this->usuarios = new Aplicacion_Usuarios();
            }

            function opciones($herencia) {
                $db = new MySQL(Router::getDefaultConexion());
                $sql = ("SELECT * FROM `aplicacion_modulos_componentes` WHERE( `herencia`='" . $herencia . "' AND `estado` = 'ACTIVO' ) ORDER BY `peso` ASC");
                //echo($sql);
                $consulta = $db->sql_query($sql);
                $filas = NULL;
                $conteo = 0;
                while ($fila = $db->sql_fetchrow($consulta)) {
                    $filas[$conteo] = $fila;
                    $conteo++;
                }$db->sql_close();
                return($filas);
            }

            public function menu($herencia, $usuario) {
                $componentes = new Aplicacion_Modulos_Componentes();
                $funciones = new Funciones();
                $identidad = "menu" . time();
                $vc = $this->opciones($herencia);
                $html = "<div id=\"$identidad\" class=\"menu\">";
                for ($c = 0; $c < count($vc); $c++) {
                    if ($this->usuarios->permiso($vc[$c]['permiso'], $usuario) || empty($vc[$c]['permiso'])) {
                        $html .= "<h2>" . (urldecode($vc[$c]['titulo'])) . "</h2>";
                        $vo = $this->opciones($vc[$c]['componente']);
                        $html .= (" <div class=\"opciones\">");
                        for ($o = 0; $o < count($vo); $o++) {
                            if ($this->usuarios->permiso($vo[$o]['permiso'], $usuario) || empty($vo[$o]['permiso'])) {
                                $html .= "<a href = \"#\" onclick=\"MUI.f" . ($vo[$o]['funcion']) . "();\">";
                                $html .= (" <div class=\"opcion\">");
                                $html .= "<div class=\"icono\"><div class=\"" . ($vc[$c]['icono']) . "\"></div></div>";
                                $html .= (" <div class=\"etiqueta\">");
                                $html .= "<div class=\"titulo\">" . urldecode($vo[$o]['titulo']) . "</div>";
                                $html .= "<div class=\"descripcion\">" . urldecode($vo[$o]['descripcion']) . "</div>";
                                $html .= "</div>";
                                $html .= "</div>";
                                $html .= "</a>";
                            }
                        }
                        $html .= "</div>";
                        if (isset($vc[$c + 1])) {
                            $html .= "\n";
                        } else {
                            $html .= "\n";
                        }
                    }
                }
                $html .= "<script>";
                $html .= "var a = new MUI.Accordion($('$identidad'), '#$identidad h2', '#$identidad .opciones',{"
                        . "container:\$('componentes'),"
                        . "width:\$('componentes').width,"
                        . "height:\$('componentes').getHeight()"
                        . "});";
                $html .= "</script>";
                return($html);
            }

        }

    }
}
?>