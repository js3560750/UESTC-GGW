<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<link rel="stylesheet" href="<?php echo base_url('assets/css/amazeui.min.css')?>"/>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/admin.css')?>">

	<title>后台管理</title>
	
</head>

<body>
<!--添加下面两个div 以给页面添加滑动条！！！-->
<div class="admin-content">
<div class="admin-content-body">

<form class="am-form" method="post" enctype="multipart/form-data" action="<?php echo site_url('/admin/admin/edit_foot_pic_action')?>">
  <fieldset>
    <legend>替换关工掠影图片</legend>

    <!--一些隐藏的需要提交的数据-->
    <input type="hidden" name="id" value="<?php echo $id?>"/>
    

    <div class="am-form-group">
      
      <p class="am-form-help">请选择形状类似宽屏的图片</p>
      <input type="file" id="doc-ipt-file-1" name="picture">
      
    </div


    <p><button type="submit" class="am-btn am-btn-primary">替换</button></p>
  </fieldset>
</form>

  
</div>
</div>
     


<!--[if (gte IE 9)|!(IE)]><!-->
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<!--<![endif]-->
<script src="<?php echo base_url('assets/js/amazeui.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/app.js')?>"></script>

</body>
</html>