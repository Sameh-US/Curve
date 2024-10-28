<?php

include('dbConnection.php');
if (isset($_GET['CurveCycle']) && isset($_GET['farmID']) && isset($_GET['CrOrder'])) {

    $CurveCycle = htmlspecialchars($_GET['CurveCycle'], ENT_QUOTES, "UTF-8");
    $farmID = htmlspecialchars($_GET['farmID'], ENT_QUOTES, "UTF-8");
    $CrOrder = htmlspecialchars($_GET['CrOrder'], ENT_QUOTES, "UTF-8");


    $sqlDetailsCurve = "SELECT DISTINCT `Cr_Notes` FROM `t_details_curve`  WHERE `Curve_cycle` = '$CurveCycle' AND `Cr_Order` = '$CrOrder' AND `farm_id` = '$farmID'";
    $resultDetailsCurve = $conn->query($sqlDetailsCurve);
    if ($resultDetailsCurve->num_rows > 0) {
        $i = 0;
        while ($rowDetailsCurve = $resultDetailsCurve->fetch_assoc()) {
            $i++;

            echo '                    
            <textarea rows="6" cols="0" id="Notes" name="Cr_Notes" maxlength="2500">' . stripcslashes($rowDetailsCurve['Cr_Notes']) . '</textarea>';
        }
    
    }
}
