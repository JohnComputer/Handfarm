<!DOCTYPE HTML>
<!-- Horizons by TEMPLATED templated.co @templatedco Released for free under the
Creative Commons Attribution 3.0 license (templated.co/license) -->
<html>
    <head>
        <title>스마트농부들</title>
        <script
            type="text/javascript"
            src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <meta name="description" content=""/>
        <meta name="keywords" content=""/>
        <!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.dropotron.min.js"></script>
        <script src="js/skel.min.js"></script>
        <script src="js/skel-layers.min.js"></script>
        <script src="js/init.js"></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
        <script src="http://bernii.github.io/gauge.js/dist/gauge.min.js"></script>
        <noscript>
            <link rel="stylesheet" href="css/skel.css"/>
            <link rel="stylesheet" href="css/style.css"/>
        </noscript>
        <script src="../js/raphael-2.1.4.min.js"></script>
        <script src="../js/justgage.js"></script>
        <!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
    </head>
    <body class="no-sidebar">

        <!-- Header -->
        <div id="header">
            <div class="container">

                <!-- Logo -->
                <h1>
                    <a href="#" id="logo">HandFarm</a>
                </h1>

                <!-- Nav -->
                <nav id="nav">
                    <ul>
                        <li>
                            <a href="url부분">Home</a>
                        </li>
                        <li>
                            <a href="">LIVE</a>
                            <ul>
                                <li>
                                    <a href="senser.php">현재 센서값</a>
                                </li>
                                <li>
                                    <a href="Iot_cctv.php">CCTV</a>
                                </li>
                                <li>
                                    <a href="">부분 센서값</a>
                                    <ul>
                                        <li>
                                            <a href="ph_senser.php">PH</a>
                                        </li>
                                        <li>
                                            <a href="hum_senser.php">HUM</a>
                                        </li>
                                        <li>
                                            <a href="temp_senser.php">TEMP</a>
                                        </li>
                                        <li>
                                            <a href="cod_senser.php">COD</a>
                                        </li>
                                        <li>
                                            <a href="rain_senser.php">RAIN</a>
                                        </li>
                                    </ul>
                                </li>

                            </ul>
                        </li>
                        <li>
                            <a href="left-sidebar.html">발표자료</a>
                        </li>
                    </ul>
                </nav>

        </ul>
    </nav>

</div>
</div>

<!-- Main -->
<div id="main" class="wrapper style1">

<div class="container">
    <section>
        <header class="major">
            <h2>PH센서값</h2>
            <span class="byline">PH센서값 측정 부분입니다</span>

        </header>
        <div>

            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <canvas id="g1"></canvas>

                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

</body>
<script type="text/javascript">
//function get_data(){
$.ajax({
    type: 'get',
    dataType: 'json',
    url: 'url부분',
    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
    async: false, // 전역변수 설정 변수
    success: function (retVal) {
        var donne = []; //ph 값을 받는 배열

        //alert(retVal.result.length);
        var html = '';
        var i = retVal.result.length - 1;

        for (var i = retVal.result.length - 11; i <= retVal.result.length - 1; i++) {


            donne.push(retVal.result[i].ph_val); // 배열에 최근 10번째 값까지 추출해서 push

        }

        var myChartOne = document.getElementById('g1');

        var barChart = new Chart(myChartOne, {
            type: 'bar', //bar타입 차트생성
            label: 'test', //제목은 'test'로 생성
            data: {
                labels: donne, // 레이블을 데이터값으로 주어서 보기편하게 함
                datasets: [
                    {
                        label: "PH_Values",
                        data: donne, //데이터값
                        backgroundColor: [
                            //차트 막대기 색깔 지정
                            'rgba(178,235,244,1)',
                            'rgba(178,235,244,1)',
                            'rgba(178,235,244,1)',
                            'rgba(178,235,244,1)',
                            'rgba(178,235,244,1)',
                            'rgba(178,235,244,1)',
                            'rgba(178,235,244,1)',
                            'rgba(178,235,244,1)',
                            'rgba(178,235,244,1)',
                            'rgba(178,235,244,1)',
                            'rgba(178,235,244,1)'
                        ]

                    }
                ]

            }
        });

        $("#dynamicTbody").empty();
        $("#dynamicTbody").append(html);
    },
    error: function (request, status, error) {
        console.log(
            'code: ' + request.status + "\nmessage: " + request.responseText +
            "\nerror: " + error
        );
        // 오류가 날경우 console창 오류 메세지 출력
    }
});
//}
</script>
</html>
