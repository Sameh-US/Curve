<?php

$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
include('../Function/dbConnection.php');

$email = strtolower(trim($_POST['email'])); // تحويل البريد إلى أحرف صغيرة وإزالة المسافات
$sqlMalie = "SELECT `email` FROM `login` WHERE `email` = ? ";
$stmtMail = $conn->prepare($sqlMalie);
$stmtMail->bind_param("s", $email);
$stmtMail->execute();
$stmtMail->store_result();
$num_rows = $stmtMail->num_rows;

if ($num_rows == 0) {
        echo "<script>alert('Email not found')</script>";
        echo "<script>window.location.href = './Forget_Password.php'</script>";     
        exit();
}



$token = bin2hex(random_bytes(16));
$token_hash = hash('sha256', $token);
$expiry = date('Y-m-d H:i:s', time() + 60 * 30); // 30 minutes
$sql = "Update login
        set reset_token_hash = ?,
        reset_token_expires_at = ?
        where email = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $token_hash, $expiry, $email);
$stmt->execute();

if ($conn->affected_rows) {
        $mail = require __DIR__ . '/mailer.php';

        $mail->setFrom("s@css.lu"); // Sender
        $mail->addAddress($email); // Receiver

        $mail->Subject = 'Password Reset Link - CSS.LU/Curve';
        $mail->Body =  <<<END

                Hello, you requested a password reset.
                Use the following link to reset your password:
                Click <a href="https://css.lu/Curve/Login/password-reset.php?token=$token">this link</a> 
                to reset your password.
        END;

        try {
                $mail->send();
        } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Reset Password </title>
</head>

<body>
        <div class="container ">
                <h1 class="text-center mb-5 ">Password Reset</h1>
                <p class="text-center mb-5 ">Check your email for password reset link.</p>
                <button type="button" class="btn btn-primary w-100 "><a href="./login.php" class="text-white text-decoration-none">Back to Login</button>
        </div>

</body>

</html>