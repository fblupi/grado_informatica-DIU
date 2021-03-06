<?php
if(!isset($_SESSION['id'])){
  session_start();
}
include_once 'libs/myLib.php';
$conn = dbConnect();
$idSala = $_GET['idSala'];
$fechaEntrada = $_GET['fechaEntrada'];
$horaEntrada = $_GET['horaEntrada'];
$fechaSalida = $_GET['fechaSalida'];
$horaSalida = $_GET['horaSalida'];
?>
<h2>Confirmar reserva</h2>
<form id="formularioConfirmarReserva" method="POST" role="search" class="buscarSalas" action="javascript:ConfirmarReserva()" data-toggle="validator" role="form">
  <input type="hidden" name="idSala" value="<?php echo $idSala; ?>">
  <div class="row">
    <div class="col-md-6 col-lg-6">
      <div class="form-group">
      <label>Fecha</label>
      <input type="date" id="fechaEntrada" name="fechaEntrada" class="form-control" placeholder="20-08-2016" value="<?php echo $fechaEntrada; ?>" required>
      </div>
    </div>
    <div class="col-md-6 col-lg-6">
    <div class="form-group">
    <label>Hora de entrada</label>
    <input type="text" id="horaEntrada" name="horaEntrada" class="form-control" placeholder="10:00" value="<?php echo $horaEntrada; ?>" required>
    </div>
    </div>
    </div>
    <div class="row">
    <div class="col-md-6 col-lg-6">
    </div>
    <div class="col-md-6 col-lg-6">
    <div class="form-group">
    <label>Hora de salida</label>
    <input type="text" id="horaSalida" name="horaSalida" class="form-control" placeholder="12:00" value="<?php echo $horaSalida; ?>" required>
    </div>
    </div>
    </div>
    <input type="submit" class="btn btn-default" value="Confirmar">
</form>
