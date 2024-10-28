<?php
$token = $_POST['token'];


$token_hash = hash('sha256', $token);



include('../Function/dbConnection.php');

$sql = "SELECT * FROM login WHERE reset_token_hash = ? ";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token_hash);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
if ($user === null) {
    echo 'token not found';
}

if (strtotime($user['reset_token_expires_at']) <=  time()) {
    die("token has expired");
}


if (isset($_POST['password']) && isset($_POST['confirmPassword'])) {
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    if ($password == $confirmPassword) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "Update login
                set password = ?,
                reset_token_hash = null,
                reset_token_expires_at = null
                where reset_token_hash = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $password_hash, $token_hash);
        $stmt->execute();
        if ($conn->affected_rows) {
            header("Location: ../Login/Login.php");
        }
    } else {
        echo 'passwords do not match';
    }
}
?>