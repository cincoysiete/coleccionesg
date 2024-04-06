<?php session_start();
include("identifica.php");
 
include("encriptado.php"); 
include("constantes.php"); 
include("cincoysiete.css"); 
// $_SESSION["elusuario"] = base64_encode($_SESSION["gusuario"]);
// $_SESSION["elusuario"] = base64_encode($_SESSION["gusuario"]);

?>

<html lang="es">
<link rel="manifest" href="manifest.json">
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link rel="icon" type="image/png" href="favicon.png" />
<?php //header('Content-Type: text/html; charset=UTF-8'); ?>


<title><?php echo $nom; ?></title>

<style>
a:link {
	text-decoration: none;
color: #34484E;
}
a:visited {
	text-decoration: none;
color: #34484E;
}
a:hover {
	text-decoration: none;
color: #34484E;
}
a:active {
	text-decoration: none;
color: #34484E;
}
</style>
<div class="gif-bajodcha">
  <img src="img/plantilla.png" alt="Imagen">
</div>


<?php


// MUESTRA LOS ARCHIVOS DE BASE DE DATOS
function listarArchivos($path,$cuantosarchivos,$archives){
    $dir = opendir($path);
    $cuenteo=0;
    sort($archives);
    while ($cuenteo < $cuantosarchivos){
      echo '<font size="3">';
      $kikio0=explode("/",$archives[$cuenteo]);
      $kikio1=explode(".",$kikio0[0]);

include("plantillas/".$kikio1[0].".php");


$_SESSION["lotengo"]='plantillas/'.$archives[$cuenteo].'" >'.$kikio1[0].$micome;

if ($come!="") {$micome='. '.'<i><font color="darkgray" size="2px">'.$come.'</font></i>';}
      echo '<a href="copiaplantilla.php?mtk='.''.$archives[$cuenteo].'" title="Toca para quedarte con esta plantilla" >'.$kikio1[0].$micome.'</a>';
      $kopa=explode("/",$mibase);
      // echo $kopa[1]; 
      if (file_exists("plantillas/".$kopa[1].".html")){
      echo '<a href="'.'plantillas/'.$kopa[1].'.html'.'">  <img src="tips.png" width="20px"></a>';
      }
            echo '<br><br>';
       $cuenteo++;
 
}

}


// MUESTRA LAS BASES
$cuantosarchivos=0;
$archives[]="";
$dir = opendir("plantillas");
  while ($elemento = readdir($dir)){
      if( $elemento != "." && $elemento != ".." && strpos($elemento,".php")){
          if( is_dir("plantillas".$elemento) ){
          } else {
            $archives[$cuantosarchivos]=$elemento;
            $cuantosarchivos++;
          }
      }
  }

?>

<div class="contenedor33">
<br>
<table width='100%' border='0' bgcolor="#fde2db">
<tr><td align='left' width="10%">
<a href="inicio.php"><img src="volver.png" width="30px"></a>
</td><td align='center'>
<?php echo "PLANTILLAS BASE DE DATOS"; ?>
</td><td align='right' width="10%">
</td></td></table>

<br>
<?php
listarArchivos("plantillas",$cuantosarchivos,$archives ); 

?>

<script>
function confirmar()
{
	if(confirm('\nATENCIÓN. Vas a enviarla base a la PAPELERA. \n¿Deseas continuar? '))
		return true;
	else
		return false;
}

function confirmar1()
{
	if(confirm('\nATENCIÓN. Vas a ELIMINAR la base seleccionada. \n¿Deseas continuar? '))
		return true;
	else
		return false;
}
</script>
