<html>
<title>Ingreso masivo de productos</title>
<body>
<?php
include ('conexion.php');
echo "
<form action='insercion.php' method='get'>

";

//$count=1;

$count= "SELECT COUNT(*) AS count FROM cma_stock_available csa 
INNER JOIN cma_product_lang cpl 
ON cpl.id_product = csa.id_product
WHERE csa.id_shop = 13 AND  cpl.id_shop=13 AND id_lang = 1
ORDER BY cpl.name";
$variables= mysql_query($count);
$variables=mysql_fetch_array($variables);
$variables = $variables['count'];
echo"<input type='text' name=9999 value=$variables style='visibility:hidden' >"; //style='visibility:hidden'
//


//traigo los productos
$productos = "SELECT  * FROM cma_stock_available csa 
INNER JOIN cma_product_lang cpl 
ON cpl.id_product = csa.id_product
WHERE csa.id_shop = 13 AND  cpl.id_shop=13 AND id_lang = 1  
ORDER BY cpl.name";
//
$productos= mysql_query($productos);

while($row_list=mysql_fetch_array($productos))
{
	$cantidadatributos= "SELECT  COUNT(*) as count FROM cma_stock_available csa 
	LEFT JOIN cma_product_lang cpl 
	ON cpl.id_product = csa.id_product
	INNER JOIN cma_product_attribute_combination cac
	ON csa.id_product_attribute = cac.id_product_attribute
	WHERE csa.id_shop = 13 AND  cpl.id_shop=13 AND id_lang = 1 AND csa.id_product = ".$row_list['id_product']."
	ORDER BY cpl.name";
	$cantidadatributos=mysql_query($cantidadatributos);
	$cantidadatributos= mysql_fetch_array($cantidadatributos);
	if ($cantidadatributos['count']==0)
	{
		//Muestro productos sin combinaciones
		if ($row_list['id_product_attribute']==0)
		{
			echo "<br>";
			echo $row_list['name'];
			echo "<input type='text' name=$count>";
		}
	}
	else
	{
		//Muestro productos con combinaciones
			$atributos="SELECT cal.name FROM cma_attribute_lang cal WHERE cal.id_attribute IN
	 (SELECT cac.id_attribute AS atributo FROM cma_product_attribute_combination cac
	WHERE cac.id_product_attribute = ".$row_list['id_product_attribute'].") AND cal.id_lang =1";
		$atributos=mysql_query($atributos);
		$picaflor= mysql_fetch_array($atributos);
		
		if ($picaflor['name']<>'')
			{
				echo "<br>";
				echo $row_list['name']." - ";
				
				$atributos="SELECT cal.name FROM cma_attribute_lang cal WHERE cal.id_attribute IN
	 (SELECT cac.id_attribute AS atributo FROM cma_product_attribute_combination cac
		WHERE cac.id_product_attribute = ".$row_list['id_product_attribute'].") AND cal.id_lang =1";
		$atributos=mysql_query($atributos);
				
				$atributo="";
				while($row = mysql_fetch_array($atributos))
				{
					$atributo=$atributo.$row['name']." ";
				}
				
				echo $atributo;
				echo "<input type='text' name=$count>";
			}
	}

	

	$count = $count+1;
}


echo"
<input type='submit'>
</form>";
?>

</body>
</html>