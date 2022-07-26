//Busqueda de internos de entrada
$(busquedaIE());

function busquedaIE(consultaIE) {
    $.ajax({
        url: 'includes/busqueda-oficios-internos-entrada.php',
        type: 'POST',
        dataType: 'html',
        data: {consultaIE: consultaIE},
    })

    .done(function(respuestaIE){
        $('#content-table').html(respuestaIE);
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
//Busqueda de internos de salida
$(busquedaIS());

function busquedaIS(consultaIS) {
    $.ajax({
        url: 'includes/busqueda-oficios-internos-salida.php',
        type: 'POST',
        dataType: 'html',
        data: {consultaIS: consultaIS},
    })

    .done(function(respuestaIS){
        $('#content-table').html(respuestaIS);
    })
    .fail(function(){
        console.log('Mamo')
    })

}
$(document).on('keyup', '#buscarIS', function(){
    let valorIS= $(this).val();
    if(valorIS !=''){
        busquedaIS(valorIS);
    }
    else{
        busquedaIS();
    }
})
//Busqueda de EXternos de entrada
$(busquedaEE());

function busquedaEE(consultaEE) {
    $.ajax({
        url: 'includes/busqueda-oficios-externos-entrada.php',
        type: 'POST',
        dataType: 'html',
        data: {consultaEE: consultaEE},
    })

    .done(function(respuestaEE){
        $('#content-table').html(respuestaEE);
    })
    .fail(function(){
        console.log('Mamo')
    })

}
$(document).on('keyup', '#buscarEE', function(){
    let valorEE= $(this).val();
    if(valorEE !=''){
        busquedaEE(valorEE);
    }
    else{
        busquedaEE();
    }
})
//Busqueda de EXternos de salida    
$(busquedaES());

function busquedaES(consultaES) {
    $.ajax({
        url: 'includes/busqueda-oficios-externos-salida.php',
        type: 'POST',
        dataType: 'html',
        data: {consultaES: consultaES},
    })

    .done(function(respuestaES){
        $('#content-table').html(respuestaES);
    })
    .fail(function(){
        console.log('Mamo')
    })

}
$(document).on('keyup', '#buscarES', function(){
    let valorES= $(this).val();
    if(valorES !=''){
        busquedaES(valorES);
    }
    else{
        busquedaES();
    }
})