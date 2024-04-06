<?php session_start();
include("identifica.php");
include("variables.php"); 
include("constantes.php");
include("cincoysiete.css"); 
?>
<html lang="es">

<?php

// ELIMINA EL REGISTRO
if ($_POST["eliminar"]=="on"){

if ($_SESSION["contadora"]>$_SESSION["cuantosregistros"]){$_SESSION["contadora"]=$_SESSION["cuantosregistros"];}
$keke="";
$ero=fopen($_SESSION["elusuario"]."/".$mibase.".csv","r") or die("Error en base de datos");
for ($f=1;$f<=$_SESSION["cuantosregistros"];$f++) {
$linea=fgets($ero);
if ($f!=$_SESSION["contadora"]){$keke=$keke.$linea;}
}
fclose($ero);


// GUARDAMOS LA BASE DE DATOS MODIFICADA
$arx=fopen($_SESSION["elusuario"]."/".$mibase.".csv","w") or die("Problemas en la creacion ");
fputs($arx,$keke);
fclose($arx);
echo '<script>location.href="tabla.php"</script>';
exit();
}

// SI ESTOY CREANDO UN REGISTRO, LE PONGO NUMERO
if ($_SESSION["puedomodificar"]==-1){$_POST[0]=9999999;}

// RECORRO LOS CAMPOS DEL REGISTRO QUE HA LLEGADO DESDE LA TABLA POR $_POST
$kiki="";
for ($f=0;$f<=count($col);$f++){
$pea=$_POST[$f];

// ELIMINA DEL textarea LOS PUNTOS Y COMA Y LOS INTROS
if ($tip[$f]=="textarea") {
$pea=str_replace(";",",",$_POST[$f]);
$_POST[$f]=$pea;
$cadenaConSaltosDeLinea=str_replace(PHP_EOL,"¬",$_POST[$f]);
$pea = preg_replace("/[\r\n]+/", "", $cadenaConSaltosDeLinea);

}

// SUBE LAS IMAGENES QUE SE HAYAN AÑADIDO
if ($tip[$f]=="image" or $tip[$f]=="doc") {
if ($_FILES[$f]['name']!="" and $_POST[$f+count($col)+1]==""){ 
move_uploaded_file($_FILES[$f]['tmp_name'], $_SESSION["elusuario"]."/"."upload/".$_FILES[$f]['name']);
$pea="upload/".$_FILES[$f]['name'];
} else {
$pea=rtrim($_POST[$f+count($col)+1]);
}
}

// AQUI ESTA EL REGISTRO NUEVO O MODIFICADO
$kiki=$kiki.$pea.";";

}
// AÑADE ; AL FINAL DEL REGISTRO
$pei=explode(";",$kiki);
$et=21-count($pei);
if ($et>1) {for ($rt=1;$rt<=$et;$rt++) {$kiki=$kiki.";";}}
// $kiki=$kiki.PHP_EOL;

// SI ESTAMOS MODIFICANDO, LEEMOS LA BASE DE DATOS Y AL LLEGAR AL NUMERO DE REGISTRO A MODIFICAR INSERTAMOS EL MODIFICADO
if ($_SESSION["puedomodificar"]==1){

$conta=1;
$koko="";
$kaka=explode("~",$_SESSION["fichactual"]);
$ero=fopen($_SESSION["elusuario"]."/".$mibase.".csv","r") or die("Error en base de datos");
while (!feof($ero)) 
{
$linea=fgets($ero);

// AÑADE ; AL FINAL DEL REGISTRO
$pei=explode(";",$linea);
$et=21-count($pei);
if ($et>1 and strlen($linea>1)) {
    for ($rt=1;$rt<=$et;$rt++) {$linea=rtrim($linea).";";} 
    $linea=$linea.PHP_EOL;
}

if ($conta==trim($kaka[0])){$koko=$koko.rtrim($kiki).PHP_EOL;} else {if (strlen($linea)>0) {$koko=$koko.rtrim($linea).PHP_EOL;}}
$conta++;
}
fclose($ero);

} else {

// SI ESTAMOS CREANDO UN REGISTRO LO AÑADIMOS AL FINAL DE LA BASE DE DATOS
$contando=0;
$ero=fopen($_SESSION["elusuario"]."/".$mibase.".csv","r") or die("Error en base de datos");
while (!feof($ero)) 
{
$linea=fgets($ero);
$koko=$koko.$linea;
$contando++;
}
fclose($ero);

$cede=explode(";",$kiki);
$kiki=$contando.";".$cede[1].";".$cede[2].";".$cede[3].";".$cede[4].";".$cede[5].";".$cede[6].";".$cede[7].";".$cede[8].";".$cede[9].";".$cede[10].";".$cede[11].";".$cede[12].";".$cede[13].";".$cede[14].";".$cede[15].";".$cede[16].";".$cede[17].";".$cede[18].";".$cede[19].";".$cede[20].";";

if (strlen($kiki)>4) {$koko=$koko.$kiki.PHP_EOL;}
}

// GUARDAMOS LA BASE DE DATOS MODIFICADA
$arx=fopen($_SESSION["elusuario"]."/".$mibase.".csv","w") or die("Problemas en la creacion ");
fputs($arx,$koko);
fclose($arx);

echo '<script>location.href="tabla.php"</script>';

?>
