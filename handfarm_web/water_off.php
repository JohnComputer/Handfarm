<?php
$servername = "DB주소";
$username = "DBID";
$password = "DBPW";
$dbname = "Table명";
$port = "포트";

$conn = mysqli_connect($servername, $username, $password, $dbname, $port);


$sql = "UPDATE control_test SET control = 0";


mysqli_query($conn, $sql);
mysqli_close($conn);
?>
