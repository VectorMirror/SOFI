<?php
    require_once 'DB_conection.php';
    require_once 'funciones.php';
    require_once 'consultas.php';

    $html='';
    $errores = array();
    $tipo= $DB_conection->real_escape_string($_POST['respuesta']);
    if($tipo > 1){
        $tipo=0;
    }
    
    if(!empty($_POST)){
        $cargo= $DB_conection->real_escape_string(ucwords(strtolower($_POST['cargo'])));
        if(checarRemDes($cargo)){
            $html='
                <div class="error">'.$errores[] ="Escribe un nombre valido".'</div>';

        }
      
        if(cargoExiste($cargo)){
            $html='
                <div class="error">'.$errores[] ="El nombre que trata de registrar ya existe en la DB".'</div>';
        } 
        if(count($errores)==0){
            $nvoCargo=addCargo($cargo, $tipo);
            if($nvoCargo >0){
                $html='
                    <div class="success">'.$errores[] ="Se ha registrado el nombre como nuevo cargo".'</div>';
            }
            else{
                
            }
        }
    }
    //echo $html;
    //echo var_dump($remitente);

    //echo var_dump($html);
    //echo var_dump($errores);

?>
