<?php

if (!class_exists("Aplicacion_Estructuras")) {

    class Aplicacion_Estructuras {

        function Aplicacion_Estructuras() {
        }

        function combo($id, $selected, $class = "") {
            $db = new MySQL(Router::getDefaultConexion());
            $sql = "SHOW TABLES";
            $consulta = $db->sql_query($sql);
            $html = ('<select name="' . $id . '"id="' . $id . '" class="' . $class . '" >');
            $conteo = 0;
            while ($fila = $db->sql_fetchrow($consulta)) {
                $html .= ('<option value="' . $fila['Tables_in_' . $db->getDB()] . '"' . (($selected == $fila['Tables_in_' . $db->getDB()]) ? "selected" : "") . '>' . $fila['Tables_in_' . $db->getDB()] . '</option>');
                $conteo++;
            }
            $db->sql_close();
            $html .= ("</select>");
            return($html);
        }

        function campo() {
            
        }

    }

}
?>