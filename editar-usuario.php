<?php
  include_once 'includes/DB_conection.php';
  include_once 'includes/consultas.php';
  include_once 'includes/crudUsers.php';
  include_once 'includes/funciones.php';

  if(!isset($_SESSION['id_usuario'])){
    header('Location: index.php');
  }

  //Agarramos el id que pasamos por la url 
  $idUsuario = $_GET['id'];
  $errores=array();
  if(!empty($_POST)){
  	$nombre = $DB_conection->real_escape_string(strtoupper($_POST['nombre']));
    $apellido_p = $DB_conection->real_escape_string(strtoupper($_POST['apellido_p']));
    $apellido_m = $DB_conection->real_escape_string(strtoupper($_POST['apellido_m']));
    $correo = $DB_conection->real_escape_string($_POST['correo']);
    $rol= $DB_conection->real_escape_string($_POST['idRol']);

      if(checarInfo($nombre, $apellido_p, $apellido_m, $correo)){
        $errores[] ="Llena TODOS los campos";
      }

      if(!esMail($correo)){
        $errores[] ="El E-mail no es valido";
      } 

      //if(mailExiste($correo)){
      //  $errores[] ="El correo que ingresaste ya esta registrado";
      //}

      if(count($errores)==0){
        $actualizaUsuario=actualizaUsuario($nombre, $apellido_p, $apellido_m, $correo, $idUsuario);
        if($actualizaUsuario){
          actualizaRol($rol, $idUsuario);
          //exit; 
        }
        else{
            $errores[] = 'No se ha podido actualizar al usuario :(';
            echo $actualizaUsuario;
        }
      }
  }

  //sql usuario con el id del url
  $sql = "SELECT r.rol_permiso, r.rol_id, 
                 t.usu_id, t.usu_adscripcion, t.usu_nombre, t.usu_apellidoP, t.usu_apellidoM, t.usu_correo, t.usu_activo
  FROM usuarios as t 
  INNER JOIN roles as r ON t.usu_rol = r.rol_id 
          WHERE usu_id ='".$idUsuario."'";        
  $result = mysqli_query($DB_conection,$sql) or die(mysqli_close($DB_conection));
  $row = mysqli_fetch_assoc($result);
  $idEmpleado=$row['usu_id'];

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Usuario</title>
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
  
<h3>Actualiza los datos del Usuario</h3>
<hr class="red">
    <!-- Contenido -->

   <?php include_once 'header.php'; ?>
<h3>Actualiza los datos del Usuario</h3>
<hr class="red">
    <main class="page">
    <form class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">    
          <div class="form-group">
            <label class="col-sm-3 control-label">Nombre</label>
              <div class="col-sm-9">
                <input class=".form-control" value="<?php echo $row['usu_nombre'];?>" type="text" name="nombre">
              </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label" >Apellido Paterno</label>
              <div class="col-sm-9">
                <input class=".form-control" value="<?php echo $row['usu_apellidoP'];?>" type="text" name="apellido_p">
              </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label" >Apellido Materno</label>
              <div class="col-sm-9">
                <input class=".form-control" value="<?php echo $row['usu_apellidoM'];?>" type="text" name="apellido_m">
              </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label" >Correo</label>
              <div class="col-sm-9">
                <input class=".form-control" value="<?php echo $row['usu_correo'];?>" type="text" name="correo">
              </div>
          </div>  
         
          <div class="form-group">
            <label class="col-sm-3 control-label" for="passwtextrd-03">Rol</label>
              <div class="col-sm-9">
              <select class=".form-control" name="idRol">
              <option value="<?php echo $row['rol_id'];?>"><?php echo $row['rol_permiso'];?> </option>
              <option value="<?php echo $row['rol_id'];?>"> ------ </option>
              <?php 
              //sql rol 
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
              </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
               <button class="btn btn-default" type="submit">Guardar</button>
               <a class="btn btn-primary" data-toggle="modal" data-target="#foo">Eliminar</a> 
            </div>
          </div>
          <div class="error">
               <?php
                echo listaErrores($errores);
                ?>
              </div>
        </form>
    </main>
   <!--Codigo ventana Modal-->
    <div class="modal fade" id="foo">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Mensaje de Alerta</h4>
      </div>
      <div class="modal-body">
        <p>¿Está seguro que desea desactivar esta cuenta?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <a href="includes/inactivar.php?id=<?php echo $idEmpleado;?>" class="btn btn-primary">Aceptar</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

    <!-- JS -->
    
     <!-- Contenido   <script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>  -->
     <script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>
  </body>
</html>
