<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
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




	<title>后台管理</title>
	
</head>

<body>
<!--添加下面两个div 以给页面添加滑动条！！！-->
<div class="admin-content">
<div class="admin-content-body">


  <fieldset>
    <legend>来稿内容</legend>
    <div class="am-form-group">
      <label for="doc-ta-1">标题</label>
      <p><input type="text" class="am-form-field am-radius" placeholder=""  name="title" value="<?php echo $submission['0']['title']?>" /></p>
      <label for="doc-ta-1">来稿人学院或所在单位</label>
      <p><input type="text" class="am-form-field am-radius" placeholder=""  name="name" value="<?php echo $submission['0']['name']?>"/></p>
      <label for="doc-ta-1">来稿人姓名及联系方式</label>
      <p><input type="text" class="am-form-field am-radius" placeholder=""  name="tel" value="<?php echo $submission['0']['tel']?>" /></p>
    </div>
    

    <div class="am-form-group">
      <label for="doc-ta-1">内容</label>
        <!--标签内的php语句保证提交的表单不通过时保存用户之前选的值-->
        <textarea  id="content" name="content"><?php echo set_value('content')?>
          <?php echo $submission['0']['content']?>
        </textarea>
        <!--打印错误提示-->
        <?php echo form_error('content','<span>','</span>')?>
    </div>


    <p><a class="am-btn am-btn-success am-active"  href="<?php echo site_url('/admin/article/get_submission')?>">返回</a></p>
  </fieldset>


  
</div>
</div>
     


<!--[if (gte IE 9)|!(IE)]><!-->
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<!--<![endif]-->
<script src="<?php echo base_url('assets/js/amazeui.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/app.js')?>"></script>

</body>
</html>