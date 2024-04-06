<?php session_start();
include("identifica.php");
 
include("variables.php"); 
include("constantes.php");
include("encriptado.php"); 
include("cincoysiete.css"); 


if ($_SESSION["bascula"]==1) {$_SESSION["col01"]=$_GET["qwer"]; }
if ($_SESSION["bascula"]!=1) {$_SESSION["col02"]=$_GET["qwer"]; }

$_SESSION["bascula"]=$_SESSION["bascula"]*-1;
echo '<script>location.href="tabla.php"</script>';
?>

