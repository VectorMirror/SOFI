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
    <style>
      .extDoc{
        padding-left: 2rem;
      }
      .extDoc img{     
        width: 58px;
        height: 58px;
        border-radius: 50%;
        border: 0px solid #13322B;
        margin: 0 0 0 -2rem;
      }
    </style>

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
    <h3> Bienvenido <?php echo ucwords(strtolower($user['usu_nombre'].' '.$user['usu_apellidoP']. ' '.$user['usu_apellidoM'])); ?></h3>
<hr class="red">

<main>
    <h4>Últimos Oficios Registrados</h4>
    <hr class="red">
    <div class="row">
      <?php
        foreach($lastOfi as $documento){
          $html ='<div class="col-md-4 bottom-buffer">';
          $mUrl = substr($documento['ofi_url'], 1);
          $arrUrl = explode(',', $mUrl);
          foreach ($arrUrl as $anexoFile){
            $ext= pathinfo($anexoFile, PATHINFO_EXTENSION);
            $html .='
            <a href="'.$anexoFile.'" target="_blank"><img src="img/'.$ext.'.png"></a>';
           } 
           $html .='<br>
            <b>Fecha Elaboracion: </b>'.$documento['ofi_fechaE'].'<br>
            <b>Fecha Registro SOFI: </b>'.$documento['ofi_fechaSOFI'].'<br>
            <b>Asunto: </b>'.$documento['ofi_asunto'].'<br>
          </div>';
          echo $html;
        }
      ?>
    </div>
    
     <script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>
     <script type="text/javascript" src="js/buscar.js"></script>
  </body>
</html>