<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<link rel="stylesheet" href="<?php echo base_url('assets/css/amazeui.min.css')?>"/>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/admin.css')?>">
	<title>后台管理</title>
	
</head>
<body>

<form class="am-form" method="post" action="<?php echo site_url('/admin/admin/edit_link_action')?>">
 
  

   
  <fieldset>
    <legend>请输入新链接名称和地址</legend>

    <div class="am-form-group">
      <label for="doc-ta-1">链接名称</label>
      <p class="am-form-help">不写名称，则为空，网站链接显示为空</p>
      <p><input type="text" class="am-form-field am-radius" placeholder="<?php echo $link['0']['name']?>"  name="name" /></p>
    </div>

    <div class="am-form-group">
      <label for="doc-ta-1">链接地址</label>
      <p class="am-form-help">链接地址一定要如下格式http://www.uestc.edu.cn/</p>
      <p class="am-form-help">不能漏掉http://</p>
      <p class="am-form-help">不写链接地址为空，即无效链接</p>
      <p><input type="text" class="am-form-field am-radius" placeholder="<?php echo $link['0']['url']?>"  name="url" /></p>
    </div>
  
    <!--一些隐藏的需要提交的数据-->
    <input type="hidden" name="id" value="<?php echo $link['0']['id']?>?>"/>


    <p><button type="submit" class="am-btn am-btn-primary">提交更改</button></p>
  </fieldset>
</form>

</body>
