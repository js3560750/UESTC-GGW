<?php
 if(!defined('BASEPATH')) exit('No direct script access allowed');
 
class Admin extends CI_Controller {

	

	public function __construct()
	{
			parent::__construct();//这句话必须加，原因是你的构造函数将会覆盖父类的构造函数，所以我们要手工的调用它。
			$this->load->model('admin_model');
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->helper('file');
			$this->load->library('session'); //application/config/config.php 中设置了session过期时间为关闭浏览器 //加载session类库自动开启session	
			$this->load->library('loginCenter');	//加载自定义的登录验证类
			$this->load->helper('input_check_helper');	//加载自定义的表单验证
			$this->load->helper('encrypt_helper');	//用于密码加密和验证


				
			//$this->output->cache(1); 					//开启缓存，持续时间1分钟
			// $this->output->enable_profiler(TRUE); 	//启用分析器
	}

	//做测试用
	public function test(){
		echo base_url();
	}

	//后台管理员登录界面
	public function login(){
		//注销后再次跳转到登录界面，首先销毁之前登录的session
		$this->session->sess_destroy();
		$this->load->view('admin/view_login');
	}

	//后台管理员登录页面进行验证
	public function login_check(){

			//获取用户输入
			$data=array(
				'nickName'=>$_POST['nickName'],
				'password'=>$_POST['password']
			);

			//获得对应账号密码的hash值
			$database_admin_password=$this->admin_model->admin_password_check($data);
			$dap=$database_admin_password['0']['password'];

		

			if($this->admin_model->admin_id_check($data))
			{
				//验证密码,if(1)=true
				//注意在config/constants/文件夹中定义PASSWORD_SALT
				if(varify_password($data['password'],$dap))
				{
					//管理员登录成功

					//记录管理员的信息到session中，并在后台主页控制器验证是否存在这些信息，防止不经登录访问后台
					if(!session_status()){
    					session_start();
    				}
    				//配置
    				$session_data=array(
    					'admin'=>$_POST['nickName'],
    					'logintime'=>date('Y-m-d H:i:s'),
    					'level'=>$this->admin_model->admin_level_check($data)	//记录管理员等级
    				);

    				

    				//存入session类
    				$this->session->set_userdata($session_data);

    				

					$this->load->view('admin/view_index');

					session_write_close();	
					
				}
				else
				{
					success('admin/admin/login','密码错误');
				}
			}
			else
			{
				success('admin/admin/login','账号错误');
			}
	}

	//后台右侧页面的默认显示
	public function welcome(){

		//验证用户是否登录，如果没登录就访问则拒绝
		if(!$this->logincenter->adminCheck()){
            success('admin/admin/login','未登录');
            die;
        }

		
		$data=array(
				'admin'=>$_SESSION['admin'],
				'level'=>$_SESSION['level']
			);
		//显示后台主页右侧框架页面的主页
    	$this->load->view('admin/view_index_welcome',$data);
	}

	//获得管理员列表
	public function get_admin_list(){

		//验证用户是否登录，如果没登录就访问则拒绝
		if(!$this->logincenter->adminCheck()){
            success('admin/admin/login','未登录');
            die;
        }


		//分页-------------------------------------------------

		//注意：使用分页，模型里的数据库查询语句不能写query('SELECT * FROM admin ORDER BY ` DESC;'),
		//而要写this->db->select('*')->from('admin')->order_by('adminid','desc')->get()->result_array();

                //载入分页类
                $this->load->library('pagination');
                
                $perPage=11;
                

                //配置
                $config_page['base_url']=site_url('/admin/admin/get_admin_list');
                $config_page['total_rows']=$this->db->count_all_results('admin'); //获取hd_article表中的总行数
                $config_page['per_page']=$perPage;  //设置每个分页显示的行数
                $config_page['uri_segment']=4;  //设置uri第四个字段为使用区间，默认是4
                $config_page['first_link'] = '第一页';
                $config_page['prev_link'] = '上一页';
                $config_page['next_link'] = '下一页';
                $config_page['last_link'] = '最后一页';

               


                //$config_page['use_page_numbers'] = TRUE;    //设置为TRUE则URL中第三段的数字为页数，但这里改的话，下面的$offset也要改，不然每页查询间隔就是1

                //载入配置
                $this->pagination->initialize($config_page);

                //创建分页，把分列链接存入$data['links']并传入check_article.html页面，打印$links就能打印出分页链接
                $data['links']=$this->pagination->create_links();

                //设置一个变量$offset等于uri的第四个字段，即数字和 $config_page['uri_segment']相等
                $offset=$this->uri->segment(4);

                //对数据库中查询数据进行限制，第一个参数是结果的显示行数，第二个参数是 Number of rows to skip
                $this->db->limit($perPage,$offset);
                

		$data['admin']=$this->admin_model->get_admin_list();

		
		$this->load->view('admin/view_admin_list',$data);

	}

