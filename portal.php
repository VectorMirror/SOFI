<?php
    require_once 'includes/DB_conection.php';
    require_once 'includes/funciones.php';
    require_once 'includes/consultas.php';

    if(!isset($_SESSION['id_usuario'])){
        header('Location: index.php');
    }
   
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>.:PORTAL SOFI:.</title>

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
  
  <h3> Bienvenido </h3>
<hr class="red">
    <!-- Contenido -->
    <?php include_once 'header.php'; ?>
<main class="container">
    <h3> Bienvenido <?php echo $user['usu_nombre'].' '.$user['usu_apellidoP']. ' '.$user['usu_apellidoM']; ?></h3>
<hr class="red">

<main>
    <h4>Ultimos Oficios Registrados</h4>
    <hr class="red">
    <div class="row">
      <?php
        foreach($lastOfi as $documento){
          echo'
          <div class="col-md-4 bottom-buffer">
            <a href="'.$documento['ofi_url'].'" target="_blank"><img src="img/pdf.png" width="58px" height="58px"></a> <br>
            <b>Caracter:</b>"'.$documento['ofi_caracter'].'"<br>
            <b>Fecha Elaboracion:</b>"'.$documento['ofi_fechaE'].'"<br>
            <b>Fecha Registro SOFI:</b>"'.$documento['ofi_fechaSOFI'].'"<br>
            <b>Asunto:</b>"'.$documento['ofi_asunto'].'"<br>
          </div>';
        }
      ?>
    </div>
    
     <script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>

  </body>
</html>