<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Proceso de insercion de costos</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<?php
//$Block = $_GET['Block'];
//$Bumpers = $_GET['Bumpers'];
//$Cristal = $_GET['Cristal'];
//$Film = $_GET['Film'];
//$FilmTablet = $_GET['FilmTablet'];
//$FlipCovers = $_GET['FlipCovers'];
//$ProtectiveCase = $_GET['ProtectiveCase'];
//$SiliconaAnimada = $_GET['SiliconaAnimada'];
//$SiliconaAnimadaAnana = $_GET['SiliconaAnimadaAnana'];
//$UltraThin = $_GET['UltraThin'];
//$idsproducto = $_GET['idsproducto'];

?>
</head>
<?php
include ('conexion.php');


?>
<body>

<?php
//variable que me va a determinar si hubo cambios
$changes=false;

			

echo '<h1>Proceso de actualización de costos agrupados iniciado.</h1>';
echo '<br/>';
echo '<h1>Paso 2: Resultados del proceso</h1>';

echo '<br/>';
$Block = $_GET['Block'];
$Bumpers = $_GET['Bumpers'];
$Cristal = $_GET['Cristal'];
$Film = $_GET['Film'];
$FilmTablet = $_GET['FilmTablet'];
$FlipCoverEjecutivo = $_GET['FlipCoverEjecutivo'];
$FlipCoverGenerico = $_GET['FlipCoverGenerico'];
$FlipCoverFemme = $_GET['FlipCoverFemme'];
$FlipCoverDiseno = $_GET['FlipCoverDiseno'];
$FlipCoverRenovatio = $_GET['FlipCoverRenovatio'];
$ProtectiveCase = $_GET['ProtectiveCase'];
$Siliconas = $_GET['Siliconas'];
$SiliconaAnimada = $_GET['SiliconaAnimada'];
$SiliconaAnimadaAnana = $_GET['SiliconaAnimadaAnana'];
$Tpu = $_GET['Tpu'];
$UltraThin = $_GET['UltraThin'];


if($Block <> '')
	{
		echo '<h2>Actualizacion de costos en las combinaciones de Block Fusion</h2>';
		echo '</br>';
		ActualizarPrecios(121,$Block);
	}
	
if($Bumpers <> '')
	{
		echo '<h2>Actualizacion de costos en las combinaciones de Bumpers</h2>';
		echo '</br>';
		ActualizarPrecios(20,$Bumpers);
	}
	
if($Cristal <> '')
	{
		echo '<h2>Actualizacion de costos en las combinaciones de Cristal Cases</h2>';
		echo '</br>';
		ActualizarPrecios(111,$Cristal);
	}
	
if($Film <> '')
	{
		echo '<h2>Actualizacion de costos en las combinaciones de Films</h2>';
		echo '</br>';
		ActualizarPrecios(35,$Film);
	}
	
if($FilmTablet <> '')
	{
		echo '<h2>Actualizacion de costos en las combinaciones de Film Tablets</h2>';
		echo '</br>';
		ActualizarPrecios(37,$FilmTablet);
	}
	
if($FlipCoverEjecutivo <> '')
	{
		echo '<h2>Actualizacion de costos en las combinaciones de Flip Cover Ejecutivo</h2>';
		echo '</br>';
		ActualizarPrecios(39,$FlipCoverEjecutivo);
	}
	
if($FlipCoverGenerico <> '')
	{
		echo '<h2>Actualizacion de costos en las combinaciones de Flip Cover Generico</h2>';
		echo '</br>';
		ActualizarPrecios(40,$FlipCoverGenerico);
	}
	
if($FlipCoverFemme <> '')
	{
		echo '<h2>Actualizacion de costos en las combinaciones de Flip Cover Femme</h2>';
		echo '</br>';
		ActualizarPrecios(122,$FlipCoverFemme);
	}

if($FlipCoverDiseno <> '')
	{
		echo '<h2>Actualizacion de costos en las combinaciones de Flip Cover Diseno</h2>';
		echo '</br>';
		ActualizarPrecios(120,$FlipCoverDiseno);
	}	
	
