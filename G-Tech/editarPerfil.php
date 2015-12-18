<?php include 'header.php'; ?>
<section>
<h1 class="section-header">Editar perfil<hr></hr></h1>
<article>
<?php
if(!isset($_SESSION['login'])){
	echo '<script>location.href="inicioSesion.php";</script>';
}
include_once 'libs/myLib.php';
$conn = dbConnect();
$login = $_SESSION['login'];

$sql = "SELECT * FROM Usuario WHERE login = '$login'";

$resultado = mysqli_query($conn, $sql);

while($usuario = mysqli_fetch_assoc($resultado)){
	echo '<div class="miPerfil">';
	echo '<h2>';
	echo $usuario['login'];
	echo '</h2>';
	echo '<form class="formularioEditarPerfil" method="POST" action="scripts/modificarPerfil.php" data-toggle="validator" role="form" enctype="multipart/form-data">';
	echo '<div class="col-lg-6 col-md-6">';
	echo '<div class="form-group has-feedback">';
	echo '<label>Nombre: </label>';
	echo '<input type="text" class="form-control" id="nombre" name="nombre" value="';
	echo $usuario['nombre'];
	echo '" maxlength="40">';
	echo '<span class="glyphicon form-control-feedback" aria-hidden="true"></span>';
	echo '</div>';
	echo '<div class="form-group">';
	echo '<label>Teléfono: </label>';
	echo '<input type="tel" class="form-control" id="telefono" name="telefono" value="';
	echo $usuario['telefono'];
	echo '" maxlength="9">';
	echo '<span class="glyphicon form-control-feedback" aria-hidden="true"></span>';
	echo '</div>';
	echo '<div class="form-group has-feedback">';
	echo '<label>Sexo: </label>';
	echo '<div class="radio">';
	echo '<label><input type="radio" name="sexo" value="hombre"';
	if($usuario['sexo']=='hombre'){ echo 'checked = checked';}
	echo '>Hombre</label><br>';
	echo '<label><input type="radio" name="sexo" value="mujer"';
	if($usuario['sexo']=='mujer'){ echo 'checked = checked';}
	echo '>Mujer</label>';
	echo '</div>';
	echo '<span class="glyphicon form-control-feedback" aria-hidden="true"></span>';
	echo '</div>';
	echo '<div class="form-group">';
	echo '<label>Imagen de perfil</label>';
	echo '<input type="file" max-size=2048 class="form-control" id="imagen" name="imagen">';
	echo '</div>';
	echo '</div>';
	echo '<div class="col-lg-6 col-md-6">';
	echo '<div class="form-group">';
	echo '<label>País</label>';
	echo '<input type="text" class="form-control" id="pais" name="pais" value="';
	echo $usuario['pais'];
	echo '">';
	echo '</div>';
	echo '<div class="form-group">';
	echo '<label>Localidad</label>';
	echo '<input type="text" class="form-control" id="localizacion" name="localizacion" value="';
	echo $usuario['localidad'];
	echo '">';
	echo '</div>';
	echo '<div class="form-group">';
	echo '<label>Dirección</label>';
	echo '<input type="text" class="form-control" id="direccion" name="direccion" value="';
	echo $usuario['direccion'];
	echo '">';
	echo '</div>';
	echo '<div class="form-group">';
	echo '<label>Código postal</label>';
	echo '<input type="text" class="form-control" id="codigoPostal" name="codigoPostal" value="';
	echo $usuario['codigoPostal'];
	echo '">';
	echo '</div>';
	echo '</div>';
	echo '<div class="form-group">';
	echo '<button type="submit" class="btn btn-default inicioSesion">Editar</button>';
	echo '</div>';
	echo '</form>';
	echo '</div>';
}

?>
</article>
</section>
<?php include 'footer.php'; ?>
