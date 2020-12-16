<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body>
    <input type="button" name="" value="데이터가져오기" onclick="get_data();">
    <div>
      <table id="dynamicTable">
        <thead>
          <tr>
            <th>num</th>
            <th>ph_val</th>
            <th>hum_val</th>
            <th>temp_val</th>
            <th>cod_val</th>
            <th>rain_val</th>
            <th>date_time</th>
          </tr>
        </thead>
        <tbody id="dynamicTbody">
        </tbody>
      </table>
    </div>
  </body>
  <script type="text/javascript">
  function get_data(){
  $.ajax({
    type: 'get',
    dataType: 'json',
    url: 'url 부분',
    contentType :   "application/x-www-form-urlencoded; charset=UTF-8",
    async:false, // 전역변수 설정 변수
    success: function (retVal) {
      alert(retVal.result.length);
        var html = '';
        for(var i = 0; i<= retVal.result.length - 1; i++){
             // console.log(retVal.data[data_num].measuredList[i]);
             html += '<tr>';
             // html += '<td>'+retVal.data[data_num].measuredList[i].dev+'</td>';
             html += '<td>'+retVal.result[i].num+'</td>';
             html += '<td>'+retVal.result[i].ph_val+'</td>';
             html += '<td>'+retVal.result[i].hum_val+'</td>';
             html += '<td>'+retVal.result[i].temp_val+'</td>';
             html += '<td>'+retVal.result[i].cod_val+'</td>';
             html += '<td>'+retVal.result[i].rain_val+'</td>';
             html += '<td>'+retVal.result[i].date_time+'</td>';
             html += '</tr>';
           }
        $("#dynamicTbody").empty();
       $("#dynamicTbody").append(html);
    },
    error: function (request, status, error) {
        console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
        // 오류가 날경우 console창 오류 메세지 출력
    }
  });
  }
  </script>
</html>
