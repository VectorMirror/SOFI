<?php
    include_once 'DB_conection.php';
    //include_once 'consultas.php';
    //$caracter = $_POST['idB'];
    #consulta multitabla con inner join para mostrar los ultimos oficios subidos
    $query4= "SELECT o.ofi_id, o.ofi_caracter, o.ofi_referencia, o.ofi_numero, o.ofi_respuesta, o.ofi_asunto, o.ofi_descripcion, o.ofi_fechaE, o.ofi_fechaSICT, o.ofi_fechaResp, o.ofi_fechaSOFI, o.ofi_url,
                u.usu_nombre, u.usu_apellidoP, u.usu_apellidoM,
                rem.rem_remitente, d.dest_destinatario, c.cargo_cargo, ud.uni_unidad
                FROM oficios as o
                INNER JOIN usuarios as u ON o.ofi_subidoPor = u.usu_id
                INNER JOIN remitentes as rem on o.ofi_remitente = rem.rem_id
                INNER JOIN destinatarios as d on o.ofi_destinatario = d.dest_id
                INNER JOIN cargos as c on o.ofi_cargo = c.cargo_id
                INNER JOIN unidades as ud on o.ofi_unidad=ud.uni_id
                WHERE o.ofi_caracter='Interno-Entrada' AND o.ofi_activo=0
                ORDER BY o.ofi_id ASC LIMIT 50;";
    $oficiosIE = $DB_conection->query($query4);
    
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
    <h3>Lista de Oficios Internos de Entrada</h3>
    <hr class="red">
    
    <table class="table table-responsive">
	<thead>
		<tr>
      <!--<th>Id</th>-->
			<th>Agregado por</th>
			<th>Remitente</th>
			<th>Destinatario</th>
			<th>Número de Oficio</th>
			<th>Oficio Referencia</th>
			<th>Fechas</th>
			<th>Detalles</th>
            <th>Oficio</th>
		</tr>
	</thead>
    <tbody>
        
    <?php
    if($DB_conection){
    //echo "se abre la conexióna la BD";
        if(mysqli_num_rows($oficiosIE)>0){
            while($oficioIE = mysqli_fetch_assoc($oficiosIE)){
    ?>  
        <tr> 
            <td><?php echo $oficioIE['usu_nombre'].' '.$oficioIE['usu_apellidoP']. ' '. $oficioIE['usu_apellidoM']; ?></td>
            <td><?php echo $oficioIE['rem_remitente'].'<br>'.$oficioIE['cargo_cargo']. '<br> '. $oficioIE['uni_unidad'];?></td>
            <td><?php echo $oficioIE['dest_destinatario']; ?></td>
            <td><?php echo $oficioIE['ofi_numero']; ?></td>
            <td><?php echo $oficioIE['ofi_referencia']; ?></td>
            <td><b>Registrado en sistema: </b><br><?php echo $oficioIE['ofi_fechaSOFI']; ?><br>
                <b>Recibido SICT:</b> <br><?php echo $oficioIE['ofi_fechaSICT']; ?><br>
                <b>Fecha Elaboracion:</b> <br><?php echo $oficioIE['ofi_fechaE']; ?><br>
                <b>Necesita Respuesta: </b><?php echo $oficioIE['ofi_respuesta']; ?>
                <b>Fecha para Resp:</b><br> <?php echo $oficioIE['ofi_fechaResp']; ?><br>
            </td>
            <td><b>Asunto: </b><?php echo $oficioIE['ofi_asunto'].'</br><b>Descripcion:</b> '.$oficioIE['ofi_descripcion']; ?></td>
            
            
            <td>
                <a href="../<?php echo $oficioIE['ofi_url']?>" class="btn btn-default" target="_blank">VER OFICIO</a>
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