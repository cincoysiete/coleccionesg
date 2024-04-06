<?php session_start();
include("identifica.php");
 
include("constantes.php"); 
include("encriptado.php"); 
// include("cincoysiete.css"); 


$kaka=explode(".",$_GET["mtk"]);
$keke=explode("/",$kaka[0]);

// copy("backup/".$keke[1].".php",$_SESSION["elusuario"]."/"."bases/".$keke[1].".php");
// copy("backup/".$keke[1].".csv",$_SESSION["elusuario"]."/"."bases/".$keke[1].".csv");

unlink($_SESSION["elusuario"]."/"."backup/".$keke[2].".php");
unlink($_SESSION["elusuario"]."/"."backup/".$keke[2].".csv");

header("location: eliminabase.php");

?>

