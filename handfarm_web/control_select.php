<?php
$servername = "DB주소";
$username = "DBID";
$password = "DBPW";
$dbname = "Table명";
$port = "포트";


$conn = mysqli_connect($servername, $username, $password, $dbname, $port);

$sql = "SELECT * FROM control_test";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
echo "<waterCheck>$row[control]</waterCheck>";

mysqli_close($conn);
?>
