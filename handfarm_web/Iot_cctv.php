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
            <h2>CCTV</h2>
            <span class="byline">CCTV 화면</span>

        </header>
        <div id="ip" style="text-align: center;">

            접속 하고싶은 IP를 입력해주세요.

            <input type="text" id="address" size="12"></br>
        <!--버튼클릭하기전에 div cctv가 hidden 이지만 버튼클릭시 활성화-->
        <input
            type="button"
            value="access"
            onclick="access_click();"
            style="text-align:center;">
        <!--버튼의 이벤트-->
    </div>

    <div id="cctv" style="text-align: center;display:none;">

    </div>

    <script type="text/javascript">

        var temp; //ip주소를 받을 변수값 생성
        function access_click() {
            //ip 변수에 ip값 을저장
            var ip = document
                .getElementById("address")
                .value;
            //temp에 저장된 ip를 저장
            temp = ip;
            //img를 열어줄 html변수 생성
            var html = '';
            //cctv hidden을 보여줌
            $("#cctv").show();
            $("#ip").hide();
            //html에 이미지 소스 저장
            html += '<img src = http://' + temp + ':8091/?action=stream/>';
            $("#cctv").empty();
            //cctv에 html 변수에 저장해둔 이미지소스 추가
            $("#cctv").append(html);
        }
    </script>

</body>

</html>
