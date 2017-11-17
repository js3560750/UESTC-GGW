<!DOCTYPE HTML>
<html>
<head>
  <meta http-equiv="content-type" content="text/html charset=utf-8">
  <title>电子科技大学关工委</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/news-content.css')?>">
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
  <!--新闻文本-->
  <div class="news-content">
    <h1><?php echo $content['0']['title']?></h1>
    <center><hr></center>
    <p>
      <?php if(!empty($content['0']['article_author'])){
              echo ' <span>文：';
              echo $content['0']['article_author'];
              echo '</span>';
            }
      ?>
      <?php if(!empty($content['0']['picture_author'])){
              echo ' <span>图：';
              echo $content['0']['picture_author'];
              echo '</span>';
            }
      ?>
      <span>来源：<?php echo $content['0']['source']?></span>
      <span>点击数：<?php echo $content['0']['click']?></span>
      <span>更新时间：<?php echo date('Y-m-d',$content['0']['time'])?></span>
    </p>
    <div class="content">
      <?php echo $content['0']['content']?>
      
    </div>
    <ul>
      <li>下一篇文章：
          <?php if(isset($previous['0'])){
          echo '<a href="';
          echo site_url('/home/content/'.$previous['0']['id']);
          echo '">';
          echo $previous['0']['title'];
          echo '</a>';
        }else{
          echo '已是末尾';
        }
        ?>
      </li>
      <li>
        上一篇文章：
        <?php if(isset($next['0'])){
          echo '<a href="';
          echo site_url('/home/content/'.$next['0']['id']);
          echo '">';
          echo $next['0']['title'];
          echo '</a>';
        }else{
          echo '已是最新';
        }
        ?>
      </li>
    </ul>
  </div>

    <!--footer-->
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
</div>
<script type="text/javascript" src="<?php echo base_url('js/header.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/weather.js')?>"></script>
</body>
</html>