function piclist1(){
      pic2=document.getElementById("piclist1-2");
      pic3=document.getElementById("piclist1-3");
      pic4=document.getElementById("piclist1-4");
      pic5=document.getElementById("piclist1-5");
      pic2.src="img/piclist1-2.png";//第二张图片地址,若没有第二张图片，请删除此行
      pic3.src="img/piclist1-3.png";//第三张图片地址,若没有第三张图片，请删除此行
      pic4.src="img/piclist1-4.png";//第四张图片地址,若没有第四张图片，请删除此行
      pic5.src="img/piclist1-5.png";//第五张图片地址,若没有第五张图片，请删除此行
      flag=0;
      number=document.getElementById("picNumber");
      li_list=number.getElementsByTagName("li");
      li_list[0].style.backgroundColor = "#e8eaeb";
      time = setInterval("turn();", 5000); 
      slider=document.getElementById("slider");
      slider.onmouseover = function () { 
          clearInterval(time); 
        } 
        slider.onmouseout = function () { 
          time = setInterval("turn();", 5000); 
        } 

        for (var num = 0; num < li_list.length; num++) { 
          li_list[num].onmouseover = function () { 
          turn(this.innerHTML); 
          clearInterval(time); 
        } 
        li_list[num].onmouseout = function () { 
          time = setInterval("turn();", 5000); 
        } 
        } 

      }
        function turn(value) { 
          if (value != null) { 
            flag = value - 2; 
          } 
          if (flag < li_list.length - 1) 
            ++flag; 
          else
            flag = 0; 
          wrap=document.getElementById("picWrap")
          slider.style.top = flag * (-372) + "px"; 
          for (var j = 0; j < li_list.length; j++) { 
            li_list[j].style.backgroundColor = "#bec6cc"; 
          } 
          picInfor=document.getElementById("picInfor");
          if(flag==0){picInfor.innerHTML="[建党96周年】离退休教职工举行“迎七一”文艺演出";}//第一张图片文字说明,若没有第一张图片，请删除此行
          else if(flag==1){picInfor.innerHTML="我是第二张图片文字说明啦啦啦";}//第二张图片文字说明,若没有第二张图片，请删除此行
          else if(flag==2){picInfor.innerHTML="我是第三张图片文字说明啦啦啦";}//第三张图片文字说明,若没有第三张图片，请删除此行
          else if(flag==3){picInfor.innerHTML="我第四张图片文字说明啦啦啦";}//第四张图片文字说明,若没有第四张图片，请删除此行
          else if(flag==4){picInfor.innerHTML="我第五章图片文字说明啦啦啦";}//第五张图片文字说明,若没有第五张图片，请删除此行
          li_list[flag].style.backgroundColor = "#e8eaeb"; 
        } 