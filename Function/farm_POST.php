<?php
include('dbConnection.php');

if (isset($_GET['farmID']) && isset($_GET['farmName'])) {
  $id = htmlspecialchars($_GET['farmID'], ENT_QUOTES, "UTF-8");
  $farm_nameEdit = htmlspecialchars($_GET['farmName'], ENT_QUOTES, "UTF-8");
  $sqlUpdate = "UPDATE t_farm SET farm_name = '$farm_nameEdit' WHERE farm_id = '$id'";
  $result = $conn->query($sqlUpdate);
  if ($conn->query($sqlUpdate) === TRUE) {
    echo "Record updated successfully";
  } else {
    header('Location: ../404.php');
  }
  $conn->close();
  header("Location: ../Page/farm.php");
  exit();
}


if (isset($_POST['farmName'])) {

  $farm_name = htmlspecialchars($_POST['farmName'], ENT_QUOTES, "UTF-8");
  $farm_name = htmlspecialchars(trim($farm_name));
}
// التحقق من ان القيمه المرسله فارغه ام لا
if (empty($farm_name)) {
  echo $farm_name;
  exit();
}
//التحقق من ان القيمه المرسلة تحمل اسكربت خبث ام لا
if (!is_string($farm_name)) {
  echo $farm_name;
}
$sqlInsert =  ("INSERT INTO t_farm (farm_name)VALUES ('$farm_name')");
if ($conn->query($sqlInsert) === TRUE) {
  echo "Record updated successfully";
} else {
  header('Location: ../404.php');
}

$conn->close();
header("Location: ../Page/farm.php");
