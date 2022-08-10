<?php
  include_once 'includes/DB_conection.php';
  include_once 'includes/consultas.php';

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
    <title>LISTA DE OFICIOS</title>
    <!-- CSS -->
    <link href="/favicon.ico" rel="shortcut icon">
    <link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
    <script src="js/jquery-3.6.0.min.js"> </script>

    <!-- Respond.js soporte de media queries para Internet Explorer 8 -->
    <!-- ie8.js EventTarget para cada nodo en Internet Explorer 8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/ie8/0.2.2/ie8.js"></script>
    <![endif]-->
    <script>
        $(document).ready(function(){
            $("#filtroBusqueda").change(function () {
			        idB= $(this).val();
			        $.post(idB, { idB: idB }, function(data){
			          $("#content-table").html(data);
			        }); 
            }); 
        });         
    </script>

  </head>
  <body>
      

<h3>Lista de Oficios</h3>
<hr class="red">
    <!-- Contenido -->

  <?php include_once 'header.php';?>
 <div class="container"> 
<h3>Lista de Oficios</h3>
<hr class="red">
      </div>
  <!--<div class="row">
            <td>
              <a href="form_crea_usuario.php" class="btn btn-link">Nuevo usuario</a>
            </td>
  </div>-->
<div class="row">
  <div class="col-md-3">
  </div>
  <div class="col-md-4">
  
  </div>
  <div class="col-md-3"><label></label>
    <select class="form-control" id="filtroBusqueda">
      <option selected="true" disabled="disabled" value="">Seleciona una categoria</option>
      <option value="includes/buscar-IE.php" id="op1">Oficios Internos de Entrada</option>
      <option value="includes/busqueda-oficios-internos-salida.php" id="op2">Oficios Internos de Salida</option>
      <option value="includes/busqueda-oficios-externos-entrada.php" id="op3">Oficios Externos de Entrada</option>
      <option value="includes/busqueda-oficios-externos-salida.php" id="op4">Oficios Externos de Salida</option>
    </select>
  </div>
</div>
    

<div id="content-table">

</div>

</div>   
    </main>
<div class="top-buffer bottom-buffer"></div>
    <!-- JS -->
    
     <!-- Contenido   <script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>  -->
     <script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>
     
  </body>
</html>


