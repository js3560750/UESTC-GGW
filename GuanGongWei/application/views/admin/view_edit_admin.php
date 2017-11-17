<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<link rel="stylesheet" href="<?php echo base_url('assets/css/amazeui.min.css')?>"/>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/admin.css')?>">
	<title>后台管理</title>
	
</head>
<body>

<form class="am-form" method="post" action="<?php echo site_url('/admin/admin/edit_admin_action')?>">
 
  <legend>编辑管理员</legend>

    <!-- 这个不可编辑的 fieldset 好像不能用表单传值-->
  <fieldset disabled>
    

    <div class="am-form-group">
      <label for="doc-ds-ipt-1">管理员昵称</label>
      <p><input type="text" id="doc-ds-ipt-1" class="am-form-field" placeholder="<?php echo $nickName?>" /></p>
  </fieldset>


  <fieldset>
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
      <label for="doc-ta-1">设置密码</label>
      <p><input type="text" class="am-form-field am-radius" placeholder="<?php echo $password?>"   name="password" /></p>
    </div>
    <!--这个隐藏的表单是为了传值，把管理员昵称通过表单提交-->
    <input type="hidden" value="<?php echo $nickName?>" name="nickName">
    <input type="hidden" value="<?php echo $admin_id?>" name="admin_id">
    <p><button type="submit" class="am-btn am-btn-primary">提交</button></p>
  </fieldset>
</form>

</body>
