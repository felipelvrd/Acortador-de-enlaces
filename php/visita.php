<?php 
include 'mysql.php';
include 'parametros.php';

$urlcorta = $_POST['url'];

session_start();
if (!isset($_SESSION[$urlcorta])) {
	$_SESSION[$urlcorta] = 0;
  
	
	visita($urlcorta);
}

?>