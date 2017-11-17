<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
  <title>电子科技大学关工委</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/amazeui.min.css')?>"/>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/admin.css')?>">

  <!--百度编辑器配置,配置config.js文件必须在all.min.js文件前面，否则出错-->
    <script type="text/javascript" src="<?php echo base_url().'ueditor/ueditor.config.js'?>"></script>

    <script type="text/javascript" src="<?php echo base_url().'ueditor/ueditor.all.min.js'?>"></script>
    
    

    <script type="text/javascript">
      //设置根路径，必须设置到包含js文件的那一层
      window.UEDITOR_HOME_URL="<?php echo base_url().'ueditor/'?>";
      window.onload=function(){
        window.UEDITOR_CONFIG.initialFrameWidth=900;//设置百度编辑器的高宽
        window.UEDITOR_CONFIG.initialFrameHeight=600;
        var ue=UE.getEditor('content'); /*这里调用的是id，不是name*/

      }
    </script>
      <style>
    .header {
      text-align: center;
    }
    .header h1 {
      font-size: 200%;
      color: #333;
      margin-top: 30px;
    }
    .header p {
      font-size: 14px;
    }
  </style>



	<title>后台管理</title>
	
</head>

<body style="overflow-y: auto;">
<div class="header">
  <div class="am-g">
    <h1>投稿</h1>
    
  </div>
  <hr />
</div>
<div class="am-g">
  <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
  

    <form class="am-form" method="post" enctype="multipart/form-data" action="<?php echo site_url('/home/submission_action')?>">
 
    <legend>发表文章</legend>
    <div class="am-form-group">
      <label for="doc-ta-1">标题</label>
      <p><input type="text" class="am-form-field am-radius" placeholder="请输入标题"  name="title" /></p>
      <label for="doc-ta-1">您的学院或所在单位</label>
      <p><input type="text" class="am-form-field am-radius" placeholder="您的学院或所在单位"  name="name" /></p>
      <label for="doc-ta-1">您的姓名及联系方式</label>
      <p><input type="text" class="am-form-field am-radius" placeholder="您的姓名及联系方式"  name="tel" /></p>
    </div>




    <div class="am-form-group">
      <label for="doc-ta-1">文章内容</label>
        <!--标签内的php语句保证提交的表单不通过时保存用户之前选的值-->
        <textarea  id="content" name="content"><?php echo set_value('content')?></textarea>
        <!--打印错误提示-->
        <?php echo form_error('content','<span>','</span>')?>
    </div>


    <p><button type="submit" class="am-btn am-btn-primary">提交</button></p>
 
</form>

    <hr>
    <a class="am-btn am-btn-success am-active"  href="<?php echo site_url('/home/index/')?>">网站首页</a>

    <p>© 2017 by StarStudio.</p>
  </div>
</div>




  
</div>
</div>
     


<!--[if (gte IE 9)|!(IE)]><!-->
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<!--<![endif]-->
<script src="<?php echo base_url('assets/js/amazeui.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/app.js')?>"></script>

</body>
</html>