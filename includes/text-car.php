<?php

    #AQUI SE MUESTRAN LOS REGISTROS DE LA TABLA DE DESTINATARIOS 
    require_once 'DB_conection.php';
    require_once 'consultas.php';

    $html = '';
    $carg = $_POST['buscarCar'];
    
    $queryCar=('SELECT * FROM cargos WHERE cargo_cargo LIKE "%'.strip_tags($carg).'%" ORDER BY cargo_cargo DESC LIMIT 0,15');
    $cargos1 = $DB_conection->query($queryCar);

    if ($cargos1->num_rows > 0) {
        while ($cargo = $cargos1->fetch_assoc()) {                
            $html.='
                    <div>
                        <a class="suggest-element " data="'.$cargo['cargo_cargo'].'" id="'.$cargo['cargo_id'].'">'.$cargo['cargo_cargo'].'</a></div>
                        <input type="hidden" id="carH" name="cargoId" value="'.$cargo['cargo_id'].'">
                ';
        }
    }
    else{
        $html.='<div><a class="suggest-element">No hay resultados similares a tu busqueda</div>';
    }
    echo $html;

?>