<?php
// PERSONALIZACION
// MODIFICAR
$anchoimg="100px";                  // ANCHO DE LAS IMAGENES EN LA TABLA
$altoimg="100px";                   // ALTO DE LAS IMAGENES EN LA TABLA
$imgtabla="";                       // CON si, MUESTRA LAS FOTOS EN LA TABLA DE REGISTROS
$mibase="Vehiculos";
$deci="2";                          // NUMERO DE DECIMALES EN CAMPOS NUMERICOS
$come="Control de averías y gastos del vehículo";

// DEFINICION DE TABLA
// ENCABEZADO Y NOMBRE DE LOS CAMPOS
$col[1]="FECHA";
$col[2]="AVERIA";
$col[3]="KMS";
$col[4]="IMPORTE";
$col[5]="TALLER";
$col[6]="NOTAS";
$col[7]="FOTO1";
$col[8]="FOTO2";

// TIPOS DE CAMPOS
$tip[1]="date";
$tip[2]="text";
$tip[3]="number";
$tip[4]="number";
$tip[5]="text";
$tip[6]="textarea";
$tip[7]="image";
$tip[8]="image";

// INDICA SI HACER SUMA DE LA COLUMNA
$sum[1]="";
$sum[2]="";
$sum[3]="";
$sum[4]="si";
$sum[5]="";
$sum[6]="";
$sum[7]="";
$sum[8]="";

// INDICA SI HAY QUE HACER LA MEDIA DE LOS VALORES DE LA COLUMNA
$med[1]="";
$med[2]="";
$med[3]="";
$med[4]="si";
$med[5]="";
$med[6]="";
$med[7]="";
$med[8]="";

$hlp[1]="";
$hlp[2]="";
$hlp[3]="";
$hlp[4]="";
$hlp[5]="";
$hlp[6]="";
$hlp[7]="";
$hlp[8]="";

// NO MODIFICAR
$mibase="bases/".$mibase;


?>
