<?php session_start();
include("identifica.php");
 
include("constantes.php"); 
include("encriptado.php"); 
include("cincoysiete.css"); 
?>

<html lang="es">
<link rel="manifest" href="manifest.json">
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link rel="icon" type="image/png" href="favicon.png" />


<title>Modifica Base de datos</title>

<?php
$esabase=$_GET["mtk"];
include($_GET["mtk"]);
$kaka1=explode("/",$esabase);
$kaka2=explode(".",$kaka1[2]);
$_SESSION["nombrebase"]=$kaka2[0];

// $numcampos=0;
// for ($f=1;$f<=20;$f++){if ($col[$f]!=""){$numcampos++;}}
?>

<div class="contenedor">
    <br>
<center>
<table width='86%' border='0' bgcolor="#878be4">
<tr><td align='left' width="10%">
<a href="inicio.php"><img src="volver.png" width="30px"></a>
<!-- <tr><td align='center' width="10%"> -->
<!-- <a href="inicio.php"><button class="button5"><</button></a> -->
</td><td align='center'>
Modificar base de datos
</td></td></table>
<br>

<form method="POST" action="modificabaseguarda.php" enctype="multipart/form-data" style="max-width:80%;margin:auto">
<input class="input-field" required type="text" placeholder="Nombre de la base de datos" name="nombre" value="<?php echo $_SESSION["nombrebase"]; ?>" title="">
<input class="input-field" required type="text" placeholder="Comentario sobre la base de datos" name="comen" value="<?php echo $come; ?>" title="">
<input class="input-field" type="number" placeholder="Decimales en campos numéricos" name="decimales" value="<?php echo $deci; ?>">

<br><br><hr><br>

<?php

for ($f=1;$f<=count($col)+1;$f++){
$polo="";
$pola="";
$tope=0;
if ($col[$f+1]==""){$tope=1;}

if ($col[$f]!="" and $f!=1){$polo="    <a href='sube.php?esabase=".$esabase."&onde=".$f."'><img src='sube.png' width='20px'></a>";} else {$polo="          ";}

if ($tope==0) {$pola="<a href='baja.php?esabase=".$esabase."&onde=".$f."'><img src='baja.png' width='20px'></a>    ";}

if ($col[$f]!="") {echo "<br><br><b><font color='#878be4'>".$pola."CAMPO ".$f."".$polo."</b></font>";
} else {echo "<br><br>CAMPO ".$f;}

?>

<?php if ($f%2==0) {echo '<div class="colofondo2">';} else {echo '<div class="colofondo1">';} ?>
<br><div class="textomediano" > Nombre del campo</div>
<input class="input-field"  type="text" placeholder="" name="nom<?php echo $f; ?>" value="<?php echo $col[$f]; ?>" title="Este es el nombre que aparecerá en tu base de datos">

<table width='100%' border='0'>
<tr><td align='left' width="33%">

<div class="textomediano" >Tipo de campo</div>
<select name="tipo<?php echo $f; ?>" title="Selecciona el tipo de información que va a contener el campo">
<option value="<?php echo $tip[$f]; ?>"><?php echo $tip[$f]; ?></option>
<option value="text">texto</option>
<option value="date">fecha</option>
<option value="time">hora</option>
<option value="number">número</option>
<option value="textarea">área de texto</option>
<option value="select">Desplegable</option>
<option value="image">imagen</option>
<option value="url">url</option>
<option value="doc">documento</option>
</select>

<td align='left' width="33%">
<div class="textomediano" >¿Hay que sumarlo?</div>
<select name="suma<?php echo $f; ?>" title="Selecciona si quieres que se sumen los valores de este campo">
<option value="<?php echo $sum[$f]; ?>"><?php echo $sum[$f]; ?></option>
<option value="si">Si</option>
</select>

<td align='left' width="33%">
<div class="textomediano" >¿Hay que hacer la media?</div>
<select name="media<?php echo $f; ?>" title="Selecciona  si quieres que se calcule la media de los valores de esta campo">
<option value="<?php echo $med[$f]; ?>"><?php echo $med[$f]; ?></option>
<option value="si">Si</option>
</select>
</table>

<?php
$pita=explode(",",$cat[$f]);
$cuanta=count($pita);
?>
<td align='left' width="33%">
<?php

if ($tip[$f]=="select"){
echo '<div class="textomediano" > Valores solo para campo desplegable. Uno por línea</div>';
echo '<textarea name="cate'.$f.'" rows="10" title="Si has seleccionado tipo de campo Desplegable, escribe en líneas separadas los posibles valores del campo">';
echo PHP_EOL;
for ($pt=0;$pt<=$cuanta;$pt++){
    echo $pita[$pt].PHP_EOL;
}
echo '</textarea>';
}
?>

<td align='left' width="33%">
<div class="textomediano" > Notas sobre el campo</div>
<input class="input-field"  type="text" placeholder="" name="help<?php echo $f; ?>" value="<?php echo $hlp[$f]; ?>" title="Esta nota aparecerá cuando estés añadiendo datos">
</div>


<hr>
<!-- <br>
<br> -->
<?php
}
?>
<br>
<!-- <textarea name="config" rows="30"><?php echo $trozo; ?></textarea> -->
<input class="submit" type="submit"  value="Modificar">
<br>
<?php
// TRAS CAMBIAR EL ORDEN DE LOS CAMPOS, SE ACTUALIZA LA PAGINA Y EL FORMULARIO
if ($_SESSION["vuelvo"]=="si"){
    $_SESSION["vuelvo"]="no"; 
    ?><script>location.reload();</script><?php; 
}
?>
<br>
