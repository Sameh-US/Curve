<?php
include('dbConnection.php');

if (isset($_GET['typeID']) && isset($_GET['typeName'])) {

  $id = htmlspecialchars($_GET['typeID'], ENT_QUOTES, "UTF-8");
  $Type_nameEdit = htmlspecialchars($_GET['typeName'], ENT_QUOTES, "UTF-8");
  $sqlUpdate = "UPDATE t_type SET type_name = '$Type_nameEdit' WHERE type_id = '$id'";

  $result = $conn->query($sqlUpdate);
  if ($conn->query($sqlUpdate) === TRUE) {
  } else {
    header('Location: ../404.php');
  }

  $conn->close();
  header("Location: ../Page/type.php");
  exit();
}


if (isset($_POST['typeName'])) {

  $type_name = htmlspecialchars($_POST['typeName'], ENT_QUOTES, "UTF-8");
  $type_name = htmlspecialchars(trim($type_name));
}

//التحقق من ان القيمه المرسلة تحمل اسكربت خبث ام لا
if (!is_string($type_name)) {
  echo $type_name;
}
$sqlInsert =  ("INSERT INTO t_type (type_name)VALUES ('$type_name')");
if ($conn->query($sqlInsert) === TRUE) {
  echo "Record updated successfully";
} else {
 header('Location: ../404.php');
}

$sqlMaxType = "SELECT max(`type_id`) FROM `t_type` ;";
$result = $conn->query($sqlMaxType);

$row = $result->fetch_assoc();
$type_id = $row["max(`type_id`)"];
for ($i = 1; $i <= 30; $i++) {
  $sqlInsertTable =  ("INSERT INTO t_table (type_id, table_Age, table_Weight, table_Stand)VALUES ('$type_id', " . $i . ", '0', '0')");
  if ($conn->query($sqlInsertTable) === TRUE) {
    echo "Record updated successfully";
  } else {
    header('Location: ../404.php');
  }
}

$conn->close();
header("Location: ../Page/type.php");
