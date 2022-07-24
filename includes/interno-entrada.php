<?php
    session_start();
    include_once 'DB_conection.php';
    include_once 'funciones.php';

    $idUser = $_SESSION['id_usuario'];
    $errores = array();
    $caracter= 'Interno-Entrada';
    $docOficio= $_FILES['archivoOficio'];
    //variables para conseguir año y mes y hacer directorios
    $anho=strftime('%Y');
    $mes= ['ene','feb','mar','abr','may','jun','jul','ago','sep','oct','nov','dic'][date('n')-1];
    $fechaResp =$DB_conection->real_escape_string($_POST['fechaRespuesta']);
    //Si los campos que cargan los id llegan vacios les damos un valor 0 para evitar que aparezca el error de variable idefinida
    if(empty($_POST['destId'])){
        $_POST['destId']=0;
    }
    if(empty($_POST['remId'])){
        $_POST['remId']=0;
    }
    if(empty($_POST['unidad'])){
        $_POST['unidad']=0;
    }
    
    //recibimos por POST los input hidden que tienen los id de los registros que se usan en los formularios para poder guardar la info en la DB
    $destId=$DB_conection->real_escape_string($_POST['destId']);
    $remId=$DB_conection->real_escape_string($_POST['remId']);

    if(!empty($_POST)){
        $destinatario =$_POST['buscarDest'];
        $remitente =$_POST['buscarRem'];
        $cargo =$_POST['cargo'];
        $unidad =$_POST['unidad'];
        $oficioRef =$_POST['ofiReferencia'];
        $numOficio =$_POST['numOficio'];
        $respuesta =$_POST['respuesta'];
        $asunto =$_POST['asunto'];
        $descripcion =$_POST['descripcion'];
        $fechaElab =$_POST['fechaElaboracion'];
        $fechaSICT =$_POST['fechaRecibidoSICT'];

        if(checarFormInterno($destinatario, $remitente, $cargo, $unidad, $oficioRef, $numOficio, $asunto, $descripcion, $fechaElab, $fechaSICT)){
            $errores[] ="Llena TODOS los campos que esten activos.";
        }
        if(!destinatarioExiste($destinatario)){
            $errores[] ="El destinatario debe existir en la DB, elija uno de la lista sino agreguelo.";
        }
        if(!remitenteExiste($remitente)){
            $errores[] ="El remitente debe existir en la DB, elija uno de la lista sino agreguelo.";
        }
        if($remitente == $destinatario){
            $errores[] ="El remitente y el destinatario no pueden ser la misma persona.";
        }
        if($respuesta=='SI' && empty($fechaResp)){
            $errores[] ="Introduce una fecha de respuesta.";
            //if($fechaResp < $fechaElab && $fechaResp < $fechaSICT){
            //    $errores[] ="La fecha de respuesta no puede ser menor a la fecha de elaboracio y fecha de SICT.";
            //}
        }
        //con este if mandamos un boton de direccioanmiento por si hay un error
        if(count($errores)>0){
            $errores[]= "<br><a href='../oficios-internos.php' class='btn btn-danger btn-lg'>INTENTAR DE NUEVO</a>";
        }
        //se verifica que los campos esten llenos
        if(count($errores)==0){
            //si los errores son cero se prosigue a cargar el oficio y a guardar la info en la DB
            if($docOficio['error']>0 ){
                //mandamos un mensaje notificando que se envio el formulario sin cargar ningun oficio
                echo "<script>alert('ERROR No seleccionaste ningún archivo HDPM >:('); </script>";
                echo "<script>setTimeout(\"location.href='../oficios-internos.php'\",500); </script>";
            }
            else{
                //restringimos que solo queremos documentos con extension pdf
                $extension='application/pdf';
                if($docOficio['type']== $extension){
                    //creamos las carpetas necesarias para guardar el oficio
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
                    $urlDoc= $urlDir.$docOficio['name'];  //Se obtiene la url final para subir el oficio
                    //se compruaba que el oficio no exista en la carpeta del mes en curso
                    if(!file_exists($urlDoc)){
                        //usamos la url que generamos para mandar a guardar el oficio
                        $oficioUrl=@move_uploaded_file($docOficio['tmp_name'], $urlDoc);
                        //generamos una url mas limpia que se guardara en la DB sin hacer mención del directorio raiz 
                        $urlDB= 'oficios/'.$idUser.'/'.$anho.'/'.$mes.'/'.$docOficio['name'];
                        //al haber subido el oficio ahora registramos la informacion en la DB
                        uploadOficioIE($idUser, $caracter, $destId, $remId, $cargo, $unidad, $oficioRef, $numOficio, $respuesta, $asunto, $descripcion, $urlDB, $fechaElab, $fechaResp, $fechaSICT);
                        if($oficioUrl){
                            echo "<script>alert('¡El oficio se ha subido con éxito :)!'); </script>";
                            echo "<script>setTimeout(\"location.href='../oficios-internos.php'\",500); </script>";
                        }
                        else{
                            echo "<script>alert('¡El oficio no se pudo subir :(!'); </script>";
                            echo "<script>setTimeout(\"location.href='../oficios-internos.php'\",500); </script>";
                        }
                    }
                    else{
                        echo "<script>alert('Ya has subido este mismo oficio en este año y mes'); </script>";
                        echo "<script>setTimeout(\"location.href='../oficios-internos.php'\",500); </script>";
                    }
                }
                else{
                    echo "<script>alert('Extensión de archivo no permitida: Los oficios deben cargarse en PDF'); </script>";
                    echo "<script>setTimeout(\"location.href='../oficios-internos.php'\",500); </script>";
                }
            }

        }
        
        
    }
    echo listaErrores($errores);
    //echo $numOficio.'----'.$oficioRef;
?>
<link href="/favicon.ico" rel="shortcut icon">
    <link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
    