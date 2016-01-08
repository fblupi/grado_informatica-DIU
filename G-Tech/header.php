<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>G-Tech</title>
<link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
<?php
include_once 'libs/myLib.php';
$conn = dbConnect();
if(!isset($_SESSION)){
	session_start();
}
if(isset($_SESSION['id'])){
	$login = $_SESSION['login'];
	$idUsuario = $_SESSION['id'];
	$sql3 = "SELECT * FROM usuario, usuario_permisos WHERE usuario.id = usuario_permisos.usuario AND usuario.id = '$idUsuario';";
	$resultado3 = mysqli_query($conn, $sql3);
	$permisosAdmin = 0;
	$permisosUser = 0;
	while($permisos = mysqli_fetch_assoc($resultado3)){
		$id = $permisos['id'];
		if($permisos['permiso']==1){
			$permisosAdmin = 1;
		}
		if($permisos['permiso']==2){
			$permisosUser = 1;
		}
	}
}
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<!-- css -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
<link href="assets/css/style.css" rel="stylesheet"/>
<link href="assets/css/animate.css" rel="stylesheet"/>
<link href="assets/css/stacktable.css" rel="stylesheet"/>
<link href="assets/css/bootstrap-datepicker3.min.css" rel="stylesheet"/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" type="text/css">
</head>
<body id="divPrincipal">
<header>
<div class="header" id="logos">
<a href="index.php"><img alt="Logo G-Tech" id="logo" src="assets/img/logo.png" alt="Inicio"></a>
	<img alt="Cabecera G-Tech" class="gtech" src="assets/img/header1.png">
	<img alt="Lema G-Tech" class="coworking" src="assets/img/header2.png">
</div>
</header>
<!-- navbar -->
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
					<?php if(!empty($_SESSION['login'])){
						$id = $_SESSION['id'];
						$sql3 = "SELECT usuario.imagen FROM usuario WHERE usuario.id = $id;";
						$resImagen = mysqli_query($conn, $sql3);
						$imagen = mysqli_fetch_assoc($resImagen);
						$fotoHeader = $imagen['imagen'];
						echo '<li class="dropdown">';
	          echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<div class="fotoHeader"><img alt="Mi foto de perfil" class="portrait" src="'.$fotoHeader.'"></div>'
							.$login.' <span class="caret"></span></a>';
	          echo '<ul class="dropdown-menu animated fadeInDown">';
						echo '<li><a href="miCuenta.php"><i class="fa fa-user usuario"></i> Mi perfil</a></li>';
						if($permisosAdmin==1){
							echo '<li><a href="gestionUsuarios.php"><i class="fa fa-users usuario"></i> Gestionar usuarios</a></li>';
						}
						if($permisosUser==1){
							echo '<li><a href="gestionarEventos.php"><i class="fa fa-calendar usuario"></i> Mis eventos</a></li>';
							echo '<li><a href="gestionarEmpresas.php"><i class="fa fa-certificate usuario"></i> Mis empresas</a></li>';
							echo '<li><a href="misSalas.php"><i class="fa fa-home usuario"></i> Mis salas</a></li>';
						}
						echo '<li role="separator" class="divider"></li>';
	          echo '<li><a href="scripts/cerrarSesion.php">Cerrar sesión</a></li>';
	          echo '</ul>';
	          echo '</li>';
					}else{
						echo '<li role="presentation" id="identificar" class="nav-right"><a href="inicioSesion.php">Identifícate</a></li>';
					}
					?>
			</ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div id="resultado"></div>
<div id="divModal" class="modalDialog">
  <div>
		<a href="#close" title="Close" class="close">X</a>
    <div id="modalBody">
	</div>
</div>
</div>
