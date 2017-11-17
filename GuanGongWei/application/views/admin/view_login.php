<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>Login Page | UESTC-关爱下一代委员会</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="format-detection" content="telephone=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  
  <link rel="stylesheet" href="<?php echo base_url('assets/css/amazeui.min.css')?>"/>
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
    .am-u-md-8 {
    width: 30%;
    }
  </style>
</head>
<body>
<div class="header">
  <div class="am-g">
    <h1>UESTC 关工委</h1>
    
  </div>
  <hr />
</div>
<div class="am-g">
  <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered" >
    <h3 >管理员登录</h3>
    <hr>
    
    <br>
    <br>

    <form method="post" class="am-form" action="<?php echo site_url('admin/admin/login_check')?>">
      <label for="text">账号:</label>
      <input type="text" name="nickName" id="nickName" value="">
      <br>
      <label for="password">密码:</label>
      <input type="password" name="password" id="password" value="">
      <br>
      
      <br />
      <div class="am-cf">
        <input type="submit" name="" value="登 录" class="am-btn am-btn-primary am-btn-sm am-fl">
        
      </div>
    </form>

    <hr>
    <a class="am-btn am-btn-success am-active"  href="<?php echo site_url('/home/index/')?>">网站首页</a>

    <p>© 2017 by StarStudio.</p>
  </div>
</div>
</body>
</html>
