<?php 
include ('conexion.php');

$consulta="SELECT o.id_order AS Nro, CONCAT_WS(  ' ', g.firstname, g.lastname ) AS Cliente, n.`product_name` AS Producto, 
n.`product_quantity` AS Cantidad,o.payment AS TipoPago, n.`unit_price_tax_incl` AS PrecioUnitario,n.`product_price` , n.`total_price_tax_incl` AS Total
FROM  `cma_orders` o
LEFT JOIN  `cma_customer` g ON g.`id_customer` = o.`id_customer` 
LEFT JOIN  `cma_order_detail` n ON n.`id_order` = o.`id_order` 
WHERE (o.date_upd
BETWEEN  '2015-06-01'
AND  '2015-06-30') AND g.lastname LIKE '%Irigoyen%'
AND o.current_state <>6";


$total ="SELECT SUM(n.product_quantity) AS cantidad, SUM(total_price_tax_incl) AS total
FROM  `cma_orders` o
LEFT JOIN  `cma_customer` g ON g.`id_customer` = o.`id_customer` 
LEFT JOIN  `cma_order_detail` n ON n.`id_order` = o.`id_order` 
WHERE (o.date_upd
BETWEEN  '2015-06-01'
AND  '2015-06-30') AND g.lastname LIKE '%Irigoyen%'
AND o.current_state <>6";

$tarjeta ="SELECT SUM(n.product_quantity) AS cantidad, SUM(total_price_tax_incl) AS total
FROM  `cma_orders` o
LEFT JOIN  `cma_customer` g ON g.`id_customer` = o.`id_customer` 
LEFT JOIN  `cma_order_detail` n ON n.`id_order` = o.`id_order` 
WHERE (o.date_upd
BETWEEN  '2015-06-01'
AND  '2015-06-30') AND g.lastname LIKE '%Irigoyen%' AND o.payment = 'CC Payments Module'
AND o.current_state <>6";

$efectivo ="SELECT SUM(n.product_quantity) AS cantidad, SUM(total_price_tax_incl) AS total
FROM  `cma_orders` o
LEFT JOIN  `cma_customer` g ON g.`id_customer` = o.`id_customer` 
LEFT JOIN  `cma_order_detail` n ON n.`id_order` = o.`id_order` 
WHERE (o.date_upd
BETWEEN  '2015-06-01'
AND  '2015-06-30') AND g.lastname LIKE '%Irigoyen%' AND o.payment <> 'CC Payments Module'
AND o.current_state <>6";

echo '<table border="1">';
echo '<tr>';
echo '<th>Nro</th>';
echo '<th>Cliente</th>';
echo '<th>Producto</th>';
echo '<th>Cantidad</th>';
echo '<th>Tipo</th>';
echo '<th>Precio Unitario</th>';
echo '<th>Precio</th>';
echo '<th>Total</th>';
echo '</tr>';

$reporte= mysql_query($consulta);
while($fila = mysql_fetch_array($reporte))
{
	//echo "Warehouse " .$almacen['id_warehouse']; 
	//echo "<br/>";
	echo "<tr>";
	echo "<th>".$fila['Nro']."</th>";
	echo "<th>".$fila['Cliente']."</th>";
	echo "<th>".$fila['Producto']."</th>";
	
	echo "<th>".$fila['Cantidad']."</th>";
	echo "<th>".$fila['TipoPago']."</th>";
	
	echo "<th>".$fila['PrecioUnitario']."</th>";
	
	echo "<th>".$fila['product_price']."</th>";
	
	echo "<th>".$fila['Total']."</th>";
	
	echo "</tr>";
}
echo "<br/>";
$total = mysql_query($total);
$total = mysql_fetch_array($total);

$tarjeta = mysql_query($tarjeta);
$tarjeta = mysql_fetch_array($tarjeta);

$efectivo = mysql_query($efectivo);
$efectivo = mysql_fetch_array($efectivo);
echo '<table border="1">';
echo '<tr>';
echo '<th>Total ventas</th>';
echo "<th>".$total['cantidad']."</th>";
echo "<th>$".$total['total']."</th>";	
echo '</tr>';
echo '<tr>';
echo '<th>Tarjeta</th>';
echo "<th>".$tarjeta['cantidad']."</th>";
echo "<th>$".$tarjeta['total']."</th>";	
echo '</tr>';
echo '<tr>';
echo '<th>Efectivo</th>';
echo "<th>".$efectivo['cantidad']."</th>";
echo "<th>$".$efectivo['total']."</th>";	
echo '</tr>';
echo "</table>";

?>