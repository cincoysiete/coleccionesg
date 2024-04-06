<?php session_start();
include("identifica.php");
 
include("variables.php"); 
include("encriptado.php"); 
include("cincoysiete.css"); 
// if ($_SESSION["gusuario"]!==$_SESSION["gusuario1"] or $_SESSION["gclave"]!==$encriptar($_SESSION["gclave1"])) {header('Location: index.php');}


$kakai=explode("~",$_GET["qwe"]);

$koko="";
$ero=fopen("compras.csv","r") or die("Error en base de datos");
while (!feof($ero)) 
{
$linea=fgets($ero);
$kaka=explode(";",$linea);

if ($kaka[0]==$kakai[0]){
unlink(trim($kakai[1]));
$linea=str_replace(trim($kakai[1]),"",$linea);
echo $kakai[1];
}
$koko=$koko.$linea;

}
fclose($ero);

// GUARDAMOS LA BASE DE DATOS MODIFICADA
$arx=fopen("compras.csv","w") or die("Problemas en la creacion ");
fputs($arx,$koko);
fclose($arx);



?>

