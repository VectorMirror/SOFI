<?php
  include_once 'includes/DB_conection.php';
  include_once 'includes/consultas.php';

  if(!isset($_SESSION['id_usuario'])){
    header('Location: index.php');
  }
  #consulta multitabla con inner join para mostrar los oficios subidos
  $query4= "SELECT o.ofi_id, o.ofi_asunto, o.ofi_observacion, o.ofi_fechaE, o.ofi_fechaRecep, o.ofi_fechaSOFI, o.ofi_url,
              u.usu_nombre, u.usu_apellidoP, u.usu_apellidoM,
              d.dest_destinatario, cDest.cargo_cargo as cargo_dest, udDest.uni_unidad as unidad_dest,
              rem.rem_remitente, cRem.cargo_cargo as cargo_rem, udRem.uni_unidad as unidad_rem 
              FROM oficios as o
              INNER JOIN usuarios as u ON o.ofi_subidoPor = u.usu_id
              INNER JOIN destinatarios as d on o.ofi_destinatario = d.dest_id
              INNER JOIN cargos as cDest on o.ofi_cargoDest = cDest.cargo_id
              INNER JOIN unidades as udDest on o.ofi_unidadDest=udDest.uni_id
              INNER JOIN remitentes as rem on o.ofi_remitente = rem.rem_id               
              INNER JOIN cargos as cRem on o.ofi_cargoRem = cRem.cargo_id
              INNER JOIN unidades as udRem on o.ofi_unidadRem=udRem.uni_id
              WHERE o.ofi_activo=0 
              ORDER BY o.ofi_id DESC;";
  $oficiosIE = $DB_conection->query($query4);

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
<main>
  <div class="row">

  <div class="col-md-1"></div>
  <div class="col-md-10">
    <table class="display" id="table-ofi">
	<thead>
		<tr>
      <!--<th>Id</th>-->
			<th>Agregado por</th>
			<th>Destinatario</th>
			<th>Remitente</th>
			<th>Fechas</th>
			<th>Detalles</th>
            <th>Oficio y Anexos</th>
		</tr>
	</thead>
    <tbody>
        
    <?php
    //echo "se abre la conexióna la BD";
    
    if($oficiosIE->num_rows > 0){
        while($oficioIE =$oficiosIE->fetch_assoc()){
    ?>  
        <tr> 
            <td><?php echo ucwords(strtolower($oficioIE['usu_nombre'].' '.$oficioIE['usu_apellidoP']. ' '. $oficioIE['usu_apellidoM'])); ?></td>
            <td><?php echo ucwords(strtolower($oficioIE['dest_destinatario'])).
                    '<br/><b>Cargo: </b><br/>'.ucwords(strtolower($oficioIE['cargo_dest'])).
                    '<br/><b>Unidad/Empresa: </b><br/>'. ucwords(strtolower($oficioIE['unidad_dest']));
                ?>
            </td>
            <td><?php echo ucwords(strtolower($oficioIE['rem_remitente'])).
                    '<br/><b>Cargo: </b><br/>'.ucwords(strtolower($oficioIE['cargo_rem'])).
                    '<br/><b>Unidad/Empresa: </b><br/>'. ucwords(strtolower($oficioIE['unidad_rem']));
                ?>
            </td>
            <td><b>Registrado en sistema: </b><br/><?php echo $oficioIE['ofi_fechaSOFI']; ?><br/>
                <b>Fecha Elaboracion:</b> <br/><?php echo $oficioIE['ofi_fechaE']; ?><br/>
                <b>Fecha Recepción: </b><br/><?php echo $oficioIE['ofi_fechaRecep']; ?><br/>
            </td>
            <td><b>Asunto: </b><br/><?php echo $oficioIE['ofi_asunto'].'</br><b>Descripcion:</b><br/> '.$oficioIE['ofi_observacion']; ?></td>
            
            
            <td>
                <?php
                    $mUrl = substr($oficioIE['ofi_url'], 1);
                    $arrUrl = explode(',', $mUrl);
                    foreach ($arrUrl as $anexoFile){
                        $ext= pathinfo($anexoFile, PATHINFO_EXTENSION);
                ?>
                    <a href="<?php echo $anexoFile; ?>" class="btn btn-default" target="_blank"><img src="img/<?php echo $ext.'.png';?>" width="30" height="30"> VER OFICIO</a><br/>
                <?php } ?>
            </td>  
          </tr>
    <?php 
    }
    } else{
		echo "No se encontraron resultados";
	}
    ?>
    </tbody>
    </table>
  </div>
    </div>
    </div><!--row-->
</main>
    

<div class="top-buffer bottom-buffer"></div>
    <!-- JS -->
    
     <!-- Contenido   <script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>  -->
     <script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>     
  </body>
</html>


