<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Proceso de insercion</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<?php
$cant = $_GET[9999];
$shop = $_GET['ids'];

?>
</head>
<?php
include ('conexion.php');
$nombreShop="SELECT s.name AS Shop,s.id_shop AS ids FROM cma_shop s WHERE s.id_shop = ".$shop."";
$nombreShop=mysql_query($nombreShop);
$nombreShop=mysql_fetch_array($nombreShop);

?>
<body>

<?php

$i=1;
echo '<h1>Proceso de insercion iniciado para sucursal: '.$nombreShop['Shop'].'</h1>';

echo '<br/>';


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
					
					if(mysql_query($insert))
					{
					  //echo 'Success';
					  $idstock = "SELECT id_stock FROM cma_stock WHERE id_product=".$row_list['id_product']." AND id_product_attribute=".$row_list['id_product_attribute']."";
						$idstock=mysql_query($idstock);
						$idstock =  mysql_fetch_array($idstock);
					} 
					else 
					{
						//mostrar que hubo un error con el producto.
					  echo "No se pudo insertar la linea de stock para el producto ".$row_list['id_product']."";
					} 
				
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
				if(mysql_query($insert))
				{
					//exito
					//echo 'succes';
					$update="UPDATE cma_stock_available SET quantity = quantity + ".$cantidad*$signo." WHERE id_product=".$row_list['id_product']." AND id_product_attribute = ".$row_list['id_product_attribute']." AND id_shop=".$shop." " ;
					if (mysql_query($update))
						echo'';
					else
						echo "No se pudo actualizar la cantidad del producto ".$row_list['id_product']."";
				}
				else
				{
					//mostrar mensaje de error de ingreso de cantidades
					echo "No se pudo insertar el movimiento para el producto ".$row_list['id_product']." ";
				}
				
				


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
		
		
		
		echo '<p2>Se '.$mensaje.$cantidad. ' articulos para el producto '.$row_list['name'].' '.$atributo.'</p2>';
		
		echo '</br>';
	}
	
	$i= $i+1;
}
?>
</body>
</html>