<?php
    session_start();
    include_once 'DB_conection.php';
    include_once 'funciones.php';

    $idUser = $_SESSION['id_usuario'];
    $errores = array();
    $urlDB = '';
    $caracter= 'Externo-Salida';
    //variables para conseguir año y mes y hacer directorios
    $anho=strftime('%Y');
    $mes= ['ene','feb','mar','abr','may','jun','jul','ago','sep','oct','nov','dic'][date('n')-1];
    //Si los campos que cargan los id llegan vacios les damos un valor 0 para evitar que aparezca el error de variable idefinida
    if(empty($_POST['destId'])){
        $_POST['destId']=0;
    }
    if(empty($_POST['remId'])){
        $_POST['remId']=0;
    }
    if(empty($_POST['empId'])){
        $_POST['empId']=0;
    }
    //recibimos por POST los input hidden que tienen los id de los registros que se usan en los formularios para poder guardar la info en la DB
    $destId=$DB_conection->real_escape_string($_POST['destId']);
    $remId=$DB_conection->real_escape_string($_POST['remId']);
    $empId=$DB_conection->real_escape_string($_POST['empId']);

    if(!empty($_POST)){
        $destinatario =$_POST['buscarDestEx'];
        $remitente =$_POST['buscarRemEx'];
        $empresa =$_POST['buscarEmpEx'];
        $oficioRef =strtoupper($_POST['buscarOficioRefEx']);
        $numOficio =strtoupper($_POST['buscarNumeroOfEx']);
        $asunto =$_POST['asuntoR'];
        $descripcion =$_POST['descripcionR'];
        $fechaElab =$_POST['fechaElaboracionR'];
        //$fechaResp =$_POST['fechaRespuesta']);

        if(checarFormInternoSalidaEx($destinatario, $remitente, $empresa, $oficioRef, $numOficio, $asunto, $descripcion, $fechaElab)){
            $errores[] ="Llena TODOS los campos que esten activos.";
        }
        if(!destinatarioExiste($destinatario)){
            $errores[] ="El destinatario debe existir en la DB, elija uno de la lista sino agreguelo.";
        }
        if(!remitenteExiste($remitente)){
            $errores[] ="El remitente debe existir en la DB, elija uno de la lista sino agreguelo.";
        }
        if(!empresaExiste($empresa)){
            $errores[] ="El nombre de empresa debe existir en la DB, elija uno de la lista sino agreguelo.";
        }
        if($remitente == $destinatario){
            $errores[] ="El remitente y el destinatario no pueden ser la misma persona.";
        }
        //con este if mandamos un boton de direccioanmiento por si hay un error
        if(count($errores)>0){
            $errores[]= "<br><a href='../oficios-externos.php' class='btn btn-danger btn-lg'>INTENTAR DE NUEVO</a>";
        }
        //se verifica que los campos esten llenos
        if(count($errores)==0){
            //si los errores son cero se prosigue a cargar el oficio y a guardar la info en la DB
            foreach ($_FILES['archivoOficioR']['tmp_name'] as $key => $value){
                //Validamos que el archivo exista
                if($_FILES['archivoOficioR']['error'][$key]>0 ){
                    //mandamos un mensaje notificando que se envio el formulario sin cargar ningun oficio
                    echo "<script>alert('ERROR No seleccionaste ningún archivo HDPM >:('); </script>";
                    //echo "<script>setTimeout(\"location.href='../oficios-internos.php'\",500); </script>";
                }
                else{
                    //restringimos que solo queremos documentos con extension pdf
                    $extension='application/pdf';
                    if($_FILES['archivoOficioR']['type'] = $extension[$key]){
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
                            $oficioUrl=@move_uploaded_file($_FILES['archivoOficioR']['tmp_name'][$key], $urlDoc);    
                            $urlDB .= ',oficios/'.$idUser.'/'.$anho.'/'.$mes.'/'.$caracter.'-'.$fecha.'-'.$random.'-numOfi-'.$numOficio.'.pdf';
                            
                        }
                    }
                    else{
                        echo "<script>alert('Extensión de archivo no permitida: Los oficios deben cargarse en PDF'); </script>";
                        echo "<script>setTimeout(\"location.href='../oficios-internos.php'\",500); </script>";                
                    }
                }
            } //fin Foreach
                
            if(!empty($oficioUrl)){
                uploadOficioISEx($idUser, $caracter, $destId, $remId, $oficioRef, $numOficio, $empId, $asunto, $descripcion, $urlDB, $fechaElab);
                echo "<script>alert('¡El oficio se ha subido con éxito :)!'); </script>";
                echo "<script>setTimeout(\"location.href='../oficios-internos.php'\",500); </script>";
            }
            else{
                echo "<script>alert('¡El oficio no se pudo subir :(!'); </script>";
                echo "<script>setTimeout(\"location.href='../oficios-internos.php'\",25500); </script>";
            }
        }
        
        
    }
    echo listaErrores($errores);
    //echo $urlDoc;
?>
<link href="/favicon.ico" rel="shortcut icon">
    <link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">