<?php

    #AQUI SE MUESTRAN LOS REGISTROS DE LA TABLA DE DESTINATARIOS 
    require_once 'DB_conection.php';
    require_once 'consultas.php';

    $html = '';
    $dest = $_POST['buscarDest'];
    
    $queryDest=('SELECT * FROM destinatarios WHERE dest_destinatario LIKE "%'.strip_tags($dest).'%" ORDER BY dest_destinatario DESC LIMIT 0,15');
    $destinatarios = $DB_conection->query($queryDest);

    if ($destinatarios->num_rows > 0) {
        while ($destinatario = $destinatarios->fetch_assoc()) {                
            $html.='
                    <div>
                        <a class="suggest-element " data="'.$destinatario['dest_destinatario'].'" id="'.$destinatario['dest_id'].'">'.$destinatario['dest_destinatario'].'</a></div>
                        <input type="hidden" id="destH" name="destId" value="'.$destinatario['dest_id'].'">
                ';
        }
    }
    else{
        $html.='<div><a class="suggest-element">No hay resultados similares a tu busqueda</div>';
    }
    echo $html;

?>
