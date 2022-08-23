<?php
    require_once 'DB_conection.php';
    require_once 'consultas.php';

    $html = '';
    //$html1 = '';
    $emp = $_POST['buscarEmpEx'];
    

    //$queryEmpresa=('SELECT * FROM empresas WHERE emp_empresa LIKE "%'.strip_tags($emp).'%" ORDER BY emp_empresa DESC LIMIT 0,15');
    //$empresas = $DB_conection->query($queryEmpresa);

    $queryUnidad=('SELECT * FROM unidades WHERE uni_unidad LIKE "%'.strip_tags($emp).'%" ORDER BY uni_unidad DESC LIMIT 0,15');
    $unidades = $DB_conection->query($queryUnidad);
    /*
    if ($empresas->num_rows > 0) {
        while ($empresa = $empresas->fetch_assoc()) {                
            $html .= '<div>
                        <a class="suggest-element" data="'.$empresa['emp_empresa'].'" id="emp'.$empresa['emp_id'].'">'.$empresa['emp_empresa'].'</a></div>
                        <input type="hidden" id="empH" name="empD" value="'.$empresa['emp_id'].'">
                        ';
        }
    }
    else{
        $html.='<div><a class="suggest-element">No hay resultados similares a tu busqueda</div>';
    }
    */
    if ($unidades->num_rows > 0) {
        while ($unidad = $unidades->fetch_assoc()) {                
            $html .= '<div>
                        <a class="suggest-element" data="'.$unidad['uni_unidad'].'" id="emp'.$unidad['uni_id'].'">'.$unidad['uni_unidad'].'</a></div>
                        <input type="hidden" id="empH" name="empR" value="'.$unidad['uni_id'].'">
                        ';
        }
    }
    else{
        $html .='<div><a class="suggest-element">No hay resultados similares a tu busqueda</div>';
    }
    //echo $html;
    echo $html;

?>
