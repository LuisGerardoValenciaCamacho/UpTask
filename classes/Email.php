<?php 

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;
    
    public function __construct($nombre, $email, $token) {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = "smtp.mailtrap.io";
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->SMTPSecure = "tls";
        $mail->Username = 'b47b98d51dad7b';
        $mail->Password = '4d0c180b9c0035';
        $mail->isHTml(true);
        $mail->CharSet  = "UTF-8";
        $mail->setFrom("cuentas@uptask.com");
        $mail->addAddress("cuentas@uptask.com", "UpTask.com");
        $mail->Subject = "Confirma tu cuenta";
        $contenido = "<html>";
        $contenido .= "<p>Hola <strong>" . $this->nombre . "</strong> Has creado tu cuenta en UpTask, solo debes confirmar la cuenta presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/confirmar-cuenta?token=";
        $contenido .= $this->token . "'>Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;
        $mail->send();
    }

    public function enviarRecuperacion() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = "smtp.mailtrap.io";
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->SMTPSecure = "tls";
        $mail->Username = 'b47b98d51dad7b';
        $mail->Password = '4d0c180b9c0035';
        $mail->isHTml(true);
        $mail->CharSet  = "UTF-8";
        $mail->setFrom("cuentas@uptask.com");
        $mail->addAddress("cuentas@uptask.com", "UpTask.com");
        $mail->Subject = "Recuperar password";
        $contenido = "<html>";
        $contenido .= "<p>Para cambiar tu password, solo debes de ir al enlace poder realizar tu cambio</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/recuperar-password?token=";
        $contenido .= $this->token . "'>Cambiar password</a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;
        $mail->send();
    }

}

?>