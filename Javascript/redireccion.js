// JavaScript Document


function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}

function redireccion(){
	var parametros = {
		"url" : getUrlVars()["a"]   
    };
	
	$.ajax({
		data:  parametros,
        url:   '../php/redireccion.php',
        type:  'post',
        beforeSend: function () {
			$("#contenido").html("Espere por favor...");
		},
		success:  function (response) {
			var resultado = response.split(",");
			var contenido = resultado[0];
			var contraseña = resultado[1];
			var tiempo = resultado[2];
			var enlace = resultado[3];
			$("#contenido").html(contenido);
			if(enlace!="No")
				correTiempo(tiempo,enlace);
			if(contraseña=="Si"){
				$('#contraseña').show();
			}
		}});
}

function checkPass(contraseña){
	var parametros = {
		"contraseña" : contraseña,
		"url" : getUrlVars()["a"]   
    };
	
	$.ajax({
		data:  parametros,
        url:   '../php/password.php',
        type:  'post',
        beforeSend: function () {
			$("#tiempo").html("Espere por favor...");
		},
		success:  function (response) {
			var resultado = response.split(",");
			var ruta = resultado[0];
			var tiempo = resultado[1];
			if(ruta!="No")
				correTiempo(tiempo,ruta);
			else{
				$("#tiempo").html("Contraseña incorrecta");
				$('#pass').val("");
			}
		}});
}

function visitar(enlace){
	var parametros = {
		"url" : getUrlVars()["a"]   
    };
	
	$.ajax({
		data:  parametros,
        url:   '../php/visita.php',
        type:  'post',
        beforeSend: function () {
		},
		success:  function (response) {
			$(location).attr('href',enlace);
		}});
}

function correTiempo(t,enlace){
	$('#tiempo').html("Espere "+t+" segundos para redireccionar...");
	if(t>0)
		setTimeout(function(){correTiempo(t-1,enlace)},1000);
	else
		if(enlace!="No")
			visitar(enlace);
}


$(document).ready(function() {
	redireccion();
	$('#contraseña').hide();
	$('#btnRedireccionar').click(function(){
		checkPass($.sha256($('#pass').val()));
	});
});