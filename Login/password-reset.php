<?php
$token = $_GET['token'];


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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Reset Password</title>
</head>

<body>

    <div class="container">
        <h1>Reset Password</h1>
        <form action="ProcesspasswordReset.php" method="post">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
            </div>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>

</body>

</html>