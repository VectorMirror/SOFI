<?php
  include_once 'includes/DB_conection.php';
  include_once 'includes/funciones.php';
  include_once 'includes/crudUsers.php';
  include_once 'includes/consultas.php';
  
  if(!isset($_SESSION['id_usuario'])){
    header('Location: index.php');
  }
  
  
  $errores = array();
    if(!empty($_POST)){
      $nombre = $DB_conection->real_escape_string(strtoupper($_POST['nombre']));
      $apellido_p = $DB_conection->real_escape_string(strtoupper($_POST['apellido_p']));
      $apellido_m = $DB_conection->real_escape_string(strtoupper($_POST['apellido_m']));
      $correo = $DB_conection->real_escape_string($_POST['correo']);
      $password = $DB_conection->real_escape_string($_POST['contrasena']);
      $password01 = $DB_conection->real_escape_string($_POST['contrasena01']);
      $cargo = $DB_conection->real_escape_string($_POST['adscripcion']);
      $unidad = $DB_conection->real_escape_string($_POST['unidad']);
      $rol = $DB_conection->real_escape_string($_POST['rol']);
    
      if(checarDatos($nombre, $apellido_p, $apellido_m, $correo)){
        $errores[] ="Llena TODOS los campos";
      }
    
      if(longPass($password, $password01)){
        $errores[] ="La contraseña debe tener minimo 8 caracteres";
      }
      
      if(!esMail($correo)){
        $errores[] ="El E-mail no es valido";
      } 
      
      if(!validarPass($password, $password01)){
        $errores[] ="Las contraseñas no son iguales";
      }
    
      if(mailExiste($correo)){
        $errores[] ="El correo que ingresaste ya esta registrado";
      }
    
    
      if(count($errores)==0){    
        $passDB = md5($password);
        $crearUsuario = creaUsuario($nombre, $apellido_p, $apellido_m, $correo, $cargo, $unidad, $rol, $passDB);
        if($crearUsuario>0){
          echo $nombre. ' '.$apellido_p. ' '.$apellido_m. " ha sido registrado correctamente"."<br>";
          echo"<a href='index.php'> Iniciar Sesion </a>";
          exit; 
        }
        else{
          $errores[] = 'No se ha podido registrar al usuario :(';
        }
      }    
    }
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nuevo Usuario</title>


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
   
<h3>Registrar nuevo usuario</h3>
<hr class="red">
    <!-- Contenido -->

    <?php include_once 'header.php'; ?>
    <main class="container"> 
    <h3>Registrar nuevo usuario</h3>
