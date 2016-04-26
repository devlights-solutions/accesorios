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

//$count= "SELECT COUNT(*) AS count FROM cma_stock_available csa 
//INNER JOIN cma_product_lang cpl 
//ON cpl.id_product = csa.id_product
//WHERE csa.id_shop = ".$shop." AND  cpl.id_shop=".$shop." AND id_lang = 1 AND csa.id_product = 17
//ORDER BY cpl.name";
//echo $count;
//$variables= mysql_query($count);
//$variables=mysql_fetch_array($variables);
//$variables = $variables['count'];

//
$count=1;

//traigo los productos
//$productos = "SELECT csa.id_product,cp.price,csa.id_product_attribute,csa.quantity,cpl.name FROM cma_stock_available csa 
//INNER JOIN cma_product_lang cpl 
//ON cpl.id_product = csa.id_product
//INNER JOIN cma_product cp
//ON csa.id_product = cp.id_product
//WHERE csa.id_shop = ".$shop." AND  cpl.id_shop= ".$shop." AND id_lang = 1  AND csa.quantity >0
//ORDER BY cpl.name
//";
//


//traigo productos ordenados por posicion
$productos = "SELECT csa.id_product,cp.price,csa.id_product_attribute,csa.quantity,cpl.name, ca.position FROM cma_stock_available csa 
INNER JOIN cma_product_lang cpl 
ON cpl.id_product = csa.id_product
INNER JOIN cma_product cp
ON csa.id_product = cp.id_product
INNER JOIN  cma_product_attribute_combination pac
ON pac.id_product_attribute = csa.id_product_attribute
INNER JOIN cma_attribute ca
ON  ca.id_attribute = pac.id_attribute
WHERE csa.id_shop =  ".$shop." AND  cpl.id_shop= ".$shop." AND id_lang = 1  AND csa.quantity >0
GROUP BY id_product,id_product_attribute 
ORDER BY cpl.name,ca.position
";




$productos= mysql_query($productos);

echo '<table border=1>';

echo '<tr>';
		//Muestro productos sin combinaciones
			echo '<td><strong>PRODUCTO</strong></td>';
			echo '<td><strong>CANTIDAD</strong></td>';
			echo '<td><strong>PRECIO</strong></td>';		
echo '</tr>';

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
			echo '<td>';echo $row_list['name'];echo '</td>';
			echo '<td>';echo $row_list['quantity'];echo '</td>';
			echo "<td>".money_format('%.2n', $row_list['price'])."</td>";
			
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
		$picaflor= mysql_fetch_array($atributos);
		
		if ($picaflor['name']<>'')
			{
				//echo "<br>";
				echo '<tr>';
				echo '<td>';
				echo $row_list['name']." - ";
				
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
				
				echo $atributo;
				echo '</td>';
				echo '<td>';echo $row_list['quantity'];echo '</td>';
				echo "<td>".money_format('%.2n', $row_list['price'])."</td>";
				echo '</tr>';
		}
	}

	

	$count = $count+1;
}


echo"

</table>
</form>";
?>

</body>
</html>