<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
	//include ('const.php');
	//Necesitam l'archiu header.php localitzat a la carpeta conexion per poder establir la conexio amb la base de dades i aixi poder realitzar les sentencies.
	require_once ("conexion/header.php");
	 
	 	if(isset($_POST['agregarprofesor'])){
	 
		$persones = $_POST['persones'];
		$correu = $_POST['correu'];
		
		$sqlprofesor="insert into profesors (id_persona, correu) values ('$persones', '$correu')";
		
		
		
		
		if($_POST['persones'] == "Seleccione una Opcion..." or empty($_POST['correu']) )
		{
			print "<script type=\"text/javascript\">";
			//print "alert('The email address '" . $_POST['email'] ."' is already registered')";
			print "alert('Faltan campos por introducir')";
			print "</script>";  
		}
		else
		{
			
			mysql_query($sqlprofesor);
			
			print "<script type=\"text/javascript\">";
			print "alert('Se ha introducido el profesor correctamente')";
			print "</script>";   
			
			
		}
	 }
	 else if(isset($_POST['asignarprofesor'])){
	 
	 
	 
		$profesor = $_POST["profesor"];
		$clase = $_POST["clase"];
		$datainici = $_POST["f_date1"];
		$datafi= $_POST["f_date2"];
		$substitut = $_POST["substitut"];
		
		echo  $clase . '</br>' . $profesor . '</br>' . $datainici . '</br>' . $datafi . '</br>'  . $substitut;
		
		$sqlimparticio="insert into imparticio(id_grup, id_profesor, data_inici, data_fi, substitut) values ('$clase', '$profesor', '$datainici', '$datafi', $substitut)";
		
		if($_POST['profesor'] == "Seleccione una Opcion..." || $_POST['clase'] == "Seleccione una Opcion..." || empty($_POST['f_date1']) || empty($_POST['f_date2']))
		{
			print "<script type=\"text/javascript\">";
			//print "alert('The email address '" . $_POST['email'] ."' is already registered')";
			print "alert('Faltan campos por introducir')";
			print "</script>"; 
		}
		else
		{
			
			mysql_query($sqlimparticio);
			
			print "<script type=\"text/javascript\">";
			print "alert('Se ha aisgnado un profesor a un grupo correctamente')";
			print "</script>";   
		}
	 }

?>
<html>
	<head>
            <title> Profesors </title>
            <!--META-->
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
            <script src = "js/plantilla.js" type = "text/javascript"></script>
            <link rel = "stylesheet" type = "text/css" href = "css/estil.css" >
			
			
			<script src="js/jscal2.js"></script>
			<script src="js/lang/ca.js"></script>
			<link rel="stylesheet" type="text/css" href="css/calendari/jscal2.css" />
			<link rel="stylesheet" type="text/css" href="css/calendari/border-radius.css" />
			<link rel="stylesheet" type="text/css" href="css/calendari/estil/steel.css" />


	
	
    </head>
	<body>
	
		<div class = "general">
			<?php 
				require_once("plantillas/encabezado.php");
				require_once("plantillas/botones.php");
			?>
			<div class = "cuerpo">
				<div class = "display">
				
								<form method="post" action="profesors.php" id="formprofesor" >
								
					                    <p class="pform">Profesor<select  name="persones" id="persones"  style="width:25%;">
										<option>Seleccione una Opcion...</option>
                                            
                                             <?php
                                                    
													$persona = "SELECT id, nom , cognom FROM persones Where tipus='2'";
													$result = mysql_query($persona);

													while ($row=mysql_fetch_array($result))
													{
														echo '<option value="'.$row['id'].'">'.$row['nom'].', '.$row['cognom'].'</option>';
													}
                                              ?>
                                        </select></p>

										<p class="pform">Correo<input type="text" name="correu" id="correu" style="width:50%;"></p>
										
										</BR>
										<input type="Submit" value="Agregar profesor" name="agregarprofesor" />
										
								</form>
								
								</br>
								
								<form method="post" action="profesors.php" id="formimparticions" >
								
					                    <p>Profesor<select  name="profesor" id="profesor"  style="width:50%;">
										<option>Seleccione una Opcion...</option>
                                            
                                             <?php
                                                    
													$profesor = "SELECT id, correu FROM profesors";
													$result = mysql_query($profesor);

													while ($row=mysql_fetch_array($result))
													{
														echo '<option value="'.$row['id'].'">'.$row['correu'].'</option>';
													}
                                              ?>
                                        </select></p>

										
										
										</BR>
										
										<p>Clase<select  name="clase" id="clase"  style="width:50%;">
										<option>Seleccione una Opcion...</option>
                                            
                                             <?php
                                                    
													$profesor = "SELECT CL.id as idlase, CL.nom as nomclase, GR.id as id, GR.id_clase as idclasegrup, GR.nom as nom 
													from clases CL, grups GR where GR.id_clase = CL.id";
													$result = mysql_query($profesor);

													while ($row=mysql_fetch_array($result))
													{
														echo '<option value="'.$row['id'].'">'.$row['nomclase']. ' ' . $row['nom'].'</option>';
													}
                                              ?>
                                        </select></p>

										
										
										</BR>
										
										<input size="30" id="f_date1" name="f_date1"/><button id="f_btn1">Data Inici</button>

											<script type="text/javascript">//<![CDATA[
											  Calendar.setup({
												inputField : "f_date1",
												trigger    : "f_btn1",
												onSelect   : function() { this.hide() },
												showTime   : 12,
												dateFormat : "%Y-%m-%d " //%I:%M %p"
											  });
											//]]></script>
											
										
										
										<input size="30" id="f_date2" name="f_date2" /><button id="f_btn2">Data fi</button><br />

											<script type="text/javascript">//<![CDATA[
											  Calendar.setup({
												inputField : "f_date2",
												trigger    : "f_btn2",
												onSelect   : function() { this.hide() },
												showTime   : 12,
												dateFormat : "%Y-%m-%d " //%I:%M %p"
											  });
											//]]></script>
										
										</br>
										
										<p>Substitut<select  name="substitut" id="substitut"  style="width:10%;">
                                            
										<option value="0">NO</option>
										
										<option value="1">Si</option>
                                        </select></p>
										
										
										</br>
										<input type="Submit" value="Asignar profesor a clase" name="asignarprofesor" />
										
								</form>
				
				</div>
				<div class = "publi">
					Publicidad
				</div>
			</div>
			<?php
				require_once("plantillas/info_mini.php");
			?>
		</div>
	</body>
</html>