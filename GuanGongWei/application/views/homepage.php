<!DOCTYPE HTML>
<html>
<head>
  <meta http-equiv="content-type" content="text/html charset=utf-8">
  <title>电子科技大学关工委首页</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/homepage.css')?>">
</head>
<body>
<div class="bg">
  <div class="head-top">
    <div class="head">
      <ul class="head-left">
        <li class="div1"><a class="div11" href="javascript:void(0);" onclick="AddFavorite('我的网站',location.href)">收藏本站</a></li>
        <li class="div1"><a class="div11" href="javascript:void(0);" onclick="SetHome(this,'http://www.ecmoban.com');">设为首页</a></li>
        <li class="div1"><a class="div11" href="<?php echo site_url('/admin/admin/login/')?>">管理入口</a></li>
      </ul>
      <ul class="head-right">
        <li id="weather"></li>
        <li id="city"></li>
        <li id="nowDateTime" onload="startTime()"></li>
      </ul>
    </div>
  </div>
  <div class="head-logo">
    <img class="head-img" src="<?php echo base_url('img/head-logo.png')?>">
    <span><img class="head-img2" src="<?php echo base_url('img/head-logo2.png')?>"></span>
    <form class="head-logo-right" method="post" action="<?php echo site_url('/home/search/')?>">
      <input class="head-submit" type="submit" name="submit" value="搜索"></input>
      <input class="head-text" type="text" name="text" placeholder ="请输入文章标题或关键字"></input>
    </form>
  </div>
  <ul class="head-title">
    <li><a href="<?php echo site_url('/home/index/')?>">首页</a></li>
    <li><a href="<?php echo site_url('/home/category/8')?>">关工委简介</a></li>
    <li><a href="<?php echo site_url('/home/category/9')?>">政策规章</a></li>
    <li><a href="<?php echo site_url('/home/category/0')?>">工作动态</a></li>
    <li><a href="<?php echo site_url('/home/category/1')?>">通知公告</a></li>
    <li><a href="<?php echo site_url('/home/category/2')?>">学习园地</a></li>
    <li><a href="<?php echo site_url('/home/category/3')?>">五老风采</a></li>
    <li><a href="<?php echo site_url('/home/category/10')?>">工作平台</a></li>
    <li><a href="<?php echo site_url('/home/contact')?>">联系我们</a></li>
  </ul>

<!--图片轮播一-->
<div class="pic-list1" id=picWrap>
      <span class="wrap">
      <span class="slider" id="slider">
        <!--只会提取设定为轮播的最新的5篇文章展示-->
        <a href="<?php echo site_url('/home/content/'.$showArticle['0']['id'])?>"><img id="piclist1-1" src="<?php echo base_url('assets/i/').$showArticle['0']['top_img_url']?>"/></a>
        <a href="<?php echo site_url('/home/content/'.$showArticle['1']['id'])?>"><img id="piclist1-2" src="<?php echo base_url('assets/i/').$showArticle['1']['top_img_url']?>"/></a>
        <a href="<?php echo site_url('/home/content/'.$showArticle['2']['id'])?>"><img id="piclist1-3" src="<?php echo base_url('assets/i/').$showArticle['2']['top_img_url']?>"/></a>
        <a href="<?php echo site_url('/home/content/'.$showArticle['3']['id'])?>"><img id="piclist1-4" src="<?php echo base_url('assets/i/').$showArticle['3']['top_img_url']?>"/></a>
        <a href="<?php echo site_url('/home/content/'.$showArticle['4']['id'])?>"><img id="piclist1-5" src="<?php echo base_url('assets/i/').$showArticle['4']['top_img_url']?>"/></a>
        


      </span>
        <div class="number">
          <!--只会提取设定为轮播的最新的5篇文章展示，文章标题在最下面的js里面-->
          <span id="picInfor"><?php echo $showArticle['0']['title']?></span>
          <ul id="picNumber">
            <li>1</li>
            <li>2</li>
            <li>3</li>
            <li>4</li>
            <li>5</li>
          </ul>
        </div>
      </span>
      
      <span class="work-dynamic">
        <span>
          <span>工作动态</span>
          <a href="<?php echo site_url('/home/category/0')?>">更多>></a>
        </span>
        <img src="<?php echo base_url('img/pic-border.png')?>">
        <ul>
        <!--置顶文章标题，区域限制只置顶1个-->
          <span><a href="<?php echo site_url('/home/content/'.$workDynamicsTop['0']['id'])?>"><?php echo $workDynamicsTop['0']['title']?></a></span>
        <!--普通文章标题-->
        <?php foreach($workDynamics as $value):?>
          <li><a href="<?php echo site_url('/home/content/'.$value['id'])?>"><?php echo $value['title']?></a></li>
        <?php endforeach ?>
        </ul>
      </span>
    </div>

