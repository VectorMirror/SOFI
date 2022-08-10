<?php
    include_once 'DB_conection.php';
    //include_once 'consultas.php';
    //$ofi_caracter = $_POST['idB'];
    #consulta multitabla con inner join para mostrar los ultimos oficios subidos
    $queryIS= "SELECT o.ofi_id, o.ofi_caracter, o.ofi_numero, o.ofi_referencia, o.ofi_asunto, o.ofi_descripcion, o.ofi_fechaE, o.ofi_fechaSOFI, o.ofi_url,
                u.usu_nombre, u.usu_apellidoP, u.usu_apellidoM,
                rem.rem_remitente, d.dest_destinatario, c.cargo_cargo, ud.uni_unidad
                FROM oficios as o
                INNER JOIN usuarios as u ON o.ofi_subidoPor = u.usu_id
                INNER JOIN remitentes as rem on o.ofi_remitente = rem.rem_id
                INNER JOIN destinatarios as d on o.ofi_destinatario = d.dest_id
                INNER JOIN cargos as c on o.ofi_cargo = c.cargo_id
                INNER JOIN unidades as ud on o.ofi_unidad=ud.uni_id
                WHERE o.ofi_caracter='Interno-Salida'
                ORDER BY o.ofi_id ASC LIMIT 50;";
    $oficiosIS = $DB_conection->query($queryIS);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <h3>Oficios Internos de Salida</h3>
    <hr class="red">
    
    <table class="table table-responsive">
	<thead>
		<tr>
      <!--<th>Id</th>-->
			<th>Agregado por</th>
			<th>Destinatario</th>
			<th>Remitente</th>
			<th>Número de Oficio</th>
			<th>Oficio Referencia</th>
			<th>Fechas</th>
			<th>Detalles</th>
            <th>Oficio y Anexos</th>
		</tr>
	</thead>
    <tbody>
        
    <?php
    if($DB_conection){
    //echo "se abre la conexióna la BD";
    if(mysqli_num_rows($oficiosIS)>0){
    while($oficioIS = mysqli_fetch_assoc($oficiosIS)){
    ?>
        <tr> 
            <td><?php echo $oficioIS['usu_nombre'].' '.$oficioIS['usu_apellidoP']. ' '. $oficioIS['usu_apellidoM']; ?></td>
            <td><?php echo $oficioIS['dest_destinatario'].'<br>'.$oficioIS['cargo_cargo']. '<br> '. $oficioIS['uni_unidad'];?></td>
            <td><?php echo $oficioIS['rem_remitente']; ?></td>
            <td><?php echo $oficioIS['ofi_numero']; ?></td>
            <td><?php echo $oficioIS['ofi_referencia']; ?></td>
            <td><b>Registrado en sistema: </b><br><?php echo $oficioIS['ofi_fechaSOFI']; ?><br>
                <b>Fecha Elaboracion:</b> <br><?php echo $oficioIS['ofi_fechaE']; ?><br>
            </td>
            <td><b>Asunto: </b><?php echo $oficioIS['ofi_asunto'].'</br><b>Descripcion:</b> '.$oficioIS['ofi_descripcion']; ?></td>
            
            
            <td>
                <?php
                    $mUrl = substr($oficioIS['ofi_url'], 1);
                    $arrUrl = explode(',', $mUrl);
                    foreach ($arrUrl as $anexoFile){
                ?>
                    <a href="<?php echo $anexoFile; ?>" class="btn btn-default" target="_blank">VER OFICIO</a><br/>
                <?php } ?>
            </td> 
          </tr>
    <?php 
    }
    } else{
		echo "No se pudo ejecutar la sentencia SQL";
	}
    } else{
        echo "Hubo un error";
    } ?>
    </tbody>
</table>

</body>
</html>