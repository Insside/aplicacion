<?php
            $sql = "create table permisos(permiso char(32) not null,descripcion blob not null,fecha date not null,hora time not null,creador char(11),primary key(permiso));";
            $db = new MySQL(Sesion::getConexion());
            if (!$db->sql_tablaexiste("permisos")) {
                $db->sql_query($sql);
            }$db->sql_close();
