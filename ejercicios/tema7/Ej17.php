<?php
// Verificar si el certificado está presente
if (!isset($_SERVER['SSL_CLIENT_CERT'])) {
    echo "No se encontró un certificado. Por favor, proporciona un certificado digital.";
    exit();
}

// Obtener el certificado
$cert = $_SERVER['SSL_CLIENT_CERT'];

// Analizar el certificado para obtener información
$cert_data = openssl_x509_parse($cert);

// Verificar el emisor y el nombre común (CN) del certificado
if ($cert_data) {
    $subject = $cert_data['subject'];
    $issuer = $cert_data['issuer'];

    // Aquí puedes verificar si el usuario es válido, basándote en el CN o algún otro atributo
    $user_cn = $subject['CN']; // Common Name del usuario

    // Validar el CN con una lista de usuarios permitidos o contra una base de datos
    if ($user_cn === "Nombre del Usuario") {
        echo "Autenticación exitosa. Bienvenido, " . htmlspecialchars($user_cn) . "!";
    } else {
        echo "Certificado válido, pero el usuario no tiene acceso.";
    }
} else {
    echo "Certificado inválido.";
}