	//跳转到编辑管理员页面
	public function edit_admin($aid){

		//验证用户是否登录，如果没登录就访问则拒绝
		if(!$this->logincenter->adminCheck()){
            success('admin/admin/login','未登录');
            die;
        }

		//根据管理员id获取该管理员的全部信息
		$data=$this->admin_model->get_admin_by_id($aid);


		$this->load->view('admin/view_edit_admin',$data['0']);
	}

	//编辑管理员动作
	public function edit_admin_action(){

		//验证用户是否登录，如果没登录就访问则拒绝
		if(!$this->logincenter->adminCheck()){
            success('admin/admin/login','未登录');
            die;
        }

		//获取用户输入
		$data=array(
			'admin_id'=>$_POST['admin_id'],
			'nickName'=>$_POST['nickName'],
			'level'=>$_POST['level'],
			'password'=>$_POST['password']

		);


		//Hash加密的方式为SHA256，只能是SHA56
		$algo='SHA256';
		//Hash加密的盐值，已经定义全局变量，不需要传入
		//密码Hash加密
		$data['password']=encrypt_password($data['password'],$algo);

		
		if($data['password']==''){
			success('admin/admin/get_admin_list','密码不能为空');
		}
		else if($data['level']==0&&$_SESSION['level']==1){
			success('admin/admin/get_admin_list','只有等级0管理员才能添加等级0管理员');
		}
		else{
			$this->admin_model->edit_admin_action($data);
			success('admin/admin/get_admin_list','修改成功');
		}
	}

	//删除管理员
	public function delete_admin($aid){

		//验证用户是否登录，如果没登录就访问则拒绝
		if(!$this->logincenter->adminCheck()){
            success('admin/admin/login','未登录');
            die;
        }

		//根据管理员id获取该管理员的全部信息，用来防止管理员删除自己
		$data=$this->admin_model->get_admin_by_id($aid);
		

		//验证管理员权限，查看该操作者是否是等级0的管理员
		if($_SESSION['level']!=0){

    		success('admin/admin/get_admin_list','非等级0管理员没有权限删除其他管理员');

    	}
    	else if($_SESSION['admin']==$data['0']['nickName']){
    		success('admin/admin/get_admin_list','管理员不能删除自己');
    	}
    	else{

    		$this->admin_model->delete_admin($aid);
       		success('admin/admin/get_admin_list','删除成功');
    	}

	
	}

	//跳转到增加管理员页面
	public function add_admin(){

		//验证用户是否登录，如果没登录就访问则拒绝
		if(!$this->logincenter->adminCheck()){
            success('admin/admin/login','未登录');
            die;
        }

		$this->load->view('admin/view_add_admin');
	}

