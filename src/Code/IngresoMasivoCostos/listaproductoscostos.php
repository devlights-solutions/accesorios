<html>
<title>Ingreso masivo de productos</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<head>
<?php
$cant = $_GET[9999];
$shop = 2;
$idsproducto = $_GET['idsproducto'];
if ($idsproducto =='')
	$idsproducto=17;
?>

</head>
<body>
<h1>Ingreso Masivo de Productos</h1>
<br/>
<h1>Paso 2: Ingreso de cantidades. Para decimales use el punto</h1>

<?php
include ('conexion.php');
echo "
<form action='insercioncostos.php' method='get'>

";

?>


<?php

$count= "SELECT COUNT(*) AS count FROM cma_stock_available csa 
INNER JOIN cma_product_lang cpl 
ON cpl.id_product = csa.id_product
WHERE csa.id_shop = ".$shop." AND  cpl.id_shop=".$shop." AND id_lang = 1 AND csa.id_product = ".$idsproducto."
ORDER BY cpl.name";
//echo $count;
$variables= mysql_query($count);
$variables=mysql_fetch_array($variables);
$variables = $variables['count'];
echo"<input type='text' name=9999 value=$variables style='visibility:hidden' >"; //style='visibility:hidden'
echo"<input type='text' name=idsproducto value=$idsproducto style='visibility:hidden' >"; //style='visibility:hidden'
echo"<input type='text' name=ids value=$shop style='visibility:hidden' >"; //style='visibility:hidden'
//
$count=1;

//traigo los productos
$productos = "SELECT  * FROM cma_stock_available csa 
INNER JOIN cma_product_lang cpl 
ON cpl.id_product = csa.id_product
WHERE csa.id_shop = ".$shop." AND  cpl.id_shop= ".$shop." AND id_lang = 1  AND csa.id_product = ".$idsproducto."
ORDER BY cpl.name

";
//
$productos= mysql_query($productos);

echo '<table border=1>';
echo '<tr>';
		
echo '<td><STRONG>PRODUCTO</STRONG></td>';
echo '<td align="center"><STRONG>COSTO</STRONG></td>';

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
			echo '<td>';echo "<input type='text' name=cost$count>";echo '</td>';
		}
		echo '</tr>';
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
				//echo "<br>";
				echo '<tr>';
				echo '<td>';
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
				echo '</td>';
				echo '<td>';echo "<input type='text' name=cost$count>";echo '</td>';
				echo '</tr>';
		}
	}

	

	$count = $count+1;
}


echo"
<tr><td></td><td><input type='submit'></td></tr>
</table>
</form>";
?>

</body>
</html>