if($FlipCoverRenovatio <> '')
	{
		echo '<h2>Actualizacion de costos en las combinaciones de Flip Cover Renovatio</h2>';
		echo '</br>';
		ActualizarPrecios(124,$FlipCoverRenovatio);
	}	
	
if($ProtectiveCase <> '')
	{
		echo '<h2>Actualizacion de costos en las combinaciones de Protective Cases</h2>';
		echo '</br>';
		ActualizarPrecios(72,$ProtectiveCase);
	}
	
if($Siliconas <> '')
	{
		echo '<h2>Actualizacion de costos en las combinaciones de Siliconas</h2>';
		echo '</br>';
		ActualizarPrecios(53,$Siliconas);
	}

if($SiliconaAnimada <> '')
	{
		echo '<h2>Actualizacion de costos en las combinaciones de Siliconas Animadas</h2>';
		echo '</br>';
		ActualizarPrecios(76,$SiliconaAnimada);
	}
	
if($SiliconaAnimadaAnana <> '')
	{
		echo '<h2>Actualizacion de costos en las combinaciones de Siliconas Animadas Anana</h2>';
		echo '</br>';
		ActualizarPrecios(113,$SiliconaAnimadaAnana);
	}

if($Tpu <> '')
	{
		echo '<h2>Actualizacion de costos en las combinaciones de TPUs</h2>';
		echo '</br>';
		ActualizarPrecios(109,$Tpu);
	}
	
if($UltraThin <> '')
	{
		echo '<h2>Actualizacion de costos en las combinaciones de Ultra Thin</h2>';
		echo '</br>';
		ActualizarPrecios(123,$UltraThin);
	}
	



function ActualizarPrecios($productoId,$costoProducto)
{
	//echo $productoId;
	//echo $costoProducto;
	//traigo los productos
	$productos = "SELECT DISTINCT(id_product_attribute), id_product FROM cma_product_attribute
	WHERE id_product = $productoId";
	//
	//echo 'productos '.$productos;
	$productos= mysql_query($productos);
	
	while($row_list=mysql_fetch_array($productos))
	{
		
		$costo = $costoProducto;
		
			//Insercion del movimiento de stock
			
				//consulta de id de stock
				$idstock = "SELECT id_stock FROM cma_stock WHERE id_product=".$row_list['id_product']."  AND id_product_attribute=".$row_list['id_product_attribute']."";
				//echo $idstock;
				$idstock=mysql_query($idstock);
				$idstock =  mysql_fetch_array($idstock);
				
			
			
			//inserto o actualizo la tabla Costos
			$costoSearch="SELECT * FROM Costos WHERE id_product = ".$row_list['id_product']." AND id_product_attribute= ".$row_list['id_product_attribute']."";	
			//echo $costoSearch;
			$costoSearch=mysql_query($costoSearch);
			$costoSearch =  mysql_fetch_array($costoSearch);
			if($costoSearch['id_product']=='')
				{
					$insertCosto="INSERT INTO Costos (id_product,id_product_attribute,costo) 
									VALUES (".$row_list['id_product'].",".$row_list['id_product_attribute'].",$costo)";
					//echo $insertCosto;
					$insertCosto=mysql_query($insertCosto);
					$costoAnterior = 0;
					$mostrarMensaje=true;
				}
				
			else
				{
					$costoAnterior =$costoSearch['costo'];
					
					if($costoAnterio <> $costo)
					{
						$modificacionCosto="UPDATE Costos SET costo = $costo WHERE id_costo = ".$costoSearch['id_costo']."";
						//echo $modificacionCosto;
						$modificacionCosto=mysql_query($modificacionCosto);
						//echo 'hay datos';
						$mostrarMensaje=true;
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
			
			
			if($costo <>'' and $costo<>$costoAnterior)
			{
				echo '<p2>Se actualizo el precio del articulo '.$row_list['name'].' '.$atributo.' de $'.$costoAnterior.' a $ '.$costo.'</p2>';
				$changes=true;
				echo '</br>';
			}
			
		
	}
	
	if ($changes==0)
	{
		echo '<p2>No hubo cambios de precios.</p2>';
	}

}

?>

</body>
</html>