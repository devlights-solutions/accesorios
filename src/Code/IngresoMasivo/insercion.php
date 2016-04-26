<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Proceso de insercion</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<?php
$cant = $_GET[9999];
$shop = $_GET['ids'];
$idsproducto = $_GET['idsproducto'];

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
//traigo el warehouse que corresponde al shop
			$warehouse="SELECT id_warehouse AS warehouse FROM cma_warehouse_shop WHERE id_shop=".$shop." AND id_warehouse <>1";
			$warehouse=mysql_query($warehouse);
			$warehouse=mysql_fetch_array($warehouse);
			//
			
//Insert in table INSERCION
$insert="
INSERT INTO Insercion 
	( 
	IdWarehouse, 
	DATE
	)
	VALUES
	( 
	".$warehouse['warehouse'].", 
	NOW()
	);";
	//echo $insert;
 mysql_query($insert);
$idInsercion=mysql_insert_id();
//echo $idInsercion;
$i=1;
echo '<h1>Proceso de insercion iniciado para sucursal: '.$nombreShop['Shop'].'</h1>';
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
	
	echo 'el costo es'.$costo;
	if ($costo == '')
		$costo =0;
		
	//echo 'costo = '.$costo;
	//echo $i .' cantidad: '.$cantidad;
	echo '<br/>';
	//echo 'cantidad '. $cantidad;
	if ($cantidad<>'')
	{
		//Insercion del movimiento de stock
		
			//consulta de id de stock
			$idstock = "SELECT id_stock FROM cma_stock WHERE id_product=".$row_list['id_product']." AND id_warehouse = ".$warehouse['warehouse']." AND id_product_attribute=".$row_list['id_product_attribute']."";
			//echo $idstock;
			$idstock=mysql_query($idstock);
			echo 'id stock es:'.$idstock;
			echo '<br/>';
			$idstock =  mysql_fetch_array($idstock);
			//
			
			
			//controlo que idstock no este vacio.
			//echo $idstock['id_stock'].' ID STOCK!!!';
			$IsStockStatus=1;
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
					".$warehouse['warehouse'].", 
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
					  $idstock = "SELECT id_stock FROM cma_stock WHERE id_product=".$row_list['id_product']." AND id_warehouse = ".$warehouse['warehouse']." AND id_product_attribute=".$row_list['id_product_attribute']."";
						$idstock=mysql_query($idstock);
						$idstock =  mysql_fetch_array($idstock);
						$IsStockStatus=1;
					} 
					else 
					{
						//mostrar que hubo un error con el producto.
					  echo "No se pudo insertar la linea de stock para el producto ".$row_list['id_product']."";
					  $IsStockStatus=2;
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
				".$costo.", 
				1, 
				1, 
				0
				)";
				if(mysql_query($insert))
				{
					//exito
					//echo 'succes';
					$update="UPDATE cma_stock_available SET quantity = quantity + ".$cantidad*$signo." WHERE id_product=".$row_list['id_product']." AND id_product_attribute = ".$row_list['id_product_attribute']." AND id_shop=".$shop." " ;
					$IdStockMvtStatus=1;
					if (mysql_query($update))
						$IdStockAvailableStatus=1;
					else
					{
						echo "No se pudo actualizar la cantidad del producto ".$row_list['id_product']."";
						$IdStockAvailableStatus=2;
					}
					//echo $i;
					$update="UPDATE cma_stock 
								SET
								physical_quantity = physical_quantity + ".$cantidad*$signo." , 
								usable_quantity = usable_quantity + ".$cantidad*$signo." 
								
								
								WHERE id_product=".$row_list['id_product']." AND id_product_attribute = ".$row_list['id_product_attribute']." AND id_warehouse=".$warehouse['warehouse']." " ;
					//echo $update;
					
					if (mysql_query($update))
						echo '';
					else
					{
						echo "No se pudo actualizar estado inmediato de existencia del producto: ".$row_list['id_product']."";
						//$IdStockAvailableStatus=2;
					}
				}
				else
				{
					//mostrar mensaje de error de ingreso de cantidades
					echo "No se pudo insertar el movimiento para el producto ".$row_list['id_product']." ";
					$IdStockMvtStatus=2;
				}
				
				


			//
			
		//INSERT INSERCIONDETALLE
		$insertDetalle="INSERT INTO InsercionDetalle 
							( 
							IdInsercion, 
							IdProduct, 
							IdAttribute, 
							Quantity, 
							StockStatus, 
							StockMvtStatus, 
							StockAvailableStatus
							)
						VALUES
							( 
							".$idInsercion.", 
							".$row_list['id_product'].", 
							".$row_list['id_product_attribute'].", 
							".$cantidad.", 
							".$IsStockStatus.", 
							".$IdStockMvtStatus.", 
							".$IdStockAvailableStatus."
							);";
		
		//echo $insertDetalle;
		mysql_query($insertDetalle);
		//
		
		//inserto o actualizo la tabla Costos
		if ($costo<>0)
		{
			$costoSearch="SELECT * FROM Costos WHERE id_product = ".$row_list['id_product']." AND id_product_attribute= ".$row_list['id_product_attribute']."";	
			//echo $costoSearch;
			$costoSearch=mysql_query($costoSearch);
			$costoSearch =  mysql_fetch_array($costoSearch);
			if($costoSearch['id_product']=='')
				{
					$insertCosto="INSERT INTO Costos (id_product,id_product_attribute,costo) VALUES (".$row_list['id_product'].",".$row_list['id_product_attribute'].",$costo)";
					//echo $insertCosto;
					$insertCosto=mysql_query($insertCosto);
					//echo 'esta vacio';
					
				}
				
			else
				{
					$modificacionCosto="UPDATE Costos SET costo = $costo WHERE id_costo = ".$costoSearch['id_costo']."";
					//echo $modificacionCosto;
					$modificacionCosto=mysql_query($modificacionCosto);
					//echo 'hay datos';
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
		
		
		
		echo '<p2>Se '.$mensaje.$cantidad. ' articulos para el producto '.$row_list['name'].' '.$atributo.' con un costo de $ '.$costo.'</p2>';
		
		echo '</br>';
	}
	
	$i= $i+1;
}
?>
</body>
</html>