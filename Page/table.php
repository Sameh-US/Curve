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
    <style>
        .selection {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;


            padding: 0;
            margin-bottom: 10px;

        }

        .selection select {
            width: 200px;
            height: 50px;
            border: 1px solid var(--color4);
            border-radius: 5px;
            background-color: var(--color5);
            color: var(--color1);
            padding: 5px;
            cursor: pointer;
            transition: 0.3s;
            text-align: center;
            font-size: 1.2rem;
            font-weight: 400;
        }

        .btn1 {
            width: 200px;
            height: 50px;
            border: 1px solid var(--color4);
            border-radius: 5px;
            background-color: var(--color5);
            color: var(--color1);
            padding: 5px;
            cursor: pointer;
            transition: 0.3s;
            text-align: center;
            font-size: 1.2rem;
            font-weight: 400;
            margin: 5px auto;
        }

        .btn1:hover {
            background-color: var(--color3);
        }

        .formTable {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    </style>
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
        <h2><i class="fa-solid fa-table-cells"></i>Table Curves<i class="fa-solid fa-table-cells"></i>
        </h2>
        <p>From here you can enter the data for calculating the amount of ventilation for birds.</p>
    </div>
    <div class="selection">

        <form action="table.php" method="get">
            <select id="selected_valueMain" name="selected_value" onchange="submit() , saveSelectedValue()">
                <option value="">Select Type</option>
                <?php
                include '../Function/dbConnection.php';
                // Select data from table
                $sql = "SELECT * FROM t_type";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row["type_id"] . '">' . $row["type_name"] . '</option>';
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>
            </select>

        </form>
    </div>
    <!-- start mainCurve -->
    <div class="mainCurveout container">
        <?php $Full = 0;  ?>
        <form class="formTable" action="../Function/table_POST.php" method="post">
            <div class="curve">
                <div class="mainTablie">
                    <?php
                    // get table
                    if (isset($_GET["selected_value"])) {

                        $id = htmlspecialchars($_GET['selected_value'], ENT_QUOTES, "UTF-8");
                        include '../Function/dbConnection.php';
                        // Select data from table
                        $sql = "SELECT type_name FROM t_type WHERE type_id = $id";
                        $result = $conn->query($sql);

                        echo '<h2>' . $result->fetch_assoc()["type_name"] . '</h2>';
                        $conn->close();
                    }
                    ?>

                    <!--  -->
                    <table id="stepFanTable" class=" table">
                        <thead>
                            <tr class="rowHead">
                                <th class="">Age</th>
                                <th class="">Weight (G)</th>
                                <th class="">Stand Min Vent</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            // get table
                            if (isset($_GET["selected_value"])) {
                                $Full++;
                                $id = htmlspecialchars($_GET['selected_value'], ENT_QUOTES, "UTF-8");
                                echo '  <input type="hidden" name="selectType" value="' . $id . '" >';
                                include '../Function/dbConnection.php';
                                // Select data from table
                                $sql = "SELECT * FROM t_table WHERE type_id = $id";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<tr id="" class="">                                   
                                        <td><input readonly name="age' . $row["table_Age"] . '" type="number" value="' . $row["table_Age"] . '"></td>
                                        <td><input name="weight' . $row["table_Age"] . '" type="number" value="' . $row["table_Weight"] . '"></td>
                                        <td><input name="vent' . $row["table_Age"] . '" type="number" step="0.001" value="' . $row["table_Stand"] . '"></td>
                                    </tr>';
                                    }
                                } else {
                                }
                                $conn->close();
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
            if ($Full > 0) {
                echo '<button onclick="return confirm(/"Are you sure?/")" type="submit" class="btn1">Save And Update</button>';
            }

            ?>

        </form>

    </div>
    <!-- end mainCurve -->

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
        // const rows = document.querySelectorAll('tr');
        // rows.forEach(row => {
        //     row.addEventListener('click', () => {
        //         const cells = row.cells;
        //         let rowData = [];
        //         for (let i = 0; i < cells.length; i++) {
        //             rowData.push(cells[i].textContent);
        //         }
        //         const
        //             farmID = document.getElementById('farmID');
        //         const farmName = document.getElementById('farmNameEdit');
        //         farmID.value = rowData[0];
        //         farmName.value = rowData[1];
        //         console.log(rowData[0]); // عرض قيم الصف في الكونسول });
        //     });
        // });
    </script>


    <!-- CHART   -->
    <!-- <script src="../Js/canvasjs.min.js"></script> -->
    <!-- Main Js -->
    <!-- <script src="../Js/Main.js"></script> -->
    <!-- Font Awesome  -->
    <script src="../Js/FontAwesome.js"></script>
</body>

</html>