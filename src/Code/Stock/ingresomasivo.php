<title>Planilla de stock</title>
<?php 
include ('conexion.php');


	$shop = $_GET['shop'];
	if ($shop =="")
	{$shop=13;}
	
	


$consulta="SELECT DISTINCT pl.name AS Producto, al.name AS Tipo , sa.quantity AS Cantidad, 
pac.id_product_attribute AS Combinacion,pac.id_attribute AS Atributo,sa.id_product AS id
FROM cma_stock_available sa
INNER JOIN cma_product_lang pl
ON pl.id_product=sa.id_product
INNER JOIN cma_product_attribute pa
ON pa.id_product_attribute= sa.id_product_attribute
INNER JOIN cma_product_attribute_combination pac
ON pac.id_product_attribute= pa.id_product_attribute
INNER JOIN cma_attribute_lang al
ON al.id_attribute= pac.id_attribute
WHERE sa.id_shop=$shop
AND pl.id_shop=$shop
AND pl.id_lang=2
ORDER BY Producto, pac.id_product_attribute";



echo '<table border="1">';
echo '<tr>';
echo '<th>Producto</th>';
echo '<th>Tipo</th>';
echo '<th>Cantidad</th>';
echo '</tr>';

$id_nuevo= 0;
$atributo_nuevo=0;
$combinacion_nuevo=0;
	
$reporte= mysql_query($consulta);
while($fila = mysql_fetch_array($reporte))
{
	//if($id_nuevo==0)
	//{
	//	$id_viejo= $fila['id'];
	//	$atributo_viejo=$fila['Atributo'];
	//	$combinacion_viejo= $fila['Combinacion'];
	//}
	//else
	//{ 
		$id_viejo= $id_nuevo;
		$atributo_viejo=$atributo_nuevo;
		$combinacion_viejo=$combinacion_nuevo;
	//}
	
	$id_nuevo= $fila['id'];
	$atributo_nuevo=$fila['Atributo'];
	$combinacion_nuevo= $fila['Combinacion'];
	
	//$tipo=$fila['Tipo']
;
	
	if($id_nuevo==$id_viejo && $combinacion_nuevo == $combinacion_viejo && $atributo_nuevo != $atributo_viejo)
	{ //Concatenar tipos
		$tipo= $tipo. ' ' .$fila['Tipo'];
		//echo "'".$tipo."'";
	}
	else
	{
		$tipo=$fila['Tipo'];
	}
	
	if($id_nuevo==$id_viejo && $combinacion_nuevo == $combinacion_viejo && $atributo_nuevo != $atributo_viejo)
	{
		echo "<tr>";
		echo "<th>".$fila['Producto']."</th>";
		echo "<th>".$tipo."</th>";
		echo "<th>".$fila['Cantidad']."</th>";
		echo "<th><input name=".$id_nuevo." type='text' /></th>";
		echo "</tr>";
	}
	

	
}
echo "<br/>";

?>