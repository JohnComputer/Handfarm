<?php
	include 'db_conn.php';
	header("Content-Type: application/json");

	if (mysqli_connect_errno($conn))
	{ echo "MySQL접속 실패: " . mysqli_connect_error(); }

	mysqli_set_charset($conn,"utf8"); // 쿼리문 실행, 결과를 res에 저장
	$res = mysqli_query($conn, "SELECT * FROM 테이블명"); // 결과를 배열로 변환하기 위한 변수 정의 
	$result = array(); // 쿼리문의 결과(res)를 배열형식으로 변환(result)
	while($row = mysqli_fetch_array($res))
	 { array_push($result,
		 array('num'=>$row[0],
		 'ph_val'=>$row[1],
		 'hum_val'=>$row[2],
		 'temp_val'=>$row[3],
		 'cod_val'=>$row[4],
		 'rain_val'=>$row[5],
		 'date_time'=>$row[6]


		 )); } // 배열형식의 결과를 json으로 변환
		 echo json_encode(array("result"=>$result),JSON_UNESCAPED_UNICODE); // DB 접속 종료
		  mysqli_close($con);



?>
