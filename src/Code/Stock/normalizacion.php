<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Normalizacion de stock</title>
</head>

<body>
<?
include ('conexion.php');

//Almacen
$almacenes= mysql_query("SELECT * FROM cma_warehouse");
while($almacen = mysql_fetch_array($almacenes))
{
	echo "Warehouse " .$almacen['id_warehouse']; 
	echo "<br/>";
	if ($almacen['id_warehouse']>1)
	{
		//PRODUCTOS
		$productos = mysql_query("SELECT * FROM cma_product");
		while($producto = mysql_fetch_array($productos))
		{
			echo "Producto " .$producto['id_product']; 
			echo "<br/>";
			 
			//MANEJO STOCK
			$insert=mysql_query("INSERT INTO cma_stock_available 
						(id_product, 
						id_product_attribute, 
						id_shop, 
						id_shop_group, 
						quantity, 
						depends_on_stock, 
						out_of_stock
						)
						VALUES
						(".$producto['id_product'].", 
						0, 
						".$almacen['id_warehouse'].",	 
						0, 
						0, 
						0, 
						0
						);");
			
			//ATRIBUTOS
			$atributos = mysql_query("SELECT count(*) as count FROM cma_product_attribute WHERE id_product = ".$producto['id_product']."");
			$atributo = mysql_fetch_array($atributos);
			if ($atributo['count']>0)
			{
				
				$atributos = mysql_query("SELECT * FROM cma_product_attribute WHERE id_product = ".$producto['id_product']."");
				while($atributo = mysql_fetch_array($atributos))
				{
					
					
					
					//si no encuentro inserto
					$warehouseproducts = mysql_query("SELECT COUNT(*) AS count FROM cma_warehouse_product_location WHERE id_product = ".$producto['id_product']." AND id_product_attribute=".$atributo['id_product_attribute']." AND id_warehouse = ".$almacen['id_warehouse']."");
					$warehouseproduct = mysql_fetch_array($warehouseproducts);
						
					if ($warehouseproduct['count']==0)
					{
						echo "Attribute " .$atributo['id_product_attribute']; 
						echo "<br/>";
						echo $producto['id_product'];
						$insert=mysql_query("INSERT INTO cma_warehouse_product_location 
							(id_product, 
							id_product_attribute, 
							id_warehouse
							)
							VALUES
							(".$producto['id_product'].", 
							".$atributo['id_product_attribute'].", 
							".$almacen['id_warehouse']."
							);");
					}
					
					//Busco en cma_stock_available, si no encuentro inserto
					$cma_stock_available = mysql_query("SELECT COUNT(*) AS count FROM cma_stock_available WHERE id_product = ".$producto['id_product']." AND id_product_attribute=".$atributo['id_product_attribute']." AND id_shop = ".$almacen['id_warehouse']."");
					$cma_stock_available = mysql_fetch_array($cma_stock_available);
						
					if ($cma_stock_available['count']==0)
					{
						$insert=mysql_query("INSERT INTO cma_stock_available 
						(id_product, 
						id_product_attribute, 
						id_shop, 
						id_shop_group, 
						quantity, 
						depends_on_stock, 
						out_of_stock
						)
						VALUES
						(".$producto['id_product'].", 
						".$atributo['id_product_attribute'].", 
						".$almacen['id_warehouse'].",	 
						0, 
						0, 
						0, 
						0
						);");
					}
					
				}
			}
			else
			{
				
				//echo "Attribute 0 (cero)"; 
				//echo "<br/>";
				//si no encuentro inserto
					$warehouseproducts = mysql_query("SELECT COUNT(*) AS count FROM cma_warehouse_product_location WHERE id_product = ".$producto['id_product']." AND id_product_attribute=0 AND id_warehouse = ".$almacen['id_warehouse']."");
					$warehouseproduct = mysql_fetch_array($warehouseproducts);
						
					if ($warehouseproduct['count']==0)
					{
						$insert=mysql_query("INSERT INTO cma_warehouse_product_location 
							(id_product, 
							id_product_attribute, 
							id_warehouse
							)
							VALUES
							(".$producto['id_product'].", 
							0, 
							".$almacen['id_warehouse']."
							);");
					}
				
				//Busco en cma_stock_available, si no encuentro inserto
						$cma_stock_availables = mysql_query("SELECT COUNT(*) AS count FROM cma_stock_available WHERE id_product = ".$producto['id_product']." AND id_product_attribute=0 AND id_shop = ".$almacen['id_warehouse']."");
						$cma_stock_available = mysql_fetch_array($cma_stock_availables);
							
						if ($cma_stock_available['count']==0)
						{
							//echo "Stock available count 0";
							$insert=mysql_query("INSERT INTO cma_stock_available 
							(id_product, 
							id_product_attribute, 
							id_shop, 
							id_shop_group, 
							quantity, 
							depends_on_stock, 
							out_of_stock
							)
							VALUES
							(".$producto['id_product'].", 
							0, 
							".$almacen['id_warehouse'].",	 
							0, 
							0, 
							0, 
							0
							);");
						}
				
				
			}
			
		}
		
	}
	//echo "<br/>";
}
$insert=mysql_query("UPDATE cma_product_shop SET advanced_stock_management = 1 where id_shop >1");

$insert=mysql_query("UPDATE cma_stock_available SET depends_on_stock = 1 where id_shop >1");

echo "Proceso finalizado correctamente";

?>

</body>
</html>