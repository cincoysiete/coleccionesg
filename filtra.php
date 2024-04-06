<?php session_start();
include("identifica.php");
 
include("variables.php"); 
include("constantes.php");
include("encriptado.php"); 
include("cincoysiete.css"); 

?>

<html lang="es">
<link rel="manifest" href="manifest.json">
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link rel="icon" type="image/png" href="<?php echo $log; ?>" />
<?php header('Content-Type: text/html; charset=UTF-8'); ?>


<title><?php echo $nom; ?></title>

<?php
$_SESSION["filtro"]=$_GET["fitra"];
$_SESSION["columna"]=$_GET["coluna"];


echo '<script>location.href="tabla.php"</script>';

?>

