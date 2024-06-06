<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $correo;
    public $nombre;
    public $token;

    public function __construct($correo, $nombre, $token) {

        $this->correo = $correo;
        $this->nombre = $nombre;
        $this->token = $token;

    }

    public function enviarConfirmacion() {
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor
            $mail->isSMTP();
            $mail->Host = $_ENV['EMAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Port = $_ENV['EMAIL_PORT'];
            $mail->Username = $_ENV['EMAIL_USER'];
            $mail->Password = $_ENV['EMAIL_PASSWORD'];
            
            // Configuración del remitente y destinatario
            $mail->setFrom('cuentas@appsalon.com', 'AppSalon.com');
            $mail->addAddress($this->correo, $this->nombre); // Correo del destinatario

            // Asunto y contenido del correo
            $mail->Subject = 'Confirma tu Cuenta';
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            $contenido = '<html>';
            $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong>, has creado tu cuenta en App Salón, solo debes confirmarla presionando el siguiente enlace:</p>";
            $contenido .= "<p>Presiona aquí: <a href='" .  $_ENV['APP_URL']  . "/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a></p>";        
            $contenido .= "<p>Si tú no solicitaste este cambio, haz caso omiso de este correo.</p>";
            $contenido .= '</html>';
            $mail->Body = $contenido;

            // Enviar el correo
            $mail->send();
            echo 'El mensaje ha sido enviado';
        } catch (Exception $e) {
            echo "El mensaje no se pudo enviar. Error de correo: {$mail->ErrorInfo}";
        }
    }

    public function enviarInstrucciones() {
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor
            $mail->isSMTP();
            $mail->Host = $_ENV['EMAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Port = $_ENV['EMAIL_PORT'];
            $mail->Username = $_ENV['EMAIL_USER'];
            $mail->Password = $_ENV['EMAIL_PASSWORD'];

            // Configuración del remitente y destinatario
            $mail->setFrom('cuentas@appsalon.com', 'AppSalon.com');
            $mail->addAddress($this->correo, $this->nombre); // Correo del destinatario

            // Asunto y contenido del correo
            $mail->Subject = 'Reestablece tu contraseña';
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            $contenido = '<html>';
            $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong>, has solicitado reestablecer tu contraseña. Sigue el siguiente enlace para hacerlo:</p>";
            $contenido .= "<p>Presiona aquí: <a href='" .  $_ENV['APP_URL']  . "/recuperar?token=" . $this->token . "'>Reestablecer Contraseña</a></p>";        
            $contenido .= "<p>Si tú no solicitaste este cambio, haz caso omiso de este correo.</p>";
            $contenido .= '</html>';
            $mail->Body = $contenido;

            // Enviar el correo
            $mail->send();
            echo 'El mensaje ha sido enviado';
        } catch (Exception $e) {
            echo "El mensaje no se pudo enviar. Error de correo: {$mail->ErrorInfo}";
        }
    }

}
