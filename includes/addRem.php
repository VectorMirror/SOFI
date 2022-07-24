<?php
    require_once 'DB_conection.php';
    require_once 'funciones.php';
    require_once 'consultas.php';

    $html='';
    $errores = array();
    
    if(!empty($_POST)){
        $remitente= $DB_conection->real_escape_string(strtoupper($_POST['remitente']));
        
        if(checarRemDes($remitente)){
            $html='
                <div class="error">'.$errores[] ="Escribe un nombre valido".'</div>';

        }
      
        if(remitenteExiste($remitente)){
            $html='
                <div class="error">'.$errores[] ="El nombre que trata de registrar ya existe en la DB".'</div>';
        } 
        if(count($errores)==0){
            $nvoRem=addRem($remitente);
            if($nvoRem >0){
                $html='
                    <div class="success">'.$errores[] ="Se ha registrado el nombre como nuevo remitente".'</div>';
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
