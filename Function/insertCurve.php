<?php
session_start();
if (!isset($_SESSION['userName'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../Login/Login.php');
} else {

    $userIdSession =  $_SESSION['userId'];
    $fullNameSession = $_SESSION['fullName'];
}



include('dbConnection.php');
$Curve_Last_Update = date('Y-m-d H:i:s');

if (
    isset($_POST['selected_value'])
    && isset($_POST['NumberCycl'])
    && isset($_POST['CountHouse'])
    && isset($_POST['DateMonth'])
    && isset($_POST['Curve_countBard'])
    && isset($_POST['Curve_powerFan'])
    && isset($_POST['Curve_typeCurveID'])
) {
    $User_ID = $userIdSession;
    $Curve_farmID = htmlspecialchars($_POST['selected_value'], ENT_QUOTES, 'UTF-8');
    $Curve_cycle = htmlspecialchars($_POST['NumberCycl'], ENT_QUOTES, 'UTF-8');
    $Curve_date = htmlspecialchars($_POST['DateMonth'], ENT_QUOTES, 'UTF-8');
    $Curve_countBard = htmlspecialchars($_POST['Curve_countBard'], ENT_QUOTES, 'UTF-8');
    $Curve_countHouse = htmlspecialchars($_POST['CountHouse'], ENT_QUOTES, 'UTF-8');
    $Curve_powerFan = htmlspecialchars($_POST['Curve_powerFan'], ENT_QUOTES, 'UTF-8');
    $Curve_typeCurveID = htmlspecialchars($_POST['Curve_typeCurveID'], ENT_QUOTES, 'UTF-8');





    $sql = "SELECT * FROM t_maincurve WHERE Curve_farmID = '$Curve_farmID' AND Curve_cycle = '$Curve_cycle'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo '
            <div style="color: red; text-align: center; font-size: 30px;  margin: 10px; padding: 10px ; border-radius: 10px; background-color: var(--color4); ">
            <strong>Error!</strong> The curve already exists. Cycle: ' . $Curve_cycle . '
                please choose another cycle.
                <br>
                
            </div>
            <div style="text-align: center;">
            <a href="../index.php" style="color: var(--colorWiht); text-decoration: none; font-size: 35px; font-weight: 500; border-radius: 5px; padding: 0 15px; cursor: pointer; width: 100%; transition: 0.5s; text-align: center;">Back</a>
            </div>
            ';
            exit();
        }
    }



    $Curve_notes = "Create a new curve start a new cycle created by  " . $fullNameSession . " on " . $Curve_Last_Update . " ."
        . " - Count Bard : " . $Curve_countBard . " -  Count House : " . $Curve_countHouse . "  - Power Fan : " . $Curve_powerFan;

    $sqlInsert = "INSERT INTO t_maincurve (User_ID, Curve_farmID, Curve_cycle, Curve_date, Curve_countBard, Curve_countHouse, Curve_powerFan, Curve_typeCurveID, Curve_Last_Update, Curve_notes)
    VALUES ('$User_ID', '$Curve_farmID', '$Curve_cycle', '$Curve_date', '$Curve_countBard', '$Curve_countHouse', '$Curve_powerFan', '$Curve_typeCurveID', '$Curve_Last_Update', '$Curve_notes')";
    if ($conn->query($sqlInsert) === TRUE) {
        //echo "Record updated successfully";
    } else {
        //echo "Error updating record: " . $conn->error;
    }

    // SELECT max( `Curve_id`) FROM `t_maincurve`
    $Curve_id = "(SELECT max( `Curve_id`) AS Curve_id FROM `t_maincurve`)";
    $result = $conn->query($Curve_id);
    $row = $result->fetch_assoc();
    $Curve_id = $row["Curve_id"];

    for ($i = 0; $i <= 9; $i++) {
        $age = $_POST['age' . $i . ''];
        $temp = $_POST['temp' . $i . ''];
        $min = $_POST['min' . $i . ''];
        $max = $_POST['max' . $i . ''];
        $coling = $_POST['coling' . $i . ''];
        $heater = $_POST['heater' . $i . ''];

        $calc = $_POST['calc' . $i + 1 . ''];
        $fan = $_POST['fan' . $i + 1 . ''];

        $sqlInsertDetalis = "INSERT INTO `t_details_curve`( `Curve_id`,`UserID`, `Cr_Age`, `Cr_Temp`, `Cr_Min`, `Cr_Max`, `Cr_Coling`, `Cr_Heater`, `Cr_Calc`, `Cr_Fan` , `Curve_Last_Update` , `Cr_Order` , `Curve_cycle` , `farm_id` , `Cr_Notes`) VALUES ('$Curve_id', '$User_ID', '$age', '$temp', '$min', '$max', '$coling', '$heater', '$calc', '$fan' , '$Curve_Last_Update' , 1 , '$Curve_cycle' , '$Curve_farmID' , '$Curve_notes')";
        if ($conn->query($sqlInsertDetalis) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }




    $conn->close();
    header("Location: ../Page/show.php");
    exit();
}
