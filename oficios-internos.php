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
    <link href="/favicon.ico" rel="shortcut icon">
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
    <h3>Subir oficio interno</h3>
    <hr class="red">
    <!-- Contenido -->
      <?php include_once 'header.php'; ?>

    <h3>Subir oficio interno</h3>
    <hr class="red">
    <main>
      <div class="row clearfix"><!--row contentedor-->
        <div class="col-md-8"><!-- contetnedor general col-md8-->
        <ol class="bottom-buffer top-buffer">
        <!--se crean los titulos de las tabs-->
        <ul class="nav nav-tabs">
          <li><a data-toggle="tab" href="#tab-01">Destinatario(entrada)</a></li>
          <li><a data-toggle="tab" href="#tab-02">Remitente(salida)</a></li>
        </ul>
        <!--contenedor del contenido de las tabs-->
        <div class="tab-content">
          <!--Tab 00 Resumen-->
          <div class="tab-pane active" id="tab-00">
            <div class="row">
              <div class="col-md-12 col-xs-12">
                <div class="form-group">
                  <label for="datos" class="control-label">Tipo oficio
                  </label>
                  <br>
                  <ul class="list-unstyled">
                    Las siguiente Información nos muetra las opciones para poder subir un oficio.
                  </ul>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 col-xs-12">
                <div class="form-group">
                  <label for="datos" class="control-label">Interno
                  </label>
                  <ul class="list-unstyled">
                    <li>  -Destinatario</li>
                    <p>Cuando un oficio es dirigido al área de la UTIC  por parte de
                      otra área, unidad, departamento de la SICT (entrada)</p>
                    <br>
                    <li>-Remitente</li>
                    <p>Cuando un oficio es dirigido a una área, unidad, departamento de la SICT
                      por parte del área UTIC (salida)</p>
                  </ul>
                </div>
              </div>

              <div class="col-md-6 col-xs-12">
                <div class="form-group">
                <label for="datos" class="control-label">Externo
                  </label>
                  <ul class="list-unstyled">
                    <li>  -Destinatario</li>
                    <p>Cuando un oficio es dirigido al área de la UTIC  por parte de
                      una empresa AJENA a la SICT(entrada)</p>
                    <br>
                    <li>  -Remitente</li>
                    <p>Cuando un oficio es dirigido a una área, unidad, departamento de la SICT
                       por parte de una empresa AJENA a la SICT (salida)</p>
                  </ul>
                </div>
              </div>
            </div>
          </div><!--fin tab-00 REsumen--->

          <!--Tab-01 Interno-->
          <div class="tab-pane" id="tab-01">
            <form role="form" action="includes/interno-entrada.php" method="post" enctype="multipart/form-data" autocomplete="off" id="f-dest">
              <div class="row">
                <h4>Datos del Destinatario</h4>
                <hr class="red">
                <div class="col-md-6 col-xs-12">
                  <div class="form-group">
                    <label for="remitente" class="control-label">Nombre
                      <span class="asteriscoData form-text">*</span>
                    </label>
                    <input type="text" class="form-control"name="buscarDest" id="buscarDest" placeholder="Buscar...">
                    <!--En este div de muestran los destinatarios de la tabla destinatrios- en tiempo real-->
                    <div id="suggestions"></div>
                    <a class="btn btn-primary" data-toggle="modal" data-target="#dest" title="Agregar nuevo destinatario">+ Destinatario</a>
                  </div>
                </div>             
              </div>
              <!--div donde se mostrara si el destinatario se agrego correctamente-->
              <div class="msg-d"></div>

              <div class="row">
                <h4>Datos del Remitente</h4>
                <hr class="red">
                <div class="col-md-6 col-xs-12">
                  <div class="form-group" id="nombre_ft1">
                    <label for="remitente" class="control-label">Nombre
                      <span class="asteriscoData form-text">*</span>
                    </label>
                    <input type="text" class="form-control"name="buscarRem" id="buscarRem" placeholder="Buscar...">
                    <!--En este div de muestran los destinatarios de la tabla destinatrios- en tiempo real-->
                    <div id="suggestionsR"></div>
                    <a class="btn btn-primary" data-toggle="modal" data-target="#remitente" title="Agregar nuevo destinatario">+ Remitente</a>
                  </div>
                </div>

                <div class="col-md-6 col-xs-12">
                  <div class="form-group">
                  <label for="cargo" class="control-label">Cargo
                    <span class="asteriscoData form-text">*</span>
                  </label>
                  <select class="form-control " name="cargo">
                  <?php
                    foreach($cargos as $cargo){
                      echo"
                          <option value=".$cargo['cargo_id'].">".$cargo['cargo_cargo']. "</option>
                      ";
                    }
                  ?>
                  </select>
                  <small class="smallDatos form-text form-text-error hide" aria-live="polite"> Este campo es obligatorio
                  </small>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 col-xs-12">
                  <div class="form-group">
                    <label for="unidad" class="control-label">Unidad
                      <span class="asteriscoData form-text">*</span>
                    </label>
                    <select name="unidad" class="form-control form-selected select small">
                      <option value disabled selected>Seleciona la unidad</option>
                        <?php
                            foreach($unidades as $unidad){
                              echo"
                                  <option value=".$unidad['uni_id'].">".$unidad['uni_unidad']. "</option>
                                ";
                            }
                        ?>
                    </select>
                    <small class="smallDatos form-text form-text-error hide" aria-live="polite"> Este campo es obligatorio
                   </small>
                  </div>
                </div>
              </div>
              <!--div donde se mostrara si el remitente se agrego correctamente-->
              <div class="msg-r"></div>

              <div class="row">
                <h4>Datos del Oficio</h4>
                <hr class="red">
                <div class="col-md-6 col-xs-12">
                  <div class="form-group">
                    <label for="oficio" class="control-label">Número de oficio
                      <span class="asteriscoData form-text">*</span>
                    </label>
                    <input type="text" class="form-control"name="numOficio" id="numOficio" placeholder="Número de oficio">
                  </div>
                </div>

                <div class="col-md-6 col-xs-12">
                  <div class="form-group">
                    <label for="calendar" class="control-label">Fecha de elaboración:
                      <span class="asteriscoData form-text">*</span>
                    </label>
                    <input id="calendarioFechaElaboradoInternoDestinatarioEntrada" type="date" class="form-control" name="fechaElaboracion">
                    <small class="smallDatos form-text form-text-error hide" aria-live="polite"> Este campo es obligatorio
                    </small>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 col-xs-12">
                  <div class="form-group">
                    <label for="oficioReferencia1" class="control-label">Oficio Referencia
                      <span class="asteriscoData form-text">*</span>
                    </label>                    
                    <input type="text" class="form-control"name="ofiReferencia" id="ofiReferencia" placeholder="Oficio de referencia">
                  </div>
                </div>

                <div class="col-md-6 col-xs-12">
                  <div class="form-group">
                    <label for="calendar" class="control-label">Fecha recibido por la SICT (Dora)
                      <span class="asteriscoData form-text">*</span>
                    </label>
                    <input id="calendarioFechaRecibidoSICTInternoDestinatarioEntrada" type="date" class="form-control" name="fechaRecibidoSICT">
                    <small class="smallDatos form-text form-text-error hide" aria-live="polite"> Este campo es obligatorio
                    </small>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 col-xs-12">
                  <div class="form-group">
                    <label for="calendar" class="control-label">¿El oficio necesita respuesta?
                      <span class="asteriscoData form-text">*</span>
                    </label>
                    <div class="radio">
                      <label>
                        <input type="radio" value="SI" name="respuesta" class="ocultar" checked="checked">Si
                      </label>
                      <label>
                        <input type="radio" value="NO" name="respuesta" class="ocultar">No
                      </label>
                    </div>
                    <small class="smallDatos form-text form-text-error hide" aria-live="polite"> Este campo es obligatorio
                    </small>
                  </div>
                </div>

                <div class="col-md-6 col-xs-12">
                  <div class="form-group date-resp">
                    <label for="calendar" class="control-label">Fecha de respuesta
                      <span class="asteriscoData form-text">*</span>
                    </label>
                    <input id="calendarioFechaRespuestaInternoDestinatarioEntrada" type="date"class="form-control" name="fechaRespuesta">
                    <small class="smallDatos form-text form-text-error hide" aria-live="polite"> Este campo es obligatorio
                    </small>
                  </div>
                </div>
              </div>

              <div class="row">                    
                <div class="col-md-6 col-xs-12">
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
                <div class="col-md-12 col-xs-12">
                  <div class="form-group">
                    <label for="asunto" class="control-label">Subir archivo
                      <span class="asteriscoData form-text">*</span>
                    </label>
                    <input  type="file" class="form-control" name="archivoOficio">
                    <small class="smallDatos form-text form-text-error hide" aria-live="polite"> Este campo es obligatorio
                    </small>
                  </div>
                </div>
              </div>

              <div class="row">                    
                <div class="col-md-12 col-xs-12">
                  <div class="form-group">
                    <label for="" class="control-label">Breve Descripción
                      <span class="asteriscoData form-text">*</span>
                    </label>
                    <textarea class="form-control" rows="3"name="descripcion" Value=""></textarea>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 col-xs-12">
                  <div class="form-group">
                    <button class="btn btn-primary pull-right" type="submit" name="submit" class="btn-success">Enviar</button> 
                  </div>
                </div>
            </div>
            </form>
          </div><!--fin tab-01 Interno--->

          <!--Tab-02 Externo-->
          <div class="tab-pane" id="tab-02">
          <form role="form" action="includes/interno-salida.php" method="post" enctype="multipart/form-data" autocomplete="off">
              <div class="row">
                <h4>Datos del Remitente</h4>
                <hr class="red">
                <div class="col-md-6 col-xs-12">
                  <div class="form-group">
                    <label for="remitente" class="control-label">Nombre
                      <span class="asteriscoData form-text">*</span>
                    </label>
                    <input type="text" class="form-control"name="buscarRemEx" id="buscarRemEx" placeholder="Buscar...">
                    <!--En este div de muestran los destinatarios de la tabla destinatrios- en tiempo real-->
                    <div id="suggestionsExR"></div>
                    <a class="btn btn-primary" data-toggle="modal" data-target="#remitente" title="Agregar nuevo remitente">+ Remitente</a>
                    
                  </div>
                </div>
              </div>
              <!--div donde se mostrara si el remitente se agrego correctamente-->
              <div class="msg-r"></div>

              <div class="row">
                <h4>Datos del Destinatario</h4>
                <hr class="red">
                <div class="col-md-6 col-xs-12">
                  <div class="form-group" id="nombre_ft1">
                    <label for="remitente" class="control-label">Nombre
                      <span class="asteriscoData form-text">*</span>
                    </label>
                    <input type="text" class="form-control"name="buscarDestEx" id="buscarDestEx" placeholder="Buscar...">
                    <!--En este div de muestran los destinatarios de la tabla destinatrios- en tiempo real-->
                    <div id="suggestionsExD"></div>
                    <a class="btn btn-primary" data-toggle="modal" data-target="#dest" title="Agregar nuevo destinatario">+ Destinatario</a>
                  </div>
                </div>

                <div class="col-md-6 col-xs-12">
                  <div class="form-group">
                  <label for="cargo" class="control-label">Cargo
                    <span class="asteriscoData form-text">*</span>
                  </label>
                  <select class="form-control " name="cargoR">
                  <?php
                    foreach($cargos as $cargo){
                      echo"
                          <option value=".$cargo['cargo_id'].">".$cargo['cargo_cargo']. "</option>
                      ";
                    }
                  ?>
                  </select>
                  <small class="smallDatos form-text form-text-error hide" aria-live="polite"> Este campo es obligatorio
                  </small>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 col-xs-12">
                  <div class="form-group">
                    <label for="unidad" class="control-label">Unidad
                      <span class="asteriscoData form-text">*</span>
                    </label>
                    <select name="unidadR" class="form-control form-selected select small">
                      <option value disabled selected>Seleciona la unidad</option>
                      <?php
                      foreach($unidades as $unidad){
                        echo"
                            <option value=".$unidad['uni_id'].">".$unidad['uni_unidad']. "</option>
                        ";
                      }
                    ?>
                    </select>
                    
                  </div>
                </div>
              </div>
              <!--div donde se mostrara si el destinatario se agrego correctamente-->
              <div class="msg-d"></div>

              <div class="row">
                <h4>Datos del Oficio</h4>
                <hr class="red">
                <div class="col-md-6 col-xs-12">
                  <div class="form-group">
                    <label for="oficio" class="control-label">Número de oficio
                      <span class="asteriscoData form-text">*</span>
                    </label>
                    <input type="text" class="form-control"name="buscarNumeroOfEx" id="buscarNumeroOfEx" placeholder="Número de oficio">
                  </div>
                </div>

                <div class="col-md-6 col-xs-12">
                  <div class="form-group">
                    <label for="calendar" class="control-label">Fecha de elaboración:
                      <span class="asteriscoData form-text">*</span>
                    </label>
                    <input id="calendarioFechaElaboradoInternoRemitenteSalida" type="date" class="form-control" name="fechaElaboracionR">
                    <small class="smallDatos form-text form-text-error hide" aria-live="polite"> Este campo es obligatorio
                    </small>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 col-xs-12">
                  <div class="form-group">
                    <label for="oficioReferencia1" class="control-label">Oficio Referencia
                      <span class="asteriscoData form-text">*</span>
                    </label>
                    <input type="text" class="form-control"name="buscarOficioRefEx" id="buscarOficioRefEx" placeholder="Oficio de referencia">
                  </div>
                </div>

                <div class="col-md-6 col-xs-12">
                  <div class="form-group">
                    <label for="asunto" class="control-label">Asunto
                      <span class="asteriscoData form-text">*</span>
                    </label>
                    <input type="text" id="asunto" palceholder="asunto" class="form-control" name="asuntoR">
                    <small class="smallDatos form-text form-text-error hide" aria-live="polite"> Este campo es obligatorio
                    </small>
                  </div>
                </div>            
              </div>

              <div class="row">                    
                <div class="col-md-12 col-xs-12">
                  <div class="form-group">
                    <label for="asunto" class="control-label">Subir archivo
                      <span class="asteriscoData form-text">*</span>
                    </label>
                    <input  type="file" class="form-control" name="archivoOficioR">
                    <small class="smallDatos form-text form-text-error hide" aria-live="polite"> Este campo es obligatorio
                    </small>
                  </div>
                </div>
              </div>

              <div class="row">                    
                <div class="col-md-12 col-xs-12">
                  <div class="form-group">
                    <label for="" class="control-label">Breve Descripción
                      <span class="asteriscoData form-text">*</span>
                    </label>
                    <textarea class="form-control" rows="3"name="descripcionR" Value=""></textarea>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 col-xs-12">
                  <div class="form-group">
                    <button class="btn btn-primary pull-right" type="submit" name="submit" class="btn-success">Enviar</button> 
                  </div>
                </div>
            </div>
            </form>    
          </div><!--fin tab-02 Enterno--->
        </div><!-- fin tab-content-->
        </ol>
        </div><!--fin contetnedor general col-md8-->
      </div><!-- fin row contentedor-->
       
    </main>

<!-- ventanas modales para los remitentes destinatarios empresas y oficios-->
<?php include_once 'popup.php'; ?>
<!-- JS -->
    
     <!-- Contenido   <script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>  -->
     <script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>
     <!-- script para mostrar destinatarios y remitentes en tiempo real-->
     <script src="js/rem-des.js"></script>
     
  </body>
</html>