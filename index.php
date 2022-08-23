<?php
    session_start();
    #script de validacion de datos para registro de usuarios
    require_once 'includes/DB_conection.php';
    require_once 'includes/funciones.php';
    require_once 'includes/inicioSesion.php';

    if(isset($_SESSION['id_usuario'])){
      header('Location:portal.php');
    }

 
  $conteo="SELECT usu_id FROM usuarios" ;
  $regs = $DB_conection->query($conteo);
  $numReg=mysqli_num_rows($regs);
  
  if($numReg ==0){
    header('Location: registro1.php');
  }
    
    $errores = array();
    if(!empty($_POST)){
        $usuario = $DB_conection->real_escape_string($_POST['usuario']);
        $password = $DB_conection->real_escape_string($_POST['password']);

        if(checkInfoLogin($usuario, $password)){
            $errores[] = 'Debes llenar todos los campos';
        }
            $errores[] = loginUser($usuario, $password);
    }

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión</title>


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
  
  <h3> Iniciar sesión </h3>
<hr class="red">
    <!-- Contenido -->
    <main class="page">
      
        <form class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
          <div class="form-group">
            <label class="col-sm-3 control-label" for="email-03">Correo Electronico:</label>
              <div class="col-sm-9">
                <input class=".form-control" id="email-03" placeholder="Correo electrónico" type="text" name="usuario">
              </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label" for="password-03">Contraseña:</label>
              <div class="col-sm-9">
                <input class=".form-control" id="password-03" placeholder="Contraseña" type="password" name="password">
              </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
              <div class="checkbox">
               
              </div>
           </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
              <button class="btn btn-primary pull-left" type="submit">Enviar</button>
            </div>
          </div>
          <div class="error">
            <?php
              echo listaErrores($errores);
            ?>
            </div>
        </form>
    </main>

    <!-- JS -->
    
     <script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>

  </body>
</html>