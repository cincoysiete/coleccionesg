<?php session_start();
include("identifica.php");
 
include("variables.php"); 
include("constantes.php");
include("encriptado.php"); 
include("cincoysiete.css"); 

if ($_SESSION["fichactual"]>1){
    $ero=fopen($_SESSION["elusuario"]."/".$mibase.".csv","r") or die("Error en base de datos");
    for ($f=1;$f<=$_GET["qwer"];$f++) {
    $linea=fgets($ero);
    $keke=str_replace(";","~",$linea);
    }
    fclose($ero);
    
    echo '<script>location.href="ver.php?modi=1&ficha='.trim($keke).'"</script>';
    }
    
    $ero=fopen($_SESSION["elusuario"]."/".$mibase.".csv","r") or die("Error en base de datos");
    $linea=fgets($ero);
    $keke=str_replace(";","~",$linea);
    fclose($ero);
    
    echo '<script>location.href="ver.php?modi=1&ficha='.trim($keke).'"</script>';

    ?>