	//添加管理员执行的动作
	public function add_admin_action(){

		//验证用户是否登录，如果没登录就访问则拒绝
		if(!$this->logincenter->adminCheck()){
            success('admin/admin/login','未登录');
            die;
        }


		//获取用户输入
		$data=array(
			'nickName'=>$_POST['nickName'],
			'level'=>$_POST['level'],
			'password'=>$_POST['password'],
			'admin_name'=>$_POST['admin_name']

		);

		//管理员注册时，密码经过hash加密后存入数据库
		//Hash加密的方式为SHA256，只能是SHA56
		$algo='SHA256';
		//Hash加密的盐值，已经定义全局变量，不需要传入
		//密码Hash加密
		$data['password']=encrypt_password($data['password'],$algo);


		//加载辅助函数
		$this->load->library('form_validation');
				
		//用户输入规则验证
		//trim去掉用户输入两边的空格，required表示必须有输入不能为Null,min_length表示最小长度,matches表示相等
		//is_unique[table.field] 如果表单元素值在指定的表和字段中并不唯一，返回 FALSE ,直接用，只要连接了数据库行
		$this->form_validation->set_rules('nickName','账号','trim|required|min_length[5]|max_length[10]|is_unique[admin.nickName]',array('min_length' => '太短啦，账号长度必须在5到10位噢~','max_length'=>'太长啦，账号长度必须在5到10位噢~','is_unique'=>'该用户名已经注册啦'));
		$this->form_validation->set_rules('password','密码','trim|required|min_length[5]|max_length[15]|alpha_numeric',array('min_length' => '密码长度必须在5位以上噢','max_length'=>'账密码度必须在15位以下噢','alpha_numeric'=>'密码只能由数字和字母组成'));
		
			
		//规则验证都通过则$this->form_validation->run()返回真
		if($this->form_validation->run()==FALSE)
		{
			//若规则验证不通过则留在该页面
			$this->load->view('admin/view_add_admin');
		}
		else if($data['level']==0&&$_SESSION['level']==1){
			success('admin/admin/add_admin','只有等级0管理员才能添加等级0管理员');
		}
		else{
			$this->admin_model->add_admin_action($data);
			success('admin/admin/get_admin_list','添加成功');
		}
	}

	//前台底部轮播图片
	public function footer_pic(){
		$data['pic']=$this->admin_model->get_foot_pic();
		$this->load->view('admin/view_all_foot_pic',$data);
	}

	//替换底部轮播图片
	public function edit_foot_pic($id){
		$data['id']=$id;
		$this->load->view('admin/view_edit_foot_pic',$data);
	}

	//替换底部图片动作
	public function edit_foot_pic_action(){
		 //文件上传----------------------------------------------------
                //配置文件上传类
                $config['upload_path'] = './assets/i/'; //这个目录一定要先手动创建好
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '10000';
                $config['file_name'] = time().mt_rand(1000,9999); //设置保存的文件名为一个随机名字

                //加载文件上传类库，并载入配置
                $this->load->library('upload',$config);

                //执行上传，并根据成功与否返回布尔值给$flag
                //do_upload方法根据设置的参数上传文件，默认情况下上传文件是来自于表单的 userfile 字段
                //表单属性里一定要有enctype="multipart/form-data"
                $flag=$this->upload->do_upload('picture');
                $info=$this->upload->data();


        //往数据库中存数据
        $data=array(
        	'id'=>$this->input->post('id'),
            'url'=>$info['file_name']
            );

        $this->admin_model->edit_foot_pic($data);

        success('admin/admin/footer_pic','替换成功');
	}


	//友情链接
	public function link(){
		$data['link']=$this->admin_model->get_link();
		$this->load->view('admin/view_all_link',$data);
	}

	//替换友情链接
	public function edit_link($id){
		$data['link']=$this->admin_model->get_link_by_id($id);

		$this->load->view('admin/view_edit_link',$data);
	}

	//替换友情链接动作
	public function edit_link_action(){
		$data=array(
        	'id'=>$this->input->post('id'),
        	'name'=>$this->input->post('name'),
            'url'=>$this->input->post('url')
            );

        $this->admin_model->edit_link($data);

        success('admin/admin/link','替换成功');
	}
	
}