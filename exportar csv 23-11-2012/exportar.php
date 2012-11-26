<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php

require_once ("conexion/header.php");


//$arraycursos = array();

//$query_cursos = "select id as id, id_any, nom, acronim as nombre from cursos";

//$resultado = mysql_query("select id as id, id_any, nom, acronim as nombre from cursos");

$resultado = mysql_query("SELECT A.any as any, C.nom as nomcurs, C.acronim as acronimcurs, CL.nom as nomclase, CL.codi as codiclase, CL.hores as horesclase, Gr.id as idgrup, GR.nom as nomgrup, GR.hores as horesgrup
FROM any_academic A, cursos C, clases CL, grups GR
WHERE GR.id_any = A.id
AND GR.id_curs = C.id
AND GR.id_clase = CL.id");


$f = fopen("reporte.csv","w");
$sep = ";"; //separador

//fwrite($f, "Clases con grupos" . "\n");
fwrite($f, "id" . $sep . "año" . $sep . "Nombre del curso" . $sep . "Acronimo" . $sep . "Nombre de la clase" . $sep . "Codigo de la clase" . $sep . "Horas totales por clase" . $sep . "Nombre del grupo" . $sep . "Horas semanales por grupo" . "\n");
while($reg = mysql_fetch_array($resultado) ) {
 
$linea = $reg["idgrup"].$sep.$reg['any'].$sep.$reg['nomcurs'].$sep.$reg['acronimcurs'].$sep.$reg['nomclase'].$sep.$reg['codiclase'].$sep.$reg['horesclase'].$sep.$reg['nomgrup'].$sep.$reg['horesgrup'] ."\n";
fwrite($f,$linea);
 
}
fclose($f);
//Read more at http://tednologia.com/exportar-importar-archivos-csv-php/#oui0xMdcvG0XtBQX.99

print "<script type=\"text/javascript\">";
print "alert('Se ha creado el csv correctamente')";
print "</script>";   

header("Location: taula.php");
exit;			

?>