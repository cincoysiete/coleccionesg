<?php 
session_start();
include("identifica.php");
 
include("variables.php"); 
include("constantes.php");
include("cincoysiete.css"); 
?>

<html lang="es">
<link rel="manifest" href="manifest.json">
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link rel="icon" type="image/png" href="<?php echo $log; ?>" />
<meta charset="UTF-8">

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

<?php

$_SESSION["puedomodificar"]=1;
$_SESSION["editar"]=1;
 $haysuma=0;
 $haymedia=0;

// SI NO EXISTE EL ARCHIVO DE BASE DE DATOS, LO CREA
// if (file_exists($_SESSION["elusuario"]."/".$mibase.".csv")){} else {
// $arx=fopen($_SESSION["elusuario"]."/".$mibase.".csv","w") or die("Problemas en la creacion ");
// fputs($arx,$lineo);
// fclose($arx);
// }

if ($_SESSION["puedomodificar"]==1){$txtper="desbloquear.png";}else{$txtper="bloquear.png";}

$labase=explode("/",$_SESSION["elusuario"]."/".$mibase);
?>
<div class="header">
<br>
<table width='100%' border='0' bgcolor="<?php echo $colo; ?>">
<tr><td align='left' width='10%'>
<a href="inicio.php"><img src="volver.png" width="30px"></a>
</td><td align='left' width="20px">
<input class="button3" name="t1" value="" />
</td><td>
<input onclick="busca(document.all.t1.value)" type="image" src="buscar.png" width="25px" value="Buscar" />

<?php 
// SI HAY IMAGENES APARECE BOTON PARA MOSTRARLAS O NO EN LA TABLA
for ($f=1;$f<=count($tip);$f++){if ($tip[$f]=="image"){$hayimagenes=1;}}
echo '     <a href="ver.php?modi=-1&ficha='.$keke.'" title="Añadir registro"><img src="mas.png" width="25px"></a>';
if ($hayimagenes==1){
if ($_SESSION["verimagenes"]==-1) {echo '     <a href="verimagenes.php" title="Toca para mostrar imágenes"><img src="siimg.png" width="25px"></a>';}
if ($_SESSION["verimagenes"]==1) {echo '     <a href="verimagenes.php" title="Toca para ocultar imágenes"><img src="noimg.png" width="25px"></a>';}
}
echo '     <a href="descargatabla.php" title="Toca para descargar base"><img src="descargar.png" width="28px"></a>';

echo '     <a href="txtmas.php" title="Toca para cambiar tamaño del texto"><img src="fuente.png" width="25px"></a>';
echo '<span class="textopequeno">'.$_SESSION["tamtxt"].'</span>';
if ($_SESSION["filtro"]!="" and $_SESSION["movilZ"]!=-1){
echo '          <span class="textopequeno"><a href="nofiltra.php"><img src="filtrar.png" width="25px"></a> '.$_SESSION["filtro"]." en ".$col[$_SESSION["columna"]].'</span>';
} 

if ($_SESSION["filtro"]=="" and $_SESSION["movilZ"]==-1){
   echo '          <span class="textopequeno"><a href="nofiltra.php"><img src="filtrar.png" width="25px"></a> '.'</span>';
}

if ($_SESSION["col01"]!="" or $_SESSION["col02"]!=""){
echo '     <a href="grafica.php?qwer1='.$_SESSION["col01"].'&qwer2='.$_SESSION["col02"].'" title="Toca para ver gráfica"><img src="crecimiento.png" width="25px"></a>';
echo '  <span class="textopequeno">'.$col[$_SESSION["col01"]]." + ".$col[$_SESSION["col02"]].'</div>';
}

?>
</td><td align='center' width='15%'>
<?php 
$kopa=explode("/",$mibase);
echo $kopa[1]; 
// SI EXISTE EL ARCHIVO .html MUESTRA BOTÓN DE AYUDA PARA VERLA
// if (file_exists($_SESSION["elusuario"].'/'."bases/".$kopa[1].".html")){
// echo '<a href="'.$_SESSION["elusuario"].'/'.'bases/'.$kopa[1].'.html'.'">  <img src="tips.png" width="20px"></a>';
// }
?>
</td></td></table>
</div>
<br>
<br>
<br>

