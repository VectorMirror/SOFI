<?php
    require_once 'DB_conection.php';
    require_once 'consultas.php';

    $html = '';
    $emp1 = $_POST['buscarEmpEx'];
    

    $queryEmpresa1=('SELECT * FROM empresas WHERE emp_empresa LIKE "%'.strip_tags($emp1).'%" ORDER BY emp_empresa DESC LIMIT 0,15');
    $empresas1 = $DB_conection->query($queryEmpresa1);

    if ($empresas1->num_rows > 0) {
        while ($empresa1 = $empresas1->fetch_assoc()) {                
            $html .= '<div>
                        <a class="suggest-element" data="'.$empresa1['emp_empresa'].'" id="rem'.$empresa1['emp_id'].'">'.$empresa1['emp_empresa'].'</a></div>
                        <input type="hidden" id="empH" name="empR" value="'.$empresa1['emp_id'].'">
                        ';
        }
    }
    else{
        $html.='<div><a class="suggest-element">No hay resultados similares a tu busqueda</div>';
    }
    echo $html;

?>