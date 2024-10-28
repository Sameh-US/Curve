<?php

include('dbConnection.php');
if (isset($_GET['CurveCycle']) && isset($_GET['farmID']) && isset($_GET['CrOrder'])) {

    $CurveCycle = htmlspecialchars($_GET['CurveCycle'], ENT_QUOTES, "UTF-8");
    $farmID = htmlspecialchars($_GET['farmID'], ENT_QUOTES, "UTF-8");
    $CrOrder = htmlspecialchars($_GET['CrOrder'], ENT_QUOTES, "UTF-8");


    $sqlDetailsCurve = "SELECT `Cr_Calc` , `Cr_Fan` FROM `t_details_curve`  WHERE `Curve_cycle` = '$CurveCycle' AND `Cr_Order` = '$CrOrder' AND `farm_id` = '$farmID'";
    $resultDetailsCurve = $conn->query($sqlDetailsCurve);
    if ($resultDetailsCurve->num_rows > 0) {
        $i = 0;
        while ($rowDetailsCurve = $resultDetailsCurve->fetch_assoc()) {
            $i++;

            echo '  <tr  class="">
                        <th>' . $i . '</th>
                        <td><input name="Cr_Calc' . $i . '" type="number" step="0.01" max="100" value="' . stripcslashes($rowDetailsCurve['Cr_Calc']) . '"></td>
                        <td><input name="Cr_Fan' . $i . '" type="number"step="1" max="100" value="'  . stripcslashes($rowDetailsCurve['Cr_Fan']) . '"></td>
                    </tr>';
        }
    }
}
