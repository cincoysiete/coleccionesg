<?php
session_start();
// include("identifica.php");
include("variables.php"); 
include("constantes.php");

$pede="";
$pedi="";

// RESCATA LOS ENCABEZADOS DE LOS CAMPOS
for ($f=1;$f<=count($col);$f++){
    $pedi=$pedi.$col[$f].";";
}
$pede=$pedi.PHP_EOL;

$file = file($_SESSION["elusuario"]."/".$mibase.".csv");
foreach ($file as $line) {

$peder="";
$kakado=explode(";",$line);
for ($f=1;$f<=count($col);$f++){
$peder=$peder.utf8_decode($kakado[$f]).";";
// echo $peder."<br>";
}
$line=$peder;

$pede=$pede.$line;
$pede=$pede.PHP_EOL;

}

// $contenido=$pede;
// $patron = '/upload\/(.*?)\.(png|jpg|jpeg|gif)/';
// preg_match_all($patron, $contenido, $matches);

// $enlaces_imagenes = $matches[0];

// foreach ($enlaces_imagenes as $enlace) {
// $kaki=explode("/",$enlace);
// echo $_SESSION["elusuario"]."/"."upload/".$kaki[1];
// echo "<br>";
// echo $kaki[1];
// echo "<br>";

// $ruta_imagen = $_SESSION["elusuario"]."/"."upload/".$kaki[1];
// $nombre_archivo = $kaki[1];
// header('Content-Description: File Transfer');
// header('Content-Type: application/octet-stream');
// header('Content-Disposition: attachment; filename=' . $nombre_archivo);
// header('Expires: 0');
// header('Cache-Control: must-revalidate');
// header('Pragma: public');
// header('Content-Length: ' . filesize($ruta_imagen));
// readfile($ruta_imagen);
// }


$labase=explode("/",$_SESSION["elusuario"]."/".$mibase);
// $pea=str_replace(".",",",$pede);

$pea=$pede;
$arx=fopen("base_".$labase[1].".csv","w") or die("Problemas en la creacion ");
fputs($arx,$pea);
fclose($arx);

header("Content-disposition: attachment; filename="."base_".$labase[1].".csv");
header("Content-type: application/csv");
readfile("base_".$labase[1].".csv");

?>