<?php

// MUESTRA LA TABLA CON LOS REGISTROS
$_SESSION["ficha"]="";
echo '<p><TABLE id="tabla" width=98% align="center" border="0" cellpadding="0" cellspacing="0" class="tabla"><TR>';

$sumao[]=0;
$sumado[]=0;
$conta=0;
$contando=1;
$promedio=[];

// GENERA LOS ENCABEZADOS DE LAS COLUMNAS
for ($k=0;$k<=count($col);$k++){
if ($k>0){
echo '<TH>'.'<center><a href="ordena.php?qwer='.$k.'" title="'.$hlp[$k].'">'.$col[$k].'</a><br>';

echo '<a href="quecolumna.php?qwer='.$k.'&nomcol='.$col[$k].'" title="Toca dos columnas para crear gráfica"><img src="crecimiento.png" width="20px"></a>';

echo '</center>'.'</TD>';
} else {echo '<TH>'.'<center><a href="ordena.php?qwer='.$k.'" title="Toca para ordenar la tabla por este campo">'.$col[$k].'</a>';}
}

$_SESSION["cuantosregistros"]=-1;
$ero=fopen($_SESSION["elusuario"]."/".$mibase.".csv","r") or die("Error en base de datos");
while (!feof($ero)) 
{
$linea=fgets($ero);
$lineo=$linea;
$trozo=explode(";",$linea);
$koko="";
for ($j=2;$j<=count($col);$j++){
$koko=$koko.$trozo[$j]."~";
}
$linea=$koko;

// GENERA EL ENLACE PARA VER LA FICHA DEL ARTICULO
$keke="";
$sumatotal=0;
for ($h=0;$h<=count($col);$h++){
$keke=$keke.$trozo[$h]."~";
}
for ($t=0;$t<=count($col);$t++) {$lineamala=$lineamala.";";}
$_SESSION["paficha"]=$keke;

// GENERA LOS DATOS DEL ARTICULO PARA VERLOS EN MODO FICHA
$kiki="";
for ($f=0;$f<=count($col);$f++){


// SUMA O RESTA LOS VALORES DE LA COLUMNA, SI ES EL CASO. Si la columna de la izquierda del importe contiene el valor 'Gasto', restará ese valor.
$filtrando=explode(";",$lineo);

if (trim(strip_tags($filtrando[$_SESSION["columna"]]))==trim($_SESSION["filtro"])){

   if ($sum[$f]=="si" and $trozo[$f]!=0){
         $sumao[$f]=$sumao[$f]+$trozo[$f]; 
         $haysuma=1;
   }
   
   if ($trozo[$f]!=0){
         $sumado[$f]=$sumado[$f]+$trozo[$f]; 
      }

   // CUENTA LAS COLUMNAS, CON ALGUN VALOR, IDENTIFICADAS PARA CALCULAR SU MEDIA
   if ($med[$f]=="si" and $trozo[$f]!=0  and $trozo[$f]!=""){
      if ($med[$f]=="si"){$promedio[$f]=$promedio[$f]+1;}
      }


   if ($med[$f]=="si"){ $haymedia=1;}
}
   
if ($trozo[1]!="") {$trozo[0]='<img src="ojo.png" width-max="15px" height="15px">';}

// ENLACE EN IMAGENES
$kikio=explode("/",$trozo[$f]);
if ($tip[$f]=="image" and $trozo[$f]!=""){
if ($_SESSION["verimagenes"]==1){
   if (strpos($trozo[$f],".")) {
$trozo[$f]='<a href="'.$_SESSION["elusuario"]."/".$trozo[$f].'" title="Toca para ver imagen: '.$kikio[1].'">'.'<img src="'.$_SESSION["elusuario"]."/".$trozo[$f].'" width-max="'.$anchoimg.'" height="'.$altoimg.'">'.'</a>';
}

} else {
$imagiya="peque.png";
$petata=$_SESSION["elusuario"]."/".$trozo[$f];
if (strlen($trozo[$f])>4) {$trozo[$f]='<a href=mira.php?tip='.$tip[$f].'&colu='.$col[$f].'&esto='.urlencode($petata).' title="Toca para ver imagen: '.$kikio[1].'"><img src="'.$imagiya.'" width="20px"></a>';}
}
}


if ($tip[$f]=="doc" and $trozo[$f]!=""){
   $cacho=explode("/",$trozo[$f]);
   $imagiya="google-docs.png";
   if (strlen($trozo[$f])>4) {$trozo[$f]='<a href="'.$trozo[$f].'">'.'<img src="'.$imagiya.'" width="20px "title="Toca para ver documento: '.$cacho[1].' " ></a>';}
}
   
// DA FORMATO A LOS VALORES NUMERICOS
if ($tip[$f]=="number" and $trozo[$f]!=0 and $deci!=""){$numfor=number_format($trozo[$f],$deci,",",".");} else {$numfor=$trozo[$f];}

if (strlen($trozo[$f])>30) {$lepa="...";} else {$lepa="";}


$troza[$f]='<a href="filtra.php?fitra='.$trozo[$f].'&coluna='.$f.'">'.$trozo[$f].'</a>';
// FILTRAMOS POR FECHA
if (strtotime($trozo[$f])){
   $atrozao=substr($trozo[$f],0,5); //AÑO
   $troza[$f]='<a href="filtra.php?fitra='.$atrozao.'&coluna='.$f.'">'.$trozo[$f].'</a>';
}

$numfar='<a href="filtra.php?fitra='.$numfor.'">'.$numfor.'</a>';

$cachete=$trozo[$f];
if ($tip[$f]=="url"){$trozo[$f]='<a href="'.$trozo[$f].'" target="_new">'.$trozo[$f].'</a>';}

if ($tip[$f]=="textarea"){
   $eltrozo=preg_replace('/[^a-zA-Z0-9_-]/', ' ', $trozo[$f]);
   $trozo[$f]='<a href="mira.php?tip='.$tip[$f].'&colu='.$col[$f].'&esto='.urlencode($trozo[$f]).'" title="Toca para ver el texto" >'.utf8_decode(substr($eltrozo,0,30)).$lepa.'</a>';
   // $trozo[$f]='<a href="mira.php?tip='.$tip[$f].'&colu='.$col[$f].'&esto='.urlencode($trozo[$f]).'" title="Toca para ver el texto" >'.utf8_decode(substr($trozo[$f],0,30)).$lepa.'</a>';
}

if ($tip[$f]=="text"){$trozo[$f]="<div title='Toca para filtrar' class='izq'>".$troza[$f]."</div>";}



// if ($tip[$f]=="date"){

// MARCA EN ROJO LAS FECHAS QUE COINCIDEN CON EL MES ACTUAL
// $fechaInicio = new DateTime($trozo[$f]);
// $fechaFin = new DateTime(); // Esto toma la fecha y hora actual
// $diferencia = $fechaInicio->diff($fechaFin);
// $numeroDias = $diferencia->d;
// $numeroAnos = $diferencia->y;
// $numeroMeses = $diferencia->m;
// if ($numeroDias<=15 and $numeroAnos<1 and $numeroMeses<1){
//    $trozo[$f]="<div title='Toca para filtrar' class='izq'>".$troza[$f]."</div>";
// } else {
//    $trozo[$f]="<div title='Toca para filtrar' class='izq'>".$troza[$f]."</div>";
// }

// }

if ($tip[$f]=="time"){$trozo[$f]="<div title='Toca para filtrar' class='izq'>".$troza[$f]."</div>";}
if ($tip[$f]=="number"){$trozo[$f]="<div title='Toca para filtrar' class='dcha'>".$numfar."</div>";}
// if ($tip[$f]=="textarea"){$trozo[$f]="<div class='izq'>".substr($trozo[$f],0,150).$lepa."</div>";}
if ($tip[$f]=="image"){$trozo[$f]="<div class='cen'>".$trozo[$f]."</div>";}
if ($tip[$f]=="select"){$trozo[$f]="<div title='Toca para filtrar' class='izq'>".$troza[$f]."</div>";}

if ($tip[$f]=="url"){$trozo[$f]="<div title='Toca para ir al enlace: ".$cachete."' class='izq'>".$trozo[$f]."</div>";}

if (is_numeric($trozo[$f])){$trozo[$f]=number_format($trozo[$f],$deci,",",".");}

if ($f==0) {$trozo[$f]='<a href="ver.php?modi=1&ficha='.urlencode($_SESSION["paficha"]).'" title="Toca para modificar registro">'.$trozo[$f].'</a>';}

$kiki=$kiki.$trozo[$f].";";
}


// MUESTRA LOS REGISTROS
if (strlen($linea)>4){
$linea=substr($kiki, 0, -1);
$filtrando=explode(";",$linea);
if (trim(strip_tags($filtrando[$_SESSION["columna"]]))==trim($_SESSION["filtro"]) or strstr(strip_tags($filtrando[$_SESSION["columna"]]),$_SESSION["filtro"])){
echo '<TR class="modo2">';
echo '<TH class="modo2">';
echo str_replace(";","<TH class='modo2'>",$linea)."";
$contando++;
}
}
$conta++;
$_SESSION["cuantosregistros"]++;
}
fclose($ero);

