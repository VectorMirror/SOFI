<?php
    require_once 'DB_conection.php';
    require_once 'funciones.php';
    require_once 'consultas.php';

    $html='';
    $errores = array();
    
    if(!empty($_POST)){
        $destinatario= $DB_conection->real_escape_string(strtoupper($_POST['destinatario']));
        
        if(checarRemDes($destinatario)){
            $html='
                <div class="error">'.$errores[] ="Escribe un nombre valido".'</div>';
        }
      
        if(destinatarioExiste($destinatario)){
            $html='
                <div class="error">'.$errores[] ="El nombre que trata de registrar ya existe en la DB".'</div>';
        } 
        if(count($errores)==0){
            $nvoDest=addDest($destinatario);
            if($nvoDest >0){
                $html='
                    <div class="success">'.$errores[] ="Se ha registrado el nombre como nuevo destinatario".'</div>';
            }
            else{
                
            }
        }
    }
    //echo $html;
    //echo var_dump($destinatario);

    //echo var_dump($html);
    //echo var_dump($errores);

?>