<!--新闻版块-->
<div class="news-list">
      <div class="row-one">
        <span class="type-one">
          <span>
            <span>通知公告</span>
            <span><a href="<?php echo site_url('/home/category/1')?>">更多>></a></span>
          </span>
          <ul>
          <!--置顶文章标题，目前只能置顶1个，后期再改-->
          <?php if(isset($noticeTop['0'])){
            echo '<li><a href="';
            echo site_url('/home/content/'.$noticeTop['0']['id']);
            echo '"><span>';
            echo $noticeTop['0']['title'];
            echo '<span class="top-style"></span></span><span>';
            echo date('Y-m-d',$noticeTop['0']['time']);
            echo '</span></a></li>';
           } ?>

          <!--普通文章标题-->
          <?php foreach($notice as $value):?>
            <li><a href="<?php echo site_url('/home/content/'.$value['id'])?>"><span><?php echo $value['title']?></span><span><?php echo date('Y-m-d',$value['time'])?></span></a></li>
          <?php endforeach ?>
            
          </ul>
        </span>
        <span class="type-one">
          <span>
            <span>五老风采</span>
            <span><a href="<?php echo site_url('/home/category/3')?>">更多>></a></span>
          </span>
          <ul>
          <!--置顶文章标题，目前只能置顶1个，后期再改-->
          <?php if(isset($fiveOldTop['0'])){
            echo '<li><a href="';
            echo site_url('/home/content/'.$fiveOldTop['0']['id']);
            echo '"><span>';
            echo $fiveOldTop['0']['title'];
            echo '<span class="top-style"></span></span><span>';
            echo date('Y-m-d',$fiveOldTop['0']['time']);
            echo '</span></a></li>';
           } ?>

          <!--普通文章标题-->
          <?php foreach($fiveOld as $value):?>
            <li><a href="<?php echo site_url('/home/content/'.$value['id'])?>"><span><?php echo $value['title']?></span><span><?php echo date('Y-m-d',$value['time'])?></span></a></li>
          <?php endforeach ?>
          </ul>         
        </span>
        <span class="type-two">
          <div class="top">
            <div>——— • 特色活动 • ——— </div>
            <a href="<?php echo site_url('/home/category/11')?>"><img src="<?php echo base_url('img/uestc-story.jpg')?>" /></a>
            <a href="<?php echo site_url('/home/category/12')?>"><img src="<?php echo base_url('img/student-invite.jpg')?>"/></a>
          </div>
          <div class="bottom">
            <div>——— • 联系我们 • ——— </div>
            <span><img src="<?php echo base_url('img/pos.png')?>"/><span>电子科技大学东二院老年活动中心三楼</span></span>
            <span><img src="<?php echo base_url('img/tel.png')?>"/><span>关工委办公室 : 028-83203579</br>综合办公室 :  028-83203568</span></span>
            <span><img src="<?php echo base_url('img/pos.png')?>"/><span>ggw@uestc.edu.cn</span></span>
          </div>
        </span>
      </div>
      <div class="row-one">
        <span class="type-one">
          <span>
            <span>学习园地</span>
            <span><a href="<?php echo site_url('/home/category/2')?>">更多>></a></span>
          </span>
          <ul>
          <!--置顶文章标题，目前只能置顶1个，后期再改-->
          <?php if(isset($learnGardenTop['0'])){
            echo '<li><a href="';
            echo site_url('/home/content/'.$learnGardenTop['0']['id']);
            echo '"><span>';
            echo $learnGardenTop['0']['title'];
            echo '<span class="top-style"></span></span><span>';
            echo date('Y-m-d',$learnGardenTop['0']['time']);
            echo '</span></a></li>';
           } ?>

          <!--普通文章标题-->
          <?php foreach($learnGarden as $value):?>
            <li><a href="<?php echo site_url('/home/content/'.$value['id'])?>"><span><?php echo $value['title']?></span><span><?php echo date('Y-m-d',$value['time'])?></span></a></li>
          <?php endforeach ?>
          </ul>
        </span>
        <span class="type-one">
          <span>
            <span>健康指南</span>
            <span><a href="<?php echo site_url('/home/category/4')?>">更多>></a></span>
          </span>
          <ul>
          <!--置顶文章标题，目前只能置顶1个，后期再改-->
          <?php if(isset($healthGuideTop['0'])){
            echo '<li><a href="';
            echo site_url('/home/content/'.$healthGuideTop['0']['id']);
            echo '"><span>';
            echo $healthGuideTop['0']['title'];
            echo '<span class="top-style"></span></span><span>';
            echo date('Y-m-d',$healthGuideTop['0']['time']);
            echo '</span></a></li>';
           } ?>

          <!--普通文章标题-->
          <?php foreach($healthGuide as $value):?>
            <li><a href="<?php echo site_url('/home/content/'.$value['id'])?>"><span><?php echo $value['title']?></span><span><?php echo date('Y-m-d',$value['time'])?></span></a></li>
          <?php endforeach ?>
          </ul>         
        </span>
        <span class="type-three">
            <div>——— • 方便通道 • ——— </div>
            <a href="<?php echo site_url('/home/submission')?>"><span><img src="<?php echo base_url('img/contribute.png')?>"/><p>我要投稿</p></span></a>
            <a href="<?php echo site_url('/home/category/13')?>"><span><img src="<?php echo base_url('img/download.png')?>"/><p>资料下载</p></span></a>
            <a href="http://living.uestc.edu.cn/jtysfw/461.jhtml"><span><img src="<?php echo base_url('img/schoolbus.png')?>"/><p>校车</p></span></a>
            <a href="http://www.jwc.uestc.edu.cn/Index.action"><span><img src="<?php echo base_url('img/calenda.png')?>"/><p>校历</p></span></a>
            <a href="http://living.uestc.edu.cn/fwdh/index.jhtml"><span><img src="<?php echo base_url('img/schooltel.png')?>"/><p>校园电话</p></span></a>
        </span>
      </div>
    </div>

    <!--图片轮播二-->
    <div class="foot-pic">
          <div class="foot-pic-top">
              <ul class="pic-ul"> 
                 <li class="pic-li1"><div></div></li>
                 <div class="pic-circle"></div>
                 <li class="pic-li2">关工掠影</li>
                 <div class="pic-circle"></div>
                 <li class="pic-li1"><div></div></li>
              </ul>
          </div>
          <div class="foot-pic-content">
            <div class="foot-pic-left" id="LeftArr" ><img src="<?php echo base_url('img/pic1.jpg')?>"></img></div>
            <div class="center-pic" id="scrollPic" >
                  <ul>
                  <li class="foot-pic-center">
                     <img height="187" width="300" class="img1" src="<?php echo base_url('assets/i/').$picture['0']['url']?>" alt="" />
                  </li>
                  <li class="foot-pic-center">
                      <img height="187" width="300" class="img1" src="<?php echo base_url('assets/i/').$picture['1']['url']?>" alt="" />
                  </li>
                  <li class="foot-pic-center">
                      <img height="187" width="300" class="img1" src="<?php echo base_url('assets/i/').$picture['2']['url']?>" alt="" />
                  </li>
                  </ul>
                </div>
            <div class="foot-pic-right" id="RightArr"><img src="<?php echo base_url('img/pic2.jpg')?>"></img></div>  
        </div>    
      </div> 
    <!--footer部分-->
    <div class="link-bg">
      <span>友情链接</span>
      <div class="link">
          <p>
            <a href="<?php echo $link['0']['url']?>"><?php echo $link['0']['name']?></a>
            <a href="<?php echo $link['1']['url']?>"><?php echo $link['1']['name']?></a>
            <a href="<?php echo $link['2']['url']?>"><?php echo $link['2']['name']?></a>
            <a href="<?php echo $link['3']['url']?>"><?php echo $link['3']['name']?></a>
          </p>
          <p>
            <a href="<?php echo $link['4']['url']?>"><?php echo $link['4']['name']?></a>
            <a href="<?php echo $link['5']['url']?>"><?php echo $link['5']['name']?></a>
            <a href="<?php echo $link['6']['url']?>"><?php echo $link['6']['name']?></a>
            <a href="<?php echo $link['7']['url']?>"><?php echo $link['7']['name']?></a>
          </p>
          <p>
            <a href="<?php echo $link['8']['url']?>"><?php echo $link['8']['name']?></a>
            <a href="<?php echo $link['9']['url']?>"><?php echo $link['9']['name']?></a>
            <a href="<?php echo $link['10']['url']?>"><?php echo $link['10']['name']?></a>
            <a href="<?php echo $link['11']['url']?>"><?php echo $link['11']['name']?></a>
          </p>
      </div>
    </div>
      <div class="footer">
          <div class="words1">版权所有@电子科技大学离退休工作处</div>
          <div class="words2">地址：四川省成都市建设北路二段四号电子科技大学东院老年活动中心&nbsp;&nbsp;&nbsp;邮政编码：610054</div>
      </div>
</div>


<script type="text/javascript" src="<?php echo base_url('js/piclist2.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/header.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/weather.js')?>"></script>
<script type="text/javascript">
function piclist1(){
      
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
          if(flag==0){picInfor.innerHTML="<?php echo $showArticle['0']['title']?>";}//第一张图片文字说明,若没有第一张图片，请删除此行
          else if(flag==1){picInfor.innerHTML="<?php echo $showArticle['1']['title']?>";}//第二张图片文字说明,若没有第二张图片，请删除此行
          else if(flag==2){picInfor.innerHTML="<?php echo $showArticle['2']['title']?>";}//第三张图片文字说明,若没有第三张图片，请删除此行
          else if(flag==3){picInfor.innerHTML="<?php echo $showArticle['3']['title']?>";}//第四张图片文字说明,若没有第四张图片，请删除此行
          else if(flag==4){picInfor.innerHTML="<?php echo $showArticle['4']['title']?>";}//第五张图片文字说明,若没有第五张图片，请删除此行
          li_list[flag].style.backgroundColor = "#e8eaeb"; 
        }   

</script>
</body>
</html>