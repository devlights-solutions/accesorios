<html>
<title>Reporte de Stock por sucursal</title>
<link href="../css/sistemas/style.css" rel="stylesheet" type="text/css">
<head>
<?php

?>

</head>
<body>
<h1>Reporte de Stock por sucursal</h1>
<br/>
<h1>Paso 1: Seleccion de sucursal</h1>
<?php
include ('conexion.php');
echo "
<form action='stockporsucursal.php' method='get'>

";

?>
Sucursal :
            <select Name='ids'>
            <option value="">--- Seleccione ---</option>
            <? $list=mysql_query("SELECT s.name AS Shop,s.id_shop AS ids FROM cma_shop s
" );
            while($row_list=mysql_fetch_assoc($list)){
                ?> 
                    <option  value="<? echo $row_list['ids']; ?>"<? if($row_list['ids']==$select){ 	echo "selected"; } ?>>
                                         <?echo $row_list['Shop'];?>
                    </option>
                <?
                }
                ?>
            </select>
            
 
<?php




echo"
<tr><td></td><td><input type='submit'></td></tr>
</table>
</form>";
?>

</body>
</html>