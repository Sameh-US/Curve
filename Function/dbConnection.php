<?php
$servername = "srv1582.hstgr.io";
$username = "u199637790_UNcurve";
$password = ";130lP2?usQ";
$dbname = "u199637790_DBcurve";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  header('Location: ../404.php');
  die("Connection failed: " . $conn->connect_error);
}


