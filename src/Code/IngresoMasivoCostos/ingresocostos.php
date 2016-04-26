<html>
<title>Ingreso masivo de costos por productos</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<head>
<?php

?>

</head>
<body>
<h1>Ingreso Masivo de Costos por Productos</h1>
<br/>
<h1>Paso 1: Seleccion de producto</h1>
<?php
include ('conexion.php');
echo "
<form action='listaproductoscostos.php' method='get'>

";

?>
Producto :
            <select Name='idsproducto'>
            <option value="">--- Seleccione ---</option>
            <? $list=mysql_query("SELECT DISTINCT(pl.name) AS Producto, p.id_product AS idsproducto FROM cma_product p
INNER JOIN cma_product_lang pl
ON pl.id_product=p.id_product
WHERE pl.id_lang=1
ORDER BY pl.name
" );
            while($row_list=mysql_fetch_assoc($list)){
                ?> 
                    <option  value="<? echo $row_list['idsproducto']; ?>"<? if($row_list['idsproducto']==$select){ 	echo "selected"; } ?>>
                                         <?echo $row_list['Producto'];?>
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