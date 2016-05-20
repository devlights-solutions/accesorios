<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Proceso de insercion precios especificos</title>

<link href="css/style.css" rel="stylesheet" type="text/css">

<?php
$cant = $_GET[9999];

$shop = $_GET['ids'];

$idsproducto = $_GET['idsproducto'];
//echo '<br>';
//echo 'SHOP'. $shop;
//echo '<br>';
//echo $idsproducto;

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

INSERT INTO InsercionPrecios 

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
//echo '<br>';

 mysql_query($insert);

$idInsercion=mysql_insert_id();
//echo '<br>';

//echo 'ID DE INSERCION:'.$idInsercion;

$i=1;

echo '<h1>Proceso de insercion de costos especificos iniciado para sucursal: '.$nombreShop['Shop'].'</h1>';

echo '<br/>';

echo '<h1>Paso 3: Resultados del proceso</h1>';

echo '<br/>';





//traigo los productos

//traigo los productos

$productos = "SELECT  * FROM cma_stock_available csa 

INNER JOIN cma_product_lang cpl 

ON cpl.id_product = csa.id_product

INNER JOIN cma_product cp

ON cp.id_product = csa.id_product

WHERE csa.id_shop = ".$shop." AND  cpl.id_shop= ".$shop." AND id_lang = 1  AND csa.id_product = ".$idsproducto."

ORDER BY cpl.name

";

//

//echo 'productos '.$productos;

$productos= mysql_query($productos);



while($row_list=mysql_fetch_array($productos))

{
	//echo $i;
	$cantidad = $_GET['precio'.$i];

	//echo '<br>';
	//echo '<br>';
	//echo '<br>';
	//echo 'cantidad'. $cantidad;	

	$costo = $_GET['cantidad'.$i];

	

	//echo 'el costo es'.$costo;

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

			//echo 'id stock es:'.$idstock;

			echo '<br/>';

			$idstock =  mysql_fetch_array($idstock);

			//

			

			

			//controlo que idstock no este vacio.

			//echo $idstock['id_stock'].' ID STOCK!!!';

			$IsStockStatus=1;

			if ($idstock['id_stock']=='')

				{

				//id stock

				

				}

			//

			

			

			

		
			//

			

		//INSERT INSERCIONDETALLE

		$insertDetalle="INSERT INTO InsercionPreciosDetalles 

						( 

							IdInsercionPrecio, 

							IdProduct, 

							IdAttribute, 

							Price

							)

						VALUES

							( 

							".$idInsercion.", 

							".$row_list['id_product'].", 

							".$row_list['id_product_attribute'].", 

							".$cantidad."

							);";

		

		//echo $insertDetalle;

		mysql_query($insertDetalle);

		//

		

		//Actualizar precios especificos
		$specificPrice="SELECT * FROM cma_specific_price cmp WHERE cmp.id_product = ".$row_list['id_product']." AND cmp.id_product_attribute = ".$row_list['id_product_attribute']." AND cmp.id_shop=".$shop."";
		//echo '<br>';
		//echo $specificPrice;

//echo '<br>';echo '<br>';
		$specificPrice=mysql_query($specificPrice);
		$specificPrice=mysql_fetch_array($specificPrice);
		
		if ($specificPrice<> '')
		{
			//echo 'Hay Resultados' . $cantidad;

			$delete="DELETE FROM cma_specific_price WHERE id_product = ".$row_list['id_product']." AND id_product_attribute = ".$row_list['id_product_attribute']." AND id_shop=".$shop."";
		            
		   // echo $delete;
			mysql_query($delete);

			$insert= " INSERT INTO cma_specific_price
						(
						id_specific_price_rule, 
						id_cart, 
						id_product, 
						id_shop, 
						id_shop_group, 
						id_currency, 
						id_country, 
						id_group, 
						id_customer, 
						id_product_attribute, 
						price, 
						from_quantity, 
						reduction, 
						reduction_type
						)
						VALUES
						( 
						0, 
						0, 
						".$row_list['id_product'].", -- id_product
						".$shop.", -- id_shop
						0, 
						0, 
						0, 
						0, 
						0, 
						".$row_list['id_product_attribute'].", -- id_product_attribute 
						".$cantidad.", -- price
						1, 
						0, 
						'amount'
						);";
			mysql_query($insert);
		}
		else
		{
			//echo 'No Hay Resultados';
			$insert= " INSERT INTO cma_specific_price
						(
						id_specific_price_rule, 
						id_cart, 
						id_product, 
						id_shop, 
						id_shop_group, 
						id_currency, 
						id_country, 
						id_group, 
						id_customer, 
						id_product_attribute, 
						price, 
						from_quantity, 
						reduction, 
						reduction_type
						)
						VALUES
						( 
						0, 
						0, 
						".$row_list['id_product'].", -- id_product
						".$shop.", -- id_shop
						0, 
						0, 
						0, 
						0, 
						0, 
						".$row_list['id_product_attribute'].", -- id_product_attribute 
						".$cantidad.", -- price
						1, 
						0, 
						'amount'
						);";
			mysql_query($insert);
		}
		echo '<br>';
echo '<br>';

		
		
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

		

		

		

		echo '<p2>Se modifico el precio del producto '.$row_list['name'].' '.$atributo.' a $  '.$mensaje.$cantidad. ' </p2>';

		

		echo '</br>';

	}

	

	$i= $i+1;

}

?>

</body>

</html>