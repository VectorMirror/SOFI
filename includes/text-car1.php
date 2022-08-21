<?php

    #AQUI SE MUESTRAN LOS REGISTROS DE LA TABLA DE DESTINATARIOS 
    require_once 'DB_conection.php';
    require_once 'consultas.php';

    $html = '';
    $carg1 = $_POST['buscarCarEx'];
    
    $queryCar1=('SELECT * FROM cargos WHERE cargo_cargo LIKE "%'.strip_tags($carg1).'%" ORDER BY cargo_cargo DESC LIMIT 0,15');
    $cargos1 = $DB_conection->query($queryCar1);

    if ($cargos1->num_rows > 0) {
        while ($cargo1 = $cargos1->fetch_assoc()) {                
            $html.='
                    <div>
                        <a class="suggest-element " data="'.$cargo1['cargo_cargo'].'" id="'.$cargo1['cargo_id'].'">'.$cargo1['cargo_cargo'].'</a></div>
                        <input type="hidden" id="carH1" name="cargoR" value="'.$cargo1['cargo_id'].'">
                ';
        }
    }
    else{
        $html.='<div><a class="suggest-element">No hay resultados similares a tu busqueda</div>';
    }
    echo $html;

?>