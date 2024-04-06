<?php 
session_start();
include("identifica.php");
 
include("encriptado.php");
include("variables.php");
include("constantes.php");
include("cincoysiete.css"); 
?>

<html lang="es">
<meta name="viewport" content="width=device-width, initial-scale=1"/>

<?php
move_uploaded_file($_FILES["importo"]['tmp_name'], $_SESSION["elusuario"]."/"."bases/".$_FILES["importo"]['name']);
$pea=$_SESSION["elusuario"]."/"."bases/".$_FILES["importo"]['name'];
copy($pea,$_SESSION["elusuario"]."/"."bases/".$_SESSION["impo"]);
unlink($pea);

// AÑADE EL CAMPO 0 PARA IDENTIFICADOR DE REGISTRO
$conta=1;
$lineo="";
$ero=fopen($_SESSION["elusuario"]."/".$mibase.".csv","r") or die("Error en base de datos");
$linea=fgets($ero);
while (!feof($ero)) 
{
$linea=$conta.";".fgets($ero);
if (strlen($linea)>2) {$lineo=$lineo.$linea;}
$conta++;
}
fclose($ero);

$arx=fopen($_SESSION["elusuario"]."/".$mibase.".csv","w") or die("Problemas en la creacion ");
fputs($arx,$lineo);
fclose($arx);


// AÑADE LOS ; NECESARIOS AL FINAL DEL REGISTRO
$conta=1;
$lineo="";
$eros=fopen($_SESSION["elusuario"]."/".$mibase.".csv","r") or die("Error en base de datos");
while (!feof($eros)) 
{
$kakota="";
$linea=trim(fgets($eros));
$kaka=explode(";",$linea);
for ($f=0;$f<=count($col);$f++){
$kakota=$kakota.$kaka[$f].";";
}
$kakota = substr($kakota, 0, -1);
if (strlen($kakota)>10) {$lineo=$lineo.$kakota.PHP_EOL;}
}
fclose($eros);

$arx=fopen($_SESSION["elusuario"]."/".$mibase.".csv","w") or die("Problemas en la creacion ");
fputs($arx,$lineo);
fclose($arx);

echo '<script>location.href="tabla.php"</script>';

?>
