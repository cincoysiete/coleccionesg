<?php session_start();
include("identifica.php");
 
include("constantes.php"); 
 
include("cincoysiete.css"); 
?>

<html lang="es">
<link rel="manifest" href="manifest.json">
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link rel="icon" type="image/png" href="favicon.png" />


<title>Crea Base de datos</title>

<?php
// $trozo="";
// $ero=fopen("config.php","r") or die("Error en base de datos");
// while (!feof($ero)) 
// {
// $linea=fgets($ero);
// $trozo=$trozo.$linea;
// }
// fclose($ero);
?>
<!-- <div class="gif-bajodcha">
  <img src="img/crear.png" alt="Imagen">
</div> -->

<div class="contenedor">
<br>
<center>
<table width='86%' border='0' bgcolor="#feb871">
<tr><td align='left' width="10%">
<a href="inicio.php"><img src="volver.png" width="30px"></a>
<!-- <tr><td align='center' width="10%">
<a href="inicio.php"><button class="button5"><</button></a> -->
</td><td align='center'>
Crear base de datos
</td></td></table>
<br>

<form method="POST" action="creabase.php" enctype="multipart/form-data" style="max-width:80%;margin:auto">
<div class="textomediano" >Nombre de la base de datos</div>
<input class="formufondo" required type="text" placeholder="" name="nombre" value="" title="Este es el nombre que identificará tu base de datos">
<div class="textomediano" >Comentario de la base de datos</div>
<input class="input-field" required type="text" placeholder="" name="comen" value="" title="Este comentario aparecerá como aclaración en el listado de bases de datos">
<div class="textomediano" >Decimales en campos numéricos</div>
<input class="input-field" type="number" placeholder="" name="decimales" value="" title="Decide cuantos decimales aparecerán en los valores numéricos">

<br>
<br>
<hr>
<br>
<br>
<?php

for ($f=1;$f<=$numcampos;$f++){
echo "CAMPO ".$f;
?>

<div class="textomediano" >Nombre del campo</div>
<input class="input-field"  type="text" placeholder="" name="nom<?php echo $f; ?>" value="" title="Anota el nombre de este campo">

<div class="textomediano" >Tipo de campo</div>
<select name="tipo<?php echo $f; ?>" title="Selecciona el tipo de información que va a contener el campo">
<option value=""></option>
<option value="text">texto</option>
<option value="date">fecha</option>
<option value="time">hora</option>
<option value="number">número</option>
<option value="textarea">área</option>
<option value="select">desplegable</option>
<option value="image">imagen</option>
<option value="url">url</option>
<option value="doc">documento</option>
</select>

<div class="textomediano" >¿Hay que sumarlo?</div>
<select name="suma<?php echo $f; ?>" title="Selecciona si quieres que se sumen los valores de este campo">
<option value=""></option>
<option value="si">Si</option>
</select>

<div class="textomediano" >¿Hay que hacer la media?</div>
<select name="media<?php echo $f; ?>" title="Selecciona  si quieres que se calcule la media de los valores de esta campo">
<option value=""></option>
<option value="si">Si</option>
</select>

<td align='left' width="33%">
<div class="textomediano" >Valores solo para campo desplegable. Uno por línea</div>
<textarea title="Si has seleccionado tipo de campo Desplegable, escribe en líneas separadas los posibles valores del campo" name="cate<?php echo $f; ?>" rows="10">
</textarea>

<td align='left' width="33%">
<div class="textomediano" >Notas sobre el campo</div>
<input class="input-field"  type="text" placeholder="" name="help<?php echo $f; ?>" value="" title="Esta nota aclaratoria aparecerá cuando estés añadiendo datos">

<hr>
<!-- <br>
<br> -->
<?php
}
?>

<br>
<!-- <textarea name="config" rows="30"><?php echo $trozo; ?></textarea> -->
<input class="submit" type="submit"  value="Crear">
<br>
<?php
