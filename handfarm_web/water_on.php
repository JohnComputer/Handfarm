<?php
$servername = "DB주소";
$username = "DBID";
$password = "DBPW";
$dbname = "Table명";
$port = "포트";

$time_data = $_GET["time_data"];

$conn = mysqli_connect($servername, $username, $password, $dbname, $port);


$sql = "UPDATE control_test SET control = $time_data";


mysqli_query($conn, $sql);
mysqli_close($conn);
echo "<script>window.location.href = 'senser.php'</script>";
?>
