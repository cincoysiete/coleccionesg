<?php session_start();
include("identifica.php");
 
include("constantes.php"); 
include("encriptado.php"); 
// include("cincoysiete.css"); 


$kaka=explode(".",$_GET["mtk"]);
$keke=explode("/",$kaka[0]);

copy($_SESSION["elusuario"]."/"."bases/".$keke[2].".php",$_SESSION["elusuario"]."/"."backup/".$keke[2].".php");
copy($_SESSION["elusuario"]."/"."bases/".$keke[2].".csv",$_SESSION["elusuario"]."/"."backup/".$keke[2].".csv");
copy($_SESSION["elusuario"]."/"."bases/".$keke[2].".html",$_SESSION["elusuario"]."/"."backup/".$keke[2].".html");

unlink($_SESSION["elusuario"]."/"."bases/".$keke[2].".php");
unlink($_SESSION["elusuario"]."/"."bases/".$keke[2].".csv");
unlink($_SESSION["elusuario"]."/"."bases/".$keke[2].".html");

header("location: eliminabase.php");

?>

