<?php 
	include("php/parametros.php");
	include("php/mysql.php");
	
	$html = "";	
 	if(isset($_GET["a"])){	
		header("Location: ".$url_dominio."html/redireccion.html" . "?a=" . $_GET["a"]);
 	}
 	else{
 		header("Location: ".$url_dominio."html/acortador.html");
		c
 	}
?>