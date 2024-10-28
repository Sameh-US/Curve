<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../Image/favicon.ico">
    <title>Ventilation Curves</title>
</head>

<body>

    <section class="wrapper">

        <?php
        include('../Function/dbConnection.php');



        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_id']) && $_POST['form_id'] === 'signup') {


            $fullName = $_POST['fullName'];
            $email = $_POST['email'];
            $userName = $_POST['userName'];
            $password = $_POST['password'];
            $Active = false;

            $fullName = htmlspecialchars($fullName);
            $userName = htmlspecialchars($userName);
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $error = array();
            if (empty($fullName) || empty($email) || empty($password)) {
                $error['fullName'] = "Full name is required";
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error['email'] = "Valid email is required";
            }
            if (strlen($password) < 3) {
                $error['password'] = "Password must be at least 3 characters";
            }
            if (strlen($fullName) < 3) {
                $error['fullName'] = "Full Name must be at least 3 characters";
            }
            if (strlen($password) > 20) {
                $error['password'] = "Password must be at least 20 characters";
            }
            if (strlen($fullName) > 20) {
                $error['fullName'] = "Full Name must be at least 20 characters";
            }


            $sqluserName = "SELECT * FROM `login` WHERE `userName` = '$userName'";
            $resultUserName = mysqli_query($conn, $sqluserName);

            $sqlEmail = "SELECT * FROM `login` WHERE `email` = '$email'";
            $resultEmail = mysqli_query($conn, $sqlEmail);

            if (mysqli_num_rows($resultUserName) > 0) {
                $error['userName'] = "Username already exists";
            }

            if (mysqli_num_rows($resultEmail) > 0) {
                $error['email'] = "email already exists";
            }

            if (count($error) > 0) {
                foreach ($error as $key => $value) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> ' . $value . '
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
            } else {
                $sql = "INSERT INTO `login`(`fullName`, `email`, `userName`, `password`, `Active`) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);

                if (!$prepareStmt) {
                    die('SQL error: ' . mysqli_error($conn));
                } else {
                    mysqli_stmt_bind_param($stmt, 'ssssb', $fullName, $email, $userName, $passwordHash, $Active);
                    mysqli_stmt_execute($stmt);
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> Your account has been created. <br> 
                            But you must have the approval of the system administrator.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>                
                        </div>';
                }
            }
        }

        ?>

        <div class="form signup">

            <header>Signup</header>
            <form action="" method="POST">
                <input type="hidden" name="form_id" value="signup">
                <input name="fullName" type="text" placeholder="Full name" required />
                <input name="email" type="text" placeholder="Email address" required />
                <input name="userName" type="text" placeholder="User Name" required />
                <input name="password" type="password" placeholder="Password" required />
                <input type="submit" value="Signup" />
            </form>
        </div>


        <?php

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_id']) && $_POST['form_id'] === '2') {



            $userName = $_POST['userName'];
            if (!preg_match('/^[a-zA-Z0-9_]{4,20}$/', $userName)) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> Invalid username format.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }

            $password = $_POST['password'];
            if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> Invalid password format.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }

            $sql = "SELECT * FROM `login` WHERE `userName` = '$userName'";

            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {

                if (password_verify($password, $user['password'])) {
                    $Active = $user['Active'];
                    if ($Active == 0) {
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> The account has already been created. <br> 
                                 But is awaiting approval with activation authorization.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>                
                            </div>';
                    } else {
                        // Here we can create the session
                        session_start();
                        $_SESSION['userId'] = $user['ID'];
                        $_SESSION['userName'] = $user['userName'];
                        $_SESSION['fullName'] = $user['fullName'];
                        $_SESSION['PowerUser'] = $user['power'];
                        $_SESSION['LinkImg'] = $user['linkImage'];
                        header('Location: ../index.php');
                    }
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> The password is incorrect.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> The username is incorrect.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
        }
        ?>
        <div class="form login">
            <header>Login</header>
            <form action="" method="POST">
                <input type="hidden" name="form_id" value="2">
                <input name="userName" type="text" placeholder="User Name" required />
                <input name="password" type="password" placeholder="Password" required />
                <a href="./Forget_Password.php">Forgot password?</a>
                <input type="submit" value="Login" />
            </form>
        </div>

        <script>
            const wrapper = document.querySelector(".wrapper"),
                signupHeader = document.querySelector(".signup header"),
                loginHeader = document.querySelector(".login header");

            loginHeader.addEventListener("click", () => {
                wrapper.classList.add("active");
            });
            signupHeader.addEventListener("click", () => {
                wrapper.classList.remove("active");
            });
        </script>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>