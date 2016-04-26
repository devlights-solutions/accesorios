<html>
<title>Ingreso de costos de Productos agrupados</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<head>


</head>
<body>
<h1>Ingreso de costos de productos agrupados.</h1>
<br/>
<h1>Paso 1: Ingrese los costos de los productos. Para decimales use el punto</h1>

<?php
include ('conexion.php');
echo "
<form action='insercioncostosagrupados.php'  method='get'>

";

?>


<?php


echo '<table border=1>';
echo '<tr>';
		
echo '<td><STRONG>PRODUCTO</STRONG></td>';
echo '<td align="center"><STRONG>COSTO</STRONG></td>';

echo '</tr>';


	
echo '<tr>';
	echo '<td>BLOCK FUSION</td>';
	echo '<td>';echo "<input type='text' name=Block>";echo '</td>';
echo '</tr>';



echo '<tr>';
	echo '<td>BUMPERS</td>';
	echo '<td>';echo "<input type='text' name=Bumpers>";echo '</td>';
echo '</tr>';


echo '<tr>';
	echo '<td>CRISTAL CASE</td>';
	echo '<td>';echo "<input type='text' name=Cristal>";echo '</td>';
echo '</tr>';

echo '<tr>';
	echo '<td>FILM</td>';
	echo '<td>';echo "<input type='text' name=Film>";echo '</td>';
echo '</tr>';

echo '<tr>';
	echo '<td>FILM TABLET</td>';
	echo '<td>';echo "<input type='text' name=FilmTablet>";echo '</td>';
echo '</tr>';


echo '<tr>';
	echo '<td>FLIP COVER EJECUTIVO</td>';
	echo '<td>';echo "<input type='text' name=FlipCoverEjecutivo>";echo '</td>';
echo '</tr>';

echo '<tr>';
	echo '<td>FLIP COVER GENERICO</td>';
	echo '<td>';echo "<input type='text' name=FlipCoverGenerico>";echo '</td>';
echo '</tr>';

echo '<tr>';
	echo '<td>FLIP COVER FEMME</td>';
	echo '<td>';echo "<input type='text' name=FlipCoverFemme>";echo '</td>';
echo '</tr>';

echo '<tr>';
	echo '<td>FLIP COVER DISENO</td>';
	echo '<td>';echo "<input type='text' name=FlipCoverDiseno>";echo '</td>';
echo '</tr>';

echo '<tr>';
	echo '<td>FLIP COVER RENOVATIO</td>';
	echo '<td>';echo "<input type='text' name=FlipCoverRenovatio>";echo '</td>';
echo '</tr>';

echo '<tr>';
	echo '<td>PROTECTIVE CASE</td>';
	echo '<td>';echo "<input type='text' name=ProtectiveCase>";echo '</td>';
echo '</tr>';

echo '<tr>';
	echo '<td>SILICONAS</td>';
	echo '<td>';echo "<input type='text' name=Siliconas>";echo '</td>';
echo '</tr>';

echo '<tr>';
	echo '<td>SILICONA ANIMADA</td>';
	echo '<td>';echo "<input type='text' name=SiliconaAnimada>";echo '</td>';
echo '</tr>';


echo '<tr>';
	echo '<td>SILICONA ANIMADA ANANA/we..</td>';
	echo '<td>';echo "<input type='text' name=SiliconaAnimadaAnana>";echo '</td>';
echo '</tr>';

echo '<tr>';
	echo '<td>TPU</td>';
	echo '<td>';echo "<input type='text' name=Tpu>";echo '</td>';
echo '</tr>';

echo '<tr>';
	echo '<td>ULTRA THIN</td>';
	echo '<td>';echo "<input type='text' name=UltraThin>";echo '</td>';
echo '</tr>';

echo"
<tr><td></td><td><input type='submit'></td></tr>
</table>
</form>";
?>

</body>
</html>