<?php
if(!defined('BASEPATH'))exit('No direct script access allowed');
?>
<!doctype html>
<html class="no-js fixed-layout">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UESTC 关工委 后台管理</title>
  <meta name="description" content="这是一个 index 页面">
  <meta name="keywords" content="index">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="icon" type="image/png" href="<?php echo base_url('assets/i/favicon.png')?>">
  <link rel="apple-touch-icon-precomposed" href="<?php echo base_url('assets/i/app-icon72x72@2x.png')?>">
  <meta name="apple-mobile-web-app-title" content="Amaze UI" />
  <link rel="stylesheet" href="<?php echo base_url('assets/css/amazeui.min.css')?>"/>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/admin.css')?>">

<!-- 默认打开目标!!!!!!!!!正因为有这句话，所以在本页面操作打开的页面都会显示在框架内 -->
<base target="iframe"/>
</head>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->

<header class="am-topbar am-topbar-inverse admin-header">
  <div class="am-topbar-brand">
    <strong>UESTC 关工委</strong> <small>后台管理</small>
  </div>

  <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>
    
  <div class="am-collapse am-topbar-collapse" id="topbar-collapse">
    

    <ul class="am-nav am-topbar-nav am-topbar-right admin-header-list">
      

      <li class="am-hide-sm-only"><a href="javascript:;" id="admin-fullscreen"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>
    </ul>

  </div>


</header>

<div class="am-cf admin-main">
  <!-- sidebar start -->
  <div class="admin-sidebar am-offcanvas" id="admin-offcanvas">
    <div class="am-offcanvas-bar admin-offcanvas-bar">
      <ul class="am-list admin-sidebar-list">
        
        <li><a href="<?php echo site_url('admin/admin/welcome')?>"> 欢迎页面</a></li>
        <li class="admin-parent">
          <a class="am-cf" data-am-collapse="{target: '#collapse-nav'}">管理员管理 <span class="am-icon-angle-right am-fr am-margin-right"></span></a><!--target:是展开收缩的列表条id-->
          <ul class="am-list am-collapse admin-sidebar-sub am-out" id="collapse-nav"><!--am-in就是默认列表展开，am-out默认列表收缩-->
            <li><a href="<?php echo site_url('/admin/admin/get_admin_list')?>" class="am-cf"> 管理员列表</a></li>
            <li><a href="<?php echo site_url('/admin/admin/add_admin')?>"> 增加管理员</a></li>
            
          </ul>
        </li>

        

        <li class="admin-parent">
          <a class="am-cf" data-am-collapse="{target: '#collapse-nav3'}">文章管理 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
          <ul class="am-list am-collapse admin-sidebar-sub am-out" id="collapse-nav3"><!--am-in就是默认列表展开，am-out默认列表收缩-->
            <li><a href="<?php echo site_url('/admin/article/add_article')?>" class="am-cf"> 发表文章</a></li>
            <li><a href="<?php echo site_url('/admin/article/get_article')?>" class="am-cf"> 所有文章</a></li>
            <li><a href="<?php echo site_url('/admin/article/get_submission')?>" class="am-cf"> 所有来稿</a></li>
            
            
            
          </ul>
        </li>

        <!--非展开栏-->
        <li><a href="<?php echo site_url('/admin/admin/footer_pic')?>"> 关工掠影</a></li>
        <li><a href="<?php echo site_url('/admin/admin/link')?>"> 友情链接</a></li> 

         

         
       
      
        <!-- target属性使目标打开的页面不再在右侧框架内-->
        <li><a href="<?php echo site_url('/admin/admin/login')?>" target="_self" onclick="javascript:if(confirm('确定要退出吗？')){return true;}return false;">注销</a></li>
      </ul>

      
    </div>
  </div>
  <!-- sidebar end -->

  <!-- content start -->
  <!-- 右侧 框架内嵌页面，默认调用admin控制器中的copy方法-->
  <div class="admin-content" >
    
    <!--设置iframe的宽和高以适应屏幕-->
    <iframe  style="height: 100%;width: 100%" frameboder="0" border="0"  scrolling="no" name="iframe" src="<?php echo site_url().'/admin/admin/welcome'?>"></iframe>

    
    
      

    <footer class="admin-content-footer">
      <hr>
      <p class="am-padding-left">© 2017 by StarStudio.</p>
    </footer>
    
  </div>
  <!-- content end -->

</div>



<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="assets/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<!--<![endif]-->
<script src="<?php echo base_url('assets/js/amazeui.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/app.js')?>"></script>
</body>
</html>
