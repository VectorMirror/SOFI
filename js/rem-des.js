//ocultar el campo de fecha respuesta cuando nmo es requrido
$(document).ready(function() {
  $('.ocultar').click(function(event){
      var valor = $(event.target).val();
      if(valor =="NO"){
          $(".date-resp").hide();
      } 
      else if (valor == "SI") {
          $(".date-resp").show();
      } 
  });
});
//buscador de destinarios interno
$(document).ready(function() {
    $('#buscarDest').on('keyup', function() {
        var buscarDest = $(this).val();		
        var dataString = 'buscarDest='+buscarDest;
	    if(buscarDest.length>0){
            $.ajax({
                type: "POST",
                url: "includes/text-des.php",
                data: dataString,
                success: function(data) {
                    //Escribimos las sugerencias que nos manda la consulta
                    $('#suggestions').fadeIn(1000).html(data);
                    //Al hacer click en algua de las sugerencias
                    $('.suggest-element').on('click', function(){
                            //Obtenemos la id unica de la sugerencia pulsada
                            var idD = $(this).attr('id');
                            //Editamos el valor del input con data de la sugerencia pulsada
                            $('#buscarDest').val($('#'+idD).attr('data'));
                            //Hacemos desaparecer el resto de sugerencias
                            $('#suggestions').fadeOut(1000);
                            //alert('Has seleccionado el '+id+' '+$('#'+id).attr('data'));
                            return false;
                    });
                }
            });
        }
        else{
            $('#suggestions').fadeOut(1000);
        }
        });
});
//buscador de remitentes internos
$(document).ready(function() {
    $('#buscarRem').on('keyup', function() {
        var buscarRem = $(this).val();		
        var dataStringR = 'buscarRem='+buscarRem;
	    if(buscarRem.length>0){
            $.ajax({
                type: "POST",
                url: "includes/text-rem.php",
                data: dataStringR,
                success: function(data) {
                    //Escribimos las sugerencias que nos manda la consulta
                    $('#suggestionsR').fadeIn(1000).html(data);
                    //Al hacer click en algua de las sugerencias
                    $('.suggest-element').on('click', function(){
                            //Obtenemos la id unica de la sugerencia pulsada
                            var idR = $(this).attr('id');
                            //Editamos el valor del input con data de la sugerencia pulsada
                            $('#buscarRem').val($('#'+idR).attr('data'));
                            //Hacemos desaparecer el resto de sugerencias
                            $('#suggestionsR').fadeOut(1000);
                            //alert('Has seleccionado el '+idR+' '+$('#'+idR).attr('data'));
                            return false;
                    });
                }
            });
        }
        else{
            $('#suggestionsR').fadeOut(1000);
        }
        });
});

//buscador destinatarioExterno
$(document).ready(function() {
    $('#buscarDestEx').on('keyup', function() {
        var buscarDestEx = $(this).val();		
        var dataStringExD = 'buscarDest='+buscarDestEx;
	    if(buscarDestEx.length>0){
            $.ajax({
                type: "POST",
                url: "includes/text-des.php",
                data: dataStringExD,
                success: function(data) {
                    //Escribimos las sugerencias que nos manda la consulta
                    $('#suggestionsExD').fadeIn(1000).html(data);
                    //Al hacer click en algua de las sugerencias
                    $('.suggest-element').on('click', function(){
                            //Obtenemos la id unica de la sugerencia pulsada
                            var idDex = $(this).attr('id');
                            //Editamos el valor del input con data de la sugerencia pulsada
                            $('#buscarDestEx').val($('#'+idDex).attr('data'));
                            //Hacemos desaparecer el resto de sugerencias
                            $('#suggestionsExD').fadeOut(1000);
                            //alert('Has seleccionado el '+id+' '+$('#'+id).attr('data'));
                            return false;
                    });
                }
            });
        }
        else{
            $('#suggestionsExD').fadeOut(1000);
        }
        });
});

//buscador remitenteExterno
$(document).ready(function() {
    $('#buscarRemEx').on('keyup', function() {
        var buscarRemEx = $(this).val();		
        var dataStringRex = 'buscarRem='+buscarRemEx;
	    if(buscarRemEx.length>0){
            $.ajax({
                type: "POST",
                url: "includes/text-rem.php",
                data: dataStringRex,
                success: function(data) {
                    //Escribimos las sugerencias que nos manda la consulta
                    $('#suggestionsExR').fadeIn(1000).html(data);
                    //Al hacer click en algua de las sugerencias
                    $('.suggest-element').on('click', function(){
                            //Obtenemos la id unica de la sugerencia pulsada
                            var idRex = $(this).attr('id');
                            //Editamos el valor del input con data de la sugerencia pulsada
                            $('#buscarRemEx').val($('#'+idRex).attr('data'));
                            //Hacemos desaparecer el resto de sugerencias
                            $('#suggestionsExR').fadeOut(1000);
                            //alert('Has seleccionado el '+idR+' '+$('#'+idR).attr('data'));
                            return false;
                    });
                }
            });
        }
        else{
            $('#suggestionsExR').fadeOut(1000);
        }
        });
});

