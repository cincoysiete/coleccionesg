<?php session_start();
include("identifica.php");
 
include("constantes.php"); 
include("encriptado.php"); 
include("cincoysiete.css"); 

if ($_GET["onde"]<20){
$prime=$_GET["onde"]+1;
$segun=$_GET["onde"];

$todo="";
$conta=1;
$linea[]="";

$ero=fopen($_GET["esabase"],"r") or die("Error en base de datos");
while (!feof($ero)) {
$linea[$conta]=fgets($ero);
$conta++;
}
fclose($ero);

for ($f=1;$f<=$conta;$f++){
    $linea[$f]=str_replace("[".$prime."]",rtrim("[".$segun."-]"),$linea[$f]);
}

for ($f=1;$f<=$conta;$f++){
    $linea[$f]=str_replace("[".$segun."]",rtrim("[".$prime."]"),$linea[$f]);
}
    
for ($f=1;$f<=$conta;$f++){
    $linea[$f]=str_replace("[".$segun."-]",rtrim("[".$segun."]"),$linea[$f]);
}
   
for ($f=1;$f<=$conta;$f++){
    $todo=$todo.$linea[$f];
}
  

$arx=fopen($_GET["esabase"],"w") or die("Problemas en la creacion ");
fputs($arx,$todo);
fclose($arx);

// MODIFICAMOS EL CSV
$todos="";
$kake=explode(".",$_GET["esabase"]);
$debase=$kake[0].".csv";

$ero=fopen($debase,"r") or die("Error en base de datos");
while (!feof($ero)) {
$entrada=fgets($ero);
$datos = explode(';', $entrada);
$temp = $datos[$prime];
$datos[$prime] = $datos[$segun];
$datos[$segun] = $temp;
$salida = implode(';', $datos);
$todos=$todos.$salida;
}
fclose($ero);

$arx=fopen($debase,"w") or die("Problemas en la creacion ");
fputs($arx,$todos);
fclose($arx);

}

$_SESSION["vuelvo"]="si";

?>

<script>window.history.go(-1)</script>
