<?php

function registrar_enlace($url, $pass, $fechaini, $fechafin, $tiempo){
	include 'parametros.php';
	try{
		if($tiempo<5)
			$tiempo=5;
		if($pass!="")
			$pass = substr(md5($pass), 0, 10); 
		$conn = new PDO("mysql:host=$hostname_Conexion;dbname=$database_Conexion", $username_Conexion,$password_Conexion);
		$sql = "INSERT INTO web_url (url, short_url, password, Activo, Vence, Tiempo)
				VALUES (:url, :urlCorta,:pass, :fechaini, :fechafin, :tiempo)";
		$q = $conn->prepare($sql);
		$q->execute(array(':url'=>$url,
						  ':urlCorta'=>$url,
						  ':pass'=>$pass,
						  ':fechaini'=>$fechaini,
						  ':fechafin'=>$fechafin,
						  ':tiempo'=>$tiempo));
					  
		$id = $conn->lastInsertId();	
		$urlcorta = base_convert($id,10,36);
	
		$sql = "UPDATE web_url 
				SET short_url=?
				WHERE id=?";
		$q = $conn->prepare($sql);
		$q->execute(array($urlcorta,$id));
		$conn=NULL;
		
		return $urlcorta;
	}

	catch(PDOException $e){
		 echo 'Ha ocurrido un error: ' .  $e->getMessage();
	}
}

function obtenerUrl($urlcorta){
	include 'parametros.php';
	$con = mysql_connect($hostname_Conexion,$username_Conexion,$password_Conexion);
	if (!$con){
		die('Ha ocurrido un error: ' . mysql_error());
	}
	
	mysql_select_db($database_Conexion, $con);
	
	$result = mysql_query("SELECT url,short_url,password,visitas,Activo,Vence,Tiempo FROM web_url where short_url='$urlcorta'");
	$row="";
	if(mysql_num_rows($result)>0){
		$row = mysql_fetch_array($result);
	}
	mysql_close($con);
	return $row;
}

function visita($urlcorta){
	include 'parametros.php';
	$con = mysql_connect($hostname_Conexion,$username_Conexion,$password_Conexion);
	if (!$con){
		die('Ha ocurrido un error: ' . mysql_error());
	}
	
	mysql_select_db($database_Conexion, $con);
	
	$result = mysql_query("SELECT visitas FROM web_url where short_url='$urlcorta'");
	$row="";
	if(mysql_num_rows($result)>0){
		$row = mysql_fetch_array($result);
	}
	$visitas = $row['visitas']+1;
	mysql_query("Update web_url set visitas=$visitas where short_url='$urlcorta'");
	
	mysql_close($con);
	return $row;
}
?>