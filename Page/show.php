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
    <!-- show Css -->
    <link rel="stylesheet" href="../Css/show.css">

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
                <?php
                if ($PowerUser === "boss") {
                    echo '
                        <li><i class="fa-solid fa-people-roof"></i><a href="../Page/farm.php"> Farm</a></li>
                        <li><i class="fa-solid fa-people-roof"></i><a href="../Page/type.php"> Type</a></li>
                        <li><i class="fa-solid fa-table-cells"></i><a href="../Page/table.php"> Table</a></li>
                ';
                }
                ?>


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
    <!-- End Navbar -->

    <div class="welcome">
        <p><?php echo "Welcome " . $fullNameSession . " !";  ?></p>
    </div>

    <div class="container title ">
        <h2><i class="fa-solid fa-table-cells"></i>Farm Curves<i class="fa-solid fa-table-cells"></i>
        </h2>
        <p>Here you do can store the entire curve and you can view it sorted by farm or cycle number.</p>
    </div>
    <?php
    $Fliter = ' WHERE Curve_cycle =  ( SELECT MAX( `Curve_cycle`) FROM `t_maincurve` ) ';
    if (isset($_GET['FliterFarm'])) {

        $Fliter = ' WHERE Curve_farmID = ' . htmlspecialchars($_GET['FliterFarm'], ENT_QUOTES, "UTF-8") . ' ';
    }

    if (isset($_GET['FliterCycle'])) {
        $Fliter = ' WHERE Curve_cycle = ' . htmlspecialchars($_GET['FliterCycle'], ENT_QUOTES, "UTF-8") . ' ';
    }
    ?>

    <!-- Start Selection -->
    <div class="selection">
        <form action="" method="get">
            <select name="selectFarm" id="" class="selectFarm" onchange="location = this.value;">
                <option value="">Select Farm</option>
                <?php
                include '../Function/dbConnection.php';
                $sqlFarm = "SELECT * FROM `t_farm`";
                $resultFarm = $conn->query($sqlFarm);
                if ($resultFarm->num_rows > 0) {
                    while ($rowFarm = $resultFarm->fetch_assoc()) {
                        echo '
                        <option value="show.php?FliterFarm=' . $rowFarm['farm_id'] . '">' . $rowFarm['farm_name'] . '</option>
                        ';
                    }
                }
                ?>
            </select>
        </form>
        <form action="" method="get">
            <select name="" id="" class="selectCyle" onchange="location = this.value;">
                <option value="">Select Cycle</option>
                <?php
                include '../Function/dbConnection.php';
                $sqlFarm = "SELECT DISTINCT `Curve_cycle`  FROM t_details_curve order by `Curve_cycle` DESC";
                $resultFarm = $conn->query($sqlFarm);
                if ($resultFarm->num_rows > 0) {
                    while ($rowFarm = $resultFarm->fetch_assoc()) {
                        echo '
                        <option value="show.php?FliterCycle=' . $rowFarm['Curve_cycle'] . '">' . $rowFarm['Curve_cycle'] . '</option>
                        ';
                    }
                }
                ?>
            </select>
        </form>
    </div>

    <!-- End Selection -->

    <!-- start mainCurve -->
    <?php
    include '../Function/dbConnection.php';
    $resultAjax = 0;
    $sqlMainCurve = "SELECT * FROM `t_maincurve` $Fliter ORDER BY `t_maincurve`.`Curve_cycle` DESC";
    $resultMainCurve = $conn->query($sqlMainCurve);
    if ($resultMainCurve->num_rows > 0) {
        $hamada = mysqli_num_rows($resultMainCurve);
        echo '<input type="hidden" ID="hamada" value="' . $hamada . '">';
        $btnUpdateID = 0;

        while ($rowMainCurve = $resultMainCurve->fetch_assoc()) {

            $btnUpdateID++;
            $resultAjax++;

            // عنوان البلوك
            $sqlFarm = "SELECT * FROM `t_farm` WHERE farm_id = '$rowMainCurve[Curve_farmID]'";
            $resultFarm = $conn->query($sqlFarm);
            if ($resultFarm->num_rows > 0) {
                $rowFarm = $resultFarm->fetch_assoc();

                $farmName = $rowFarm['farm_name'];

                echo '
                <form action="../Function/insertCurveDetails.php" method="post" id="formGetInsert">
                    
                    <input type="hidden" name="Curve_id" value="' . $rowMainCurve['Curve_id'] . '">
                    <input type="hidden" name="Curve_cycle" value="' . $rowMainCurve['Curve_cycle'] . '">
                    <input type="hidden" name="Curve_farmID" value="' . $rowMainCurve['Curve_farmID'] . '">
                    <div id="mainCurvePrint" class="mainCurveFarm container">';
                echo "<h1 class='printcycle'> Farm : " . $rowFarm['farm_name'] . " / Cycle : " . $rowMainCurve['Curve_cycle'] . " / Date : " . $rowMainCurve['Curve_date'] . "</h1>";
                echo '<div class="mainCurveout container">  <div class="curve">';
                // Last Update
                echo '  
                    <div class="mainTablie contantUpdate">
                        <h2>last Update</h2>';
                $sqlLastUpdate = "SELECT DISTINCT `UserID`, `Curve_id`,`Curve_cycle` ,`Curve_Last_Update`,`Cr_Order` , `farm_id` FROM t_details_curve WHERE `Curve_cycle` = '$rowMainCurve[Curve_cycle]' AND `farm_id` = '$rowMainCurve[Curve_farmID]' ORDER BY `Cr_Order` DESC";
                $resultLastUpdate = $conn->query($sqlLastUpdate);
                if ($resultLastUpdate->num_rows > 0) {

                    $indexOrder = 0;

                    while ($rowLastUpdate = $resultLastUpdate->fetch_assoc()) {
                        $Cr_Order = $rowLastUpdate['Cr_Order'];
                        $indexOrder++;

                        echo '<input type="hidden" name="Cr_Order" value="' . $indexOrder . '">';

                        $Curve_cycle_LastUpdate = $rowLastUpdate['Curve_cycle'];
                        $farm_id_LastUpdate = $rowLastUpdate['farm_id'];

                        $sqlUser = "SELECT * FROM `login` WHERE ID = '$rowLastUpdate[UserID]'";
                        $resultUser = $conn->query($sqlUser);
                        if ($resultUser->num_rows > 0) {
                            $rowUser = $resultUser->fetch_assoc();
                            $linkImage = $rowUser['linkImage'];

                            echo '
                            <button id="btnUpdateID' . $btnUpdateID . '"   class="btnUpdate">
                            
                                <section class="update">
                                    <input type="hidden"  value="?CurveCycle=' . $Curve_cycle_LastUpdate . '&farmID=' . $farm_id_LastUpdate . '&CrOrder=' . $Cr_Order . '">
                                     <input type="hidden" value="' . $resultAjax . '">
                                    <img src="..' . $linkImage . '" alt="">
                                    <p>' . $rowUser['fullName'] . '<br> Last Update: ' . $rowLastUpdate['Curve_Last_Update'] . '</p>
                                </section>
                            </button>
                           ';
                        }
                    }
                }
                echo '  </div>
                ';
                // curve
                echo '             
                    <div class="mainTablie">
                        <h2>Curve</h2>
                        <table id="stepFanTable" class="table">
                            <thead>
                                <tr class="rowHead">
                                    <th class="">Point</th>
                                    <th class="">Age</th>
                                    <th class="">Temp</th>
                                    <th class="">Min</th>
                                    <th class="">max</th>
                                    <th class="">Coling</th>
                                    <th class="">Heater</th>
                                </tr>
                            </thead>
                            <tbody id="result' . $resultAjax  . '">
                            <!-- Ajax -->
                            </tbody>
                        </table>
                    </div>
                ';
                // Step Fan
                echo '
                    <div class="mainTablie">
                        <h2>Step Fan</h2>
                        <table class="table">
                            <thead>
                                <tr class="rowHead">
                                    <th class="">Step</th>
                                    <th class="">Clac</th>
                                    <th class="">Fan</th>
                                </tr>
                            </thead>
                            <tbody id="resultFan' . $resultAjax  . '">
                            <!-- Ajax -->
                            </tbody>
                        </table>
                    </div>
                ';
                echo '</div>
                            <div id="resultNotes' . $resultAjax  . '" class="Notes"></div>
                        </div>';

                if ($PowerUser === "boss") {
                    echo '
                        <button class="btn" onclick="return confirm(\'Are you sure?\')" type="submit" name="update" value="Update"> Update </button>';
                }



                echo "</div></form>";
            }
        }
    }
    ?>
    <!-- End mainCurve -->

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


        window.onload = function() {
            try {


                var hamada = document.getElementById('hamada').value;

                for (let i = 1; i <= hamada; i++) {
                    setTimeout(() => {
                        try {
                            const btnUpdateLoad = document.getElementById('btnUpdateID' + i);
                            btnUpdateLoad.click();
                        } catch (error) {}
                    }, 500 * i);
                }
            } catch (error) {}
        };

        const btnUpdate = document.querySelectorAll('.btnUpdate');
        let URLinputPHP = '';
        let resultAjax = '';

        btnUpdate.forEach(btnUpdateURL => {
            btnUpdateURL.addEventListener('click', function() {
                URLinput = btnUpdateURL.getElementsByTagName('input');
                URLinputPHP = URLinput[0].value;
                resultAjax = URLinput[1].value;
                Select_t_details_curve();
                Select_t_details_curveFan();
                Select_t_details_curveNotes();
            });
        });

        function Select_t_details_curve() {
            event.preventDefault();
            const form = document.getElementById('formGetInsert'); // استخدم معرف العنصر
            // تحقق من وجود النموذج (اختياري ولكن موصى به)
            if (!form) {
                console.error('لم يتم العثور على عنصر النموذج بمعرف "formGetInsert".');
                return; // توقف عن التنفيذ إذا كان النموذج مفقودًا
            }
            const xhr = new XMLHttpRequest();
            xhr.open('Get', '../Function/SelectTDetailsCurve.php' + URLinputPHP, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // اضبط نوع المحتوى بشكل صحيح
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('result' + resultAjax).innerHTML = xhr.responseText;
                } else {
                    console.error('فشل الطلب. حالة الإرجاع: ' + xhr.status);
                }
            };
            const formData = new FormData(form);
            xhr.send(formData);
        }

        function Select_t_details_curveFan() {
            event.preventDefault();
            const form = document.getElementById('formGetInsert'); // استخدم معرف العنصر
            // تحقق من وجود النموذج (اختياري ولكن موصى به)
            if (!form) {
                console.error('لم يتم العثور على عنصر النموذج بمعرف "formGetInsert".');
                return; // توقف عن التنفيذ إذا كان النموذج مفقودًا
            }
            const xhr = new XMLHttpRequest();
            xhr.open('Get', '../Function/SelectTDetailsCurveFan.php' + URLinputPHP, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // اضبط نوع المحتوى بشكل صحيح
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('resultFan' + resultAjax).innerHTML = xhr.responseText;
                } else {
                    console.error('فشل الطلب. حالة الإرجاع: ' + xhr.status);
                }
            };
            const formData = new FormData(form);
            xhr.send(formData);
        }

        function Select_t_details_curveNotes() {
            event.preventDefault();
            const form = document.getElementById('formGetInsert'); // استخدم معرف العنصر
            // تحقق من وجود النموذج (اختياري ولكن موصى به)
            if (!form) {
                console.error('لم يتم العثور على عنصر النموذج بمعرف "formGetInsert".');
                return; // توقف عن التنفيذ إذا كان النموذج مفقودًا
            }
            const xhr = new XMLHttpRequest();
            xhr.open('Get', '../Function/SelectTDetailsCurveNotes.php' + URLinputPHP, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // اضبط نوع المحتوى بشكل صحيح
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('resultNotes' + resultAjax).innerHTML = xhr.responseText;
                } else {
                    console.error('فشل الطلب. حالة الإرجاع: ' + xhr.status);
                }
            };
            const formData = new FormData(form);
            xhr.send(formData);
        }


        // function PrintDiv(id) {

        //     var data = document.getElementById(id).innerHTML;
        //     var myWindow = window.open('', 'my div', 'height=400,width=600');
        //     myWindow.document.write('<link rel="stylesheet" href="../Css/Media.css">');
        //     myWindow.document.write('<link rel="stylesheet" href="../Css/Main.css">');
        //     myWindow.document.write('<link rel="stylesheet" href="../Css/show.css">');
        //     myWindow.document.write('<link rel="stylesheet" href="../Css/print.css">');
        //     myWindow.document.write('<style> .btn{display: none;} </style>');
        //     /*optional stylesheet*/
        //     myWindow.document.write('</head><body >');
        //     myWindow.document.write(data);
        //     myWindow.document.write('</body></html>');
        //     myWindow.document.close(); // necessary for IE >= 10

        //     myWindow.onload = function() { // necessary if the div contain images

        //         myWindow.focus(); // necessary for IE >= 10
        //         myWindow.print();
        //         myWindow.close();
        //     };
        // }
    </script>



    <!-- CHART   -->
    <!-- <script src="../Js/canvasjs.min.js"></script> -->
    <!-- Main Js -->
    <!-- <script src="../Js/Main.js"></script> -->
    <!-- Font Awesome  -->
    <script src="../Js/FontAwesome.js"></script>
</body>

</html>