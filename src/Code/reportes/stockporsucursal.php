<html>
<title>Reporte de stock</title>
<link href="../css/sistemas/style.css" rel="stylesheet" type="text/css">
<head>
<?php
$shop = $_GET['ids'];
?>

</head>
<body>
<?php
include ('conexion.php');
$nombreShop="SELECT s.name AS Shop,s.id_shop AS ids FROM cma_shop s WHERE s.id_shop = ".$shop."";
$nombreShop=mysql_query($nombreShop);
$nombreShop=mysql_fetch_array($nombreShop);
echo '<h1>Stock salon: '.$nombreShop['Shop'].'</h1>';
?>


<br/>
<?php
include ('conexion.php');
echo "


";

?>


<?php
function guidv4()
{
    if (function_exists('com_create_guid') === true)
        return trim(com_create_guid(), '{}');

    $data = openssl_random_pseudo_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

//
$count=1;
mysql_query("DELETE FROM a_StockSucursal WHERE Sucursal = $shop");




//traigo productos ordenados por posicion
$productos = "SELECT csa.id_product,cp.price,csa.id_product_attribute,csa.quantity,cpl.name, ca.position, IFNULL(csp.price,0) specificprice FROM cma_stock_available csa 
INNER JOIN cma_product_lang cpl 
ON cpl.id_product = csa.id_product
INNER JOIN cma_product cp
ON csa.id_product = cp.id_product
INNER JOIN  cma_product_attribute_combination pac
ON pac.id_product_attribute = csa.id_product_attribute
INNER JOIN cma_attribute ca
ON  ca.id_attribute = pac.id_attribute
LEFT JOIN cma_specific_price csp
ON csp.id_product = cp.id_product AND csp.id_product_attribute = csa.id_product_attribute
WHERE csa.id_shop =  02 AND  cpl.id_shop= 02 AND id_lang = 1  AND csa.quantity >0
GROUP BY id_product,id_product_attribute 
ORDER BY cpl.name,ca.position
";

//
//echo $productos;


$productosCount = mysql_query($productos);
$productosCount = mysql_num_rows($productosCount);
echo '<h2>Cantidad de productos en el listado: '.$productosCount.'</h2>';
$productos= mysql_query($productos);



while($row_list=mysql_fetch_array($productos))
{
	
	$cantidadatributos= "SELECT  COUNT(*) as count FROM cma_stock_available csa 
	LEFT JOIN cma_product_lang cpl 
	ON cpl.id_product = csa.id_product
	INNER JOIN cma_product_attribute_combination cac
	ON csa.id_product_attribute = cac.id_product_attribute
	WHERE csa.id_shop = ".$shop." AND  cpl.id_shop= ".$shop." AND id_lang = 1 AND csa.id_product = ".$row_list['id_product']."
	ORDER BY cpl.name";
	$cantidadatributos=mysql_query($cantidadatributos);
	$cantidadatributos= mysql_fetch_array($cantidadatributos);
	if ($cantidadatributos['count']==0)
	{
		echo '<tr>';
		//Muestro productos sin combinaciones
		if ($row_list['id_product_attribute']==0)
		{
			//echo "<br>";
			//echo '<td>';echo $row_list['name'];echo '</td>';
			//echo '<td>';echo $row_list['quantity'];echo '</td>';
			//echo "<td>".money_format('%.2n', $row_list['price'])."</td>";
			
			$insert="INSERT INTO a_StockSucursal 
				(Id,Producto,Cantidad,Precio,Sucursal)
				VALUES
				('".guidv4()."', 
				'".$row_list['name']."', 
				".$row_list['quantity'].", 
				".$row_list['price'].",
				".$shop."
				)";
			
			$a_stock= mysql_query($insert);
			
		}
		echo '</tr>';
	}
	else
	{
		//Muestro productos con combinaciones
		$atributos="SELECT cal.name FROM cma_product_attribute_combination pac
INNER JOIN cma_attribute ca
ON ca.id_attribute = pac.id_attribute
INNER JOIN cma_attribute_lang cal
ON cal.id_attribute = ca.id_attribute
WHERE pac.id_product_attribute = ".$row_list['id_product_attribute']." AND cal.id_lang =1
ORDER BY ca.id_attribute_group DESC ";
		$atributos=mysql_query($atributos);
		$atributos= mysql_fetch_array($atributos);
		
		if ($atributos['name']<>'')
			{
				//echo "<br>";
				//echo '<tr>';
				//echo '<td>';
				//echo $row_list['name']." - ";
				
				

				$atributos="SELECT cal.name FROM cma_product_attribute_combination pac
INNER JOIN cma_attribute ca
ON ca.id_attribute = pac.id_attribute
INNER JOIN cma_attribute_lang cal
ON cal.id_attribute = ca.id_attribute
WHERE pac.id_product_attribute = ".$row_list['id_product_attribute']." AND cal.id_lang =1
ORDER BY ca.id_attribute_group DESC ";
				$atributos=mysql_query($atributos);
				
				$atributo="";
				while($row = mysql_fetch_array($atributos))
				{
					$atributo=$atributo.$row['name']." ";
				}
				
				//echo $atributo;
				//echo '</td>';
				//echo '<td>';echo $row_list['quantity'];echo '</td>';
				//echo "<td>".money_format('%.2n', $row_list['price'])."</td>";
				//echo '</tr>';


				$insert="INSERT INTO a_StockSucursal 
					(Id,Producto,Combinacion,Cantidad,Precio,Sucursal,SpecificPrice)
					VALUES
					('".guidv4()."', 
					'".$row_list['name']."',
					'".$atributo."', 
					".$row_list['quantity'].", 
					".$row_list['price'].",
					".$shop.",
					".$row_list['specificprice']."
					)";
				
				$a_stock= mysql_query($insert);
		}
	}

	

	$count = $count+1;
}

echo '<table border=1>';

echo '<tr>';
		//Muestro productos sin combinaciones
			echo '<td><strong>PRODUCTO</strong></td>';
			echo '<td><strong>ATRIBUTO</strong></td>';
			echo '<td><strong>CANTIDAD</strong></td>';
			echo '<td><strong>PRECIO</strong></td>';		
echo '</tr>';
$stock_query="SELECT * FROM a_StockSucursal where Sucursal = $shop ORDER BY Producto,Combinacion";

$stock_query= mysql_query($stock_query);



while($row_list=mysql_fetch_array($stock_query))
{
	echo '<tr>';
	echo '<td>';echo $row_list['Producto'];echo '</td>';
	echo '<td>';echo $row_list['Combinacion'];echo '</td>';
	echo '<td>';echo $row_list['Cantidad'];echo '</td>';
	if ($row_list['SpecificPrice'] > 0)
		echo "<td><strong>".money_format('%.2n', $row_list['SpecificPrice'])."</strong></td>";
	else
		echo "<td>".money_format('%.2n', $row_list['Precio'])."</td>";
	
	echo '</tr>';
}


echo"


</table>
</form>";
include('desconexion.php');
?>

</body>
</html>