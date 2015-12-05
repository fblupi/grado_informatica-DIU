<?php
include_once('../libs/myLib.php');
$conn=dbConnect();
$nombre_filtro = $_GET['search'];

$empresas = "SELECT * FROM empresa WHERE empresa.nombre like '%$nombre_filtro%';";

$result = mysqli_query($conn, $empresas);

while ($empresa = mysqli_fetch_assoc($result)) {
  echo '<div class="empresas">';
  echo '<img class="logoEmpresa" src="';
  echo $empresa['imagen'];
  echo '">';
  echo '<h2 class="nombreEmpresa">';
  echo $empresa['nombre'];
  echo '</h2>';
  echo '<p class="descripcionEmpresa">';
  echo $empresa['descripcion'];
  echo '</p>';
  echo '<a class="btn btn-default masInfoEmpresa" href="#" role="button">Ver más...</a>';
  echo '</div>';
}
?>
