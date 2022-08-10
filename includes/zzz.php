<?php
    //$_FILES['archivoOficio']
    $idUser = '1';
    $caracter = 'Interno-Entrada';
    $numOficio = '12345';
    $urlDB = '';
    $anho=strftime('%Y');
    $mes= ['ene','feb','mar','abr','may','jun','jul','ago','sep','oct','nov','dic'][date('n')-1];

    foreach ($_FILES['archivoOficio']['tmp_name'] as $key => $value){
        //Validamos que el archivo exista
		if($_FILES['archivoOficio']['error'][$key]>0 ){
            //mandamos un mensaje notificando que se envio el formulario sin cargar ningun oficio
            echo "<script>alert('ERROR No seleccionaste ningún archivo HDPM >:('); </script>";
            //echo "<script>setTimeout(\"location.href='../oficios-internos.php'\",500); </script>";
        }
        else{
            //restringimos que solo queremos documentos con extension pdf
            $extension='application/pdf';
            if($_FILES['archivoOficio']['type'] = $extension[$key]){
                $root='../';                    //regresamos al directorio raiz
                $oficiosDir=$root.'oficios';    //Creamos la carpeta oficios en la carpeta raiz si no existe
                if(!is_dir($oficiosDir)){
                    mkdir($oficiosDir);
                }
                $idDir=$oficiosDir.'/'.$idUser.'/';     //Creamos la carpeta del usuario si no existe
                if(!is_dir($idDir)){
                    mkdir($idDir);
                }
                $anhoDir=$oficiosDir.'/'.$idUser.'/'.$anho;   //Creamos la carpeta del año en curso
                if(!is_dir($anhoDir)){
                    mkdir($anhoDir);
                }
                $urlDir=$oficiosDir.'/' .$idUser .'/'.$anho. '/'.$mes.'/';    //Creamos la carpeta del mes del año en curso
                if(!is_dir($urlDir)){
                    mkdir($urlDir);
                }
                $fecha = date('d-m-y-h-i-s'); 
                $random = rand(999, 9999);
                $urlDoc =$urlDir.$caracter.'-'.$fecha.'-'.$random.'-numOfi-'.$numOficio.'.pdf';

                if(!file_exists($urlDoc)){
                    $oficioUrl=@move_uploaded_file($_FILES['archivoOficio']['tmp_name'][$key], $urlDoc);    
                    $urlDB .= ',oficios/'.$idUser.'/'.$anho.'/'.$mes.'/'.$caracter.'-'.$fecha.'-'.$random.'-numOfi-'.$numOficio.'.pdf';
                    
                }
            }
            else{
                echo "<script>alert('Extensión de archivo no permitida: Los oficios deben cargarse en PDF'); </script>";
                //echo "<script>setTimeout(\"location.href='../oficios-internos.php'\",500); </script>";                
            }
        }
    } //fin Foreach
        
    if(!empty($oficioUrl)){
        //uploadOficioIE($idUser, $caracter, $destId, $remId, $cargo, $unidad, $oficioRef, $numOficio, $respuesta, $asunto, $descripcion, $urlDB, $fechaElab, $fechaResp, $fechaSICT);
        echo "<script>alert('¡El oficio se ha subido con éxito :)!'); </script>";
        //echo "<script>setTimeout(\"location.href='../oficios-internos.php'\",500); </script>";
    }
    else{
        echo "<script>alert('¡El oficio no se pudo subir :(!'); </script>";
        //echo "<script>setTimeout(\"location.href='../oficios-internos.php'\",25500); </script>";
    }
                
            
    
    foreach ($urlDB as $oficioHost){
        echo "<li>". $oficioHost. "</li>";
    }
    echo '<pre>';  var_dump($urlDB); echo '</pre>';
    echo '<pre>';  var_dump($_FILES['archivoOficio']); echo '</pre>';
?>