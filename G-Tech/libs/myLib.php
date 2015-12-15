<?php
 function dbConnect() {
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "diu";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

function salir($message, $code) {
  echo '<script>
    alert("' . $message . '");
    location.href= " ' . $_SERVER['HTTP_REFERER'] . '";
  </script>';
  return $code;
}

function salir2($str, $code, $url) {
  switch ($code) {
    case '0':
      echo '<script>document.getElementById("resultado").className = "alertas animated bounceInDown";</script>';
      echo '<div class="alert alert-success alert-dismissible animated bounceInDown" role="alert">';
      echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
      echo '<strong>'.$str.'</strong>';
      if($url!='0'){
        echo 'En breves instantes será redirigido. Si no fuera así, puede acceder desde el siguiente <a href="'.$url.'" class="alert-link">enlace</a>';
      }
      echo '</div>';
      echo '<script>
      setTimeout(function () {
         document.getElementById("resultado").className = "alertas animated zoomOut";}, 2000);</script>';
      if($url!='0'){
        echo '<script>
        setTimeout(function () {
           window.location.href = "'.$url.'";}, 3000);</script>';
      }
      break;
    case '-1':
      echo '<script>document.getElementById("resultado").className = "alertas animated bounceInDown";</script>';
      echo '<div class="alert alert-danger alert-dismissible animated bounceInDown" role="alert">';
      echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
      echo '<strong>'.$str.'</strong>';
      if($url!='0'){
        echo 'En breves instantes será redirigido. Si no fuera así, puede acceder desde el siguiente <a href="'.$url.'" class="alert-link">enlace</a>';
      }
      echo '</div>';
      echo '<script>
      setTimeout(function () {
         document.getElementById("resultado").className = "alertas animated zoomOut";}, 3000);</script>';
       if($url!='0'){
         echo '<script>
         setTimeout(function () {
            window.location.href = "'.$url.'";}, 3000);</script>';
       }
      break;
    default:
      echo '<script>document.getElementById("resultado").className = "alertas animated bounceInDown";</script>';
      echo '<div class="alert alert-danger alert-dismissible animated bounceInDown" role="alert">';
      echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
      echo '<strong>Si estás viendo esto es porque algo muy malo acaba de pasar.</strong>';
      if($url!='0'){
        echo 'En breves instantes será redirigido. Si no fuera así, puede acceder desde el siguiente <a href="'.$url.'" class="alert-link">enlace</a>';
      }
      echo '</div>';
      echo '<script>
      setTimeout(function () {
         document.getElementById("resultado").className = "alertas animated zoomOut";}, 3000);</script>';
       if($url!='0'){
         echo '<script>
         setTimeout(function () {
            window.location.href = "'.$url.'";}, 3000);</script>';
       }
      break;
  }
}

function envioCorreo($correo, $asunto, $contenido){
  include_once("../assets/sendgrid-php/sendgrid-php.php");

  $sendgrid = new SendGrid('GtechDIU', 'gtechdiu201516');
  $to = $correo;
  $subject = '[G-Tech] '.$asunto;
  $consulta = $contenido;

  $email = new SendGrid\Email();
  $email
      ->addTo($to)
      ->setFrom('gtech@gtech.com')
      ->setSubject($subject)
      ->setHtml($consulta);

  $sendgrid->send($email);
}

function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 6; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass);
}

?>
