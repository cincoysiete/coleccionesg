<?php session_start();
include("identifica.php");
 
include("encriptado.php"); 
include("constantes.php"); 
include("cincoysiete.css"); 
// $_SESSION["elusuario"] = base64_encode($_SESSION["gusuario"]);

$kao=explode(".",$_GET["mtk"]);
$kaos=$kao[0]."_".date('YmdHis');

// SI YA TIENES LA PLANTILLA CON EL MISMO NOMBRE, NO TE LA PUEDES LLEVAR
copy("plantillas/".$kao[0].".csv",$_SESSION["elusuario"]."/bases"."/".$kaos.".csv");
copy("plantillas/".$kao[0].".php",$_SESSION["elusuario"]."/bases"."/".$kaos.".php");
if (file_exists("plantillas/".$kao[0].".html")){
copy("plantillas/".$kao[0].".html",$_SESSION["elusuario"]."/bases"."/".$kaos.".html");
}

$ero=fopen($_SESSION["elusuario"]."/bases"."/".$kaos.".php","r") or die("Error en base de datos");
// $linea=fgets($ero);
while (!feof($ero)) 
{
    $linea=fgets($ero);
if (substr($linea,0,8)=='$mibase=') {$linea='$mibase="bases/'.$kaos.'";'.PHP_EOL;}
    $kakado=$kakado.$linea;
}
fclose($ero);

$arx=fopen($_SESSION["elusuario"]."/bases"."/".$kaos.".php","w") or die("Problemas en la creacion ");
fputs($arx,$kakado);
fclose($arx);

?>

<script>window.history.go(-2)</script>