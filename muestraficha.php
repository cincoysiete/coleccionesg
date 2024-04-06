<html lang="es">
<link rel="icon" type="image/png" href="<?php echo $log; ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<title><?php echo $nom; ?></title>

<?php
session_start();
include("identifica.php");
include("cincoysiete.css"); 
include("markdown.php"); 

$kaka=explode("~",$_GET["ficha"]);
// $_SESSION["fichactual"]=$_GET["ficha"];
$_SESSION["contadora"]=$kaka[0];

// PERMITIMOS O NO QUE SE PUEDAN EDITAR LOS CAMPOS
if ($_SESSION["editar"]==-1){$bloquear="";} else {$bloquear="disabled";}
if ($_SESSION["editar"]==-1){$txtper="desbloquear.png";}else{$txtper="bloquear.png";}
?>

<!-- MOSTRAMOS EL REGISTRO EN FORMATO FICHA-->
<div class="contenedor">
<br>
<center>
<table width='86%' border='0' bgcolor="<?php echo $colo; ?>">
<tr><td align='left'>
 <a href="tabla.php"><img src="volver.png" width="30px"></a>     
<?php if ($_GET["modi"]!=-1) {echo '<span class="textopequeno">'.$_SESSION["contadora"]." / ".$_SESSION["cuantosregistros"].'</span>';} ?>
</td><td align='center'>
<!-- <a href="#" title="Descargar instantánea de la ficha" onClick="window.open('lafoto.php?modi=<?php echo $_GET["modi"]; ?>&ficha=<?php echo $_GET["ficha"]; ?>','popup', 'width=540px,height=1000px')"><img src="camara.png" width="30px"></a> -->
<a href="documea.php"><img src="camara.png" width="30px"></a>
</td><td align='center'>
<a href="permitir.php" title="Permitir o no hacer cambios en la base de datos"><img src="<?php echo $txtper; ?>" width="20px"></a>
</td><td align='center'>
<a href="retrocede.php?qwer=<?php echo $kaka[0]-1; ?>" title="Ver registro anterior"><img src="atras.png" width="30px"></a>
</td><td align='center'>
<a href="avanza.php?qwer=<?php echo $kaka[0]+1; ?>" title="Ver registro siguiente"><img src="alante.png" width="30px"></a>
</td></td></table>
<br>


<form method="POST" action="modifica.php"  enctype="multipart/form-data" style="max-width:80%;margin:auto">

