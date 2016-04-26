<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Proceso de insercions</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<?php
$cant = $_GET[9999];
$shop = $_GET['ids'];
$idsproducto = $_GET['idsproducto'];

?>
</head>
<?php
include ('conexion.php');


?>
<body>

<?php
//variable que me va a determinar si hubo cambios
$changes=false;
//traigo el warehouse que corresponde al shop
			$warehouse="SELECT id_warehouse AS warehouse FROM cma_warehouse_shop WHERE id_shop=".$shop." AND id_warehouse <>1";
			$warehouse=mysql_query($warehouse);
			$warehouse=mysql_fetch_array($warehouse);
			//
			

$i=1;
echo '<h1>Proceso de actualización de costos iniciado.</h1>';
echo '<br/>';
echo '<h1>Paso 3: Resultados del proceso</h1>';

echo '<br/>';


//traigo los productos
$productos = "SELECT  * FROM cma_stock_available csa 
INNER JOIN cma_product_lang cpl 
ON cpl.id_product = csa.id_product
WHERE csa.id_shop = ".$shop." AND  cpl.id_shop= ".$shop." AND id_lang = 1 AND csa.id_product = ".$idsproducto." 
ORDER BY cpl.name";
//
//echo 'productos '.$productos;
$productos= mysql_query($productos);

while($row_list=mysql_fetch_array($productos))
{
	$cantidad = $_GET[$i];
	$costo = $_GET['cost'.$i];
	//echo 'costo = '.$costo;
	//echo $i .' cantidad: '.$cantidad;
	//echo '<br/>';
	//echo 'cantidad '. $cantidad;
	
		//Insercion del movimiento de stock
		
			//consulta de id de stock
			$idstock = "SELECT id_stock FROM cma_stock WHERE id_product=".$row_list['id_product']." AND id_warehouse = ".$warehouse['warehouse']." AND id_product_attribute=".$row_list['id_product_attribute']."";
			//echo $idstock;
			$idstock=mysql_query($idstock);
			$idstock =  mysql_fetch_array($idstock);
			
		
		
		//inserto o actualizo la tabla Costos
		$costoSearch="SELECT * FROM Costos WHERE id_product = ".$row_list['id_product']." AND id_product_attribute= ".$row_list['id_product_attribute']."";	
		//echo $costoSearch;
		$costoSearch=mysql_query($costoSearch);
		$costoSearch =  mysql_fetch_array($costoSearch);
		if($costoSearch['id_product']=='')
			{
				$insertCosto="INSERT INTO Costos (id_product,id_product_attribute,costo) 
								VALUES (".$row_list['id_product'].",".$row_list['id_product_attribute'].",$costo)";
				//echo $insertCosto;
				$insertCosto=mysql_query($insertCosto);
				$costoAnterior = 0;
				$mostrarMensaje=true;
			}
			
		else
			{
				$costoAnterior =$costoSearch['costo'];
				
				if($costoAnterio <> $costo)
				{
					$modificacionCosto="UPDATE Costos SET costo = $costo WHERE id_costo = ".$costoSearch['id_costo']."";
					//echo $modificacionCosto;
					$modificacionCosto=mysql_query($modificacionCosto);
					//echo 'hay datos';
					$mostrarMensaje=true;
				}
				
					
			}
		
		//Mensaje de éxito con descripcion del producto y cantidad anadida
		$codigosatributos= "SELECT * FROM cma_product_attribute_combination WHERE id_product_attribute=".$row_list['id_product_attribute']."";
		$codigosatributos=mysql_query($codigosatributos);
		$atributo='';
		while ($row_att_list =  mysql_fetch_array($codigosatributos))
		{
			
			$nombreatributo="SELECT name FROM cma_attribute_lang WHERE id_attribute=".$row_att_list['id_attribute']." AND id_lang = 1";
			$nombreatributo=mysql_query($nombreatributo);
			$nombreatributo=mysql_fetch_array($nombreatributo);
			$atributo = $atributo.' '.$nombreatributo['name'];
		}
		
		
		if($costo <>'' and $costo<>$costoAnterior)
		{
			echo '<p2>Se actualizo el precio del articulo '.$row_list['name'].' '.$atributo.' de $'.$costoAnterior.' a $ '.$costo.'</p2>';
			$changes=true;
			echo '</br>';
		}
		
	
	
	$i= $i+1;
}

if ($changes==0)
{
	echo '<p2>No hubo cambios de precios.</p2>';
}
?>
<?php

?>
</body>
</html>