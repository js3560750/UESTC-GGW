<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<link rel="stylesheet" href="<?php echo base_url('assets/css/amazeui.min.css')?>"/>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/admin.css')?>">
	<title>后台管理</title>
	
</head>
<body style="overflow-y: auto;overflow-x: auto">  <!--添加了自动滚动条，当页面内容超出页面大小时出现滚动条-->

  
        <div class="am-u-sm-12">
          <table class="am-table am-table-bd am-table-striped admin-content-table">
            <thead>
            <tr>
           
              <th>ID</th>
              <th>文章类型</th>
              <th>标题</th>
              <th>admin_id</th>
              <th>发表时间</th>
              <th>文章来源</th>
              <th>作为主页轮播时的图片</th>
              <th>是否置顶</th>
              <th>是否首页轮播展示</th>
              <th>点击量</th>
              <th>管理操作</th>
              
            </tr>
            </thead>

            <tbody>

        <?php foreach($article as $value):?>

          <tr>
            <td><?php echo $value['id']?></td>
            <td><?php echo $value['type']?></td>
            <td><?php echo $value['title']?></td>
            <td><?php echo $value['admin_id']?></td>
            <td><?php echo date('Y-m-d H:i:s',$value['time'])?></td>
            <td><?php echo $value['source']?></td>
            <td>
              <img src="<?php echo base_url('assets/i/').$value['top_img_url']?>"  height="150" width="150" >
            </td>
            <th><?php echo $value['top']?></th>
            <th><?php echo $value['show']?></th>
            <th><?php echo $value['click']?></th>
            <td>
            <a class="am-btn am-btn-secondary am-active" href="<?php echo site_url('/admin/article/edit_article/'.$value['id'])?>">编辑</a>
            <a class="am-btn am-btn-danger am-active" href="<?php echo site_url('/admin/article/delete_article/'.$value['id'])?>" onclick="javascript:if(confirm('确定要删除此内容吗？')){alert('删除成功！');return true;}return false;">删除</a></td>
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