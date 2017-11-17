<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<link rel="stylesheet" href="<?php echo base_url('assets/css/amazeui.min.css')?>"/>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/admin.css')?>">
	<title>后台管理</title>
	
</head>
<body style="overflow-y: auto;">  <!--添加了自动滚动条，当页面内容超出页面大小时出现滚动条-->

  
        <div class="am-u-sm-12">
          <table class="am-table am-table-bd am-table-striped admin-content-table">
            <thead>
            <tr>
              <th>AdminID</th><th>NickName</th><th>Level</th><th>Management</th>
            </tr>
            </thead>

            <tbody>

        <?php foreach($admin as $value):?>

            <tr><td><?php echo $value['admin_id']?></td><td><?php echo $value['nickName']?></td><td><?php echo $value['level']?></td>
              <td>
                <div class="am-dropdown" data-am-dropdown>
                  <button class="am-btn am-btn-success am-btn-xs am-dropdown-toggle" data-am-dropdown-toggle><span class="am-icon-cog"></span> <span class="am-icon-caret-down"></span></button>
                  <ul class="am-dropdown-content">
                    <li><a href="<?php echo site_url('/admin/admin/edit_admin/'.$value['admin_id'])?>" >编辑</a></li>
                    <li><a href="<?php echo site_url('/admin/admin/delete_admin/'.$value['admin_id'])?>" onclick="javascript:if(confirm('确定要删除此管理员吗？')){alert('您点击了确定');return true;}return false;">删除</a></li>
                  </ul>
                </div>
              </td>
            </tr>

        <?php endforeach ?>
           
            </tbody>
          </table>
        </div>


   <!--分页-->
  <p align="center"> <?php echo $links?></p> 
 

     


<!--[if (gte IE 9)|!(IE)]><!-->
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<!--<![endif]-->
<script src="<?php echo base_url('assets/js/amazeui.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/app.js')?>"></script>

</body>
</html>