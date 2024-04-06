<?php 
session_start();
include("identifica.php");
 
include("encriptado.php");
include("variables.php");
include("constantes.php");
include("cincoysiete.css"); 
?>

<html lang="es">

<link rel="icon" type="image/png" href="<?php echo $log; ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<title><?php echo $nom; ?></title>


<?php
if ($_GET["modi"]=="-1") {$_SESSION["puedomodificar"]=$_GET["modi"]; $_SESSION["editar"]=-1;}

// $keke=$_GET["ficha"];
$_SESSION["fichactual"]=urldecode($_GET["ficha"]);
 
include("muestraficha.php");

?>
