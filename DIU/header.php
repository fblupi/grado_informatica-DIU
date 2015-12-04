<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
	<?php if(!isset($_SESSION)){ session_start();} ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<!-- css -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
<link href="assets/css/style.css" rel="stylesheet"/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" type="text/css">
</head>
<body id="divPrincipal">
<header>
<div class="header">
<a href="index.php"><img id="logo" src="assets/img/logo.png" alt="Inicio"></a>
	<img class="gtech" src="assets/img/header1.png">
	<img class="coworking" src="assets/img/header2.png">
</div>
</header>
<!-- navbar -->
<nav>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav nav-tabs">
					<li role="presentation" id="inicio"><a href="index.php">Home</a></li>
					<li role="presentation" id="empresas"><a href="empresas.php">Empresas</a></li>
					<li role="presentation" id="eventos"><a href="eventos.php">Eventos</a></li>
					<li role="presentation" id="salas"><a href="salas.php">Salas</a></li>
			</ul>
				<ul class="nav navbar-nav nav-tabs navbar-right">
					<?php if(isset($_SESSION['login'])){ echo '<li role="presentation" class="nav-right" id="micuenta"><a href="miCuenta.php">Mi Cuenta</a></li>'; }else{ echo '<li role="presentation" id="identificar" class="nav-right"><a href="inicioSesion.php">Indentifícate</a></li>';}
					?>
			</ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</nav>
