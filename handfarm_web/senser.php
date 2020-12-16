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
        <link rel="stylesheet" type="text/css" href="css/toggle.css"/>
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
            <h2>센서값</h2>
            <span class="byline">센서값 측정 부분입니다</span>

        </header>
        <div>
            <div class="container">
                <div class="row" style="text-align: center;">
                    <div class="col-md-12">

                        <div id="g1" style="float: left;"></div>
                        <!-- PH센서값 받는부분 -->
                        <div id="g2" style="float: left;"></div>
                        <!-- 습도센서값 받는부분-->
                        <div id="g3" style="float: left;"></div>
                        <!-- 온도 센서값 받는 부분-->
                        <div id="g4" style="float: left;"></div>
                        <!-- 일산화 탄소 센서값 받는 부분-->
                        <div id="g5" style="float: left;"></div>
                        <!--빗물감지 센서값 받는부분 -->

                    </div>
                </div>
            </div>
            <!-- 물공급 on/off 버튼 -->
            <div style="text-align: center;">
            <h1 id="watertitle">WATER 수동 공급 중</h1>
            <input type="checkbox" id="checkbox">
            <label for="checkbox"><span></span>
            </label>

            </div>

            <!--물을수동적으로 공급해주는 부분-->
            <div id="water" style="text-align: center;">
                sec값을 입력해주세요
            <form action="water_on.php" method="get">
                <input type="text" id="sec" size="12" name="time_data"></br>

                <input
                    type="submit"
                    value="access"
                    onclick="access_click();"
                    style="text-align:center;">
            <!--버튼의 이벤트-->
            </form>
            </div>
        </div>

		<script>


		</script>
    </section>
</div>
</div>

</body>


<script type="text/javascript">

$(document).ready(function(){
    $("#checkbox").change(function(){
        if($("#checkbox").is(":checked")){
            $("#water").hide();
            $("#watertitle").text('WATER 자동 공급 중');
        }else{

            $("#water").show();
            $("#watertitle").text('WATER 수동 공급 중');
        }
    });
});
</script>

<script type="text/javascript">
//function get_data(){
$.ajax({
type: 'get', //get 방식으로 받음
dataType: 'json', //데이터 값을 json으로 받아옴
url: 'url부분', //json api php
contentType: "application/x-www-form-urlencoded; charset=UTF-8",
async: false, // 전역변수 설정 변수
success: function (retVal) {

    var donne = []; //각각데이터값을 받아오는 배열
    //alert(retVal.result.length);
    var html = '';
    var i = retVal.result.length - 1;


    donne.push(retVal.result[i].ph_val);
    donne.push(retVal.result[i].hum_val);
    donne.push(retVal.result[i].temp_val);
    donne.push(retVal.result[i].cod_val);
    donne.push(retVal.result[i].rain_val);

    var g1,
        g2,
        g3,
        g4,
        g5;
    // 게이지 차트 생성
    document.addEventListener("DOMContentLoaded", function (event) {
        g1 = new JustGage({
            id: "g1", value: donne[0], min: -1.75, //최소값
            max: 15.75, //최댓값
            decimals: 2, //소수2번째자리 까지 받아옴
            title: "PH", //타이틀 제목
            label: "ph" //서브 제목
        });

        g2 = new JustGage({
            id: "g2",
            value: donne[1],
            min: 0,
            max: 100,
            decimals: 2,
            title: "습도",
            label: "%"
        });

        g3 = new JustGage({
            id: "g3",
            value: donne[2],
            min: 0,
            max: 100,
            decimals: 2,
            title: "온도",
            label: "°C"
        });

        g4 = new JustGage({
            id: "g4",
            value: donne[3],
            min: 0,
            max: 100,
            decimals: 2,
            title: "일산화탄소",
            label: "ppm"
        });
        g5 = new JustGage({
            id: "g5",
            value: donne[4],
            min: 0,
            max: 100,
            decimals: 2,
            title: "빗물감지",
            label: "%"
        });

        setInterval(function () {
            g1.refresh(donne[0]);
            g2.refresh(donne[1]);
            g3.refresh(donne[2]);
            g4.refresh(donne[3]);
            g5.refresh(donne[4]);
        }, 2500);
    });

    //  }
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
