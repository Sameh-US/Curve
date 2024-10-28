<?php
session_start();
if (!isset($_SESSION['userName'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../Login/Login.php');
} else {
    $userNameSession = $_SESSION['userName'];
    $userIdSession =  $_SESSION['userId'];
    $fullNameSession = $_SESSION['fullName'];
    $PowerUser = $_SESSION['PowerUser'];
    $linkImg = $_SESSION['LinkImg'];
}
if ($PowerUser === "guest") {
    header('location: ../index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Sameh Kamal">
    <!-- Fonts Cairo and Noto Serif Oriya -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Noto+Serif+Oriya:wght@400..700&display=swap"
        rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../Image/favicon.ico">
    <!-- Normalize -->
    <link rel="stylesheet" href="../Css/Normalize.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../Css/FontAwesome.css">
    <!-- Google Material Icon -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=mode_fan" />
    <!-- Main Css -->
    <link rel="stylesheet" href="../Css/Main.css">
    <!-- Media Css -->
    <link rel="stylesheet" href="../Css/Media.css">

    <title>Ventilation Curves</title>
</head>

<body>
    <!-- Start Navbar -->
    <nav class="navbar container">
        <div class="logo">
            <h2>Curves</h2>
        </div>
        <div class="navbar-toggler">
            <i class="fas fa-bars"></i>
        </div>
        <div class="normal linkToggle">
            <ul class="links">
                <li class="activelink"><i class="fa-solid fa-house-flag"></i><a href="../index.php">Home</a></li>
                <li><i class="fa-solid fa-people-roof"></i><a href="../Page/farm.php"> Farm</a></li>
                <li><i class="fa-solid fa-people-roof"></i><a href="../Page/type.php"> Type</a></li>
                <li><i class="fa-solid fa-table-cells"></i><a href="../Page/table.php"> Table</a></li>
                <li><i class="fa-solid fa-chart-line"></i><a href="../Page/show.php">Show All carves</a></li>
                <li style="background-color: #25D366;"><i class="fa-brands fa-whatsapp " style="color: green;"></i><a
                        href="https://wa.me/+966596733058" style="color: green;">Contact</a></li>
                <div>
                    <form action="">
                        <a class="btn btnOut" type="submit" href="../Function/CloseSession.php"><img class="imgLogo" src="..<?php echo $linkImg; ?>" alt="">Logout</a>
                    </form>
                </div>
            </ul>
        </div>
    </nav>
    <div class="welcome">
        <p><?php echo "Welcome " . $fullNameSession . " !";  ?></p>
    </div>
    <!-- End Navbar -->
    <div class="container title ">
        <h2><i class="fa-solid fa-house-chimney-window"></i>Farm<i class="fa-solid fa-house-chimney-window"></i></h2>
        <p>From here you can enter and modify the types of farms on which you want to store data.</p>
    </div>



    <div class="container farm">
        <div class="addFarm ">
            <form action="../Function/farm_POST.php" method="POST">
                <label for="farmName">Add Farm</label>
                <input type="text" name="farmName" id="farmName" placeholder="Farm Name" required maxlength="30" minlength="3">
                <button type="submit" onclick="return confirm('Are you sure?')" class="btn">Add Farm</button>
            </form>
            <div></div>
            </hr>
            <form action="../Function/farm_POST.php" method="POST">
                <table class="tableFarm" id="tableFarm">
                    <tr>
                        <th>ID</th>
                        <th>Farm Name</th>
                        <th>Delete</th>
                    </tr>
                    <?php
                    include '../Function/dbConnection.php';
                    // Delete
                    if (isset($_GET['id']) && $_GET['action'] == 'delete') {

                        $id = htmlspecialchars($_GET['id'], ENT_QUOTES, "UTF-8");
                        $sql = "DELETE FROM t_farm WHERE farm_id = '$id'";
                        if ($conn->query($sql) === TRUE) {
                            echo "<p class='msg'>Record deleted successfully </p>";
                        } else {
                            header('Location: ../404.php');
                        }
                        $sqlDelete = "DELETE FROM `t_details_curve` WHERE `farm_id`  = '$id'";
                        if ($conn->query($sql) === TRUE) {
                            echo "<p class='msg'>Record deleted successfully </p>";
                        } else {
                            header('Location: ../404.php');
                        }
                    }
                    // Select data from table
                    $sql = "SELECT * FROM t_farm";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>" . $row["farm_id"] . "</td>
                                <td>" . $row["farm_name"] . "</td>          

                                <td>
                                        <a onclick='return confirm(\"Are you sure?\")' href='./farm.php?id=" . $row["farm_id"] . "&action=delete'><i class='fa-solid fa-trash'></i> Delete</a></td>
                                </tr>";
                        }
                    } else {
                    }
                    $conn->close();
                    ?>
                </table>
            </form>
            <div></div>
            <form action="../Function/farm_POST.php?action=edit&id=farmID&farmName=farmName" method="get" action>
                <label for="farmName">Edit Farm</label>
                <input type="number" readonly name="farmID" id="farmID" placeholder="Farm ID ">
                <input type="text" name="farmName" id="farmNameEdit" placeholder="Farm Name " required maxlength="30" minlength="3">
                <button onclick="return confirm('Are you sure?')" type="submit" class="btn">Edit Farm</button>
            </form>
        </div>
    </div>

    <!-- start footer -->
    <div class="footer ">
        All rights reserved © 2022 to <a href="https://css.lu/">css.lu</a> Sponsored by Eng. Osama, Eng. Ahmed Al-Nakhli and Eng. Mohamed Eid
    </div>
    <!-- end footer -->

    <script>
        const active = document.querySelector(".navbar-toggler");
        const links = document.querySelector(".linkToggle");
        active.addEventListener("click", () => {
            if (links.classList.contains("active")) {
                document.querySelector(".linkToggle").classList.remove("active");
                document.querySelector(".linkToggle").classList.add("normal");
            } else {
                document.querySelector(".linkToggle").classList.add("active");
                document.querySelector(".linkToggle").classList.remove("normal");
            }
        });
        // الحصول على الجدول
        const rows = document.querySelectorAll('tr');
        rows.forEach(row => {
            row.addEventListener('click', () => {
                const cells = row.cells;
                let rowData = [];
                for (let i = 0; i < cells.length; i++) {
                    rowData.push(cells[i].textContent);
                }
                const farmID = document.getElementById('farmID');
                const farmName = document.getElementById('farmNameEdit');
                farmID.value = rowData[0];
                farmName.value = rowData[1];
                console.log(rowData[0]); // عرض قيم الصف في الكونسول
            });
        });
    </script>



    <!-- CHART   -->
    <!-- <script src="../Js/canvasjs.min.js"></script> -->
    <!-- Main Js -->
    <!-- <script src="../Js/Main.js"></script> -->
    <!-- Font Awesome  -->
    <script src="../Js/FontAwesome.js"></script>
</body>

</html>