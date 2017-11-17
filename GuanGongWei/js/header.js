'use strict';
function SetHome(obj,url){
    try{
        obj.style.behavior='url(#default#homepage)';
       obj.setHomePage(url);
   }catch(e){
       if(window.netscape){
          try{
              netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
         }catch(e){
              alert("抱歉，此操作被浏览器拒绝！\n\n请在浏览器地址栏输入“about:config”并回车然后将[signed.applets.codebase_principal_support]设置为'true'");
          }
       }else{
        alert("抱歉，您所使用的浏览器无法完成此操作。\n\n您需要手动将【"+url+"】设置为首页。");
       }
  }
}
function AddFavorite(title, url) {
  try {
      window.external.addFavorite(url, title);
  }
catch (e) {
     try {
       window.sidebar.addPanel(title, url, "");
    }
     catch (e) {
         alert("抱歉，您所使用的浏览器无法完成此操作。\n\n加入收藏失败，请使用Ctrl+D进行添加");
     }
  }
}



window.onload = function(){
  var myDate = new Date();
  var year = myDate.getFullYear();
  var month = myDate.getMonth()+1;
  var date = myDate.getDate();
  var day = myDate.getDay()
  function check(i){
        if (i==0)
        {
          return "日";
        }
        else if(i==1)
        {return "一"}
      else if(i==2)
        {return "二"}
      else if(i==3)
        {return "三"}
      else if(i==4)
        {return "四"}
      else if(i==5)
        {return "五"}
      else
        {return "六"}
      }
  var nowDateTime = document.getElementById("nowDateTime");
  nowDateTime.innerHTML="<span>"+year+"年"+month+"月"+date+"日"+"</span><span>周"+check(day)+"</span>"
  piclist1();
  piclist2();
}


