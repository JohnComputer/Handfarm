<?php
 date_default_timezone_set("Asia/Seoul");
 $ph_val = $_GET['ph_val'];
$hum_val = $_GET['hum_val'];
$temp_val = $_GET['temp_val'];
$cod_val = $_GET['cod_val'];
$rain_val = $_GET['rain_val'];
$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

 $servername = "DB주소";
 $username = "DBID";
 $password = "DBPW";
 $dbname = "Table명";
 $port = "포트";

// $conn = mysqli_connect($servername, $username, $password, $dbname, $port);
// $sql = "INSERT INTO senser_data(ph_val, hum_val, temp_val, cod_val, rain_val, date_time) VALUES ('$ph_val', '$hum_val','$temp_val', '$cod_val', '$rain_val', '$regist_day')";
// mysqli_query($conn, $sql);
// mysqli_close($conn);

$mysqli = new mysqli("DB주소", "DBID", "DBPW", "Table명");
$stmt = $mysqli->prepare("INSERT INTO sensor_data(ph_val, hum_val, temp_val, cod_val, rain_val, date_time) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param('ssssss', $ph_val, $hum_val, $temp_val, $cod_val, $rain_val, $regist_day);
if ($stmt->execute()) {
$returnData .= 'success';
$stmt->close();
}


?>
