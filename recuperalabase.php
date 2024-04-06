<?php session_start();
include("identifica.php");
 
include("constantes.php"); 
include("encriptado.php"); 
// include("cincoysiete.css"); 


$kaka=explode(".",$_GET["mtk"]);
$keke=explode("/",$kaka[0]);

copy($_SESSION["elusuario"]."/"."backup/".$keke[2].".php",$_SESSION["elusuario"]."/"."bases/".$keke[2].".php");
copy($_SESSION["elusuario"]."/"."backup/".$keke[2].".csv",$_SESSION["elusuario"]."/"."bases/".$keke[2].".csv");
copy($_SESSION["elusuario"]."/"."backup/".$keke[2].".html",$_SESSION["elusuario"]."/"."bases/".$keke[2].".html");

// unlink("backup/".$keke[1].".php");
// unlink("backup/".$keke[1].".csv");

header("location: eliminabase.php");

?>

