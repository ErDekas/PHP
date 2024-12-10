<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

class MailHelper {
    public static function enviarCorreoVerificacion($email, $token) {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = $_ENV['SMTP_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['SMTP_USERNAME'];
            $mail->Password = $_ENV['SMTP_PASSWORD'];
            $mail->SMTPSecure = $_ENV['SMTP_SECURE'];
            $mail->Port = $_ENV['SMTP_PORT'];

            $mail->setFrom($_ENV['SMTP_USERNAME'], 'Salon Belleza');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Confirma tu cuenta';
            $mail->Body = "Haz clic en el siguiente enlace para confirmar tu cuenta: 
                          <a href='http://localhost/salon/index.php?action=confirmar&token=$token'>Confirmar Cuenta</a>";

            $mail->send();
        } catch (Exception $e) {
            echo "Error al enviar el correo: {$mail->ErrorInfo}";
        }
    }
}
?>
