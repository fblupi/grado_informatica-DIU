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

function envioCorreo($correo, $asunto, $contenido){
  require("../assets/sendgrid-php/sendgrid-php.php");

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
