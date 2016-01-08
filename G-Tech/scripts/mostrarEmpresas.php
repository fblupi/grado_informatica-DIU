<?php
include_once('../libs/myLib.php');
$conn=dbConnect();
$nombre_filtro = $_GET['search'];

$empresas = "SELECT * FROM empresa WHERE empresa.nombre like '%$nombre_filtro%';";

$result = mysqli_query($conn, $empresas);

while ($empresa = mysqli_fetch_assoc($result)) {
  echo '<div class="empresas row">';
  echo '<div class="col-md-12 col-lg-12">';
  echo '<div class="logoEmpresa">';
  echo '<img alt="Logo ';
  echo $empresa['nombre'];
  echo '" src="';
  echo $empresa['imagen'];
  echo '"/>';
  echo '</div>';
  echo '<h2 class="nombreEmpresa">';
  echo $empresa['nombre'];
  echo '</h2>';
  echo '<div class="descripcionEmpresa">';
  echo '<p>';
  echo $empresa['descripcion'];
  echo '</p>';
  echo '<a class="btn btn-default masInfoEmpresa" href="empresa.php?i=';
  echo $empresa['id'];
  echo '" role="button">Ver más...</a>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
}
?>
