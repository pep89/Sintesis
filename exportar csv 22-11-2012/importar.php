

<?php

require_once ("conexion/header.php");

$fila = 0;

if (($gestor = fopen("reporte.csv", "r")) !== FALSE) 
{


echo "<table width='600' cellpadding='5' cellspacing='5' border='1'>";
echo "<td> id </td>";
echo "<td> a�o </td>";
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
        //echo "<p> $numero campos en la l�nea $fila: <br /></p>\n";
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
							
							
							//------------------------------------Seleccion l'id del nou any introduit - el guard dins una variable - i imprimeixc per pantalla el resultat
							$anycreat = "Select id from any_academic where any = '$datos[$c]'";
							$resultid = mysql_query($anycreat);
							while($row = mysql_fetch_array($resultid))
							{
								$idany = $row["id"];
								//echo "a�o creado con identificador" . $idany . "</br>";
							}
							
						}
						else
						{
							$anyexistent = "Select id from any_academic";
							$idexistent = mysql_query($anyexistent);
							while($row = mysql_fetch_array($idexistent))
							{
								$idany = $row["id"];
								//echo "A�o existente con identificador" . $idany . "</br>";
								
							}
							
						}

				}
				else if($c == 2)
				{
					$cursosnocreats = "SELECT id as idcurs, id_any, nom, acronim from cursos where nom = $datos[$c]";
					$resultcursos = mysql_query($cursosnocreats);

						//echo $datos[$c] . "</br>";
						
						$acronim = $datos[$c + 1];
						
						if(mysql_num_rows($resultcursos) < 1)
						{
							$insert = "INSERT INTO cursos(id_any, nom, acronim) VALUES ( '$idany', '$datos[$c]', '$acronim');";
							echo $insert."<br />";
							$runInsert = mysql_query($insert) or die(mysql_error()." Error: No se pudo registar la precarga");
							
							
							//------------------------------------Seleccion l'id del nou any introduit - el guard dins una variable - i imprimeixc per pantalla el resultat
							$curscreat = "Select id from cursos where nom = '$datos[$c]'";
							$resultid = mysql_query($curscreat);
							while($row = mysql_fetch_array($resultid))
							{
								$idcurs = $row["id"];
								echo "curso creado con identificador" . $idcurs . "</br>";
							}
							
						}
						else
						{
							$cursexistent = "Select id from cursos";
							$idexistent = mysql_query($cursexistent);
							while($row = mysql_fetch_array($idexistent))
							{
								$idcurs = $row["id"];
								echo "Curso existente con identificador" . $idcurs . "</br>";
								
							}
							
						}
					
				}
				/*if ($c == 8 && $fila == 2)
				{
					echo $datos[$c] . "<br />\n";
				}*/
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


