<?php
session_start();
if (!isset($_SESSION['userName'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ./Login/Login.php');
} else {
    $userNameSession = $_SESSION['userName'];
    $userIdSession =  $_SESSION['userId'];
    $fullNameSession = $_SESSION['fullName'];
    $PowerUser = $_SESSION['PowerUser'];
    $linkImg = $_SESSION['LinkImg'];
}

$id = 0;
$CountBaird = 0;
$PowerFan = 0;
?>


<?php include './Function/dbConnection.php'; ?>
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
    <link rel="icon" type="image/x-icon" href="./Image/favicon.ico">
    <!-- Normalize -->
    <link rel="stylesheet" href="./Css/Normalize.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./Css/FontAwesome.css">
    <!-- Google Material Icon -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=mode_fan" />
    <!-- Main Css -->
    <link rel="stylesheet" href="./Css/Main.css">
    <!-- Media Css -->
    <link rel="stylesheet" href="./Css/Media.css">
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
                <li class="activelink"><i class="fa-solid fa-house-flag"></i><a href="./index.php">Home</a></li>
                <?php
                if ($PowerUser === "boss") {
                    echo '<li><i class="fa-solid fa-people-roof"></i><a href="./Page/farm.php"> Farm</a></li>
                            <li><i class="fa-solid fa-people-roof"></i><a href="./Page/type.php"> Type</a></li>
                            <li><i class="fa-solid fa-table-cells"></i><a href="./Page/table.php"> Table</a></li>';
                }
                ?>


                <li><i class="fa-solid fa-chart-line"></i><a href="./Page/show.php">Show All carves</a></li>
                <li style="background-color: #25D366;"><i class="fa-brands fa-whatsapp " style="color: green;"></i><a
                        href="https://wa.me/+966596733058" style="color: green;">Contact</a></li>
                <div>
                    <form action="" class="formOutLogin">
                        <a class="btn btnOut" type="submit" href="./Function/CloseSession.php"><img class="imgLogo" src=".<?php echo $linkImg; ?>" alt="">Logout</a>
                    </form>
                </div>
            </ul>
        </div>

    </nav>
    <!-- End Navbar -->

    <div class="welcome">
        <p><?php echo "Welcome " . $fullNameSession . " !";  ?></p>
    </div>

    <!-- Start Main -->
    <main class="container ">
        <div class="mainInsertFan">
            <h2>Curves</h2>
            <p>How to calculate minimum ventilation with curve data extraction</p>
            <div>
                <form id="formGet" action="" class="form" method="get">
                    <select required name="selected_value" id="selected_value">
                        <option value="">Select Type</option>
                        <?php
                        // Select data from table
                        $sql = "SELECT * FROM t_type";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option  value="' . $row["type_id"] . '">' . $row["type_name"] . '</option>';
                            }
                        } else {
                            echo "0 results";
                        }
                        ?>
                    </select>
                    <input required type="number" name="CountBaird" placeholder="Count Baird" value="">
                    <input required type="number" name="PowerFan" placeholder="Power Fan" value="">
                    <input required type="number" name="MinimumVentilation" step="0.01"
                        placeholder="Minimum Ventilation" value="">
                    <input required type="number" name="MaxmumVentilation" step="0.01" placeholder="Maxmum Ventilation"
                        value="">
                    <div class="DecimalNumber">
                        <input type="checkbox" checked id="DecimalNumber" name="DecimalNumber" value="true"
                            placeholder="Convert to Decimal">
                    </div>
                    <div class="importData">
                        <button type="submit" class="btn" onclick="getDataFromTable()">Calculate</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <!-- End Main -->

    <!-- start table -->
    <?php $tableEmpty = 0;  ?>
    <div class="container">
        <div class="mainTablie ">
            <?php
            // get table
            if (isset($_GET["selected_value"])) {

                $id = htmlspecialchars($_GET['selected_value'], ENT_QUOTES, "UTF-8");

                // Select data from table
                $sql = "SELECT type_name FROM t_type WHERE type_id = $id";
                $result = $conn->query($sql);

                echo '<h2 class="title" style="color: #25D366">' . $result->fetch_assoc()["type_name"] . ' (Count Baird : ' . $_GET["CountBaird"] . ') - (Power Fan : ' . $_GET["PowerFan"] . ') </h2>';
            }
            ?>
            <table class="table" ID="MainTable">
                <thead>
                    <tr class="rowHead">
                        <th class="">Age</th>
                        <th class="">Weight (G)</th>
                        <th class="">Stand Min Vent</th>
                        <th class="">Min Vent M3/h</th>
                        <th class="">Result (%)</th>
                        <th class="">STEP 1</th>
                        <th class="">STEP 2</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // get table
                    if (isset($_GET["selected_value"]) & isset($_GET["CountBaird"]) & isset($_GET["PowerFan"])) {

                        $id = htmlspecialchars($_GET['selected_value'], ENT_QUOTES, "UTF-8");

                        $CountBaird = htmlspecialchars($_GET['CountBaird'], ENT_QUOTES, "UTF-8");

                        $PowerFan =  htmlspecialchars($_GET['PowerFan'], ENT_QUOTES, "UTF-8");
                        echo '  <input type="hidden" name="selectType" value="' . $id . '" >';
                        // Select data from table
                        $sql = "SELECT * FROM t_table WHERE type_id = $id";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $tableEmpty = 1;
                                $MinVent = floatval($row["table_Stand"]) * floatval($CountBaird);
                                $Result = round(floatval($MinVent) / $PowerFan  * 100);
                                $Step1;
                                $Step2;
                                if ($Result / 100 <= 1) {
                                    $Step1 = $Result;
                                    $Step2 = 0;
                                } else {
                                    $Step1 = 100;
                                    $Step2 = $Result - $Step1;
                                }
                                echo '<tr id="" class="">                                   
                                        <td name="age' . $row["table_Age"] . '">' . $row["table_Age"] . '</td>
                                        <td name="weight' . $row["table_Age"] . '">' . $row["table_Weight"] . '</td>
                                        <td name="vent' . $row["table_Age"] . '">' . $row["table_Stand"] . '</td>
                                        <td>' . $MinVent . '</td>
                                        <td>' . $Result . '</td>
                                        <td>' . $Step1 . '% </td>
                                        <td>' . $Step2 . '%</td>
                                    </tr>';
                            }
                        } else {
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- end table -->



    <!-- start mainCurve -->
    <form id="formGet" action="./Function/insertCurve.php" class="form" method="Post">

        <div class="mainCurveout container">
            <div class="curve">
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
                        <tbody>
                            <?php
                            // get table
                            if (isset($_GET["selected_value"]) & isset($_GET["CountBaird"]) & isset($_GET["PowerFan"]) & isset($_GET["MaxmumVentilation"]) & isset($_GET["MinimumVentilation"])) {

                                $id = htmlspecialchars($_GET['selected_value'], ENT_QUOTES, "UTF-8");
                                $CountBaird = htmlspecialchars($_GET['CountBaird'], ENT_QUOTES, "UTF-8");
                                $PowerFan = htmlspecialchars($_GET['PowerFan'], ENT_QUOTES, "UTF-8");
                                $MaxmumVentilation = htmlspecialchars($_GET['MaxmumVentilation'], ENT_QUOTES, "UTF-8");
                                $MinimumVentilation = htmlspecialchars($_GET['MinimumVentilation'], ENT_QUOTES, "UTF-8");
                                $DecimalNumber;

                                if (isset($_GET["DecimalNumber"])) {
                                    $DecimalNumber = true;
                                } else {
                                    $DecimalNumber = false;
                                }

                                echo '  <input type="hidden" name="selectType" value="' . $id . '" >';
                                // Select data from table
                                $sql = "SELECT * FROM t_table WHERE type_id = $id";
                                $result = $conn->query($sql);
                                $arrayAge = [1, 3, 6, 9, 12, 15, 18, 21, 24, 27];
                                $index = -1;
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {

                                        $age = $row["table_Age"];
                                        if ($age == 1 || $age == 3 || $age == 6 || $age == 9 || $age == 12 || $age == 15 || $age == 18 ||  $age == 21 || $age == 24 ||  $age == 27) {
                                            $index += 1;

                                            $MinVent = floatval($row["table_Stand"] * $MinimumVentilation) * floatval($CountBaird);
                                            $Result = round(floatval($MinVent) / $PowerFan  * 100);
                                            $Step1;
                                            $Step2;
                                            if ($Result / 100 <= 1) {
                                                $Step1 = $Result;
                                                $Step2 = 0;
                                            } else {
                                                $Step1 = 100;
                                                $Step2 = $Result - $Step1;
                                            }

                                            if ($DecimalNumber === true) {
                                                $StepMax = ($Step1 + ($Step2 * 0.01)  * $MaxmumVentilation);
                                                if ($StepMax <= 100) {
                                                    if (($Step1 * $MaxmumVentilation) <= 100) {
                                                        $StepMax = ($Step1 * $MaxmumVentilation);
                                                    } else {
                                                        $StepMax = round(($Step1 * $MaxmumVentilation) / 100) + 100;
                                                    }
                                                } else {
                                                    $StepMax = round($StepMax) + $MaxmumVentilation;
                                                }
                                            } else {
                                                $Step1 = $Step1  / 100;
                                                $StepMax = (($Step1 + ($Step2 * 0.01)) * $MaxmumVentilation);
                                            }



                                            echo '
                                            <tr class="">
                                                <th>' . $index + 1 . '</th>
                                                <td><input name="age' . $index . '" step="1" min="1" max="50" type="number" value="' . $age . '"></td>
                                                <td><input name="temp' . $index . '" step="0.01" min="15" max="40" type="number" value="' . 34 - $index . '"></td>
                                                <td><input name="min' . $index . '" step="0.01"  min="0.01" max="120" type="number" value="' . $Step1 + ($Step2 * 0.01)  . '"></td>
                                                <td><input name="max' . $index . '" step="0.01" min="0.01" max="150" type="number" value="' . $StepMax . '"></td>
                                                <td><input name="coling' . $index . '" step="0.01" min="-10" max="10" type="number" value="' . ($index <= 6  ? "4" : "5") . '"></td>
                                                <td><input name="heater' . $index . '" step="0.01" min="-10" max="10" type="number" value="0"></td>
                                            </tr>
                                        ';
                                        }
                                    }
                                } else {
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="mainTablie">
                    <h2>Step Fan</h2>
                    <table class="table" required>
                        <thead>
                            <tr class="rowHead">
                                <th class="">Step</th>
                                <th class="">Clac</th>
                                <th>Fan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_GET["selected_value"])) {
                                for ($i = 1; $i <= 10; $i++) {
                                    $fan;
                                    if ($i <= 6) {
                                        $fan = 1;
                                    } else if ($i <= 8) {
                                        $fan = 2;
                                    } else {
                                        $fan = 0;
                                    }
                                    echo '
                                    <tr class="">
                                        <td>' . $i . '</td>
                                        <td><input name="calc' . $i . '" step="0.01" min="0" max="30" type="number" value="' . ($i <= 8  ? ($i * 0.5)  : "0") . '"></td>
                                        <td><input name="fan' . $i . '" step="1"  min="0" max="30" type="number" value="' . $fan . '"></td>
                                    </tr>
                                ';
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <?php
            if (isset($_GET["selected_value"])) {
                echo '
            <div class="chart ">
                <div id="chartContainer" style="width: 100%; height: 400px"></div>
            </div> 
            ';
            }
            ?>
        </div>
        <!-- end mainCurve -->

        <!-- Start Save -->
        <?php
        if ($PowerUser === "boss") {
            if ($tableEmpty  == 1) {

                echo '        
                    <main class="container ">
                        <div class="InsertFan">

                        <select required name="selected_value" id="selected_value">
                            <option value="">Select Farm</option>
                            
                            ';

                // Select data from table
                $sql = "SELECT * FROM t_farm";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option  value="' . $row["farm_id"] . '">' . $row["farm_name"] . '</option>';
                    }
                } else {
                    echo "0 results";
                }


                echo ' </select>

                            <input type="hidden" name="Curve_countBard" value="' . $CountBaird . '">
                            <input type="hidden" name="Curve_powerFan" value="' . $PowerFan . '">
                            <input type="hidden" name="Curve_typeCurveID" value="' . $id . '">

                            <input required type="number" name="NumberCycl" min="200" max="2000" placeholder="Number Cycl" value="">
                            <input required type="number" name="CountHouse" min="1" max="100" placeholder="Count House" value="">
                            <input required type="date" min="2020-01-01" max="2100-12-31" name="DateMonth" value="">

                            <div class="importData">
                                <button type="submit" class="btn">Save</button>
                            </div>


                        </div>
                    </main>';
            } else {
            }
        }
        ?>



    </form>
    <!-- End Save -->



    <!-- start footer -->
    <div class="footer ">
        <h2>
            All rights reserved © 2022 to <a href="https://css.lu/">css.lu</a> Sponsored by Eng. Osama, Eng. Ahmed Al-Nakhli and Eng. Mohamed Eid
        </h2>
    </div>
    <!-- end footer -->

    <script>
        window.onload = function() {
            try {
                createCurve();
            } catch (e) {

            }
        };



        $DataTable = []; // المتغير المسئول عن جمع البيانات من الجدول
        // الدالة المسئولة عن تعبئة الكيرف
        const createCurve = function() {
            getDataFromTable();
            var chart = new CanvasJS.Chart("chartContainer", {
                exportEnabled: true,
                animationEnabled: true,
                title: {
                    text: "General diagram of the minimum ventilation and maximum ventilation curve",
                },
                axisX: {
                    valueFormatString: "",
                },
                axisY: {
                    title: "Ventilation Ratio (%)",
                    suffix: " %",
                },
                data: [{
                    type: "rangeSplineArea",
                    indexLabel: "{y[#index]}%",
                    xValueFormatString: "Day 0",
                    toolTipContent: "{x} </br> <strong>Ventilation: </strong> </br> Min: {y[0]} %, Max: {y[1]} %",

                    dataPoints: [{
                            x: new Number($DataTable[1][1]),
                            y: [$DataTable[1][3], $DataTable[1][4]],
                        },
                        {
                            x: new Number($DataTable[2][1]),
                            y: [$DataTable[2][3], $DataTable[2][4]],
                        },
                        {
                            x: new Number($DataTable[3][1]),
                            y: [$DataTable[3][3], $DataTable[3][4]],
                        },
                        {
                            x: new Number($DataTable[4][1]),
                            y: [$DataTable[4][3], $DataTable[4][4]],
                        },
                        {
                            x: new Number($DataTable[5][1]),
                            y: [$DataTable[5][3], $DataTable[5][4]],
                        },
                        {
                            x: new Number($DataTable[6][1]),
                            y: [$DataTable[6][3], $DataTable[6][4]],
                        },
                        {
                            x: new Number($DataTable[7][1]),
                            y: [$DataTable[7][3], $DataTable[7][4]],
                        },
                        {
                            x: new Number($DataTable[8][1]),
                            y: [$DataTable[8][3], $DataTable[8][4]],
                        },
                        {
                            x: new Number($DataTable[9][1]),
                            y: [$DataTable[9][3], $DataTable[9][4]],
                        },
                        {
                            x: new Number($DataTable[10][1]),
                            y: [$DataTable[10][3], $DataTable[10][4]],
                        },
                    ],
                }, ],
            });
            chart.render();
        };
    </script>
    <!-- CHART   -->
    <script src="./Js/canvasjs.min.js"></script>

    <!-- Main Js -->
    <script src="./Js/Main.js"></script>
    <!-- Font Awesome  -->
    <script src="./Js/FontAwesome.js"></script>
</body>

</html>