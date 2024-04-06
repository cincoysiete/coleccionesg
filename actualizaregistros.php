<?php
// ACTUALIZA LOS NUMEROS DE LOS REGISTROS HACIENDOLOS CONSECUTIVOS
$conta=1;
$lineo="";
$contao=1;
$ero=fopen($_SESSION["elusuario"]."/".$mibase.".csv","r") or die("Error en base de datos");
while (!feof($ero)) 
{
$linea=fgets($ero);
$kaka=explode(";",$linea);
if ($kaka[0]>0){
$kaka[0]=$conta;
for ($f=0;$f<=count($col);$f++){$lineo=$lineo.$kaka[$f].";";}
// echo $kaka[$f]."<br>";
$conta++;
}
$lineo = substr($lineo, 0, -1);
$contao++;
}
fclose($ero);
$lineo=$lineo.PHP_EOL;
$lineo=str_replace(PHP_EOL.PHP_EOL,PHP_EOL,$lineo);
if (strlen($lineo)<2){$lineo = substr($lineo, 0, -1);}

exit();

$arx=fopen($_SESSION["elusuario"]."/".$mibase.".csv","w") or die("Problemas en la creacion ");
fputs($arx,$lineo);
fclose($arx);
?>