///buscar empresa de entrada
$(document).ready(function() {
  $('#buscarEmp').on('keyup', function() {
      var buscarEmp = $(this).val();		
      var dataStringEmp = 'buscarEmp='+buscarEmp;
    if(buscarEmp.length>0){
          $.ajax({
              type: "POST",
              url: "includes/text-emp.php",
              data: dataStringEmp,
              success: function(data) {
                  //Escribimos las sugerencias que nos manda la consulta
                  $('#suggestionsEmp').fadeIn(1000).html(data);
                  //Al hacer click en algua de las sugerencias
                  $('.suggest-element').on('click', function(){
                          //Obtenemos la id unica de la sugerencia pulsada
                          var idEmp = $(this).attr('id');
                          //Editamos el valor del input con data de la sugerencia pulsada
                          $('#buscarEmp').val($('#'+idEmp).attr('data'));
                          //Hacemos desaparecer el resto de sugerencias
                          $('#suggestionsEmp').fadeOut(1000);
                          //alert('Has seleccionado el '+id+' '+$('#'+id).attr('data'));
                          return false;
                  });
              }
          });
      }
      else{
          $('#suggestionsEmp').fadeOut(1000);
      }
      });
});
///buscar empresa de salida
$(document).ready(function() {
  $('#buscarEmpEx').on('keyup', function() {
      var buscarEmpEx = $(this).val();		
      var dataStringEmpEx = 'buscarEmp='+buscarEmpEx;
    if(buscarEmpEx.length>0){
          $.ajax({
              type: "POST",
              url: "includes/text-emp.php",
              data: dataStringEmpEx,
              success: function(data) {
                  //Escribimos las sugerencias que nos manda la consulta
                  $('#suggestionsEmpEx').fadeIn(1000).html(data);
                  //Al hacer click en algua de las sugerencias
                  $('.suggest-element').on('click', function(){
                          //Obtenemos la id unica de la sugerencia pulsada
                          var idEmpEx = $(this).attr('id');
                          //Editamos el valor del input con data de la sugerencia pulsada
                          $('#buscarEmpEx').val($('#'+idEmpEx).attr('data'));
                          //Hacemos desaparecer el resto de sugerencias
                          $('#suggestionsEmpEx').fadeOut(1000);
                          //alert('Has seleccionado el '+id+' '+$('#'+id).attr('data'));
                          return false;
                  });
              }
          });
      }
      else{
          $('#suggestionsEmpEx').fadeOut(1000);
      }
      });
});

//Funcion para agregar destinatarios a la DB sin refrescar formulario
$(document).ready(function() {
  $('#btn-addDest').click(function() {
    var datosD= $('#form-destinatario').serialize();
    //alert(datos);
    //return false;
    $.ajax({
      url: 'includes/addDest.php',
      type: 'POST',
      data: datosD,
      success: function(d) {
        if(d=1){
          $('.msg-d').fadeIn(1000).html('<div class="alert alert-info">Si el nombre no aparece en la lista es porque ingreso un nombre invalido con menos de 5 letras</div>');
          //alert('Se ha agregado bien');
          //alert(datos);
        }
        else{
          alert('mamo este pedo');
        }
        $('#t-dest').val('');
        $('#dest').modal('hide');
        $('.msg-d').fadeOut(10000);
      }               
    });
    return false;
  });
})
//funcion para agregar remitentes a la DB sin refrescar formulario
$(document).ready(function() {
  $('#btn-addRem').click(function() {
    var datos= $('#form-remitente').serialize();
    //alert(datos);
    //return false;
    $.ajax({
      url: 'includes/addRem.php',
      type: 'POST',
      data: datos,
      success: function(r) {
        if(r=1){

          $('.msg-r').fadeIn(1000).html('<div class="alert alert-info">Si el nombre no aparece en la lista es porque ingreso un nombre invalido con menos de 5 letras</div>');
          //alert('Se ha agregado bien');
          //alert(datos);
        }
        else{
          alert('mamo este pedo');
        }
        $('#t-rem').val('');
        $('#remitente').modal('hide');
        $('.msg-r').fadeOut(10000);
      }               
    });
    return false;
  }); 
})

//con esta funcion guardamos nuevas empresas en la db sin refrescar pagina principal
$(document).ready(function() {
  $('#btn-addEmp').click(function() {
    var datosEmp= $('#form-empresa').serialize();
    //alert(datos);
    //return false;
    $.ajax({
      url: 'includes/addEmp.php',
      type: 'POST',
      datatype: 'html',
      data: datosEmp,
      success: function(emp) {
        if(emp=1){
          $('.msg-emp').fadeIn(1000).html('<div class="alert alert-info">Si el nombre no aparece en la lista es porque ingreso un nombre invalido con menos de 5 letras</div>');
          //alert('Se ha agregado bien');
          //alert(datos);
        }
        else{
          alert('mamo este pedo');
        }
        $('#t-emp').val('');
        $('#emp').modal('hide'); 
        $('.msg-emp').fadeOut(10000);      
      }               
    });
    return false;
  });
})