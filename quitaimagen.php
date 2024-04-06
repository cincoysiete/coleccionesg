<?php session_start();
include("identifica.php");
 
include("variables.php"); 
include("constantes.php");
include("encriptado.php"); 
include("cincoysiete.css"); 


$kakai=explode("~",$_GET["qwei"]);

$koko="";
$ero=fopen($_SESSION["elusuario"]."/".$mibase.".csv","r") or die("Error en base de datos");
while (!feof($ero)) 
{
$linea=fgets($ero);
$kaka=explode(";",$linea);

if ($kaka[0]==$kakai[0]){
unlink(trim($kakai[1]));
$linea=str_replace(trim($kakai[1]),"",$linea);
// echo $kakai[1];
}
$koko=$koko.$linea;

}
fclose($ero);

// GUARDAMOS LA BASE DE DATOS MODIFICADA
$arx=fopen($_SESSION["elusuario"]."/".$mibase.".csv","w") or die("Problemas en la creacion ");
fputs($arx,$koko);
fclose($arx);


?>

<script>window.history.go(-2)</script>
