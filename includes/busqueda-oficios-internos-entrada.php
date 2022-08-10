<?php
    include_once 'DB_conection.php';
    //include_once 'consultas.php';

    //Paginacion La paginacion depende de las consultas 
    $regPerPage = 5;
    if(!isset($_GET['nPag'])){
        $nPag = 0;
    }
    else{
        $nPag = $_GET['nPag'];
    }
    $init = $nPag*$regPerPage;
    #consulta multitabla con inner join para mostrar los oficios subidos
    $query4= "SELECT o.ofi_id, o.ofi_referencia, o.ofi_numero, o.ofi_respuesta, o.ofi_asunto, o.ofi_descripcion, o.ofi_fechaE, o.ofi_fechaSICT, o.ofi_fechaResp, o.ofi_fechaSOFI, o.ofi_url,
                u.usu_nombre, u.usu_apellidoP, u.usu_apellidoM,
                rem.rem_remitente, d.dest_destinatario, c.cargo_cargo, ud.uni_unidad
                FROM oficios as o
                INNER JOIN usuarios as u ON o.ofi_subidoPor = u.usu_id
                INNER JOIN remitentes as rem on o.ofi_remitente = rem.rem_id
                INNER JOIN destinatarios as d on o.ofi_destinatario = d.dest_id
                INNER JOIN cargos as c on o.ofi_cargo = c.cargo_id
                INNER JOIN unidades as ud on o.ofi_unidad=ud.uni_id
                WHERE o.ofi_caracter='Interno-Entrada' AND o.ofi_activo=0
                ORDER BY o.ofi_id LIMIT $init, $regPerPage;";

    
    //consulta de busqueda en tiempo real
    if(isset($_POST['consultaIE'])){
        $txt=$DB_conection->real_escape_string($_POST['consultaIE']);
        $query4= "SELECT o.ofi_id,o.ofi_caracter,o.ofi_referencia,o.ofi_numero,o.ofi_respuesta,o.ofi_asunto,o.ofi_descripcion,o.ofi_fechaE,o.ofi_fechaSICT,o.ofi_fechaResp,o.ofi_fechaSOFI,o.ofi_url,
                    u.usu_nombre, u.usu_apellidoP, u.usu_apellidoM,
                    rem.rem_remitente, d.dest_destinatario, c.cargo_cargo, ud.uni_unidad
                    FROM oficios as o
                    INNER JOIN usuarios as u ON o.ofi_subidoPor = u.usu_id
                    INNER JOIN remitentes as rem on o.ofi_remitente = rem.rem_id
                    INNER JOIN destinatarios as d on o.ofi_destinatario = d.dest_id
                    INNER JOIN cargos as c on o.ofi_cargo = c.cargo_id
                    INNER JOIN unidades as ud on o.ofi_unidad=ud.uni_id
                    WHERE o.ofi_caracter='Interno-Entrada' AND o.ofi_referencia LIKE '%".$txt."%' 
                    OR rem.rem_remitente LIKE '%".$txt."%'
                    OR d.dest_destinatario LIKE '%".$txt."%' 
                    OR o.ofi_referencia LIKE '%".$txt."%' 
                    OR o.ofi_numero LIKE '%".$txt."%' 
                    ORDER BY o.ofi_id LIMIT $init, $regPerPage;";
    }
    $oficiosIE = $DB_conection->query($query4);

    $queryCR = "SELECT ofi_id FROM oficios WHERE ofi_caracter='Interno-Entrada' AND ofi_activo=0;";
    $conteo = $DB_conection->query($queryCR);
    $numReg = mysqli_num_rows($conteo);
    
      
    //Total de paginas que tendra la consulta
    $tPag = floor($numReg/$regPerPage);
    if(($numReg%$regPerPage) > 0){
        $tPag++;
    }
?>

    <h3>Oficios Internos de Entrada </h3><?php echo 'Hay '.$numReg.' resultados';?>
        
    <hr class="red">
    <ul class="pagination">
        
        <?php echo 'Pagina '.($nPag+1). ' de '.$tPag .'<br/>'; ?>

            <li><a href="#">&laquo;</a></li>
            <?php for($i=0; $i < $tPag; $i++) {
                if($i==$nPag){
                    echo '<li><a>'.($i+1).'</a></li>';
                }
                else{
                ?>
                <li><a href="<?php echo "includes/busqueda-oficios-internos-entrada.php?nPag=".$i; ?>"> <?php echo $i+1; ?></a></li>
            <?php }} ?>
            <li><a href="#">&raquo;</a></li>
        </ul>
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
            <td><?php echo $oficioIE['usu_nombre'].' '.$oficioIE['usu_apellidoP']. ' '. $oficioIE['usu_apellidoM']; ?></td>
            <td><?php echo $oficioIE['rem_remitente'].'<br>'.$oficioIE['cargo_cargo']. '<br> '. $oficioIE['uni_unidad'];?></td>
            <td><?php echo $oficioIE['dest_destinatario']; ?></td>
            <td><?php echo $oficioIE['ofi_numero']; ?></td>
            <td><?php echo $oficioIE['ofi_referencia']; ?></td>
            <td><b>Registrado en sistema: </b><br><?php echo $oficioIE['ofi_fechaSOFI']; ?><br>
                <b>Recibido SICT:</b> <br><?php echo $oficioIE['ofi_fechaSICT']; ?><br>
                <b>Fecha Elaboracion:</b> <br><?php echo $oficioIE['ofi_fechaE']; ?><br>
                <b>Necesita Respuesta: </b><?php echo $oficioIE['ofi_respuesta']; ?><br>
                <b>Fecha para Resp:</b><br> <?php echo $oficioIE['ofi_fechaResp']; ?><br>
            </td>
            <td><b>Asunto: </b><?php echo $oficioIE['ofi_asunto'].'</br><b>Descripcion:</b> '.$oficioIE['ofi_descripcion']; ?></td>
            
            
            <td>
                <?php
                    $mUrl = substr($oficioIE['ofi_url'], 1);
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
		echo "No se encontraron resultados";
	}
    ?>
    </tbody>
    </table>
    <?php echo 'Hay '.$numReg.' resultados';?>
    <hr class="red">
    <ul class="pagination">
        
        <?php echo 'Pagina '.($nPag+1). ' de '.$tPag .'<br/>'; ?>

            <li><a href="#">&laquo;</a></li>
            <?php for($i=0; $i < $tPag; $i++) {
                if($i==$nPag){
                    echo '<li><a>'.($i+1).'</a></li>';
                }
                else{
                ?>
                <li><a href="<?php echo "includes/busqueda-oficios-internos-entrada.php?nPag=".$i; ?>"> <?php echo $i+1; ?></a></li>
            <?php }} ?>
            <li><a href="#">&raquo;</a></li>
        </ul>


    <div class="top-buffer bottom-buffer"></div>
</body>
</html>