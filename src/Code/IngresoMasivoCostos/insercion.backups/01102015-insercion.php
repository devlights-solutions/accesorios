<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<?php
$cant = $_GET[9999];
$shop = $_GET['ids'];
echo $shop;
?>
</head>
<?php
include ('conexion.php');
	
	
?>
<body>

<?php

$i=1;
echo 'Proceso de insercion iniciado...';
if (mysql_query("INSERT INTO PEOPLE (NAME ) VALUES ('COLE')")) {
  echo 'Success';
} else {
  echo 'Fail';
} 
echo '<br/><br/>';


//traigo los productos
$productos = "SELECT  * FROM cma_stock_available csa 
INNER JOIN cma_product_lang cpl 
ON cpl.id_product = csa.id_product
WHERE csa.id_shop = ".$shop." AND  cpl.id_shop= ".$shop." AND id_lang = 1  
ORDER BY cpl.name";
//
$productos= mysql_query($productos);

while($row_list=mysql_fetch_array($productos))
{
	$cantidad = $_GET[$i];
	
	
	if ($cantidad<>'')
	{
		//Insercion del movimiento de stock
		
			//consulta de id de stock
			$idstock = "SELECT id_stock FROM cma_stock WHERE id_product=".$row_list['id_product']." AND id_product_attribute=".$row_list['id_product_attribute']."";
			$idstock=mysql_query($idstock);
			$idstock =  mysql_fetch_array($idstock);
			//
			
			//controlo que idstock no este vacio.
			//echo $idstock['id_stock'].' ID STOCK!!!';
			if ($idstock['id_stock']=='')
				{
				$insert="INSERT INTO cma_stock 
					( 
					id_warehouse, 
					id_product, 
					id_product_attribute, 
					physical_quantity, 
					usable_quantity, 
					price_te
					)
					VALUES
					( 
					".$shop.", 
					".$row_list['id_product'].", 
					".$row_list['id_product_attribute'].", 
					0,
					0,
					1
					);";
					//echo $insert;
				mysql_query($insert);
				$idstock = "SELECT id_stock FROM cma_stock WHERE id_product=".$row_list['id_product']." AND id_product_attribute=".$row_list['id_product_attribute']."";
			$idstock=mysql_query($idstock);
			$idstock =  mysql_fetch_array($idstock);
				}
			//
			
			//determino si es aumento o disminucion de stock
			if ($cantidad>0)
			{
				$mvtreason=1;
				$signo=1;
				$mensaje='aumentaron ';
			}
				
			else
			{
				$mvtreason=2;
				$cantidad=$cantidad*-1;
				$signo=-1;
				$mensaje='disminuyeron ';
			}
			//
			
			//insercion del stock movement
			$insert="INSERT INTO cma_stock_mvt 
				(id_stock, 
				id_order, 
				id_supply_order, 
				id_stock_mvt_reason, 
				id_employee, 
				employee_lastname, 
				employee_firstname, 
				physical_quantity, 
				DATE_ADD, 
				SIGN, 
				price_te, 
				last_wa, 
				current_wa, 
				referer
				)
				VALUES
				(".$idstock['id_stock'].", 
				0, 
				0, 
				".$mvtreason."., 
				5, 
				'Movil Group', 
				'Alejandro', 
				".$cantidad.", 
				NOW(), 
				".$signo.", 
				1, 
				1, 
				1, 
				0
				)";
				mysql_query($insert);
				
				$update="UPDATE cma_stock_available SET quantity = quantity + ".$cantidad*$signo." WHERE id_product=".$row_list['id_product']." AND id_product_attribute = ".$row_list['id_product_attribute']." AND id_shop=".$shop." " ;
				mysql_query($update);


			//
			
			
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
		
		
		
		echo 'Se '.$mensaje.$cantidad. ' articulos para el producto '.$row_list['name'].' '.$atributo;
		
		echo '</br>';
	}
	
	$i= $i+1;
}
?>
</body>
</html>