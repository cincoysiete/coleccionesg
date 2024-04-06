<?php session_start();
include("identifica.php");
 
include("variables.php"); 
include("constantes.php");
include("encriptado.php"); 
include("cincoysiete.css"); 
// include($_SESSION["elusuario"]."/".$mibase); 

?>

<html lang="es">
<link rel="manifest" href="manifest.json">
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link rel="icon" type="image/png" href="<?php echo $log; ?>" />
<?php header('Content-Type: text/html; charset=UTF-8'); ?>


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

$labase=explode("/",$_SESSION["elusuario"]."/".$mibase);
?>
<div class="header">
<br>
<table width='100%' border='0' bgcolor="<?php echo $colo; ?>">
<tr><td align='left' width='10%'>
<a href="tabla.php"><img src="volver.png" width="30px"></a>
</td><td align='center' width='15%'>
</td><td>
<!-- <a href="#" title="Descargar instantánea de la ficha" onClick="window.open('copiagrafica.php?modi=<?php echo $_GET["modi"]; ?>&ficha=<?php echo $_GET["ficha"]; ?>','popup', 'width=1280px,height=720px')"><img src="camara.png" width="30px"></a> -->
<?php 
echo '<span class="textopequeno">'.$col[$_SESSION["col01"]]." + ".$col[$_SESSION["col02"]].'</div>';
echo '     <a href="grafica.php?qwer1='.$_SESSION["col01"].'&qwer2='.$_SESSION["col02"].'" title="Toca para ver gráfica de barras"><img src="barra-grafica.png" width="25px"></a>';

echo '     <a href="graficaline.php?qwer1='.$_SESSION["col01"].'&qwer2='.$_SESSION["col02"].'" title="Toca para ver gráfica de líneas"><img src="grafico-de-lineas.png" width="25px"></a>';

echo '     <a href="graficapie.php?qwer1='.$_SESSION["col01"].'&qwer2='.$_SESSION["col02"].'" title="Toca para ver gráfica de pastel"><img src="grafico-de-torta.png" width="25px"></a>';

echo '          <a href="#" id="capturar"><img src="camara.png" width="25px"></a>';

if ($_SESSION["filtro"]!=""){
    echo '          <span class="textopequeno"><img src="filtraitor.png" width="25px"> '.$col[$_SESSION["columna"]].": ".$_SESSION["filtro"].'</span>';
    }
    
?>

</td><td align='center' width='15%'>
<?php echo $labase[2]; ?>
</td></td></table>
</div>
<br><br><br>
<div class="canvas-container" id="graficaContainer" style="width: 100%; height: 80vh;">
        <canvas id="myChart"></canvas>
    </div>


<?php
// require_once ( "../_phpChart/conf.php" ) ;

// Leer el archivo CSV
$archivo = $_SESSION["elusuario"]."/".$mibase.".csv";
$filas = file($archivo);

// Inicializar un array para contar los platos
$platos = [];
$coste = [];

// Recorrer las filas y contar los platos
foreach ($filas as $fila) {
    $datos = explode(';', $fila);
if (trim($datos[$_SESSION["columna"]])==$_SESSION["filtro"]){
    $plato = trim($datos[$_GET["qwer1"]]);
    if (isset($platos[$plato])) {
        $platos[$plato]++;
        if ($_GET["qwer1"]!=$_GET["qwer2"]){$coste[$plato]=$coste[$plato]+abs($datos[$_GET["qwer2"]]);}
    } else {
        $platos[$plato] = 1;
        if ($_GET["qwer1"]!=$_GET["qwer2"]){$coste[$plato]=$coste[$plato]+abs($datos[$_GET["qwer2"]]);}
    }
}
}
// sort($coste,SORT_NUMERIC);

// Convertir los resultados en formato adecuado para Chart.js
$labels = array_keys($platos);
$data = array_values($coste);
if ($_GET["qwer1"]==$_GET["qwer2"]){$data = array_values($platos);}

// Convertir los resultados a formato JSON
$labels_json = json_encode($labels);
$data_json = json_encode($data);

$quecolumna=$_GET["nomcol"];
$quegrafica="bar"; //bar, line, pie
?>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <div class="canvas-container">
        <canvas id="myChart"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('myChart').getContext('2d');

        // const ctx = document.getElementById('myChart');
        const labels = <?php echo $labels_json; ?>;
        const data = <?php echo $data_json; ?>;
        const quecolumna = '<?php echo $quecolumna; ?>';
        const grafica = '<?php echo $quegrafica; ?>';

    const coloresBarras = [
  '#71809e',
  '#d98880',
  '#76d7c4',
  '#f9e79f',
  '#76c7c0',
  '#b2a2c7',
  '#aeb6bf',
  '#e59866',
  '#82e0aa',
  '#d98880',
  '#7fb3d5',
  '#f5cba7',
  '#82e0aa',
  '#d2b4de',
  '#99a3a4',
  '#f7dc6f',
  '#bdc3c7',
  '#d98880',
  '#85c1e9'
];

        new Chart(ctx, {
            type: grafica,
            data: {
                labels: labels,
                datasets: [{
                    label: quecolumna,
                    data: data,
                    backgroundColor: coloresBarras,
                    borderWidth: 1
                }]

            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


// Ajustar el tamaño del gráfico al tamaño del contenedor en caso de cambio en el tamaño de la ventana
    // window.addEventListener('resize', () => {
    //     const contenedor = document.getElementById('myChart').parentElement;
    //     myChart.canvas.parentNode.style.width = contenedor.offsetWidth + 'px';
    //     myChart.canvas.parentNode.style.height = contenedor.offsetHeight + 'px';
    //     myChart.canvas.width = contenedor.offsetWidth;
    //     myChart.canvas.height = contenedor.offsetHeight;
    //     myChart.update();
    // });
    </script>


<script>
    // Función para realizar la captura de pantalla de la gráfica con mayor resolución y guardarla
    function capturarPantallaGrafica() {
        var contenedorGrafica = document.getElementById('graficaContainer');

        // Configurar las opciones de html2canvas, incluyendo la opción de escala
        var opcionesCaptura = {
            scale: 2, // Puedes ajustar este valor para aumentar la resolución
            useCORS: true // Habilitar si es necesario debido a restricciones CORS
        };

        // Capturar solo el contenedor de la gráfica con las opciones configuradas
        html2canvas(contenedorGrafica, opcionesCaptura).then(function(canvas) {
            // Convertir el canvas a una imagen
            var imagenCapturada = canvas.toDataURL("image/png");

            // Guardar la imagen usando FileSaver.js
            saveAs(imagenCapturada, 'captura_grafica.png');
        });
    }

    // Asociar la función al clic del botón
    document.getElementById('capturar').addEventListener('click', capturarPantallaGrafica);
</script>
