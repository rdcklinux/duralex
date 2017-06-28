<!DOCTYPE html>
<html>
    <head>
        <title><?=$title?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
	    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.7/dt-1.10.15/datatables.min.css"/>
    </head>
    <?php
    $user_profile = $_SESSION['user']['perfil'];
    ?>
    <body>
        <nav class="navbar navbar-default navbar-static-top">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">---</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>

              <a class="navbar-brand pull-right	" href="/">DURALEX</a>
              <a href="/">
              	<img style="height:50px" src="/images/logo4.png">
              </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                <?php if(!empty($_SESSION['user'])): ?>
                    <li><a href="/backend/welcome">Inicio</a></li>
                    <li><a href="javascript:void(0);"><small><b><?=$_SESSION['user']["nombre"] . ' ' . $_SESSION['user']["apellido"]?></b></small> </a></li>
                	<?php if ($_SESSION['user']['gestor']): ?>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                            Gestión <span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu" role="menu" aria-labelledby="adminMenu">
                            <li><a href="/backend/abogado">Abogados</a></li>
                            <li><a href="/backend/usuario"><?=($user_profile != 1)?'Clientes':'Usuarios'?></a></li>
                            <?php if($user_profile == 3): ?>
                                <li><a href="/backend/atencion/new">Agendar Atención</a></li>
                            <?php else: ?>
                                <li><a href="/backend/atencion">Atenciones</a></li>
                            <?php endif ?>
                            <?php if($user_profile == 2): ?>
                                <li><a href="/backend/estadistica">Estadisticas</a></li>
                            <?php endif ?>
                          </ul>
                        </li>
                	<?php endif ?>
                	<li><a href="/frontend/auth/logout">Cerrar Sesion</a></li>
        	    <?php endif; ?>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div>
        </nav>

        <script src="/js/jquery-3.2.1.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/datatables.min.js"></script>
        <script src="/js/tables.js"></script>

        <div class="container">
          <?php @include($this->view) ?>
          <br><br><br>
        </div>
    </body>
</html>
