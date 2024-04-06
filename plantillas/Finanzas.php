<?php

$mibase="bases/Finanzas";
$deci="2";
$come="Lleva el control de todas tus finanzas";

// EL PRIMER CAMPO ES OBLIGATORIO RELLENARLO EN LA BASE DE DATOS
$col[1]="CONCEPTO";
$tip[1]="text";
$sum[1]="";
$med[1]="";
$cat[1]="";
$hlp[1]="Anota el movimiento: gasto o ingreso";

$col[2]="CATEGORIA";
$tip[2]="select";
$sum[2]="";
$med[2]="";
$cat[2]=",Ingreso,Hipoteca,Plazos,Casa,Ocio,Vehiculo,Combustible,Salud,Alimentacion,Ropa,Compras,Interno,Otros";
$hlp[2]="Agrupa los movimientos por categoría";

$col[3]="NECESIDAD";
$tip[3]="select";
$sum[3]="";
$med[3]="";
$cat[3]=",Nada necesario,Necesario,Muy necesario";
$hlp[3]="Define como de necesario es el movimiento";

$col[4]="CICLO";
$tip[4]="select";
$sum[4]="";
$med[4]="";
$cat[4]=",Diario,Semanal,Quincenal,Mensual,Bimestral,Trimestral,Cuatrimestral,Semestral,Anual,Bianual,Otros";
$hlp[4]="Anota si la temporalización del movimiento";

$col[5]="TIPO";
$tip[5]="select";
$sum[5]="";
$med[5]="";
$cat[5]=",Gasto,Ingreso,Neutro";
$hlp[5]="Anota si se trata de un gasto o un ingreso. Si es neutro no sumará ni restará";

$col[6]="IMPORTE";
$tip[6]="number";
$sum[6]="si";
$med[6]="";
$cat[6]="";
$hlp[6]="Especifica el importe del movimiento";

$col[7]="ORIGEN";
$tip[7]="select";
$sum[7]="";
$med[7]="";
$cat[7]=",Entidad 1,Entidad 2,Entidad 3,Credito,Otros";
$hlp[7]="Cuenta de la que sale el dinero";

$col[8]="DESTINO";
$tip[8]="select";
$sum[8]="";
$med[8]="";
$cat[8]=",Aseguradora,Mecanico";
$hlp[8]="Destinatario del dinero";

$col[9]="NOTAS";
$tip[9]="textarea";
$sum[9]="";
$med[9]="";
$cat[9]="";
$hlp[9]="";


?>

