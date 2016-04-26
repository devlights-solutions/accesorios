<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reporte de ventas</title>
<?php
include ('conexion.php');
	$shop = $_GET['idc'];
	if ($vendedor =="")
	{$vendedor=13;}
	
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
<form id="form1" name="form1" method="get" action="<?php echo "ReporteGanancias.php?"; ?>">
            
            
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
$ventasTotalesCantidad=0;
$ventasTotalesPesos=0;
$ventasTotalesCostos=0;
$ventasTotalesTarjetas=0;
$ventasTotalesEfectivo=0;
$ventasTotalesBalance=0;
$totalSucursales=0;


$shops="SELECT DISTINCT(id_shop) FROM cma_orders o where (o.date_add
BETWEEN  '".$yearfrom."-".$monthfrom."-".$dayfrom."'
AND  '".$yearto."-".$monthto."-".$dayto."')";
//echo $shops;
$shops= mysql_query($shops);
while($filaShop = mysql_fetch_array($shops))
{
	//echo 'fila shop '.$filaShop['id_shop'];
	$shopName="SELECT * FROM cma_shop where id_shop = ".$filaShop['id_shop']."";
	$shopName= mysql_query($shopName);
	$shopName = mysql_fetch_array($shopName);
	
	
			//tabla principal
		$consulta="SELECT o.id_order AS Nro, o.date_add AS fecha, n.`product_name` AS Producto, 
		(n.`product_quantity` - n.product_quantity_return) AS Cantidad,o.payment AS TipoPago, n.`unit_price_tax_incl` AS PrecioUnitario,n.`product_price` , (n.`product_price`  * (n.`product_quantity` - n.product_quantity_return)) AS Total
		FROM  `cma_orders` o
		LEFT JOIN  `cma_order_detail` n ON n.`id_order` = o.`id_order` 
		WHERE (o.date_add
BETWEEN  '".$yearfrom."-".$monthfrom."-".$dayfrom."'
AND  '".$yearto."-".$monthto."-".$dayto."') AND o.id_shop=".$filaShop['id_shop']."
		AND o.current_state <>6";
	
	
	
		//Totales
		$total ="SELECT SUM(n.product_quantity - n.product_quantity_return) AS cantidad, SUM(n.`product_price`  * (n.`product_quantity` - n.product_quantity_return)) AS total
		FROM  `cma_orders` o
		LEFT JOIN  `cma_customer` g ON g.`id_customer` = o.`id_customer` 
		LEFT JOIN  `cma_order_detail` n ON n.`id_order` = o.`id_order` 
		WHERE (o.date_add
BETWEEN  '".$yearfrom."-".$monthfrom."-".$dayfrom."'
AND  '".$yearto."-".$monthto."-".$dayto."') AND o.id_shop=".$filaShop['id_shop']."
		AND o.current_state <>6";
	
		//Tarjeta
		$tarjeta ="SELECT SUM(n.product_quantity - n.product_quantity_return) AS cantidad, SUM(n.`product_price`  * (n.`product_quantity` - n.product_quantity_return)) AS total
		FROM  `cma_orders` o
		LEFT JOIN  `cma_customer` g ON g.`id_customer` = o.`id_customer` 
		LEFT JOIN  `cma_order_detail` n ON n.`id_order` = o.`id_order` 
		WHERE (o.date_add
			BETWEEN  '".$yearfrom."-".$monthfrom."-".$dayfrom."'
			AND  '".$yearto."-".$monthto."-".$dayto."') AND o.id_shop=".$filaShop['id_shop']." 
			AND (o.payment = 'CC Payments Module' OR o.payment = 'Tarjeta de credito')
			AND o.current_state <>6";
		
		//Efectivo
		$efectivo ="SELECT SUM(n.product_quantity - n.product_quantity_return) AS cantidad, SUM(n.`product_price`  * (n.`product_quantity` - n.product_quantity_return)) AS total
		FROM  `cma_orders` o
		LEFT JOIN  `cma_customer` g ON g.`id_customer` = o.`id_customer` 
		LEFT JOIN  `cma_order_detail` n ON n.`id_order` = o.`id_order` 
		WHERE (o.date_add BETWEEN  '".$yearfrom."-".$monthfrom."-".$dayfrom."' AND  
		'".$yearto."-".$monthto."-".$dayto."') AND  o.id_shop=".$filaShop['id_shop']." AND o.payment <> 'CC Payments Module' 
		AND o.payment <> 'Tarjeta de credito'
		AND o.current_state <>6" ;
		
		echo '<br/>';
		$costos = 0;
		$costosTotales=0;
		$costosCargados=0;
		$costosNoCargados=0;
		$vend=mysql_query($consulta);
		if ($vend <>'')
			$vend = mysql_fetch_array($vend);
		
		
			echo "<th>Reporte de ventas y costos de: <strong>".$shopName['name']."</strong></th>";
			echo '<br/>';
			
			//echo '<table border="1">';
			///echo '<tr>';
			//echo '<th>Nro</th>';
			//echo '<th>Fecha</th>';
			//echo '<th>Producto</th>';
			//echo '<th>Cantidad</th>';
			//echo '<th>Tipo</th>';
			//echo '<th>Precio Unitario</th>';
			//echo '<th>Precio</th>';
			//echo '<th>Total</th>';
			//echo '</tr>';
			
			$reporte= mysql_query($consulta);
			while($fila = mysql_fetch_array($reporte))
			{
				//Order detail
				$orderdetail="SELECT * FROM cma_order_detail WHERE id_order = ".$fila['Nro']."";
				$orderdetail=mysql_query($orderdetail);
				$orderdetail=mysql_fetch_array($orderdetail);
				//
				$costoUnitario="SELECT * FROM Costos WHERE id_product = ".$orderdetail['product_id']." 
									AND id_product_attribute = ".$orderdetail['product_attribute_id']."";
			
				$costoUnitario=mysql_query($costoUnitario);
				if ($costoUnitario=='')
				{
					$costos=0 * $fila['Cantidad'];
				}
				else
				{
					$costoUnitario=mysql_fetch_array($costoUnitario);
					$costos=$costoUnitario['costo'] * $fila['Cantidad'];
				}
				
				$costosTotales=$costosTotales+$costos;
				
				if ($costos>0)
					$costosCargados=$costosCargados+1;
				else
					$costosNoCargados=$costosNoCargados+1;
				
				//echo $costos;
				//echo "<br/>";
				
				if ($fila['TipoPago']=="CC Payments Module" || $fila['TipoPago']=="Tarjeta de credito")
					$tipoPago = "Tarjeta";
				else
					$tipoPago = "Efectivo";
					
				//echo "<tr>";
				//echo "<th>".$fila['Nro']."</th>";
				//$fecha = $fila['fecha']; 
				//	preg_match('/(\d{4})-(\d{2})-(\d{2})/',$fecha,$partes);
				//echo "<th>".$partes[3]."/".$partes[2]."/".$partes[1]."</th>";
				//echo "<th>".$fila['Producto']."</th>";
				
				//echo "<th>".$fila['Cantidad']."</th>";
				//echo "<th>".$tipoPago."</th>";
				
				//echo "<th>".money_format('%.2n', $fila['PrecioUnitario'])."</th>";
				
				//echo "<th>".money_format('%.2n', $fila['product_price'])."</th>";
				
				//echo "<th>".money_format('%.2n', $fila['Total'])."</th>";
			
				
				//echo "</tr>";
			}
			//echo "Costos cargados= ".$costosCargados;
			//echo "Costos no cargados= ".$costosNoCargados;
			//echo "Costos Totales= ".$costosTotales;
			//echo "<br/>";
			$total = mysql_query($total);
			$total = mysql_fetch_array($total);
			
			$tarjeta = mysql_query($tarjeta);
			$tarjeta = mysql_fetch_array($tarjeta);
			
			$efectivo = mysql_query($efectivo);
			$efectivo = mysql_fetch_array($efectivo);
			echo '<table border="1">';
			echo '<tr>';
			echo '<th>Costos Cargados</th>';
			echo "<th>#</th>";
			echo "<th>".$costosCargados."</th>";	
			echo '</tr>';
			
			echo '<tr>';
			echo '<th>Costos sin cargar</th>';
			echo "<th>#</th>";
			echo "<th>".$costosNoCargados."</th>";	
			echo '</tr>';
			
						
			echo '<tr>';
			echo '<th>Total ventas</th>';
			echo "<th>".$total['cantidad']."</th>";
			echo "<th>$".money_format('%.2n', $total['total'])."</th>";	
			echo '</tr>';
			
			echo '<tr>';
			echo '<th>Total de costos</th>';
			echo "<th>#</th>";
			echo "<th>$".money_format('%.2n', $costosTotales)."</th>";	
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
			
			$ventasTotalesCantidad= $ventasTotalesCantidad+$total['cantidad'];
			$ventasTotalesPesos= $ventasTotalesPesos + $total['total'];
			$ventasTotalesCostos=$ventasTotalesCostos +$costosTotales;
			$ventasTotalesTarjetas=$ventasTotalesTarjetas + $tarjeta['total'];
			$ventasTotalesEfectivo=$ventasTotalesEfectivo + $efectivo['total'];
			
			$totalSucursales=$totalSucursales+1;
			
	
}
?>
</table>
<?php
echo '<br/>';echo '<br/>';
echo '<h1>TOTALES</h1>';
echo '<br/>';


$ventasTotalesBalance=$ventasTotalesPesos-$ventasTotalesCostos;


echo'
<table width="30%" border="1" style="font-size:22px">
  <tr>
    <td>Cantidad de sucursales</td>
    <td align="right"><strong>'.$totalSucursales.'</strong></td>
  </tr>
  <tr>
    <td>Cantidad Total</td>
    <td align="right"><strong>'.$ventasTotalesCantidad.'</strong></td>
  </tr>
  <tr>
    <td>Total Ingresos</td>
    <td align="right"><strong>$ '.$ventasTotalesPesos.'</strong></td>
  </tr>
  <tr>
    <td>Total Tarjetas</td>
    <td align="right"><strong>$ '.$ventasTotalesTarjetas.'</strong></td>
  </tr>
  <tr>
    <td>Total Efectivo</td>
    <td align="right"><strong>$ '.$ventasTotalesEfectivo.'</strong></td>
  </tr>
  <tr>
    <td>Total Costos</td>
    <td align="right"><strong>$ '.$ventasTotalesCostos.'</strong></td>
  </tr>
  <tr>
    <td>Balance</td>
    <td align="right"><strong>$ '.$ventasTotalesBalance.'</strong></td>
  </tr>
</table>
';

?>
</body>
</html>