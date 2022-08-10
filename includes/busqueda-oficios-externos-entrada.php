<?php
    include_once 'DB_conection.php';
    //include_once 'consultas.php';
    //$ ofi_caracter = $_POST['idB'];
    #consulta multitabla con inner join para mostrar los ultimos oficios subidos
    $queryEE= "SELECT o.ofi_id, o.ofi_caracter, o.ofi_respuesta, o.ofi_asunto, o.ofi_descripcion, o.ofi_fechaE, o.ofi_fechaSOFI, o.ofi_fechaResp, o.ofi_url, o.ofi_numero, o.ofi_referencia,
                u.usu_nombre, u.usu_apellidoP, u.usu_apellidoM,
                rem.rem_remitente, d.dest_destinatario, em.emp_empresa
                FROM oficios as o
                INNER JOIN usuarios as u ON o.ofi_subidoPor = u.usu_id
                INNER JOIN remitentes as rem on o.ofi_remitente = rem.rem_id
                INNER JOIN destinatarios as d on o.ofi_destinatario = d.dest_id
                LEFT JOIN empresas as em on o.ofi_empresa= em.emp_id
                WHERE o.ofi_caracter='Externo-Entrada'
                ORDER BY o.ofi_id ASC LIMIT 50;";
    $oficiosEE = $DB_conection->query($queryEE);
    
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
    <h3>Oficios Externos de Entrada</h3>
    <hr class="red">
    
    <table class="table table-responsive">
	<thead>
		<tr>
      <!--<th>Id</th>-->
			<th>Agregado por</th>
			<th>Destinatario</th>
			<th>Remitente</th>
			<th>Empresa</th>
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
    if(mysqli_num_rows($oficiosEE)>0){
    while($oficioEE = mysqli_fetch_assoc($oficiosEE)){
    ?>
        <tr> 
            <td><?php echo $oficioEE['usu_nombre'].' '.$oficioEE['usu_apellidoP']. ' '. $oficioEE['usu_apellidoM']; ?></td>
            <td><?php echo $oficioEE['dest_destinatario'];?></td>
            <td><?php echo $oficioEE['rem_remitente']; ?></td>
            <td><?php echo $oficioEE['emp_empresa']; ?></td>
            <td><?php echo $oficioEE['ofi_numero']; ?></td>
            <td><?php echo $oficioEE['ofi_referencia']; ?></td>
            <td><b>Registrado en sistema: </b><br><?php echo $oficioEE['ofi_fechaSOFI']; ?><br>
                <b>Fecha Elaboracion:</b> <br><?php echo $oficioEE['ofi_fechaE']; ?><br>
                <b>Necesita Respuesta: </b><?php echo $oficioEE['ofi_respuesta']; ?><br>
                <b>Fecha para Resp:</b><br> <?php echo $oficioEE['ofi_fechaResp']; ?><br>
            </td>
            <td><b>Asunto: </b><?php echo $oficioEE['ofi_asunto'].'</br><b>Descripcion:</b> '.$oficioEE['ofi_descripcion']; ?></td>
            
            
            <td>
                <?php
                    $mUrl = substr($oficioEE['ofi_url'], 1);
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