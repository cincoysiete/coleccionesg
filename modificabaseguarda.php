<?php session_start();
include("identifica.php");
 
include("constantes.php"); 
include("encriptado.php"); 
include("cincoysiete.css"); 
// $_SESSION["elusuario"] = base64_encode($_SESSION["gusuario"]);

$linea=PHP_EOL;
$linea.='$mibase="'.'bases/'.$_POST["nombre"].'";'.PHP_EOL;
$linea.='$deci="'.$_POST["decimales"].'";'.PHP_EOL;
$linea.='$come="'.$_POST["comen"].'";'.PHP_EOL.PHP_EOL;

for ($f=1;$f<=$numcampos;$f++){
if ($_POST["nom".$f]!=""){
$linea.='$col['.$f.']="'.$_POST["nom$f"].'";'.PHP_EOL;
$linea.='$tip['.$f.']="'.$_POST["tipo$f"].'";'.PHP_EOL;
$linea.='$sum['.$f.']="'.$_POST["suma$f"].'";'.PHP_EOL;
$linea.='$med['.$f.']="'.$_POST["media$f"].'";'.PHP_EOL;

$kita=str_replace("\r\n",",",rtrim($_POST["cate$f"]));
$linea.='$cat['.$f.']="'.$kita.'";'.PHP_EOL;
$linea.='$hlp['.$f.']="'.$_POST["help$f"].'";'.PHP_EOL;
}
$linea.=PHP_EOL;
}

// GUARDA EL ARCHIVO variables.php QUE CONTIENE LOS DETALLES DE LA TABLA
$nuevabase='<?php'.PHP_EOL.$linea.PHP_EOL.'?>';


$arx=fopen($_SESSION["elusuario"]."/"."bases/".$_SESSION["nombrebase"].".php","w") or die("Problemas en la creacion ");
fputs($arx,$nuevabase);
fclose($arx);

// exit($_SESSION["elusuario"].'/'.'bases/'.$_SESSION["nombrebase"].".csv");

// AÑADE ; EN CASO DE SER NECESARIO
$ero=fopen($_SESSION["elusuario"].'/'.'bases/'.$_SESSION["nombrebase"].".csv","r") or die("Error en base de datos 1");
while (!feof($ero)) 
{
$linea=fgets($ero);

$pei=explode(";",$linea);
$et=21-count($pei);
if ($et>2 and strlen($linea>1)) {for ($rt=1;$rt<=$et;$rt++) {$linea=rtrim($linea).";";}}

if ($linea!=";;") {$koko=$koko.$linea;}
$contando++;
}
fclose($ero);
$arx=fopen($_SESSION["elusuario"].'/'.'bases/'.$_SESSION["nombrebase"].".csv","w") or die("Problemas en la creacion ");
fputs($arx,$koko);
fclose($arx);


// SI HEMOS CAMBIADO EL NOMBRE DE LA BASE DE DATOS ACTUALIZA LOS ARCHIVOS PHP Y CSV

// echo $_SESSION["nombrebase"];
// echo "<br>";
// echo  preg_replace('/[^a-zA-Z0-9_-]/', '', $_POST["nombre"]).".php";
// exit();

if ($_SESSION["nombrebase"].".php"!=preg_replace('/[^a-zA-Z0-9 _-]/', '', $_POST["nombre"]).".php"){
    $kake=explode(".",$_SESSION["nombrebase"]);

    $nuevabase=$kake[0].".csv";
    copy($_SESSION["elusuario"]."/"."bases/".$nuevabase,$_SESSION["elusuario"]."/"."bases/".preg_replace('/[^a-zA-Z0-9 _-]/', '', $_POST["nombre"]).".csv");
    unlink($_SESSION["elusuario"]."/"."bases/".$nuevabase);

    $nuevabase=$kake[0].".php";
    copy($_SESSION["elusuario"]."/"."bases/".$nuevabase,$_SESSION["elusuario"]."/"."bases/".preg_replace('/[^a-zA-Z0-9 _-]/', '', $_POST["nombre"]).".php");
    unlink($_SESSION["elusuario"]."/"."bases/".$nuevabase);

    $nuevabase=$kake[0].".html";
    copy($_SESSION["elusuario"]."/"."bases/".$nuevabase,$_SESSION["elusuario"]."/"."bases/".preg_replace('/[^a-zA-Z0-9 _-]/', '', $_POST["nombre"]).".html");
    unlink($_SESSION["elusuario"]."/"."bases/".$nuevabase);

}


?>
<script>window.history.go(-2)</script>