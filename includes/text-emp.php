<?php
    require_once 'DB_conection.php';
    require_once 'consultas.php';

    $html = '';
    $emp = $_POST['buscarEmp'];
    

    $queryEmpresa=('SELECT * FROM empresas WHERE emp_empresa LIKE "%'.strip_tags($emp).'%" ORDER BY emp_empresa DESC LIMIT 0,15');
    $empresas = $DB_conection->query($queryEmpresa);

    if ($empresas->num_rows > 0) {
        while ($empresa = $empresas->fetch_assoc()) {                
            $html .= '<div>
                        <a class="suggest-element" data="'.$empresa['emp_empresa'].'" id="emp'.$empresa['emp_id'].'">'.$empresa['emp_empresa'].'</a></div>
                        <input type="hidden" id="empH" name="empId" value="'.$empresa['emp_id'].'">
                        ';
        }
    }
    else{
        $html.='<div><a class="suggest-element">No hay resultados similares a tu busqueda</div>';
    }
    echo $html;

?>
