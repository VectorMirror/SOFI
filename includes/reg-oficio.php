<?php
    session_start();
    include_once 'DB_conection.php';
    include_once 'funciones.php';

    $idUser = $_SESSION['id_usuario'];
    $errores = array();
    $urlDB = '';
    //variables para conseguir año y mes y hacer directorios
    $anho=strftime('%Y');
    $mes= ['ene','feb','mar','abr','may','jun','jul','ago','sep','oct','nov','dic'][date('n')-1];

    //restringimos que solo queremos documentos con extension pdf
    $extension = array('application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.openxmlformats-officedocument.presentationml.presentation');
    //convertir bytes a Unidades de almacenamiento de archivo
    $TB = pow(1024, 4);  // = 1TB en bytes
    $GB = pow(1024, 3);  // = 1GB en bytes
    $MB = pow(1024, 2);  // = 1MB en bytes
    //ponemos el limite máximo que debe pesar cada archivo en MB
    $docSize= $MB * 5;

    //Si los campos que cargan los id llegan vacios les damos un valor 0 para evitar que aparezca el error de variable idefinida
    if(empty($_POST['destId'])){
        $_POST['destId']=0;
    }
    if(empty($_POST['cargoId'])){
        $_POST['cargoId']=0;
    }
    if(empty($_POST['empD'])){
        $_POST['empD']=0;
    }
    if(empty($_POST['remId'])){
        $_POST['remId']=0;
    }
    if(empty($_POST['cargoR'])){
        $_POST['cargoR']=0;
    }
    if(empty($_POST['empR'])){
        $_POST['empR']=0;
    }
    
    //recibimos por POST los input hidden que tienen los id de los registros que se usan en los formularios para poder guardar la info en la DB
    $destId=$DB_conection->real_escape_string($_POST['destId']);
    $cargoD=$DB_conection->real_escape_string($_POST['cargoId']);
    $unidadD=$DB_conection->real_escape_string($_POST['empD']);
    $remId=$DB_conection->real_escape_string($_POST['remId']);
    $cargoR=$DB_conection->real_escape_string($_POST['cargoR']);
    $unidadR=$DB_conection->real_escape_string($_POST['empR']);
    

    if(!empty($_POST)){
        $destinatario =$_POST['buscarDest'];
        $cargoIdDest =$_POST['buscarCar'];
        $unidadIdDest =$_POST['buscarEmp'];
        $remitente =$_POST['buscarRem'];
        $cargoIdRem =$_POST['buscarCarEx'];
        $unidadIdRem =$_POST['buscarEmpEx'];
        $asunto =$_POST['asunto'];
        $descripcion =$_POST['descripcion'];
        $fechaElab =$_POST['fechaElaboracion'];
        $fechaSICT =$_POST['fechaRecepcion'];

        if(checarFormInterno($destinatario, $remitente, $cargoIdDest, $unidadIdDest,$cargoIdRem,$unidadIdRem,$asunto, $descripcion, $fechaElab, $fechaSICT)){
            $errores[] ="Llena TODOS los campos que esten activos.";
        }
        if(!destinatarioExiste($destinatario)){
            $errores[] ="El destinatario debe existir en la DB, elija uno de la lista o agreguelo.";
        }
        if(!remitenteExiste($remitente)){
            $errores[] ="El remitente debe existir en la DB, elija uno de la lista o agreguelo.";
        }
        if($remitente == $destinatario){
            $errores[] ="El remitente y el destinatario no pueden ser la misma persona.";
        }
        if(empty($fechaElab)){
            $errores[] ="El oficio debe de llevar fecha de elaboración.";
        }
        if(empty($fechaSICT)){
            $errores[] ="El oficio debe de llevar fecha de recepción.";
        }
     
        //con este if mandamos un boton de direccioanmiento por si hay un error
        if(count($errores)>0){
            $errores[]= "<br><a href='../subir-oficio-nuevo.php' class='btn btn-danger btn-lg'>INTENTAR DE NUEVO</a>";
        }
        //se verifica que los campos esten llenos
        if(count($errores)==0){
            //si los errores son cero se prosigue a verificar los documentos que se estan subiendo
            //verificamos los archivos y evitamos que suba cualquier documento si alguno pesa mas de 50MB
            foreach ($_FILES['archivoOficio']['tmp_name'] as $key => $value){
                if($_FILES['archivoOficio']['size'][$key] > $docSize){
                    echo "<script>alert('El oficio no puede pesar más de 50MB ●︿●'); </script>";
                    echo "<script>setTimeout(\"location.href='../subir-oficio-nuevo.php'\",500); </script>";
                    exit();
                }
            }
            //volvemos a recorrer el $_files ahora para guardar el oficio
            foreach ($_FILES['archivoOficio']['tmp_name'] as $key => $value){
                //Validamos que el archivo exista
                if($_FILES['archivoOficio']['error'][$key]>0 ){
                    //mandamos un mensaje notificando que se envio el formulario sin cargar ningun oficio
                    echo "<script>alert('ERROR No seleccionaste ningún archivo HDPM >:('); </script>";
                    echo "<script>setTimeout(\"location.href='../subir-oficio-nuevo.php'\",500); </script>";
                    exit();
                }
                if(in_array($_FILES['archivoOficio']['type'][$key], $extension)){  
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
                    $fecha = date('d-m-y'); 
                    $random = rand(99999, 999999999);
                    //Extraemos la extension del oficio
                    $ext = pathinfo($_FILES['archivoOficio']['name'][$key], PATHINFO_EXTENSION);
                    $urlDoc =$urlDir.$fecha.'_'.$random.'.'.$ext;

                    if(!file_exists($urlDoc)){
                        $oficioUrl=@move_uploaded_file($_FILES['archivoOficio']['tmp_name'][$key], $urlDoc);    
                        $urlDB .= ',oficios/'.$idUser.'/'.$anho.'/'.$mes.'/'.$fecha.'_'.$random.'.'.$ext;
                        
                    }
                }
                else{
                    echo "<script>alert('Extensión no valida: Solo se aceptan archivos de Word, Excel, Power Point o PDF'); </script>";
                    echo "<script>setTimeout(\"location.href='../subir-oficio-nuevo.php'\",500); </script>";
                    exit();               
                }
            } //fin Foreach
                
            if($oficioUrl){
                uploadOficioIE($idUser,  $destId, $cargoD, $unidadD, $remId, $cargoR, $unidadR, $asunto, $descripcion, $urlDB, $fechaElab,  $fechaSICT);
                echo "<script>alert('¡El oficio se ha subido con éxito :)!'); </script>";
                echo "<script>setTimeout(\"location.href='../lista-oficios.php'\",500); </script>";
            }
            else{
                echo "<script>alert('¡El oficio no se pudo subir :(!'); </script>";
                echo "<script>setTimeout(\"location.href='../subir-oficio-nuevo.php'\",500); </script>";
            }
        }    
    }
    echo listaErrores($errores);
    //echo $urlDoc;
?>
<link href="/favicon.ico" rel="shortcut icon">
    <link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">