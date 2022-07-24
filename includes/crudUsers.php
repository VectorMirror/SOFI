<?php
    #FUNCIONES PARA EL REGISTRO DE USUARIOS
    #REvisamos que los datos del  formulario esten completos
    function checarDatos($nombre, $apellido_p, $apellido_m, $correo){
        if(strlen(trim($nombre)) <1 || strlen(trim($apellido_p)) <1 || strlen(trim($apellido_m)) <1 ||  strlen(trim($correo)) <1 ){
            return true;            
        }
        else {
            return false;
        }
    }

    #function para que la contraseña sea minimo de 8 caracteres
    function longPass($password, $password01){
      if(strlen(trim($password)) <8 || strlen(trim($password01)) <8){
        return true;            
      }
      else {
            return false;
      }

    }

    #Verificamos que se esta igresando una direccion de correo valida
    function esMail ($correo){
        if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
            return true;            
        }
        else {
            return false;
        }
    }

    #Se comprueba de que los campos de password sean iguales
    function validarPass($pass01, $pass02){
        if(strcmp($pass01, $pass02)!==0){
            return false;            
        }
        else {
            return true;
        }
    }

    #Se comprueba que el correo ingresado no exista en la base de datos
    function mailExiste ($correo){
        global $DB_conection;
        $consulta = $DB_conection -> prepare ('SELECT usu_id FROM usuarios WHERE usu_correo = ? LIMIT 1');
        $consulta->bind_param("s", $correo);
        $consulta->execute();
        $consulta->store_result();
        $fila = $consulta->num_rows;
        $consulta ->close();

        if($fila >0){
            return true;
        }
        else{
            return false;
        }
    }

    #Se ejecuta la funcion para ingresar los datos de la tabla usuarios
    function creaUsuario($nombre, $apellido_p, $apellido_m, $correo, $adscripcion, $unidad, $rol, $DBpass){
        global $DB_conection;
        $consulta = $DB_conection->prepare("INSERT INTO usuarios (usu_nombre, usu_apellidoP, usu_apellidoM, usu_correo, usu_adscripcion, usu_unidad, usu_rol, usu_pass) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $consulta->bind_param('ssssiiis', $nombre, $apellido_p, $apellido_m, $correo, $adscripcion, $unidad, $rol, $DBpass);
        if($consulta->execute()){
            return $DB_conection->insert_id;
        }
        else{
            return 0;
        }       
    }

    #función para comprobar que se llenen todos los datos del formulario 
    function checarInfo($nombre, $apellido_p, $apellido_m, $correo){
        if(strlen(trim($nombre)) <1 || strlen(trim($apellido_p)) <1 || strlen(trim($apellido_m)) <1 ||  strlen(trim($correo)) <1){
            return true;            
        }
        else {
            return false;
        }
    }

    #funcion para actualizar informacion del usuario 
    function actualizaUsuario($nombre, $apellido_p, $apellido_m, $correo, $idUsuario){
        global $DB_conection;
        $consulta = $DB_conection->prepare('UPDATE usuarios SET usu_nombre =?, usu_apellidoP=?, usu_apellidoM=?, usu_correo=? WHERE usu_id =?');
        $consulta->bind_param('ssssi', $nombre, $apellido_p, $apellido_m, $correo, $idUsuario);
        $ejecutar = $consulta->execute();
        //ventana modal actualizar usuario
        echo'
          <div class="modal show">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Mensaje de Alerta</h4>
                </div>
                <div class="modal-body">
                  <p>La información de: '.$nombre. ' '.$apellido_p. ' '.$apellido_m. ' ha sido modificada correctamente<br></p>
                </div>
                <div class="modal-footer">
                <a href="usuarios.php" class="btn btn-default">Aceptar</a>
                </div>
              </div>
            </div>
          </div>';
        $consulta-> close();
        return $ejecutar;
        
    }

    #funcion que actualiza el idrol del empleado
    function actualizaRol($idUsuario, $idRol){
        global $DB_conection;
        $consulta = $DB_conection->prepare('UPDATE usuarios SET usu_rol =? WHERE usu_id =?');
        $consulta->bind_param('ii', $idRol, $idUsuario);
        $ejecutar = $consulta->execute();
        $consulta-> close();
        return $ejecutar;
    }

    #funcion para desactivar usuario 
    function inactivaUsuario($idEmpleado){
        global $DB_conection;
        $consulta = $DB_conection->prepare('UPDATE usuarios SET usu_activo =1 WHERE usu_id =?');
        $consulta->bind_param('i', $idEmpleado);
        $ejecutar = $consulta->execute();
        //ventana modal actualizar usuario
        echo'
          <div class="modal show">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Mensaje de Alerta</h4>
                </div>
                <div class="modal-body">
                  <p>La cuenta ha sido inactivada<br></p>
                </div>
                <div class="modal-footer">
                <a href="../usuarios.php" class="btn btn-default">Aceptar</a>
                </div>
              </div>
            </div>
          </div>';
        $consulta-> close();
        return $ejecutar;
        
    }

    #funcion para activar usuario 
    function  activaUsuario($idEmpleado){
        global $DB_conection;
        $consulta = $DB_conection->prepare('UPDATE usuarios SET usu_activo =0 WHERE usu_id =?');
        $consulta->bind_param('i', $idEmpleado);
        $ejecutar = $consulta->execute();
        //ventana modal actualizar usuario
        echo'
          <div class="modal show">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Mensaje de Alerta</h4>
                </div>
                <div class="modal-body">
                  <p>La cuenta ha sido activada nuevamente<br></p>
                </div>
                <div class="modal-footer">
                <a href="../usuarios.php" class="btn btn-default">Aceptar</a>
                </div>
              </div>
            </div>
          </div>';
        $consulta-> close();
        return $ejecutar;
        
    }
?>