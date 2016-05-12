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

				//id stock

				

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

			

		

		

				

				





			//

			

		//INSERT INSERCIONDETALLE

		$insertDetalle="INSERT INTO InsercionDetallePrecios 

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