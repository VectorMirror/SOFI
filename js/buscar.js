$(busquedaIE());

function busquedaIE(consultaIE) {
    $.ajax({
        url: 'includes/busqueda-oficios-internos-entrada.php',
        type: 'POST',
        dataType: 'html',
        data: {consultaIE: consultaIE},
    })

    .done(function(respuestaIE){
        $('#busquedaIE').html(respuestaIE);
    })
    .fail(function(){
        console.log('Mamo')
    })

}
$(document).on('keyup', '#buscarIE', function(){
    let valorIE= $(this).val();
    if(valorIE !=''){
        busquedaIE(valorIE);
    }
    else{
        busquedaIE();
    }

})