<hr class="red">

    <div class="row ">
      <div class="col-md-9">
        <ol class="bottom-buffer top-buffer">
      <div class="tab-pane clearfix " id="tab-01">
          
          <form role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="row">
              <div class="col-md-6 col-xs-12">
                <div class="form-group">
                  <label for="nombre" class="control-label">Nombre
                    <span class="asteriscoData form-text">*</span>
                  </label>
                  <input id="nombre" type="text"
                  class="campos form-control ember-text-field ember-view" name="nombre">
                  <small class="smallDatos form-text form-text-error hide" aria-live="polite"> Este campo es obligatorio
                  </small>
                </div>
              </div>
              <div class="col-md-6 col-xs-12">
                <div class="form-group">
                  <label for="apeliidoPaterno" class="control-label">Apellido Paterno
                    <span class="asteriscoData form-text">*</span>
                  </label>
                  <input id="elaboracion" type="text" class="campos form-control ember-text-field ember-view" name="apellido_p">
                  <small class="smallDatos form-text form-text-error hide" aria-live="polite"> Este campo es obligatorio
                  </small>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-xs-12">
                <div class="form-group">
                  <label for="apellidoMaterno" class="control-label">Apellido Materno
                    <span class="asteriscoData form-text">*</span>
                  </label>
                  <input id="apellido_m" type="text" class="campos form-control ember-text-field ember-view" name="apellido_m">
                  <small class="smallDatos form-text form-text-error hide" aria-live="polite"> Este campo es obligatorio
                  </small>
                </div>
              </div>
              <div class="col-md-6 col-xs-12">
                <div class="form-group">
                  <label for="correo" class="control-label">Correo
                    <span class="asteriscoData form-text">*</span>
                  </label>
                  <input id="correo" type="text" class="campos form-control ember-text-field ember-view" name="correo">
                  <small class="smallDatos form-text form-text-error hide" aria-live="polite"> Este campo es obligatorio
                  </small>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-xs-12">
                <div class="form-group">
                  <label for="adscripcion" class="control-label">Cargo
                    <span class="asteriscoData form-text">*</span>
                  </label>
                  <select class="campos form-control ember-text-field ember-view" name="adscripcion">
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

              <div class="col-md-6 col-xs-12">
                <div class="form-group">
                  <label for="unidad" class="control-label">Unidad
                    <span class="asteriscoData form-text">*</span>
                  </label>
                  <select name="unidad" class="campos form-control form-selected select small">
                    <!--option selected="true" disabled="disabled" value="">Seleciona la unidad</option>-->
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

            <div class="row">
              

              <div class="col-md-6 col-xs-12">
                <div class="form-group">
                  <label for="rol" class="control-label">Rol
                    <span class="asteriscoData form-text">*</span>
                  </label>
                  <select name="rol" class="campos form-control form-selected select small">
                    <!--<option selected="true" disabled="disabled">Seleciona el rol</option>-->
                      <?php //sql rol 
                        $sql1 = "SELECT * FROM roles";        
                        $result1 = mysqli_query($DB_conection,$sql1) or die(mysqli_close($DB_conection));
                        if(mysqli_num_rows($result1)>0){
                          while($rowRol = mysqli_fetch_assoc($result1)){
                      ?>
                      <option value="<?php echo $rowRol['rol_id']?>"><?php echo $rowRol['rol_permiso']?></option>
                      <?php
                          }
                        }
                      ?>
                  </select>
                  <small class="smallDatos form-text form-text-error hide" aria-live="polite"> Este campo es obligatorio
                  </small>
                </div>
              </div>

              <div class="col-md-6 col-xs-12">
                <div class="form-group">
                  
                </div>
              </div>

              <div class="col-md-6 col-xs-12">
              </div>
            </div>


            <div class="row">
              <div class="col-md-6 col-xs-12">
                <div class="form-group">
                  <label for="contraseniaUsuario" class="control-label">Contraseña
                    <span class="asteriscoData form-text">*</span>
                  </label>
                  <input type="password" id="pass01" type="text" class="campos form-control ember-text-field ember-view" name="contrasena">
                  <small class="smallDatos form-text form-text-error hide" aria-live="polite"> Este campo es obligatorio
                  </small>
                </div>
              </div>

              <div class="col-md-6 col-xs-12">
                <div class="form-group">
                  <label for="contraseniaUsuario" class="control-label">Repite Contraseña
                    <span class="asteriscoData form-text">*</span>
                  </label>
                  <input id="pass02" type="password" class="campos form-control ember-text-field ember-view" name="contrasena01">
                  <small class="smallDatos form-text form-text-error hide" aria-live="polite"> Este campo es obligatorio
                  </small>
                </div>
              </div>
              <div class="col-md-6 col-xs-12">
              
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 col-xs-12">
                <div class="form-group">
                    <button class="btn btn-primary pull-right" type="submit">Enviar</button> 
                </div>
              </div>
            </div>

            <div class="error">
               <?php
                echo listaErrores($errores);
                ?>
              </div>
          </form>
          </div>
      </div>
    </div>
    </main>

    <!-- JS -->
    
     <!-- Contenido   <script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>  -->
     <script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>

     <!-- Contenido para el calendario  <script src="https://framework-gb.cdn.gob.mx/assets/scripts/jquery-ui-datepicker.js"></script>  -->
     <script src="https://framework-gb.cdn.gob.mx/assets/scripts/jquery-ui-datepicker.js"></script>


  </body>
</html>
