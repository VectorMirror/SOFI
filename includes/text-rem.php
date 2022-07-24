<?php
    require_once 'DB_conection.php';
    require_once 'consultas.php';

    $html = '';
    $remit = $_POST['buscarRem'];
    

    $queryRemit=('SELECT * FROM remitentes WHERE rem_remitente LIKE "%'.strip_tags($remit).'%" ORDER BY rem_remitente DESC LIMIT 0,15');
    $remitentes = $DB_conection->query($queryRemit);

    if ($remitentes->num_rows > 0) {
        while ($remitente = $remitentes->fetch_assoc()) {                
            $html .= '<div>
                        <a class="suggest-element" data="'.$remitente['rem_remitente'].'" id="rem'.$remitente['rem_id'].'">'.$remitente['rem_remitente'].'</a></div>
                        <input type="hidden" id="remH" name="remId" value="'.$remitente['rem_id'].'">
                        ';
        }
    }
    else{
        $html.='<div><a class="suggest-element">No hay resultados similares a tu busqueda</div>';
    }
    echo $html;

?>
