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
$_SESSION["impo"]=$_GET["impo"];
?>

<form method="POST" action="importo.php"  enctype="multipart/form-data" style="max-width:500px;margin:auto">
<input type="hidden" name="MAX_FILE_SIZE" value="50000000"> 
<input class="input-field" type="file" placeholder="" name="importo" value="" accept="application/csv, .csv">
<input class="submit" type="submit"  value="Importar">
</form>



