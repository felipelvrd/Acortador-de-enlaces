<?php 
include 'mysql.php';
include 'parametros.php';


$contraseña = $_POST['contraseña'];

$urlcorta = $_POST['url'];
$enlace = "No";

$url = obtenerUrl($urlcorta);
	if($url!=""){
		if($url['password']==(substr(md5($contraseña), 0, 10))){
			$enlace = $url['url'];
		}
	}
	echo $enlace . "," . $url['Tiempo'];
?>