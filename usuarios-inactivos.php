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
    <title>Usuarios</title>
    <!-- CSS -->
    <link href="/favicon.ico" rel="shortcut icon">
    <link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
    <link href="css/datatables.min.css" rel="stylesheet">
    <script src="js/jquery-3.6.0.min.js"> </script>
    <script type="text/javascript" src="js/datatables.js"></script>
    <script src="js/dataofi.js"></script>

    <!-- Respond.js soporte de media queries para Internet Explorer 8 -->
    <!-- ie8.js EventTarget para cada nodo en Internet Explorer 8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/ie8/0.2.2/ie8.js"></script>
    <![endif]-->

  </head>
  
  <body>
      

<h3>Usuarios Inactivos</h3>
<hr class="red">
    <!-- Contenido -->

    <?php include_once 'header.php'; ?>
    <div class="container">
<h3>Usuarios Inactivos</h3>
<hr class="red">
</div>
  <!--<div class="row">
            <td>
              <a href="form_crea_usuario.php" class="btn btn-link">Nuevo usuario</a>
            </td>
  </div>-->
    

  <main class="container">
<table class="table table-responsive display" id="table-ofi">
	<thead>
		<tr>
      <!--<th>Id</th>-->
			<th>Nombre</th>
			<th>Correo</th>
			<th>Cargo</th>
			<th>Fecha ingreso</th>
			<th>Rol</th>
			<th>Activo</th>
      <th> </th>
		</tr>
	</thead>
    <tbody>
        
    <?php
    if($DB_conection){
    //echo "se abre la conexióna la BD";
    if(mysqli_num_rows($result1)>0){
    while($row = mysqli_fetch_assoc($result1)){

    ?>
        <tr> 
          <td><?php echo ucwords(strtolower($row['usu_nombre']. ' '. $row['usu_apellidoP']. ' '. $row['usu_apellidoM'])); ?></td>
          <td><?php echo $row['usu_correo']; ?></td>
          <td><?php echo $row['cargo_cargo']; ?></td>
          <td><?php echo $row['usu_fecha']; ?></td>
          <td><?php echo $row['rol_permiso']; ?></td>
            <?php if($row['usu_activo']==0) { ?>
              <td><img src="img/0.png" width="15px" height="15px" title="cuenta activa"/></td>
            <?php } else if($row['usu_activo']==1){ ?>
              <td><img src="img/1.png" width="15px" height="15px" title="cuenta inactiva"/></td>
            <?php } ?>     
          <td>
            <a href="includes/activar.php?id=<?php echo $row['usu_id']?>" class="btn btn-default">Activar</a>
          </td>  
          </tr>
    <?php 
    }
    } else{
		echo "No se encontraron resultados";
	}
    } else{
        echo "Hubo un error";
    } ?>
    </tbody>
</table>
</div>
    
    </main>
    <div class="top-buffer bottom-buffer"></div>

    <!-- JS -->
    
     <!-- Contenido   <script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>  -->
     <script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>
  </body>
</html>