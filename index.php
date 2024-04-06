<?php 
session_start();
include("variablesZ.php");
include('Mobile_Detect.php');
include("constantes.php");
$_SESSION["tamtxt"]=12;

$_SESSION["movilZ"]=0;
$detect = new Mobile_Detect();
if ($detect->isMobile()) {$_SESSION["movilZ"]=-1;}
if ($detect->isTablet()) {$_SESSION["movilZ"]=1;}

$_SESSION["editar"]=-1;
if ($imgtabla=="si"){$_SESSION["verimagenes"]=1;} else {$_SESSION["verimagenes"]=-1;}
$_SESSION["elusuario"] = base64_encode("micuenta");
header('Location: inicio.php');

?>
