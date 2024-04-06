<?php session_start();
include("identifica.php");
 
include("constantes.php"); 
 
include("cincoysiete.css"); 


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
$linea.='$cat['.$f.']="'.','.$kita.'";'.PHP_EOL;

$linea.='$hlp['.$f.']="'.$_POST["help$f"].'";'.PHP_EOL;

}
$linea.=PHP_EOL;
}

// GUARDA EL ARCHIVO variables.php QUE CONTIENE LOS DETALLES DE LA TABLA
$nuevabase='<?php'.PHP_EOL.$linea.PHP_EOL.'?>';

$arx=fopen($_SESSION["elusuario"]."/"."bases/".$_POST["nombre"].".php","w") or die("Problemas en la creacion ");
fputs($arx,$nuevabase);
fclose($arx);

// CREA EL ARCHIVO DE BASE DE DATOS
$nuevabase=$_SESSION["comitas"];
$nuevabase="";
$arx=fopen($_SESSION["elusuario"]."/"."bases/".$_POST["nombre"].".csv","w") or die("Problemas en la creacion ");
fputs($arx,$nuevabase);
fclose($arx);

?>
<script>window.history.go(-2)</script>