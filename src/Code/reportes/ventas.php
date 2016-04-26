<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reporte de ventas</title>
<?php
include ('conexion.php');
	$vendedor = $_GET['idc'];
	if ($vendedor =="")
	{$vendedor=20;}
	
	//FROM
	$dayfrom = $_GET['day'];
	if ($dayfrom =="")
	{$dayfrom=1;}
	
	$monthfrom = $_GET['month'];
	if ($monthfrom =="")
	{$monthfrom=1;}
	
	$yearfrom = $_GET['year'];
	if ($yearfrom =="")
	{$yearfrom=2015;}
	
	//TO
	$dayto = $_GET['dayto'];
	if ($dayfrom =="")
	{$dayfrom=31;}
	
	$monthto = $_GET['monthto'];
	if ($monthfrom =="")
	{$monthfrom=12;}
	
	$yearto = $_GET['yearto'];
	if ($yearfrom =="")
	{$yearfrom=2015;}
?>
</head>

<body>
<form id="form1" name="form1" method="get" action="<?php echo "http://devlightsclientes.com.ar/accesorios/reportes/ventas.php?"; ?>">
            Vendedor :
            <select Name='idc'>
            <option value="">--- Seleccione ---</option>
            <? $list=mysql_query("SELECT CONCAT_WS(  ' ', c.firstname, c.lastname ) AS Cliente,c.id_customer AS idc FROM cma_customer c
" );
            while($row_list=mysql_fetch_assoc($list)){
                ?> 
                    <option  value="<? echo $row_list['idc']; ?>"<? if($row_list['idc']==$select){ 	echo "selected"; } ?>>
                                         <?echo $row_list['Cliente'];?>
                    </option>
                <?
                }
                ?>
            </select>
            
 <br />   
 Desde:
<select name="day">
  <option value="">Dia</option>
	<?php for ($day = 1; $day <= 31; $day++) { ?>
	<option value="<?php echo strlen($day)==1 ? '0'.$day : $day; ?>"><?php echo strlen($day)==1 ? '0'.$day : $day; ?></option>
	<?php } ?>
</select>
<select name="month">
	<option value="">Mes</option>
	<?php for ($month = 1; $month <= 12; $month++) { ?>
	<option value="<?php echo strlen($month)==1 ? '0'.$month : $month; ?>"><?php echo strlen($month)==1 ? '0'.$month : $month; ?></option>
	<?php } ?>
</select>
<select name="year">
  <option value="">Año</option>
  <?php for ($year = date('Y'); $year > date('Y')-100; $year--) { ?>
	<option value="<?php echo $year; ?>"><?php echo $year; ?></option>
	<?php } ?>
</select>
<br />
 Hasta:
<select name="dayto">
  <option value="">Dia</option>
	<?php for ($day = 1; $day <= 31; $day++) { ?>
	<option value="<?php echo strlen($day)==1 ? '0'.$day : $day; ?>"><?php echo strlen($day)==1 ? '0'.$day : $day; ?></option>
	<?php } ?>
</select>
<select name="monthto">
	<option value="">Mes</option>
	<?php for ($month = 1; $month <= 12; $month++) { ?>
	<option value="<?php echo strlen($month)==1 ? '0'.$month : $month; ?>"><?php echo strlen($month)==1 ? '0'.$month : $month; ?></option>
	<?php } ?>
</select>
<select name="yearto">
  <option value="">Año</option>
  <?php for ($year = date('Y'); $year > date('Y')-100; $year--) { ?>
	<option value="<?php echo $year; ?>"><?php echo $year; ?></option>
	<?php } ?>
</select>
            
            
            <input type="submit" name="Submit" value="Ver Reporte" />
</form>





<!--FORMULARIO DE VENTA--!>
<?php 
if ($vendedor<>0)
{
	//tabla principal
$consulta="SELECT o.id_order AS Nro, CONCAT_WS(  ' ', g.firstname, g.lastname ) AS Cliente,o.date_add AS fecha, n.`product_name` AS Producto, 
(n.`product_quantity` - n.product_quantity_return) AS Cantidad,o.payment AS TipoPago, n.`unit_price_tax_incl` AS PrecioUnitario,n.`product_price` , (n.`product_price`  * (n.`product_quantity` - n.product_quantity_return)) AS Total
FROM  `cma_orders` o
LEFT JOIN  `cma_customer` g ON g.`id_customer` = o.`id_customer` 
LEFT JOIN  `cma_order_detail` n ON n.`id_order` = o.`id_order` 
WHERE (o.date_add
BETWEEN  '".$yearfrom."-".$monthfrom."-".$dayfrom."'
AND  '".$yearto."-".$monthto."-".$dayto."') AND g.id_customer =$vendedor
AND o.current_state <>6";



//Totales
$total ="SELECT SUM(n.product_quantity - n.product_quantity_return) AS cantidad, SUM(n.`product_price`  * (n.`product_quantity` - n.product_quantity_return)) AS total
FROM  `cma_orders` o
LEFT JOIN  `cma_customer` g ON g.`id_customer` = o.`id_customer` 
LEFT JOIN  `cma_order_detail` n ON n.`id_order` = o.`id_order` 
WHERE (o.date_add
BETWEEN  '".$yearfrom."-".$monthfrom."-".$dayfrom."'
AND  '".$yearto."-".$monthto."-".$dayto."') AND g.id_customer =$vendedor
AND o.current_state <>6";

//Tarjeta
$tarjeta ="SELECT SUM(n.product_quantity - n.product_quantity_return) AS cantidad, SUM(n.`product_price`  * (n.`product_quantity` - n.product_quantity_return)) AS total
FROM  `cma_orders` o
LEFT JOIN  `cma_customer` g ON g.`id_customer` = o.`id_customer` 
LEFT JOIN  `cma_order_detail` n ON n.`id_order` = o.`id_order` 
WHERE (o.date_add
BETWEEN  '".$yearfrom."-".$monthfrom."-".$dayfrom."'
AND  '".$yearto."-".$monthto."-".$dayto."') AND g.id_customer =$vendedor AND (o.payment = 'CC Payments Module' OR o.payment = 'Tarjeta de credito')
AND o.current_state <>6";

//Efectivo
$efectivo ="SELECT SUM(n.product_quantity - n.product_quantity_return) AS cantidad, SUM(n.`product_price`  * (n.`product_quantity` - n.product_quantity_return)) AS total
FROM  `cma_orders` o
LEFT JOIN  `cma_customer` g ON g.`id_customer` = o.`id_customer` 
LEFT JOIN  `cma_order_detail` n ON n.`id_order` = o.`id_order` 
WHERE (o.date_add
BETWEEN  '".$yearfrom."-".$monthfrom."-".$dayfrom."'
AND  '".$yearto."-".$monthto."-".$dayto."') AND g.id_customer =$vendedor AND o.payment <> 'CC Payments Module' AND o.payment <> 'Tarjeta de credito'
AND o.current_state <>6" ;

echo '<br/>';

$vend=mysql_query($consulta);
$vend = mysql_fetch_array($vend);
if ($vend['Cliente']<>""){
echo "<th>Reporte de ventas de: <strong>".$vend['Cliente']."</strong></th>";
echo '<br/>';

echo '<table border="1">';
echo '<tr>';
echo '<th>Nro</th>';
echo '<th>Fecha</th>';
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
	if ($fila['TipoPago']=="CC Payments Module" || $fila['TipoPago']=="Tarjeta de credito")
		$tipoPago = "Tarjeta";
	else
		$tipoPago = "Efectivo";
		
	echo "<tr>";
	echo "<th>".$fila['Nro']."</th>";
	$fecha = $fila['fecha']; 
		preg_match('/(\d{4})-(\d{2})-(\d{2})/',$fecha,$partes);
	echo "<th>".$partes[3]."/".$partes[2]."/".$partes[1]."</th>";
	echo "<th>".$fila['Producto']."</th>";
	
	echo "<th>".$fila['Cantidad']."</th>";
	echo "<th>".$tipoPago."</th>";
	
	echo "<th>".money_format('%.2n', $fila['PrecioUnitario'])."</th>";
	
	echo "<th>".money_format('%.2n', $fila['product_price'])."</th>";
	
	echo "<th>".money_format('%.2n', $fila['Total'])."</th>";

	
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
echo "<th>$".money_format('%.2n', $total['total'])."</th>";	
echo '</tr>';
echo '<tr>';
echo '<th>Tarjeta</th>';
echo "<th>".$tarjeta['cantidad']."</th>";
echo "<th>$".money_format('%.2n', $tarjeta['total'])."</th>";	
echo '</tr>';
echo '<tr>';
echo '<th>Efectivo</th>';
echo "<th>".$efectivo['cantidad']."</th>";
echo "<th>$".money_format('%.2n', $efectivo['total'])."</th>";	
echo '</tr>';
echo "</table>";
}
else
	echo 'No se encontraron resultados';
}
else
	echo 'No se encontraron resultados';
?>
</table>


</body>
</html>