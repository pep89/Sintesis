<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
	//include ('const.php');
	//Necesitam l'archiu header.php localitzat a la carpeta conexion per poder establir la conexio amb la base de dades i aixi poder realitzar les sentencies.
	require_once ("conexion/header.php");
	 
	 
?>
<html>
	<head>
            <title> Dosagui </title>
            <!--META-->
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
            <script src = "js/plantilla.js" type = "text/javascript"></script>
            <link rel = "stylesheet" type = "text/css" href = "css/estil.css" >
	
    </head>
	<body>
	
		<div class = "general">
			<?php 
				require_once("plantillas/encabezado.php");
				require_once("plantillas/botones.php");
			?>
			<div class = "cuerpo">
				<div class = "display">
				
					
					<TABLE BORDER="1"> CLASES CON GRUPOS
						<TR>
						   <TH>ID</TH>
						   <TH>A&Ntilde;O</TH>
						   <TH>NOMBRE DEL CURSO</TH>
						   <TH>ACRONIMO</TH>
						   <TH>NOMBRE DE LA CLASE</TH>
						   <TH>CODIGO</TH>
						   <TH>HORAS TOTALES</TH>
						   <TH>NOMBRE DEL GRUPO</TH>
						   <TH>HORAS SEMANALES</TH>
						</TR>
						<?php  
						  $query = "SELECT A.any as any, C.nom as nomcurs, C.acronim as acronimcurs, CL.nom as nomclase, CL.codi as codiclase, CL.hores as horesclase, 
						  Gr.id as idgrup, GR.nom as nomgrup, GR.hores as horesgrup
							FROM any_academic A, cursos C, clases CL, grups GR
							WHERE GR.id_any = A.id
							AND GR.id_curs = C.id
							AND GR.id_clase = CL.id";
							
						  $result = mysql_query($query);
						  $numero = 0;
						  while($row = mysql_fetch_array($result))
						  {
							echo "<tr><td width=\"25%\"><font face=\"verdana\">" . 
								$row["idgrup"] . "</font></td>";
							echo "<td width=\"25%\"><font face=\"verdana\">" . 
								$row["any"] . "</font></td>";
							echo "<td width=\"25%\"><font face=\"verdana\">" . 
								$row["nomcurs"]. "</font></td>";
							echo "<td width=\"25%\"><font face=\"verdana\">" . 
								$row["acronimcurs"] . "</font></td>";
							echo "<td width=\"25%\"><font face=\"verdana\">" . 
								$row["nomclase"] . "</font></td>";
							echo "<td width=\"25%\"><font face=\"verdana\">" . 
								$row["codiclase"]. "</font></td>";
							echo "<td width=\"25%\"><font face=\"verdana\">" . 
								$row["horesclase"] . "</font></td>";
							echo "<td width=\"25%\"><font face=\"verdana\">" . 
								$row["nomgrup"]. "</font></td>"; 
							echo "<td width=\"25%\"><font face=\"verdana\">" . 
								$row["horesgrup"]. "</font></td></tr>";
							$numero++;
						  }
						  echo "<tr><td colspan=\"15\"><font face=\"verdana\"><b>Número: " . $numero . 
							  "</b></font></td></tr>";
							  ?>
					</TABLE>
					
					</br>
					</br>
					
					<TABLE BORDER="1"> CLASES SIN GRUPOS
						<TR>
						   <TH>ID</TH>
						   <TH>A&Ntilde;O</TH>
						   <TH>NOMBRE DEL CURSO</TH>
						   <TH>ACRONIMO</TH>
						   <TH>NOMBRE DE LA CLASE</TH>
						   <TH>CODIGO</TH>
						   <TH>HORAS TOTALES</TH>
						   <TH>NOMBRE DEL GRUPO</TH>
						   <TH>HORAS SEMANALES</TH>
						</TR>
						<?php  
						  $query = "SELECT A.any AS any, C.nom AS nomcurs, C.acronim AS acronimcurs, CL.id AS idclase, CL.nom AS nomclase, CL.codi AS codiclase, CL.hores AS horesclase
									FROM any_academic A, cursos C, clases CL
									WHERE CL.id_any = A.id
									AND CL.id_curs = C.id
									AND Cl.id NOT
									IN (

									SELECT id_clase
									FROM grups
									)";
							
						  $result = mysql_query($query);
						  $numero = 0;
						  while($row = mysql_fetch_array($result))
						  {
							echo "<tr><td width=\"25%\"><font face=\"verdana\">" . 
								$row["idclase"] . "</font></td>";
							echo "<td width=\"25%\"><font face=\"verdana\">" . 
								$row["any"] . "</font></td>";
							echo "<td width=\"25%\"><font face=\"verdana\">" . 
								$row["nomcurs"]. "</font></td>";
							echo "<td width=\"25%\"><font face=\"verdana\">" . 
								$row["acronimcurs"] . "</font></td>";
							echo "<td width=\"25%\"><font face=\"verdana\">" . 
								$row["nomclase"] . "</font></td>";
							echo "<td width=\"25%\"><font face=\"verdana\">" . 
								$row["codiclase"]. "</font></td>";
							echo "<td width=\"25%\"><font face=\"verdana\">" . 
								$row["horesclase"] . "</font></td>";
							$numero++;
						  }
						  echo "<tr><td colspan=\"15\"><font face=\"verdana\"><b>Número: " . $numero . 
							  "</b></font></td></tr>";
							  ?>
					</TABLE> 
				
					<a href="exportar.php"><button><font color="#cc0000"><strong>Exportar</strong></font></button>
					<a href="importar.php"><button><font color="#cc0000"><strong>Importar</strong></font></button>
				</div>
			</div>
			<?php
				require_once("plantillas/info_mini.php");
			?>
		</div>
	</body>
</html>