if ($_SESSION["filtro"]!=""){
   $contando++;
}

// TOTALIZA LAS COLUMNAS INDICADAS
if ($conta>=1 and $haysuma==1){
$kiki="SALDO";

for ($l=0;$l<=count($sum);$l++)
{
if ($sum[$l]=="si"){
   $linea="<div class='dcha'>".number_format($sumao[$l],$deci,",",".")."</div>";
} else {
      $linea="";
}
$kiki=$kiki.$linea.";";
}
$kiki = substr($kiki, 0, -1);

echo '</TR><TR class="modo22">';
echo '<TH class="modo22">';
echo str_replace(";","</TD><TH class='modo22'>",$kiki);
echo '</TD>';
echo '</TR><TR>';
}

// HACE LA MEDIA DE LAS COLUMNAS INDICADAS
if ($conta>1 and $haymedia==1){
$kiki="MEDIA";
for ($l=0;$l<=count($med);$l++)
{
if ($med[$l]=="si" and is_numeric($sumado[$l])){$mediao=$sumado[$l]/$promedio[$l]; $linea="<div class='dcha'>".number_format($mediao,$deci,",",".")."</div>";} else {$linea="";}
$kiki=$kiki.$linea.";";
}
// $kiki=intval($kiki);
$kiki = substr($kiki, 0, -1);
echo '</TR><TR class="modo22">';
echo '<TH class="modo22">';
echo str_replace(";","</TD><TH class='modo22'>",$kiki);
echo '</TD>';
echo '</TR><TR>';
}

