

<?php

$fila = 0;

if (($gestor = fopen("reporte.csv", "r")) !== FALSE) {


echo "<table width='600' cellpadding='5' cellspacing='5' border='1'>";
echo "<td> id </td>";
echo "<td> año </td>";
echo "<td> Nombre del curso </td>";
echo "<td> Acronimo </td>";
echo "<td> Nombre de la clase </td>";
echo "<td> Codigo </td>";
echo "<td> Horas totales </td>";
echo "<td> Nombre del grupo </td>";
echo "<td> Horas semanales </td>";

    while (($datos = fgetcsv($gestor, 1000, ";")) !== FALSE) {
	
	
		echo "<tr>";
        $numero = count($datos);
        //echo "<p> $numero campos en la línea $fila: <br /></p>\n";
        $fila++;
        for ($c=0; $c < $numero; $c++) {
			if( $fila != 1)
			{
				echo "<td width=\"25%\"><font face=\"verdana\">" . 
				$datos[$c] . "</font></td>";
				
				if ($c == 8 && $fila == 2)
				{
					echo $datos[$c] . "<br />\n";
				}
			}
        }
		echo "<tr>";
		
    }
    fclose($gestor);
}
?>












<!-- -------------------------------------------------PROVES -----------------------------------------------------------------------------------------
<?php
/*
$fichero = fopen("lista.csv","r")or die("No se consigue el archivo");
while (!feof($fichero)){
	$campo = fgetcsv($fichero,4096,";");
	$hay = count($campo);
	$insert = "INSERT INTO any_academic(any) VALUES ('$campo[1]');";
	//echo $insert."<br />";
	$runInsert = mysql_query($insert,$conexion) or die(mysql_error()." Error: No se pudo registar la precarga");
}
fclose($fichero);
*/
?>

<?php

/*$fp = fopen ( "reporte.csv" , "r" );

echo "<table width='600' cellpadding='5' cellspacing='5' border='1'>";


while (( $data = fgetcsv ($fp,1000,";")) !== FALSE ){
 
 
    $i = 0;
	$numero = count($data);

	
	echo "<tr>";

	for ($c=0; $c < $numero; $c++) {

		
			echo "<td width=\"25%\"><font face=\"verdana\">" . 
				$data[$c] . "</font></td>";
       
		$i++;
		
		
    }
	echo "</tr>";
	
}
fclose ( $fp );
*/
?>



<?php
/*
$fp = fopen ( "reporte.csv" , "r" );

echo "<table width='600' cellpadding='5' cellspacing='5' border='1'>";


while (( $data = fgetcsv ($fp,1000,";")) !== FALSE ){
 
	//echo $data[0]. "</br>";
    $i = 0;
	echo "<tr>";
    foreach($data as $row) {

		
         //echo "Campo $i: $row<br />";
        // Muestra todos los campos de la fila actual
		echo "<td width=\"25%\"><font face=\"verdana\">" . 
			$row . "</font></td>";
        $i++ ;
		

		
    }
	echo "</tr>";
 
}
fclose ( $fp );
*/
?>


