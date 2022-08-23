<?php 
    //iniciamos sesion y mandamos a llamar los id necesarios
    session_start();
    $idUser = $_SESSION['id_usuario'];
    $idRol= $_SESSION['id_rol'];

    #consulta que muestra en el portal la info de bienvenida al usuario
    $queryUser="SELECT usu_id, usu_nombre, usu_apellidoP, usu_apellidoM, usu_activo FROM usuarios WHERE usu_activo=0 AND usu_id=$idUser LIMIT 1";
    $userInfo = $DB_conection->query($queryUser);
    $user = $userInfo->fetch_assoc();

    

    #consulta multitabla con inner join para mostrar usuarios con cuenta activa
    $query2= "SELECT u.usu_nombre, u.usu_apellidoP, u.usu_apellidoM, u.usu_correo, u.usu_fecha, u.usu_activo, u.usu_id,
                    c.cargo_cargo, r.rol_permiso
                    FROM usuarios as u
                    INNER JOIN cargos as c ON u.usu_adscripcion = c.cargo_id
                    INNER JOIN roles as r ON u.usu_rol = r.rol_id
                    WHERE u.usu_activo=0 ORDER BY u.usu_id ASC LIMIT 15;";
    $result = $DB_conection->query($query2);
    

    #consulta multitabla con inner join para mostrar usuarios con cuenta inactiva
    $query3= "SELECT u.usu_nombre, u.usu_apellidoP, u.usu_apellidoM, u.usu_correo, u.usu_fecha, u.usu_activo, u.usu_id,
                    c.cargo_cargo, r.rol_permiso
                    FROM usuarios as u
                    INNER JOIN cargos as c ON u.usu_adscripcion = c.cargo_id
                    INNER JOIN roles as r ON u.usu_rol = r.rol_id
                    WHERE u.usu_activo=1 ORDER BY u.usu_id ASC LIMIT 15;";
    $result1 = $DB_conection->query($query3);	 
    

    #consulta para cargas la tabla cargos
    $query5="SELECT * FROM cargos WHERE cargo_tipo=1 ORDER BY cargo_cargo ASC;";
    $cargos=$DB_conection->query($query5);

    #consulta para cargas la tabla cargos
    $query6="SELECT * FROM unidades WHERE uni_tipo=1";
    $unidades=$DB_conection->query($query6);

    //consulta para mandar a llamar los ultimos documentos subidos 
    $query7="SELECT ofi_id, ofi_asunto, ofi_fechaE, ofi_fechaSOFI, ofi_url FROM oficios ORDER BY ofi_id DESC LIMIT 9";
    $lastOfi=$DB_conection->query($query7);

?>