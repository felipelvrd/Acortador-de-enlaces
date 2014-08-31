<?php 
include 'mysql.php';
include 'parametros.php';

$url = $_POST['url'];
$fechaini = $_POST['fechaini'];
$fechafin = $_POST['fechafin'];
$pass = $_POST['pass'];
$tiempo = $_POST['tiempo'];


if($pass=="")
	$pass=NULL;
if($fechaini=="")
	$fechaini=NULL;
if($fechafin=="")
	$fechafin=NULL;

$urlcorta=registrar_enlace($url, $pass, $fechaini, $fechafin, $tiempo);
if($urlcorta!="")
	echo $url_dominio."?a=".$urlcorta;

?>
