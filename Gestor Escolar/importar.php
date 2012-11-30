

<?php

require_once ("conexion/header.php");

$fila = 0;

if (($gestor = fopen("reporte.csv", "r")) !== FALSE) 
{


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

    while (($datos = fgetcsv($gestor, 1000, ";")) !== FALSE) 
	{
	
	
		echo "<tr>";
        $numero = count($datos);
        //echo "<p> $numero campos en la línea $fila: <br /></p>\n";
        $fila++;
        for ($c=0; $c < $numero; $c++) 
		{
			if( $fila != 1)
			{
				echo "<td width=\"25%\"><font face=\"verdana\">" . 
				$datos[$c] . "</font></td>";
				
				if($c == 1)
				{	
					
					
					$anysnocreats = "SELECT id as idany, any as any from any_academic where any = '$datos[$c]'";
					$result = mysql_query($anysnocreats);

						//echo $datos[$c] . "</br>";
						if(mysql_num_rows($result) < 1)
						{
							//----------------------------------------------Faig l'insert - imprimeixc per pantalla el resultat - execut l'insert
							$insert = "INSERT INTO any_academic(any) VALUES ('$datos[$c]');";
							echo $insert."<br />";
							$runInsert = mysql_query($insert) or die(mysql_error()." Error: No se pudo registar la precarga");
							
						}
						$anycreat = "Select id from any_academic where any = '$datos[$c]'";
						$resultid = mysql_query($anycreat);
						$row = mysql_fetch_array($resultid);
						$idany = $row["id"];
				}
				else if($c == 2)
				{
					$cursosnocreats = "SELECT id, id_any, nom, acronim from cursos where nom = '$datos[$c]'";
					$resultcursos = mysql_query($cursosnocreats);

						//echo $datos[$c] . "</br>";
						
						
						$acronim = $datos[$c + 1];
						
						//echo $acronim . "</br>";
						
						if(mysql_num_rows($resultcursos) < 1)
						{
							$insert = "INSERT INTO cursos(id_any, nom, acronim) VALUES ( '$idany', '$datos[$c]', '$acronim');";
							echo $insert."<br />";
							$runInsert = mysql_query($insert) or die(mysql_error()." Error: No se pudo registar la precarga");
							
						}
						$curscreat = "Select id from cursos where nom = '$datos[$c]'";
						$resultid = mysql_query($curscreat);
						$row = mysql_fetch_array($resultid);
						$idcurs = $row["id"];
				}
				else if ($c == 4)
				{
					$clasesnocreades = "SELECT id, id_any, id_curs, nom, codi, hores from clases where nom = '$datos[$c]'";
					$resultclases = mysql_query($clasesnocreades);
					
					$codi = $datos[$c + 1];
					$hores = $datos[$c + 2];
					
						if(mysql_num_rows($resultclases) < 1)
						{
							$insert = "INSERT INTO clases(id_any, id_curs, nom, codi, hores) VALUES ( '$idany', '$idcurs', '$datos[$c]', '$codi', '$hores');";
							echo $insert."<br />";
							$runInsert = mysql_query($insert) or die(mysql_error()." Error: No se pudo registar la precarga");
							
						}
						$clasecreada = "Select id from clases where nom = '$datos[$c]'";
						$resultid = mysql_query($clasecreada);
						$row = mysql_fetch_array($resultid);
						$idclase = $row["id"];
				}
				else if ($c == 7)
				{
					$grupsnocreats = "SELECT id, id_any, id_curs, id_clase, nom, hores from grups where nom = '$datos[$c]' AND id_curs = '$idcurs' AND id_clase = '$idclase'";
					$resultgrups = mysql_query($grupsnocreats);
					
					$horesclase = $datos[$c + 1];
					
						if(mysql_num_rows($resultgrups) < 1)
						{
							$insert = "INSERT INTO grups(id_any, id_curs, id_clase, nom, hores) VALUES ( '$idany', '$idcurs', '$idclase', '$datos[$c]', '$horesclase');";
							echo $insert."<br />";
							$runInsert = mysql_query($insert) or die(mysql_error()." Error: No se pudo registar la precarga");
							
							
						}
												
												
						$clasecreada = "Select id from clases where nom = '$datos[$c]'";
						$resultid = mysql_query($clasecreada);
						$row = mysql_fetch_array($resultid);
						$idclase = $row["id"];

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


