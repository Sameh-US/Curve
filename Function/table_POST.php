<?php
include('dbConnection.php');

$arrytable = array();
for ($i = 1; $i <= 30; $i++) {
    if (isset($_POST['selectType']) && isset($_POST['age' . $i . '']) && isset($_POST['weight' . $i . '']) && isset($_POST['vent' . $i . ''])) {

        $type_id = htmlspecialchars($_POST['selectType'], ENT_QUOTES, "UTF-8");
        $arrytable[$i]['age']   = htmlspecialchars($_POST['age' . $i . ''], ENT_QUOTES, "UTF-8");
        $arrytable[$i]['weight']   = htmlspecialchars($_POST['weight' . $i . ''], ENT_QUOTES, "UTF-8");
        $arrytable[$i]['vent']   = htmlspecialchars($_POST['vent' . $i . ''], ENT_QUOTES, "UTF-8");
    }

    $sqlUpdate = "UPDATE `t_table` SET `table_Weight`='" . $arrytable[$i]['weight'] . "',`table_Stand`='" . $arrytable[$i]['vent'] . "' WHERE `table_Age`='" . $arrytable[$i]['age'] . "' and `type_id`='" . $type_id . "'; ";

    if ($conn->query($sqlUpdate) === TRUE) {
        echo "Record updated successfully";
    } else {
        header('Location: ../404.php');
    }
}

$conn->close();
header("Location: ../Page/table.php");
exit();
