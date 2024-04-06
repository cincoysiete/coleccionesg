<?php session_start();
include("identifica.php");
 
include("variables.php"); 
include("constantes.php");
include("encriptado.php"); 
include("cincoysiete.css"); 

if ($_SESSION["tamtxt"]<20){$_SESSION["tamtxt"]++; $_SESSION["tamtxt"]++;}
if ($_SESSION["tamtxt"]>=20){$_SESSION["tamtxt"]=10;}


echo '<script>location.href="tabla.php"</script>';
?>

