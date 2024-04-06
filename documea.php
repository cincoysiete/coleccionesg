<html lang="es">
<link rel="icon" type="image/png" href="<?php echo $log; ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<title><?php echo $nom; ?></title>

<?php
session_start();
include("identifica.php");
include("cincoysiete.css"); 
include("markdown.php"); 

echo '<div class="contenedor44">';
echo '<table width="100%" border="0" bgcolor="'.$colo.'">';
echo '<tr><td align="left">';
echo '<a href="#" onclick="history.back(); return false;"><img src="volver.png" width="30px"></a>';
echo '</td></tr></table>';
echo $_SESSION["eldocu"];
echo "<br>";
echo '<table width="100%" border="0" bgcolor="'.$colo.'">';
echo '<tr><td align="left">';
echo '<a href="#" onclick="history.back(); return false;">  </a>';
echo '</td></tr></table>';
echo "<br>";
?>



