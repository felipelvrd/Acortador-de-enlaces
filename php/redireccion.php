<?php 
include 'mysql.php';
include 'parametros.php';

$html="";
$contraseña = "No";
$tiempo = 10;
@$urlcorta = $_POST['url'];
$enlace = "No";
$url = obtenerUrl($urlcorta);
	if($url!=""){
		
		$html = $html . "<p>Este enlace ha recibido <b>" . $url['visitas'] . "</b> visitas</p>";
		//$html = $html . "Hoy es: " . date("d/M/Y" , time());
				
		if( (strtotime($url['Activo']) > time() && $url['Activo']!="") ||  
			(strtotime($url['Vence']) < time() && $url['Vence']!="") ){
			$html= $html . "<p>El enlace no está disponible</p>";
		}
		else{
			$enlace = $url['url'];
		
			if($url['password']!=""){
				$contraseña="Si";
				$enlace = "No";
			}
			
			$tiempo = $url['Tiempo'];
		}
			
		if($url['Activo']!=""){
			$html = $html . "<p>El enlace esta disponible a partir de: " . date("d/M/Y" , strtotime($url['Activo'])) . "</p>";
		}
		
		if($url['Vence']!=""){
			$html = $html . "<p>El enlace esta disponible hasta el: " . date("d/M/Y" , strtotime($url['Vence'])) . "</p>";
		}

	}
	else{
		$html = $html . "<p>El enlace no existe</p>";
	}
	
	echo $html . "," . $contraseña . "," . $tiempo . "," . $enlace;
?>