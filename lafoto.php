<?php
session_start();
include("identifica.php");
 
include("variables.php");
include("constantes.php");
include("cincoysiete.css"); 

if ($_GET["modi"]=="-1") {$_SESSION["puedomodificar"]=$_GET["modi"]; $_SESSION["editar"]=-1;}

$keke=$_GET["ficha"];
$_SESSION["fichactual"]=$_GET["ficha"];
$_SESSION["editar"]=1;
include("muestraficha.php");
?>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-rc.1/dist/html2canvas.min.js"></script> 

<script>
//Definimos el botón para escuchar su click
const $boton = document.querySelector("#btnCapturarin"), // El botón que desencadena
// $objetivo = document.querySelector("contenedor"); // A qué le tomamos la fotocanvas
$objetivo = document.body; // A qué le tomamos la fotocanvas
// Nota: no necesitamos contenedor, pues vamos a descargarla

// Agregar el listener al botón
html2canvas($objetivo) // Llamar a html2canvas y pasarle el elemento
.then(canvas => {
  // Cuando se resuelva la promesa traerá el canvas
  // Crear un elemento <a>
  let enlace = document.createElement('a');
  enlace.download = "<?php echo $id; ?>_Bdatos.png";
  // Convertir la imagen a Base64
  enlace.href = canvas.toDataURL();
  // Hacer click en él
  enlace.click();
window.close();
//   window.history.back();
});
</script>

<script src="script.js"></script>

