<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

class Mail
{

    public function verifyMail($recipient_mail, $recipient_name)
    {


        try {
            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'mimikhainglin70@gmail.com';
            $mail->Password   = 'ngkm xkib nwvl cmkx';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('mimikhainglin70@gmail.com', 'Library');
            $mail->addAddress($recipient_mail, $recipient_name);

            $mail->isHTML(true);
            $mail->Subject = 'Verify Mail';
            $mail->Body    = "<b><a href='$' target='_blank'>Click here</a></b> to verify your registration.";
            $mail->AltBody = 'Visit this link to verify your registration: ';

            return $mail->send(); // ✅ THIS RETURNS TRUE ON SUCCESS
        } catch (Exception $e) {
            error_log("Mailer Error: " . $mail->ErrorInfo);
            return false; // ✅ RETURN FALSE ON FAILURE
        }
    }

    public function sendotp($email, $otp)
    {
        $mail = new PHPMailer(true);

        try {
            // SMTP configuration
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'mimikhainglin70@gmail.com';
            $mail->Password   = 'ngkm xkib nwvl cmkx';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            // Sender & recipient
            $mail->setFrom('mimikhainglin70@gmail.com', 'Go Library');
            $mail->addAddress($email);

            // Email content
            $mail->isHTML(true);
            // Set the email subject
            $mail->Subject = 'Password Reset OTP';

            // Create a professional HTML email body
            $otpLink = "http://localhost:8000/pages/otp?otp=" . urlencode($otp);

$mail->Body = '
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Password Reset OTP</title>
</head>
<body>
  <p>We received a request to reset your password. Use the OTP below or click the button:</p>
  <div style="font-size: 24px; font-weight: bold;">' . htmlspecialchars($otp, ENT_QUOTES) . '</div>
  <p>
    <a href="http://localhost:8000/pages/otp?otp= '.$otp.'" style="
       display:inline-block;
       background-color:#10b981;
       color:#fff;
       padding:10px 20px;
       text-decoration:none;
       border-radius:8px;
       font-weight:bold;
    ">Verify OTP</a>
  </p>
</body>
</html>';


            // Plain text fallback for non-HTML email clients
            $mail->AltBody = "Password Reset Request\n\nYour OTP is: $otp\n\nIf you did not request this, please ignore this email.";



            // Debug
            // $mail->SMTPDebug = 2; // 0=off, 2=full debug output

            // Send email
            $mail->send();
            return true;
        } catch (Exception $e) {
            // Detailed logging
            error_log("PHPMailer failed: " . $mail->ErrorInfo);
            error_log("Exception: " . $e->getMessage());
            // Optional: fallback action here (e.g., save OTP in DB for manual email)
            return false;
        }
    }




    public function sendPasswordEmail($email, $name, $password)
    {
        try {
            $mail = new PHPMailer(true);

            // SMTP configuration from environment variables
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'mimikhainglin70@gmail.com';
            $mail->Password   = 'kazi rpzl mrod njbc';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('mimikhainglin70@gmail.com', 'Library');
            $mail->addAddress($email, $name);

            // HTML email
            $mail->isHTML(true);
            $mail->Subject = 'Your School Library Account is Ready';

            $mail->Body = "
            <html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                    .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #eee; border-radius: 10px; }
                    .btn { display: inline-block; padding: 10px 20px; background: #007BFF; color: #fff; text-decoration: none; border-radius: 5px; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <h2>Welcome to School Library, {$name}!</h2>
                    <p>Your account has been created successfully by the admin.</p>
                    <p><strong>Login Email:</strong> {$email}<br>
                    <strong>Password:</strong> {$password}</p>
                    <p>Please log in using the button below and change your password immediately for security.</p>
                    <p><a class='btn' href='" . URLROOT . "/pages/login'>Login Now</a></p>
                    <p>Best regards,<br>School Library Admin</p>
                </div>
            </body>
            </html>
        ";

            $mail->AltBody = "Dear {$name},\n\nYour account has been created for the School Library system.\n\nLogin Email: {$email}\nPassword: {$password}\n\nPlease log in at " . URLROOT . "/pages/login and change your password.\n\nBest regards,\nSchool Library Admin";

            return $mail->send();
        } catch (Exception $e) {
            error_log("Mailer Error: " . $mail->ErrorInfo);
            return false;
        }
    }


    public function sendReservation($email, $name, $title)
    {
        try {
            $mail = new PHPMailer(true);

            // SMTP configuration
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'mimikhainglin70@gmail.com';
            $mail->Password   = 'kazi rpzl mrod njbc';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('mimikhainglin70@gmail.com', 'School Library');
            $mail->addAddress($email, $name);

            // HTML email
            $mail->isHTML(true);
            $mail->Subject = 'Your Reserved Book is Now Available';

            $mail->Body = "
            <html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f9f9f9; }
                    .container { max-width: 600px; margin: 30px auto; padding: 20px; background: #ffffff; border: 1px solid #e0e0e0; border-radius: 8px; }
                    .header { font-size: 20px; font-weight: bold; margin-bottom: 15px; color: #2c3e50; }
                    .content { font-size: 16px; margin-bottom: 20px; }
                    .btn { display: inline-block; padding: 10px 20px; background: #007BFF; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold; }
                    .footer { font-size: 14px; color: #777; margin-top: 20px; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='header'>Hello {$name},</div>
                    <div class='content'>
                        Good news! The book you reserved is now available for pickup:<br><br>
                        <strong>Book Title:</strong> {$title}<br><br>
                        Please visit the library to collect it at your earliest convenience.
                    </div>
                    <a class='btn' href='" . URLROOT . "/pages/library'>View Library</a>
                    <div class='footer'>
                        Thank you for using our library services.<br>
                        Best regards,<br>
                        School Library Team
                    </div>
                </div>
            </body>
            </html>
        ";

            $mail->AltBody = "Hello {$name},\n\nGood news! The book you reserved is now available for pickup.\n\nBook Title: {$title}\n\nPlease visit the library to collect it.\n\nThank you,\nSchool Library Team";

            return $mail->send();
        } catch (Exception $e) {
            error_log("Mailer Error: " . $mail->ErrorInfo);
            return false;
        }
    }
}