$contando=$contando-2;
// echo '</TR><TR class="modo2">';
// echo '<TH class="modo2">';
// echo str_replace(";","</TD><TH class='modo2'>",$contando." registros");
// echo '</TD>';
// echo '</TR><TR>';

// FINALIZA LA TABLA
echo '</TR></TABLE>';
// echo '<br>';

if ($contando>0) {echo '<center><font size="1px">'.$contando." registros</font></center>";}

if ($contando==0) {echo '<a href="importar.php?impo='.$labase[1].'.csv" title="Importar base de datos">    <img src="subir.png" width="30px"></a>';}
echo '<br>';

?>

<!-- BUSQUEDA EN LA TABLA DE DATOS -->
<script language="JavaScript">
var TRange=null

function busca (str) {
 if (parseInt(navigator.appVersion)<4) return;
 var strFound;
 if (window.find) {

  strFound=self.find(str);
  if (!strFound) {
   strFound=self.find(str,0,1)
   while (self.find(str,0,1)) continue
  }
 }
 else if (navigator.appName.indexOf("Microsoft")!=-1) {

    if (TRange!=null) {
   TRange.collapse(false)
   strFound=TRange.findText(str)
   if (strFound) TRange.select()
  }
  if (TRange==null || strFound==0) {
   TRange=self.document.body.createTextRange()
   strFound=TRange.findText(str)
   if (strFound) TRange.select()
  }
 }
 else if (navigator.appName=="Opera") {
  alert ("Opera no soporta busqueda")
  return;
 }
 return;
}
</script>

