<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
	//include ('const.php');
	//Necesitam l'archiu header.php localitzat a la carpeta conexion per poder establir la conexio amb la base de dades i aixi poder realitzar les sentencies.
	require_once ("conexion/header.php");
	 
	 
	 
	if(isset($_POST['agregarano'])){
	 
		$año = $_POST['anytxt'];
		$sqlany="insert into any_academic(any) values ('$año')";
		
		
		
		
		if(empty($_POST['anytxt']))
		{
			print "<script type=\"text/javascript\">";
			//print "alert('The email address '" . $_POST['email'] ."' is already registered')";
			print "alert('no has introducido ningun valor en el campo')";
			print "</script>";  
		}
		else
		{
			
			mysql_query($sqlany);
			
			print "<script type=\"text/javascript\">";
			print "alert('Se ha introducido el a\u00f1o correctamente')";
			print "</script>";   
			
			
		}
	 }
	 else if(isset($_POST['agregarcurso'])){
	 
		$año = $_POST['any1'];
		$curs = $_POST['curstxt'];
		
		$sqlcurs="insert into cursos(id_any) values ('$año')";
		if($_POST['any1'] == "seleccione opcion" or empty($_POST['curs'])){
		
			print "<script type=\"text/javascript\">";
			print "alert('Faltan datos por rellenar')";
			print "</script>";  
		}
		else
		{
			
		}
	 
	 }
	 /*else if(isset($_POST['agregar clase'])){
	 
	 }
	 else if(isset($_POST['agregar grupo'])){
	 
	 }*/
	  
	 //-----------------------------------------------------------------------------------------------------------------------------------------
	 //-----------------------------------------------------------------------------------------------------------------------------------------
	 
	 //Cream e inicialitcem els arrays on emmagatzemarem els resultats de les sentencies. 
	$arrayanys = array();
	 
	$arraycursos = array();
	 
	$arrayclases = array();
	 
	$arraygrups = array();
 
	 
	 //Guardam les sentencies que emprarem en unes variables.
	$query_anys = "select id as id, any as nombre from any_academic";
	 
	$query_cursos = "select id as id, id_any, nom, acronim as nombre from cursos";
	 
	$query_clases = "select id as id, id_any, id_curs, nom, codi as nombre, hores from clases";
	 
	$query_grups = "select id as id, id_any, id_curs, id_clase, nom as nombre, hores from grups";

	 
	 
	 
	 //Guardam el resultat de cada sentencia en une variables.
	$result_anys = mysql_query($query_anys);
	 
	$result_cursos = mysql_query($query_cursos);
	 
	$result_clases = mysql_query($query_clases);
	 
	$result_grups = mysql_query($query_grups);
	 
	// echo mysql_num_rows($result_clases);
	 
	 
	while ($result_anys && $row = mysql_fetch_object($result_anys))
	 
	    $arrayanys[] = $row;
	 
	while ($result_cursos && $row = mysql_fetch_object($result_cursos))
 
	    $arraycursos[] = $row;
	 
	while ($result_clases && $row = mysql_fetch_object($result_clases))
	 
	    $arrayclases[] = $row;
 
	while ($result_grups && $row = mysql_fetch_object($result_grups))
 
	    $arraygrups[] = $row;
 
	     
		 
	//El que fem a continuació es guardar en una variable el resultat de cada array i passar-li el parametre json_encode que es una funció emprada per traduir o intercanviar
	//informació entre diferents llenguatges. En aquest cas, la funció json_encode ens converteix arrays en cadenas de text en format json (Javascript Object Nation) per així
	//poderlas interpretar i ferlas servir en javascript.
	 
	$anysJS = json_encode($arrayanys);
	 
	$cursosJS = json_encode($arraycursos);
	 
	$clasesJS = json_encode($arrayclases);
	 
	$grupsJS = json_encode($arraygrups);
	
	//--------------------------------------------------------------------------------------------------------------------------------------
	//--------------------------------------------------------------------------------------------------------------------------------------
