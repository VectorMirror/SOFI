
    <!-- Contenido -->

    <main class="page">
<nav class="navbar navbar-inverse sub-navbar navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#subenlaces">
        <span class="sr-only">Interruptor de Navegación</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><span class="icon-home" aria-hidden="true"></span> Sistema de Oficios</a>
    </div>
    <div class="collapse navbar-collapse" id="subenlaces">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Usuarios <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="usuarios.php">Lista de Usuarios</a></li>
            <li><a href="registro.php">Crear nuevo Usuario</a></li>
            <li class="divider"></li>
            <li><a href="usuarios-inactivos.php">Usuarios Inactivos</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Oficios <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="lista-oficios.php">Lista de Oficios</a></li>
            <li><a href="subir-oficio-nuevo.php">Subir nuevo oficio</a></li>
          </ul>
        </li>
        <li>
          <a data-toggle="modal" data-target="#logout" title="Cerrar Sesión" role="button" >Cerrar Sesion </a>
          <!--<a href="includes/logout.php" title="Cerrar Sesión" role="button" >Cerrar Sesion </a>-->
        </li>
      </ul>
    </div>
  </div>
</nav>
</div>


<!--Codigo ventana cerrar sesion-->
<div class="modal fade" id="logout">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Mensaje de Alerta</h4>
      </div>
      <div class="modal-body">
        <form role="form" id="form-num-of" name="form-num-of">
          <p>¿<?php echo $user['usu_nombre'];?> quieres cerrar la sesión?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <a href="includes/logout.php" class="btn btn-primary" id="btn-addNumOf">Aceptar</a>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
