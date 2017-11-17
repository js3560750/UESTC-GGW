  function findWeather() {
  var cityUrl = 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js';
  $.getScript(cityUrl, function(script, textStatus, jqXHR) {
    var citytq = remote_ip_info.city ;// 获取城市
    $('#city').html(citytq);
    var url = "http://php.weather.sina.com.cn/iframe/index/w_cl.php?code=js&city=" + citytq + "&day=0&dfc=3";
    $.ajax({
      url : url,
      dataType : "script",
      scriptCharset : "gbk",
      success : function(data) {
        var _w = window.SWther.w[citytq][0];
        var tq = _w.s1;
        $('#weather').html(tq);
      }
    });
  });
}
findWeather();

