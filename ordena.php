<?php session_start();
include("identifica.php");
 
include("variables.php"); 
include("constantes.php");

// ORENA SEGUN LA COLUMNA QUE HEMOS MARCADO
$comoordeno=$_GET["qwer"];

$conta=0;
$er=fopen($_SESSION["elusuario"]."/".$mibase.".csv","r");
while (!feof($er))
{
$linea=fgets($er);
$kaka=explode(";",$linea);
$lineo[$conta]=$kaka[$comoordeno].";";
// if ($lineo[$conta]==";"){$lineo[$conta]="vacio;";}
// if ($lineo[$conta]==";"){$conta--;}
for ($t=0;$t<=count($col);$t++){$lineo[$conta]=$lineo[$conta].$kaka[$t].";";}
// $lineo[$conta] = substr($lineo[$conta], 0, -1);

// echo $lineo[$conta]."<br>";

$conta++;
}
fclose($er);

// exit();

// echo "<br><br>";
// echo count($lineo);
// echo "<br>...<br>";

// $kiki="";
// $lineamala="";
// for ($t=1;$t<=count($col);$t++) {$lineamala=$lineamala.";";}

// if ($tip[$comoordeno]=="number" or $tip[$comoordeno]=="date"){$k=sort($lineo,SORT_NUMERIC);} else {$k=sort($lineo,SORT_NATURAL);}
if ($_SESSION["orden"]!=1) {
$k=sort($lineo,SORT_NATURAL | SORT_FLAG_CASE);
$_SESSION["orden"]=1;
} else {
$k=rsort($lineo,SORT_NATURAL | SORT_FLAG_CASE);
$_SESSION["orden"]=-1;
}

// for ($r=0;$r<count($lineo);$r++){echo $lineo[$r]."<br>";}
// echo "<br><br>";


$contao=1;
$ar=fopen($_SESSION["elusuario"]."/".$mibase.".csv","w");
for ($i=0; $i<$conta; $i++)
{
$kaka=explode(";",$lineo[$i]);
if (substr($lineo[$i],0,2)!=";;") {
$lineu="";
$lineu=$lineu.$contao.";";
$contao++;
for ($t=2;$t<=count($col)+1;$t++){$lineu=$lineu.$kaka[$t].";";}

// echo "-".substr($lineo[$i],0,2);
// echo "-<br>";

$kiki=$kiki.$lineu.PHP_EOL;

// echo $lineu."<br>";
}
}
fputs($ar,$kiki);
fclose($ar);

echo '<script>location.href="tabla.php"</script>';

?>
