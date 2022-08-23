<?php
  include_once 'includes/DB_conection.php';
  include_once 'includes/consultas.php';

  //Agarramos el id que pasamos por la variable de sesion
  if(!isset($_SESSION['id_usuario'])){
    header('Location: index.php');
  }
  //Agarramos el id que pasamos por la url 
  //$idUsuario = $_GET['id'];
  //sql usuario con el id del url
  $sql = "SELECT usu_id FROM usuarios 
          WHERE usu_id =' " .$idUser."'";        
  $result = mysqli_query($DB_conection,$sql) or die(mysqli_close($DB_conection));
  $row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alta oficio interno</title>
    <!-- CSS -->
    <link rel="shortcut icon" href="favicon.ico"><link rel="icon"  href="favicon.ico" />
    <link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
    <style>


 .suggest-element {
    background-color: #EEEEEE;
    border-top: 1px solid #d6d4d4;
    cursor: pointer;
    padding: 5px;
    width: 93%;
    float: left;
    position: absolute;
    z-index: 9999;
    
  }

      </style>

    <!-- Respond.js soporte de media queries para Internet Explorer 8 -->
    <!-- ie8.js EventTarget para cada nodo en Internet Explorer 8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      
    <![endif]
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ie8/0.2.2/ie8.js"></script>  --->
    <!-- Llamda a archivo jquery -->
    <script src="js/jquery-3.6.0.min.js"></script>
  </head>
  
  <body>
   
    <hr class="red">
    <!-- Contenido -->
      <?php include_once 'header.php'; ?>
      
    <main class="container top-buffer">
      <div class="row clearfix"><!--row contentedor-->
        <form role="form" action="includes/reg-oficio.php" method="post" enctype="multipart/form-data" autocomplete="off" id="f-dest">
            <div class="row">           
              <div class="col-md-4">
                <div class="form-group">
                  <label for="remitente" class="control-label">Nombre Destinatario
                    <span class="asteriscoData form-text">*</span>
                  </label>
                  <input type="text" class="form-control"name="buscarDest" id="buscarDest" placeholder="Buscar...">
                  <!--En este div de muestran los destinatarios de la tabla destinatrios- en tiempo real-->
                  <div id="suggestions"></div>
                  <a class="btn btn-default" data-toggle="modal" data-target="#dest" title="Agregar nuevo destinatario">+ Destinatario</a>
                  <!--div donde se mostrara si el destinatario se agrego correctamente-->
                  <div class="msg-d"></div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="cargo" class="control-label">Cargo Destinatario
                    <span class="asteriscoData form-text">*</span>
                  </label>
                  <input type="text" class="form-control"name="buscarCar" id="buscarCar" placeholder="Buscar...">
                  <div id="suggestionsc"></div>
                  <a class="btn btn-default" data-toggle="modal" data-target="#cargo" title="Agregar nuevo cargo">+ Cargo</a>
                  <!--div donde se mostrara si el destinatario se agrego correctamente-->
                  <div class="msg-cc"></div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">      
                  <label for="unidad" class="control-label">Empresa/Unidad Destinatario
                    <span class="asteriscoData form-text">*</span>
                  </label>
                  <input type="text" class="form-control"name="buscarEmp" id="buscarEmp" placeholder="Buscar...">
                  <!--En este div de muestran los destinatarios de la tabla destinatrios- en tiempo real-->
                  <div id="suggestionsEmp"></div>
                  <a class="btn btn-default" data-toggle="modal" data-target="#emp" title="Agregar nueva empresa">+ Empresa</a>
                </div>
              </div>
            </div>
                 
            <div class="row">
              <div class="col-md-4 ">
                <div class="form-group" id="nombre_ft1">
                  <label for="remitente" class="control-label">Nombre Remitente
                    <span class="asteriscoData form-text">*</span>
                  </label>
                  <input type="text" class="form-control"name="buscarRem" id="buscarRem" placeholder="Buscar...">
                  <!--En este div de muestran los destinatarios de la tabla destinatrios- en tiempo real-->
                  <div id="suggestionsR"></div>
                  <a class="btn btn-default" data-toggle="modal" data-target="#remitente" title="Agregar nuevo destinatario">+ Remitente</a>
                  <div class="msg-r"></div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                <label for="cargos" class="control-label">Cargo Remitente
                  <span class="asteriscoData form-text">*</span>
                </label>
                <input type="text" class="form-control"name="buscarCarEx" id="buscarCarEx" placeholder="Buscar...">
                <div id="suggestionsEx"></div>
                <a class="btn btn-default" data-toggle="modal" data-target="#cargo" title="Agregar nuevo cargo">+ Cargo</a>
                  <!--div donde se mostrara si el destinatario se agrego correctamente-->
                <div class="msg-c"></div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">      
                  <label for="unidad" class="control-label">Empresa/Unidad Remitente
                    <span class="asteriscoData form-text">*</span>
                  </label>
                  <input type="text" class="form-control"name="buscarEmpEx" id="buscarEmpEx" placeholder="Buscar...">
                  <!--En este div de muestran los destinatarios de la tabla destinatrios- en tiempo real-->
                  <div id="suggestionsEmpEx"></div>
                  <a class="btn btn-default" data-toggle="modal" data-target="#emp" title="Agregar nueva empresa">+ Empresa</a>
                  <div class="msg-emp"></div>
                </div>
              </div>
            </div>
             
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="calendar" class="control-label">Fecha de elaboración:
                    <span class="asteriscoData form-text">*</span>
                  </label>
                  <input id="FechaElaborado" type="date" class="form-control" name="fechaElaboracion">
                  <small class="smallDatos form-text form-text-error hide" aria-live="polite"> Este campo es obligatorio
                  </small>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="calendar" class="control-label">Fecha recepcion
                    <span class="asteriscoData form-text">*</span>
                  </label>
                  <input id="FechaRecibidoSICT" type="date" class="form-control" name="fechaRecepcion">
                  <small class="smallDatos form-text form-text-error hide" aria-live="polite"> Este campo es obligatorio
                  </small>
                </div>
              </div>
                                 
              <div class="col-md-4">
                <div class="form-group">
                  <label for="asunto" class="control-label">Asunto
                    <span class="asteriscoData form-text">*</span>
                  </label>
                  <input type="text" id="asunto" palceholder="asunto" class="form-control" name="asunto">
                  <small class="smallDatos form-text form-text-error hide" aria-live="polite"> Este campo es obligatorio
                  </small>
                </div>
              </div>
            </div>

            <div class="row">                    
              <div class="col-md-4">
                <div class="form-group">
                  <label for="asunto" class="control-label">Subir archivo
                    <span class="asteriscoData form-text">*</span>
                  </label>
               
                  <input  type="file" class="form-control" name="archivoOficio[]" multiple>
               
                  <small class="smallDatos form-text form-text-error hide" aria-live="polite"> Este campo es obligatorio
                  </small>
                </div>
              </div>
                                
              <div class="col-md-8">
                <div class="form-group">
                  <label for="" class="control-label">Observación
                    <span class="asteriscoData form-text">*</span>
                  </label>
                  <textarea class="form-control" rows="3"name="descripcion" Value=""></textarea>
                </div>
              </div>
            </div>

            <div class="row"> 
              <div class="col-md-6 col-md-6" >
                <div class="form-group">
                  <button class="btn btn-primary active pull-right" type="submit" name="submit" class="btn-success"><span class="glyphicon glyphicon-cloud-upload"></span> Registrar Oficio</button> 
                </div>
              </div>
            </div>

          </form>
      </div><!-- fin row contentedor-->      
    </main>

    <div class="bottom-buffer"></div>

    <!-- ventanas modales para los remitentes destinatarios empresas y oficios-->
    <?php include_once 'popup.php'; ?>
    <!-- JS -->
    <!-- Contenido   <script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>  -->
    <script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>
    <!-- script para mostrar destinatarios y remitentes en tiempo real-->
    <script src="js/rem-des.js"></script> 
  </body>
</html>