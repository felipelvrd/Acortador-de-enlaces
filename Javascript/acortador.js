// JavaScript Document

var OpcionesVisibles = false;


$(document).ready(function() {
	$('.ocultar').hide();  
	$('#enlace').hide();	
 
    $('#aOpciones').click(function (){
		if(!OpcionesVisibles){
			$('#aOpciones').html("Menos opciones");
			$(".ocultar").slideToggle();
			OpcionesVisibles=true;
		}
		else{
			$('#aOpciones').html("Más opciones");
			$(".ocultar").slideToggle();
			OpcionesVisibles=false;
		}
		});
		
	$('#btnAcortar').click(function(){
		if($('#password1').val()!=$('#password2').val()){
			alert("Error. Las contraseñas no coinciden");
			return (false);
		}
		if($('#fechaInicio').val()>$('#fechaFin').val()){
			if($('#fechaFin').val()!=""){
				alert("Error. La fecha de vencimiento es más reciente que la fecha de disponibilidad");
				return (false);
			}
		}
		if(!isUrl($('#txtURL').val())){
			alert("Error. Url invalida, recuerde incluir el http:// o https:// al inicio de la url");
			return (false);
		}
		var pass = $('#password1').val();
		if(pass!="")
			pass=$.sha256(pass);
		acortar($('#txtURL').val(),$('#fechaInicio').val(),$('#fechaFin').val(),pass,$('#tiempo').val());
		});
});

function isUrl(s) {
    var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
    return regexp.test(s);
}

function acortar(url,fechaini,fechafin,pass,tiempo){
       var parametros = {
		   "url" : url,
		   "fechaini" : fechaini,
		   "fechafin" : fechafin,
		   "pass" : pass,
		   "tiempo" : tiempo   
       };
	   
       $.ajax({
               data:  parametros,
               url:   '../php/acortar.php',
               type:  'post',
               beforeSend: function () {
                       $("#enlaceAcortado").html("Espere por favor...");
               },
               success:  function (response) {
                       $("#enlaceAcortado").html(response);
					   $('#enlace').show();
               }
       });
}