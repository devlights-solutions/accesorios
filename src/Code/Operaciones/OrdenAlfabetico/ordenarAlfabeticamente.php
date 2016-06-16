<html>

<title>Ingreso masivo de productos</title>

<link href="css/style.css" rel="stylesheet" type="text/css">

<head>
</head>

<body>
<?php

include ('conexion.php');

echo '<h1>Orden alfabetico</h1>';

$listados="SELECT * FROM cma_attribute cmat INNER JOIN cma_attribute_lang cmatl ON cmat.id_attribute = cmatl.id_attribute WHERE cmatl.id_lang = 1 ORDER BY cmat.id_attribute_group,name";
$listados= mysql_query($listados);
$listado=mysql_fetch_array($listados);

$i=0;
$attributeGroup= $listado['id_attribute_group'];

while($row_list=mysql_fetch_array($listados))
{
	if ($row_list['id_attribute_group'] <> $attributeGroup)
	{
		$i=0;
		$i=$i+1;
		$attributeGroup= $row_list['id_attribute_group'];
	}
	else
	{
		$i=$i+1;
	}
		
	
	$update=" 	
			UPDATE cma_attribute 
				SET
				POSITION = ".$i."
				
				WHERE
				id_attribute = ".$row_list['id_attribute']." ";
				
	mysql_query($update);
	
}
echo '<br>';echo '<br>';

echo '<p>Proceso terminado, se ordenaron alfabeticamente todos los atributos</p>';
?>
</body>