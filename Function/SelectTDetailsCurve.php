<?php

include('dbConnection.php');
if (isset($_GET['CurveCycle']) && isset($_GET['farmID']) && isset($_GET['CrOrder'])) {

    $CurveCycle = htmlspecialchars($_GET['CurveCycle'], ENT_QUOTES, "UTF-8");
    $farmID = htmlspecialchars($_GET['farmID'], ENT_QUOTES, "UTF-8");
    $CrOrder = htmlspecialchars($_GET['CrOrder'], ENT_QUOTES, "UTF-8");


    $sqlDetailsCurve = "SELECT * FROM `t_details_curve`  WHERE `Curve_cycle` = '$CurveCycle' AND `Cr_Order` = '$CrOrder' AND `farm_id` = '$farmID'";
    $resultDetailsCurve = $conn->query($sqlDetailsCurve);
    if ($resultDetailsCurve->num_rows > 0) {
        $i = 0;
        while ($rowDetailsCurve = $resultDetailsCurve->fetch_assoc()) {
            $i++;

            echo '  <tr  class=""> 
                    <th>' . $i . '</th>
                    <td><input name="Cr_Age' . $i . '" type="number" step="1" max="100" value="' . stripcslashes($rowDetailsCurve['Cr_Age']) . '"></td>
                    <td><input name="Cr_Temp' . $i . '" type="number" step="0.1" max="100" value="' . stripcslashes($rowDetailsCurve['Cr_Temp']) . '"></td>
                    <td><input name="Cr_Min' . $i . '" type="number" step="0.01" max="200" value="' . stripcslashes($rowDetailsCurve['Cr_Min']) . '"></td>
                    <td><input name="Cr_Max' . $i . '" type="number" step="0.01" max="200" value="' . stripcslashes($rowDetailsCurve['Cr_Max']) . '"></td>
                    <td><input name="Cr_Coling' . $i . '" type="number" step="0.01" max="100" value="' . stripcslashes($rowDetailsCurve['Cr_Coling']) . '"></td>
                    <td><input name="Cr_Heater' . $i . '" type="number" step="0.01" max="100" value="' . stripcslashes($rowDetailsCurve['Cr_Heater']) . '"></td>
                </tr>';
        }
    }
}
