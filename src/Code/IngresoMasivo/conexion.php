<?php

$conexion = mysql_connect('localhost','devlights_db','quilombito','devlights_accesorios')
or die ("No se puede conectar con el servidor");

$db = mysql_select_db('devlights_accesorios')
or die ("no se puede señalar la BD");

?>


