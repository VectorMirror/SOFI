$(document).ready( function () {
    $('#table-ofi').DataTable({
        'language':{
            'lengthMenu': 'Ver _MENU_ regs. por pag.',
            'info': 'página _PAGE_ de _PAGES_',
            'infoEmpty': 'No se encontraron resultados',
            'infoFiltered': '(filtrada de _MAX_ regs.',
            'loadingRecords': 'Cargando...',
            'processing': 'Procesando...',
            'search': '<span class="glyphicon glyphicon-search"></span> Buscar ',
            'zeroRecords': 'No se encontraron registros que coincidan con tu busqueda :(',
            'paginate': {
                'next': 'Sig.',
                'previous': 'Ant.'
            },
        }/*,
        'bProcessing': true,
        'bServerSide': true,
        'sAjaxSource': 'process_regs.php'*/
    });
});