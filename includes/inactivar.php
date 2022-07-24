<?php
    #script de validacion de datos para registro de usuarios
    session_start();
    include_once 'DB_conection.php';
    require_once 'crudUsers.php';
    #require 'includes/posting.php';

    //if(!isset($_SESSION['id_usuario'])){
    //    header('Location: index.php');
    //}

    $idEmpleado = $_GET['id'];

    if(isset($idEmpleado)){
        inactivaUsuario($idEmpleado);
    }

    //if(isset($idEmpleado)){
    //  activaUsuario($idEmpleado);
  //}
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <!-- CSS -->
    <link href="/favicon.ico" rel="shortcut icon">
    <link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">

    <!-- Respond.js soporte de media queries para Internet Explorer 8 -->
    <!-- ie8.js EventTarget para cada nodo en Internet Explorer 8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/ie8/0.2.2/ie8.js"></script>
    <![endif]-->

    
  </head>
  
  <body>
  <h3>Gestion de cuentas de Usuario</h3>
    <hr class="red">

    
<!-- JS -->
    
     <!-- Contenido   <script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>  -->
     <script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>
  </body>
</html>
