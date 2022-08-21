<?php
    include_once 'includes/DB_conection.php';
    include_once 'includes/consultas.php';  
    if(!isset($_SESSION['id_usuario'])){
      header('Location: index.php');
    }
    //Nombre de la tabla en uso
    $sTabla ='oficios'; 
    //Array que contiene las columnas que se usaran en la consulta
    $aColumnas = array('ofi_id', 'ofi_asunto', 'ofi_observacion', 'ofi_fechaE', 'ofi_fechaRecep', 'ofi_fechaSOFI', 'ofi_url');  
    //ColumnaIndexada
    $sIndexColumn = 'ofi_id';   
    //paginacion
    if(isset($_GET['iDisplayStart'])&& $_GET['iDisplayLength']!= '1'){
      $sLimit = 'LIMIT'. $_GET['iDisplayStart']. ', '. $_GET['iDisplayLength'];
    }   
    //ordenacion
    if(isset($_GET['iSortCol_0'])){
      $sOrder ='ORDER BY';
      for($i=0; $i < intval($_GET['iSortingCols']); $i++){
          if($_GET['bSortable_'.intval($_GET['iSortCol_'.$i])]=='true'){
              $sOrder .= $aColumnas[intval($_GET['iSortCol_'.$i])].''.$_GET['sSortDir_'.$i]. ',';
          }
      }
      $sOrder = substr($sOrder, '', -2);
      if($sOrder == 'ORDER BY'){
          $sOrder ='';
      }
    }   
    //filtracion
    $sWhere = '';
    if($_GET['sSearch']!=''){
        $sWhere ='WHERE (';
        for($i=0; $i < count($aColumnas); $i++){
            $sWhere .= $aColumnas[$i]. "LIKE '%".$_GET['sSearch']."%' OR ";  
        }
        $sWhere = substr($sWhere, '', -3);
        $sWhere .= ');';
    }

    //filtrado columna individual
    for($i=0; $i < count($aColumnas); $i++){
        if($_GET['bSearchable_'.$i]=='true' && $_GET['sSearch'.$i]!= ''){
            if($sWhere==''){
                $sWhere = 'WHERE ';
            }
            else{
                $sWhere .=' AND ';
            }
            $sWhere = $aColumnas[$i]. " LIKE '%". $_GET['sSearch_'.$i]. "%' ";
        }
    }

    //obtener datos para mostrar SQL queries
    $sQuery ="SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumnas))." FROM $sTabla $sWhere $sOrder $sLimit";
    $rResult = $mysqli_query($sQuery);

    //data set length after filtering
    $sQuery ='SELECT FOUND_ROWS()';
    $rResultFilterTotal = $mysqli->query($sQuery);
    $aResultFilterTotal =$rResultFilterTotal->fetch_array();
    $iFilteredTotal = $aResultFilterTotal[0];

    //total data set length
    $sQuery ="SELECT COUNT(".$sIndexColumn.") FROM $sTabla";
    $rResultTotal = $mysqli->query($sQuery);
    $aResultTotal = $rResultTotal->fetch_array();
    $iTotal = $aResultTotal[0];

    //salida
    $output = array(
        "sEcho" => intval($_GET['sEcho']),
        "iTotalRecords" => $iTotal,
        "iTotalDisplayRecords" => $iFilteredTotal,
        "aaData" => array()
    );

    while($aRow = $rResult->fetch_array()){
        $row = array();
        for($i=0; $i < count($aColumnas); $i++){
            if($aColumnas[$i]=='version'){
                //salida formateada para la version de columna
                $row[] =($aRow[$aColumnas[$i]]=='0') ? '-' : $aRow[$aColumnas[$i]];
            }
            else if($aColumnas[$i]==''){
                //salida general
                $row[] = $aRow[$aColumnas[$i]];
            }
        }
        //print in screen
        $row[] ="<td>
                    <a href='lista-usuarios.php?id=".$aRow['id']."'><span class='glyphicon glypicon-pencil'></span></a>
                </td>";
        $row[] ="<td>
                    <a href='lista-usuarios.php?id=".$aRow['id']."'><span class='glyphicon glypicon-pencil'></span></a>
                </td>";
        $output['aaData'][]=$row;
    }

    echo json_decode($output);

?>