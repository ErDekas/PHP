<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require __DIR__ . '/../vendor/autoload.php';
class MailHelper {
    public static function enviarCorreoVerificacion($email, $token) {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Cambia esto por tu servidor SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'pabletor0505@gmail.com';
            $mail->Password = 'xysd htjj rcyn kdhj';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->setFrom('pabletor0505@gmail.com', 'Salon Belleza');
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
