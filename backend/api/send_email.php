<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

function sendMail($to, $name, $subject, $body)
{
    $mail = new PHPMailer(true);

    try {

        // =========================
        // SMTP CONFIG
        // =========================
        $mail->isSMTP();
        $mail->Host = getenv("SMTP_HOST") ?: 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        $mail->Username = getenv("SMTP_USER") ?: 'vidhyasri0615@gmail.com';
        $mail->Password = getenv("SMTP_PASS") ?: 'fazxokkcoqwwbanu'; // APP PASSWORD (NO SPACES)

        $secureMode = getenv("SMTP_SECURE") ?: 'tls';
        $mail->SMTPSecure = ($secureMode === 'ssl') ? PHPMailer::ENCRYPTION_SMTPS : PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = getenv("SMTP_PORT") ?: 587;

        // =========================
        // 🔥 IMPORTANT DEBUG (TURN ON FOR TESTING)
        // =========================
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = function ($str, $level) {
            error_log("SMTP DEBUG: $str");
        };

        // =========================
        // EMAIL SETTINGS
        // =========================
        $mail->setFrom(getenv("SMTP_FROM_EMAIL") ?: 'vidhyasri0615@gmail.com', getenv("SMTP_FROM_NAME") ?: 'HIREIQ');
        $mail->addAddress($to, $name);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        // =========================
        // SEND EMAIL
        // =========================
        $mail->send();

        return [
            "status" => "success",
            "message" => "Email sent successfully"
        ];

    } catch (Exception $e) {

        // 🔥 SHOW REAL ERROR
        return [
            "status" => "error",
            "message" => "Email failed",
            "error" => $mail->ErrorInfo
        ];
    }
}
?>

