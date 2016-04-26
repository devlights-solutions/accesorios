<?php
$enlace = mysql_connect('localhost','devlights_db','quilombito','devlights_accesorios');
if (!$enlace) {
    die('No se pudo conectar: ' . mysql_error());
}
//echo 'Conectado con éxito';
mysql_close($enlace);
?>