<?php
    #FUNCIONES PARA EL INICIO DE SESION
    #Se checa que los campos no esten vacios
    function checkInfoLogin($usuario, $password){
        if(strlen(trim($usuario)) <1 || strlen(trim($password)) <1){
            return true;
        }
        else{
            return false;
        }
    }

    function loginUser($usuario, $password){
        global $DB_conection;
        $consulta = $DB_conection->prepare("SELECT usu_id, usu_rol, usu_pass, usu_activo FROM usuarios WHERE usu_correo = ? LIMIT 1");
        $consulta ->bind_param("s", $usuario);
        $consulta ->execute();
        $consulta->store_result();
        $fila = $consulta->num_rows;
    
        if($fila > 0){
            if(cuentaActiva ($usuario)){
                $consulta->bind_result($idUser, $idRol, $passDB, $usu_activo);
                $consulta->fetch();
    
                if($passDB == md5($password)){
                    $_SESSION['id_usuario'] = $idUser;
                    $_SESSION['id_rol'] = $idRol;
                    header("location: portal.php");
                }
                else{
                    $errores ='Contraseña incorrecta';
                }
            } 
            else {
                $errores = 'Esta cuenta ya no se encuentra activa por el momento';
            }
        }
        else{
            $errores = 'El nombre de usuario no esta registrado a DB';
        }
        return $errores;
    }
    
    #Verificamos que la cuenta que esta iniciando sesion ya se encuentre activada
    function cuentaActiva($usuario){
        global $DB_conection;
        $consulta = $DB_conection->prepare("SELECT usu_activo FROM usuarios WHERE usu_correo= ? LIMIT 1");
        $consulta ->bind_param('s', $usuario);
        $consulta->execute();
        $consulta->bind_result($activo);
        $consulta->fetch();

        if($activo ==0){
            return true;
        }
        else{
            return false;
        }
    }
?>