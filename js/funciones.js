function validarFormulario(){
var nombre = document.getElementById('nombre_usuario').value;
var apaterno = document.getElementById('apaterno_usuario').value;
	if(nombre === null || nombre === ''){
		alert('[ERROR] Es necesario ingresar el nombre del usuario');
		return false;			
	}

	 if(apaterno === null || apaterno === ''){
		alert('[ERROR] Es necesario ingresar el apellido paterno del usuario');
		return false;
	}

	return true;
	
	
}

function mensajeEliminarUsuario(){
    var result = document.getElementById('result').value;
    if (result){
        alert('paso algo');
    }
    return false;
}


/*$(document).ready(function(){
	$("#nombre_ft1").click(function(){
		$("#nombre_ft1").hide();
	});
	
 });*/