<input type="hidden" name="MAX_FILE_SIZE" value="50000000"> 
<?php
$_SESSION["eldocu"]="";
for ($f=0;$f<=count($col);$f++){
if ($f==1){$siosi="required";} else {$siosi="";}
if ($f==1){$asterisco=" *";} else {$asterisco="";}
// LA PRIMERA COLUMNA, CON EL NUMERO DE REGISTRO, SE OCULTA
if ($f==0){echo '<input class="input-field" type="hidden" placeholder="" name="'.$f.'" value="'.$kaka[$f].'">'; $id=$kaka[$f];} 

if ($tip[$f]=="textarea") {
$palite=str_replace("¬",PHP_EOL,$kaka[$f]);
// $palite=$kaka[$f];
echo '<div class="textopequeno">'.' '.$col[$f].". ".$hlp[$f].$asterisco."<br>";
echo '<textarea placeholder="'.$col[$f].'" rows="10" '.$bloquear.' name="'.$f.'">'.$palite.'</textarea>';

$palite=str_replace("¬","<br>\r\n",$kaka[$f]);
$_SESSION["eldocu"].="<h2>".$col[$f]."</h2>";
$_SESSION["eldocu"].=MarkdownInterpreter::toHTML($palite).PHP_EOL.PHP_EOL;
// echo MarkdownInterpreter::toHTML($palite);

}

// MOSTRAMOS ESTOS CAMPOS SOLO SI ESTAMOS CREANDO EL REGISTRO
if ($_SESSION["editar"]==-1){
if ($tip[$f]=="image"){
echo '<hr>';
echo '<div class="textopequeno">'.' '.$col[$f].". ".$hlp[$f].$asterisco."<br>";echo "<table width='100%' border='0'><tr><td width='50%'>";
$pete=$f+count($col)+1;
echo '<input class="input-field" type="file" placeholder="'.$kaka[$f].'" name="'.$f.'" value="'.$kaka[$f].'"'.$siosi.'>'; 
echo '<input type="text" placeholder="'.$col[$f].'" name="'.$pete.'" value="'.$kaka[$f].'" '.$siosi.'> ';
echo "</td><td align='center'>";
echo '<button class="button2" onclick="return confirmar1();"><a href="quitaimagen.php?qwei='.$kaka[0].'~'.$kaka[$f].'  ">Eliminar imagen</a></button>';
echo "</td></td></table><hr>";

}

if ($tip[$f]=="doc"){
	echo '<br><br><br><hr>';
	echo '<div class="textopequeno">'.' '.$col[$f].". ".$hlp[$f].$asterisco."<br>";echo "<table width='100%' border='0'><tr><td width='50%'>";
	$pete=$f+count($col)+1;
	echo '<input class="input-field" type="file" placeholder="'.$kaka[$f].'" name="'.$f.'" value="'.$kaka[$f].'"'.$siosi.'>'; 
	echo '<input type="text" placeholder="'.$col[$f].'" name="'.$pete.'" value="'.$kaka[$f].'" '.$siosi.'> ';
	echo "</td><td align='center'>";
	echo '<button class="button2" onclick="return confirmar1();"><a href="quitaimagen.php?qwei='.$kaka[0].'~'.$kaka[$f].'  ">Eliminar documento</a></button>';
	echo "</td></td></table><hr>";
}

}

if ($tip[$f]=="image" and $kaka[$f]!="" ){
	// echo $kaka[$f];
echo '<center><a href="'.$_SESSION["elusuario"]."/"."".$kaka[$f].'">'.'<img src="'.$_SESSION["elusuario"]."/".$kaka[$f].'" width="30%" >'.'</a></center>';
// $_SESSION["eldocu"].=$_SESSION["elusuario"]."/"."".$kaka[$f]."<br><br>";
}

if ($tip[$f]=="number") {echo '<div class="textopequeno">'.' '.$col[$f].". ".$hlp[$f].$asterisco."<br>"; echo '<input class="input-field" step="0.1" type="'.$tip[$f].'"  placeholder="'.$col[$f].'" '.$bloquear.' name="'.$f.'" value="'.$kaka[$f].'"'.$siosi.'>';}

if ($tip[$f]=="text") {echo '<div class="textopequeno">'.' '.$col[$f].". ".$hlp[$f].$asterisco."<br>"; echo '<input class="input-field" type="'.$tip[$f].'"  placeholder="'.$col[$f].'" '.$bloquear.' name="'.$f.'" value="'.$kaka[$f].'"'.$siosi.'>';}

if ($tip[$f]=="url") {echo '<div class="textopequeno">'.' '.$col[$f].". ".$hlp[$f].$asterisco."<br>"; echo '<input class="input-field" type="text"  placeholder="'.$col[$f].'" '.$bloquear.' name="'.$f.'" value="'.$kaka[$f].'"'.$siosi.'>';}

if ($tip[$f]=="date") {echo '<div class="textopequeno">'.' '.$col[$f].". ".$hlp[$f].$asterisco."<br>"; echo '<input class="input-field" type="'.$tip[$f].'"  placeholder="'.$col[$f].'" '.$bloquear.' name="'.$f.'" value="'.$kaka[$f].'"'.$siosi.'>'; }

if ($tip[$f]=="time") {echo '<div class="textopequeno">'.' '.$col[$f].". ".$hlp[$f].$asterisco."<br>"; echo '<input class="input-field" type="'.$tip[$f].'"  placeholder="'.$col[$f].'" '.$bloquear.' name="'.$f.'" value="'.$kaka[$f].'"'.$siosi.'>';}

if ($tip[$f]=="password") {echo '<div class="textopequeno">'.' '.$col[$f].". ".$hlp[$f].$asterisco."<br>"; echo '<input class="input-field" type="'.$tip[$f].'"  placeholder="'.$col[$f].'" '.$bloquear.' name="'.$f.'" value="'.$kaka[$f].'"'.$siosi.'>';}

if ($tip[$f]=="select") {
echo '<div class="textopequeno">'.$col[$f].'. '.$hlp[$f].$asterisco."</div><br>"; 
echo '<select '.$bloquear.' class="input-field" name="'.$f.'" value="'.$kaka[$f].'"'.$siosi.'>';
$cuan1=explode(",",$cat[$f]);
$cuan=count($cuan1);
// for ($r=0;$r<$cuan;$r++){echo '<option value="'.$kaka[$f].'">'.$kaka[$f].'</option>';}
if ($_SESSION["editar"]==-1) {for ($r=0;$r<$cuan;$r++){echo '<option value="'.$cuan1[$r].'">'.$cuan1[$r].'</option>';}}
if ($_SESSION["editar"]==1) {for ($r=0;$r<$cuan;$r++){echo '<option value="'.$kaka[$f].'">'.$kaka[$f].'</option>';}}
echo '</select>';
}

if ($tip[$f]!="textarea" and $tip[$f]!="image" and $f!=0) {$_SESSION["eldocu"].="<h2>".$col[$f]."</h2>"; $_SESSION["eldocu"].=$kaka[$f]."<br><br>";}
if ($tip[$f]=="image" and $kaka[$f]!=""){$_SESSION["eldocu"].="<h2>".$col[$f]."</h2>"; $_SESSION["eldocu"].='<img src="'.$_SESSION["elusuario"]."/".$kaka[$f].'" width="50%"><br><br>';}
}

?>

<!-- MOSTRAMOS ESTOS CAMPOS SOLO SI ESTAMOS CREANDO EL REGISTRO -->
<?php if ($_SESSION["editar"]==-1){ ?>
<center>
<hr>
<input class="input-field" type="checkbox" name="eliminar"><font size="2px" color="red">Eliminar registro</font>
<hr>
<input class="submit" type="submit"  value="Guardar">
</form>
<!-- <a href="elimina.php?qwe=<?php echo $kaka[0]; ?>"><button onclick="return confirmar();" class="button1">Eliminar registro</button></a> -->
<br><br><br>
<?php } ?>

</div>
</center>

<script>
function confirmar()
{
	if(confirm('\nATENCIÓN. Esta operación no se puede deshacer\nVas a eliminar el registro actual. \n¿Deseas continuar? '))
		return true;
	else
		return false;
}

function confirmar1()
{
	if(confirm('\nATENCIÓN. Esta operación no se puede deshacer\nVas a eliminar la imagen actual. \n¿Deseas continuar? '))
		return true;
	else
		return false;
}
</script>


<!-- </span> -->

