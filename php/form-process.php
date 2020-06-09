<?php
require("/class.phpmailer.php");
require("/class.smtp.php");

$errorMSG = "";


// NAME
if (empty($_POST["name"])) {
    $errorMSG = "El nombre es obligario ";
} else {
    $name = $_POST["name"];
}

// EMAIL
if (empty($_POST["email"])) {
    $errorMSG .= "El email es obligatorio ";
} else {
    $email = $_POST["email"];
}

// SUBJECT
if (empty($_POST["subject"])) {
    $errorMSG .= "El asunto es obligatorio";
} else {
    $subject = $_POST["subject"];
}
// phone
if (empty($_POST["phone"])) {
    $errorMSG .= "El Telefono es obligatorio";
} else {
    $phone = $_POST["phone"];
}

// MESSAGE
if (empty($_POST["message"])) {
    $errorMSG .= "El mensaje es obligatorio ";
} else {
    $message = $_POST["message"];
}
$smtpCorreo = "seent.contacto@gmail.com";
$smtpClave = "seent2020!"
$EmailTo = "seent.tramites@gmail.com";


$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Port = 587; 
$mail->IsHTML(true); 
$mail->CharSet = "utf-8";

$mail->Host = $EmailTo; 
$mail->Username = $smtpCorreo; 
$mail->Password = $smtpClave;

$Subject = $subject;

$mail->From = $email; // Email desde donde env�o el correo.
$mail->FromName = $name;
$mail->AddAddress($smtpCorreo); // Esta es la direcci�n a donde enviamos los datos del formulario

$mail->Subject = $Subject; // Este es el titulo del email.
$mensajeHtml = nl2br($mensaje);

$mail->Body = "
<html> 

<body> 

<h1>Recibiste un nuevo mensaje desde el formulario de contacto</h1>

<p>Informacion enviada por el usuario de la web:</p>

<p>nombre: {$name}</p>

<p>email: {$email}</p>

<p>telefono: {$phone}</p>

<p>asunto: {$Subject}</p>

<p>mensaje: {$message}</p>

</body> 

</html>

<br />"; // Texto del email en formato HTML
$mail->AltBody = "{$mensaje} \n\n "; // Texto sin formato HTML

// prepare email body text
// $Body = "";
// $Body .= "Nombre: ";
// $Body .= $name;
// $Body .= "\n";
// $Body .= "Email: ";
// $Body .= $email;
// $Body .= "\n";
// $Body .= "Telefono: ";
// $Body .= $phone;
// $Body .= "\n";
// $Body .= "Mensaje: ";
// $Body .= $message;
// $Body .= "\n";

// send email
// $success = mail($EmailTo, $Subject, $Body, "From:".$email);
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

$estadoEnvio = $mail->Send(); 
if($estadoEnvio){
    echo "El correo fue enviado correctamente.";
} else {
    echo "Ocurri� un error inesperado.";
    exit();
}

// redirect to success page
// if ($success && $errorMSG == ""){
//    echo "Tu mensaje a sido enviado";
// }else{
//     if($errorMSG == ""){
//         echo "Algo fallo :/ pero puedes llamarnos al: 313 3126271 :D";
//     } else {
//         echo $errorMSG;
//     }
// }

?>