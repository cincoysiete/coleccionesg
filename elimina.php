<?php session_start();
include("identifica.php");
 
include("variables.php"); 
include("constantes.php");
include("encriptado.php"); 
include("cincoysiete.css"); 

// ELIMINA DEL textarea LOS PUNTOS Y COMA Y LOS INTROS
$kiki="";
for ($f=0;$f<=count($col);$f++){
$pea=str_replace(";",",",$_POST[$f]);
$_POST[$f]=$pea;
if ($tip[$f]="textarea") {$pea=str_replace(PHP_EOL,". ",$_POST[$f]);}
$kiki=$kiki.$pea.";";
}
$kiki = substr($kiki, 0, -1);

// LEEMOS LA BASE DE DATOS Y AL LLEGAR AL NUMERO DE REGISTRO A MODIFICAR INSERTAMOS EL MODIFICADO
echo $kiki."<br><br>";

$koko="";
$ero=fopen($_SESSION["elusuario"]."/".$mibase.".csv","r") or die("Error en base de datos");
while (!feof($ero)) 
{
$linea=fgets($ero);
$kaka=explode(";",$linea);
if ($kaka[0]==$_GET["qwe"]){$linea="";} else {}
$koko=$koko.$linea;

}
fclose($ero);

$koko=str_replace(PHP_EOL.PHP_EOL,PHP_EOL,$koko);

// GUARDAMOS LA BASE DE DATOS MODIFICADA
$arx=fopen($_SESSION["elusuario"]."/".$mibase.".csv","w") or die("Problemas en la creacion ");
fputs($arx,$koko);
fclose($arx);


// echo "<br><br>";
// echo $koko;
?>
<script>window.history.go(-2)</script>