?>
<html>
	<head>
            <title> Dosagui </title>
            <!--META-->
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
            <script src = "js/plantilla.js" type = "text/javascript"></script>
            <link rel = "stylesheet" type = "text/css" href = "css/estil.css" >
			<script src="js/Mochikit.js"></script><!--Javascript necesari per poder interactuar amb els dropdownlist i poder interpretar algunes funcions de javascript que s'empraran -->
 
     
 
		<script>
	 
	 //-------------------------------------------------------------------------------------------------------------------------------------
	 //-------------------------------------------------------------------------------------------------------------------------------------
	 
	 	//Comencem el codi javascript
	
	
		//Cream e inicialitcem unes variables donant-lis el valor dels arrays creats anteriorment amb el json_encode.
			var anys = <?=$anysJS?>;

			var cursos = <?=$cursosJS?>;
	 
			var clases = <?=$clasesJS?>;
	 
			var grups = <?=$grupsJS?>;

				 
			//Get en el que aconseguirem els cursos segons l'any que hem triat, li passam un parametre per referencia.
			function getCursosPerAnys(idany){
	 
				var nousCursos = [];
				
				//Recorrem tot el vector "cursos" en el que trobarem tota la informació segons la sentencia creada anteriorment, hem de recordar que el que guardam a la variable cursos es el que hem tret de l'array
				//per el qual se li ha passat el json_encode.
				for (var i=0;i<cursos.length;i++)
				{
					//si el id del any de la taula cursos es igual al que li pasam per referencia a la funció, agafarem el valor d'aquest id.
					if (cursos[i].id_any==idany)
					{
	 
						nousCursos.push(cursos[i]);
					}
				}
	 
				return nousCursos;
		 
			}
	 
			 
			//Gent en el que aconseguirem les clases segons el curs que hem triat.
			function getClasesPerCursos(curs){
	 
				var novesClases = [];
	 
				//alert(curs);
				
				for (var i=0;i<clases.length;i++)
				{
					//document.write(clases[i]);
					if (clases[i].id_curs==curs)
					{
						//alert('entra');
						novesClases.push(clases[i]);
						
					}
					
				}
	 
				return novesClases;
	 
			}
	 
			 
			//Get en el que aconseguirem els grups segons la clase que hagem triat
			function getGrupsPerClases(clase){
	 
				var nousGrups = [];
	 
				for (var i=0;i<grups.length;i++)
	 
					if (grups[i].id_clase==clase)
	 
						nousGrups.push(grups[i]);
	 
				return nousGrups;
	 
			}
	 
			 
	 
			function setDataSource(obj,items){
		 
				var array = getElementsByTagAndClassName("option",null,obj); //Agafem tots els options de l'element que li estem passant
	 
	 
				//Deixam a 0 tots els valors de l'array
				for (var i=0;i<array.length;i++)
				{
					removeElement(array[i]);
				}
		 
				if (items!=null)
				{
					appendChildNodes(obj, OPTION({'value':-1},null,'seleccione opcion'));
					for (var i=0;i<items.length;i++)
					{
							appendChildNodes(obj, OPTION({'value':items[i].id},null,items[i].nombre));
					}
				}
	 
			}
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------
			//Farem un addLoadEvent per cada formulari que tenguem a la pagina i hagi d'emprar aquesta funcionalitat.
			 
	 
			addLoadEvent
			(
				//En aquest primer addLoadEvent el que feim es canviar el valor del dropdownlist cada vegada que triem una opció d'un nivell superior.
				function()
				{
	 
					//Empram el setDataSource per omplir els camps de l'element amb id 'any'
					setDataSource($('any'),anys);
	 
					 
					//Una vegada que l'element 'any' te un valor canviarem el valor de l'element amb id 'curs', podrem triar els valors d'aquest element depenent del valor triat amb l'element superior 'any'
					connect ($('any'),"onchange", function (elem){
					
							//alert(elem.target().value);
	 
							setDataSource($('curs'),getCursosPerAnys(elem.target().value));
		 
							setDataSource($('clase'),null);
		 
							setDataSource($('grup'),null);
	 
						}
		 
					);
	 
					connect ($('curs'),"onchange", function (elem){
					
							//alert(elem.target().value);
		 
							setDataSource($('clase'),getClasesPerCursos(elem.target().value));
		 
							setDataSource($('grup'),null);
	 
						}
		 
					);
		 
					connect ($('clase'),"onchange", function (elem){
		 
							setDataSource($('grup'),getGrupsPerClases(elem.target().value));
	 
						}
	 
					);
					
					
					
	 
				}
				
			);
				
				addLoadEvent
				(
				
					function()
					{
					
						setDataSource($('any1'),anys);
					}
				);
				
				addLoadEvent
				(
				
					function()
					{
					
						setDataSource($('any2'),anys);
						
						connect ($('any2'),"onchange", function (elem){
					
								//alert(elem.target().value);
		 
								setDataSource($('curs1'),getCursosPerAnys(elem.target().value));
	 
							}
		 
						);
					}
				);
				
				
				
				addLoadEvent
				(
				
					function()
					{
					
						setDataSource($('any3'),anys);
						
						connect ($('any3'),"onchange", function (elem){
					
									//alert(elem.target().value);
			 
									setDataSource($('curs2'),getCursosPerAnys(elem.target().value));
		 
								}
							);
							
							connect ($('curs2'),"onchange", function (elem){
						
									//alert(elem.target().value);
				 
									setDataSource($('clase1'),getClasesPerCursos(elem.target().value));
			 
		 
								}
			 
							);
		 
						
					}
				);
				
				
	 //---------------------------------------------------------------------------------------------------------------------------------
	 //---------------------------------------------------------------------------------------------------------------------------------
		
		
		</script>
	
		<script type="text/javascript">
		
			//Funcions per amagar i mostrar els formularis de la pagina.
		
			function mostrar() {
			
				if(document.getElementById('form').style.display =='none')
				{
					document.getElementById('form').style.display ='inherit';
				}
				else
				{
					document.getElementById('form').style.display ='none';
				}
			};
			
			function mostrarany() {
			
				if(document.getElementById('formany').style.display =='none')
				{
					document.getElementById('formany').style.display ='inherit';
				}
				else
				{
					document.getElementById('formany').style.display ='none';
				}
			};
			
			function mostrarcurs() {
			
				if(document.getElementById('formcurso').style.display =='none')
				{
					document.getElementById('formcurso').style.display ='inherit';
				}
				else
				{
					document.getElementById('formcurso').style.display ='none';
				}
			};
			
			function mostrarclase() {
			
				if(document.getElementById('formclase').style.display =='none')
				{
					document.getElementById('formclase').style.display ='inherit';
				}
				else
				{
					document.getElementById('formclase').style.display ='none';
				}
			};
			
			function mostrargrup() {
			
				if(document.getElementById('formgrup').style.display =='none')
				{
					document.getElementById('formgrup').style.display ='inherit';
				}
				else
				{
					document.getElementById('formgrup').style.display ='none';
				}
			};
			
		</script>
	
	
    </head>
	<body>
	
		<div class = "general">
			<?php 
				require_once("plantillas/encabezado.php");
				require_once("plantillas/botones.php");
			?>
			<div class = "cuerpo">
				<div class = "display">
				
					
					<a class="formulario" href="javascript:void(0)" onclick='mostrar()'>A&ntilde;o academico </a>
					
					<form method="post" action="index.php" id="form" style="display:none">

						<table class="tabla1" >
							

							<select id="any" name="Any"></select>
		 
			 
		 
							<select id="curs" name="Curs"/></select>
		 
			 
		 
	 
							<select id="clase" name="Clase"/></select>
		 
			 
		 
	 
							<select id="grup" name="Grup"/></select>



							</BR>
							<input type="Submit" value="Mostrar datos" name="enviar" />
              
						</table>
						
					</form>
					
					</br>
					</br>
					</br>
					</br>
					
					<a class="formulario" href="javascript:void(0)" onclick='mostrarany()'>Agregar A&ntilde;o  </a>
					
					<form method="post" action="index.php" id="formany" style="display:none">

						<table class="tabla1" >
							
							
							
							<p>A&ntilde;o: <input type="text" name="anytxt" id="anytxt" /></p>


							</BR>
							<input type="submit" value="Agregar A&ntilde;o " name="agregarano"  />
              
						</table>
						
					</form>

					</br>
					</br>
					</br>
					</br>
					
					<a class="formulario" href="javascript:void(0)" onclick='mostrarcurs()'>Agregar Curso  </a>
					
					<form method="post" action="index.php" id="formcurso" style="display:none">

						<table class="tabla1" >
							
							<select id="any1" name="Any"></select>
							</br>
							<p class="pform">Curso: <input type="text" name="curs" id="curstxt" /></p>


							</BR>
							<input type="Submit" value="Agregar A&ntilde;o " name="agregarcurso" />
              
						</table>
						
					</form> 
					
					</br>
					</br>
					</br>
					</br>
					
					<a class="formulario" href="javascript:void(0)" onclick='mostrarclase()'>Agregar Clase  </a>
					
					<form method="post" action="index.php" id="formclase" style="display:none">

						<table class="tabla1" >
							
							<select id="any2" name="Any"></select>
							<select id="curs1" name="Curs"></select>
							</br>
							<p class="pform">Clase: <input type="text" name="clase" id="clasetxt" /></p>


							</BR>
							<input type="Submit" value="Agregar A&ntilde;o " name="agregarclase" />
              
						</table>
						
					</form>
					
					</br>
					</br>
					</br>
					</br>
					
					<a class="formulario" href="javascript:void(0)" onclick='mostrargrup()'>Agregar Grup  </a>
					
					<form method="post" action="index.php" id="formgrup" style="display:none">

						<table class="tabla1" >
							
							<select id="any3" name="Any"></select>
							<select id="curs2" name="Curs"></select>
							<select id="clase1" name="Clase"></select>
							
							</br>
							<p class="pform">Grup: <input type="text" name="grup" id="gruptxt" /></p>


							</BR>
							<input type="Submit" value="Agregar A&ntilde;o " name="agregargrupo" />
              
						</table>
						
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