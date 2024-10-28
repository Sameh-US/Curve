<?php
session_start();
if (!isset($_SESSION['userName'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../Login/Login.php');
} else {

    $userIdSession =  $_SESSION['userId'];
}

include('dbConnection.php');


if (
    isset($_POST['Curve_id'])

) {
    $User_ID = $userIdSession;
    $Curve_id = htmlspecialchars($_POST['Curve_id'], ENT_QUOTES, "UTF-8");
    $Curve_Last_Update = date('Y-m-d H:i:s');
    $Cr_Order = htmlspecialchars($_POST['Cr_Order'], ENT_QUOTES, "UTF-8");
    $Cr_Order++;
    $Curve_cycle = htmlspecialchars($_POST['Curve_cycle'], ENT_QUOTES, "UTF-8");
    $Curve_farmID = htmlspecialchars($_POST['Curve_farmID'], ENT_QUOTES, "UTF-8");
    $Cr_Notes = htmlspecialchars($_POST['Cr_Notes'], ENT_QUOTES, "UTF-8");



    for ($i = 1; $i <= 10; $i++) {
        $Cr_Age = $_POST['Cr_Age' . $i . ''];
        $Cr_Temp = $_POST['Cr_Temp' . $i . ''];
        $Cr_Min = $_POST['Cr_Min' . $i . ''];
        $Cr_Max = $_POST['Cr_Max' . $i . ''];
        $Cr_Coling = $_POST['Cr_Coling' . $i . ''];
        $Cr_Heater = $_POST['Cr_Heater' . $i . ''];
        $Cr_Calc = $_POST['Cr_Calc' . $i  . ''];
        $Cr_Fan = $_POST['Cr_Fan' . $i . ''];

        $Cr_Age = filter_var($Cr_Age, FILTER_VALIDATE_INT);
        $Cr_Temp = filter_var($Cr_Temp, FILTER_VALIDATE_FLOAT);
        $Cr_Min = filter_var($Cr_Min, FILTER_VALIDATE_FLOAT);
        $Cr_Max = filter_var($Cr_Max, FILTER_VALIDATE_FLOAT);
        $Cr_Coling = filter_var($Cr_Coling, FILTER_VALIDATE_FLOAT);
        $Cr_Heater = filter_var($Cr_Heater, FILTER_VALIDATE_FLOAT);
        $Cr_Calc = filter_var($Cr_Calc, FILTER_VALIDATE_FLOAT);
        $Cr_Fan = filter_var($Cr_Fan, FILTER_VALIDATE_INT);



        $sqlInsertDetalis = "INSERT INTO `t_details_curve`( `UserID`, `Curve_id`, `Cr_Age`, `Cr_Temp`, `Cr_Min`, `Cr_Max`, `Cr_Coling`, `Cr_Heater`, `Cr_Calc`, `Cr_Fan`, `Curve_Last_Update`, `Cr_Order`, `Curve_cycle`, `farm_id`, `Cr_Notes`) VALUES     
    
                                                        ('$User_ID','$Curve_id','$Cr_Age','$Cr_Temp','$Cr_Min','$Cr_Max','$Cr_Coling','$Cr_Heater','$Cr_Calc','$Cr_Fan','$Curve_Last_Update','$Cr_Order','$Curve_cycle','$Curve_farmID','$Cr_Notes')";

        if ($conn->query($sqlInsertDetalis) === TRUE) {
            echo "Record updated successfully";
        } else {
           header('Location: ../404.php');
        }
    }

    $conn->close();
    header("Location: ../Page/show.php");
    exit();
}
