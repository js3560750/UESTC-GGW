<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<link rel="stylesheet" href="<?php echo base_url('assets/css/amazeui.min.css')?>"/>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/admin.css')?>">
	<title>后台管理</title>
	
</head>
<body>

<form class="am-form" method="post" action="<?php echo site_url('/admin/admin/add_admin_action')?>">
  <fieldset>
    <legend>添加管理员</legend>
    <div class="am-form-group">
      <label for="doc-ta-1">账号（昵称）</label><span style="color: red"><?php echo form_error('nickName'); ?></span><!--form_error函数返回规则验证的错误信息-->
      <p><input type="text" class="am-form-field am-radius" placeholder="请添加账号（昵称）"   name="nickName" /></p>
    </div>
    <div class="am-form-group">
      <label for="doc-ta-1">真实姓名</label><span style="color: red"><?php echo form_error('admin_name'); ?></span><!--form_error函数返回规则验证的错误信息-->
      <p><input type="text" class="am-form-field am-radius" placeholder="请添加真实姓名"   name="admin_name" /></p>
    </div>

    <div class="am-form-group">
      <label for="doc-ta-1">管理员等级</label>

    <div class="am-radio">
      <label>
        <input type="radio" name="level" value="0" >
        等级0，可以删除其他管理员
      </label>
    </div>

    <div class="am-radio">
      <label>
        <input type="radio" name="level" value="1" checked>
        等级1，不能删除其他管理员
      </label>
    </div>
    </div>

    

    <div class="am-form-group">
      <label for="doc-ta-1">设置密码</label><span style="color: red"><?php echo form_error('password'); ?></span>
      <p><input type="text" class="am-form-field am-radius" placeholder="请设置密码"   name="password" /></p>
    </div>
    <p><button type="submit" class="am-btn am-btn-primary">提交</button></p>
  </fieldset>
</form>
<hr>
<p>&nbsp;&nbsp;Tips:只有等级0管理员才能添加等级0管理员</p>

  
 

     


<!--[if (gte IE 9)|!(IE)]><!-->
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<!--<![endif]-->
<script src="<?php echo base_url('assets/js/amazeui.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/app.js')?>"></script>

</body>
</html>