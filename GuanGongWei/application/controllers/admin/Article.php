<?php
 if(!defined('BASEPATH')) exit('No direct script access allowed');
 
class Article extends CI_Controller {

	public function __construct()
	{
			parent::__construct();//这句话必须加，原因是你的构造函数将会覆盖父类的构造函数，所以我们要手工的调用它。
			$this->load->model('backstageArticle_model');
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->helper('file');
			$this->load->library('session'); //加载session类库自动开启session
			$this->load->library('loginCenter');
				
			//$this->output->cache(1); 					//开启缓存，持续时间1分钟
			// $this->output->enable_profiler(TRUE); 	//启用分析器
	}

    //发布文章
    public function add_article(){
        $data['article_type']=$this->backstageArticle_model->get_article_type();
        $this->load->view('admin/view_add_article',$data);
    }

    //发布文章动作
    public function add_article_action(){

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
                $flag=$this->upload->do_upload('picture');    //  picture标示提交的表单中的具体哪个

                /*
                if(!$flag){
                    error('必须上传图片');
                }
                */
                
                //如果上传有错误则弹窗提示错误,加了下面那行就必须得上传东西
                /*
                $wrong=$this->upload->display_errors();
                if($wrong){
                    error($wrong);
                }
                */
                //返回信息,$info['full_path']是文件上传路径且包含保存的文件名
                $info=$this->upload->data();
                
        //往数据库中存数据
        $data=array(
            'ar_id'=>md5(time()),
            'type'=>$this->input->post('type'),
            'title'=>$this->input->post('title'),
            'content'=>$this->input->post('content'),
            'admin_id'=>$_SESSION['admin'], //管理员账户名
            'status'=>0,    //0是正常、已审核状态。管理员自己发布的文章难不成要自己再审一遍？
            'anonymity'=>0, //匿名状态，0是非匿名，1匿名
            'time'=>time(), //发布时间
            'source'=>'关工委',
            'top_img_url'=>$info['file_name'] ,
            'top'=>$this->input->post('top'),   //top是否置顶，0未置顶，1置顶
            'article_author'=>$this->input->post('article_author'), 
            'picture_author'=>$this->input->post('picture_author'), 
            'click'=>0, //点击量，默认0
            'show'=>$this->input->post('show') //show是否首页轮播展示，0不展示，1展示
            );


        $flag=$this->backstageArticle_model->add_article($data);

        //额外勾选该文章同时发布到另外的板块
        if($this->input->post('tese1')=='option1'){
            $data=array(
            'ar_id'=>md5(time()+1),
            'type'=>11,
            'title'=>$this->input->post('title'),
            'content'=>$this->input->post('content'),
            'admin_id'=>$_SESSION['admin'], //管理员账户名
            'status'=>0,    //0是正常、已审核状态。管理员自己发布的文章难不成要自己再审一遍？
            'anonymity'=>0, //匿名状态，0是非匿名，1匿名
            'time'=>time(), //发布时间
            'source'=>'关工委',
            'top_img_url'=>$info['file_name'] ,
            'top'=>$this->input->post('top'),   //top是否置顶，0未置顶，1置顶
            'article_author'=>$this->input->post('article_author'), 
            'picture_author'=>$this->input->post('picture_author'), 
            'click'=>0, //点击量，默认0
            'show'=>$this->input->post('show') //show是否首页轮播展示，0不展示，1展示
            );
            $this->backstageArticle_model->add_article($data);
        }

        if($this->input->post('tese2')=='option2'){
            $data=array(
            'ar_id'=>md5(time()+2),
            'type'=>12,
            'title'=>$this->input->post('title'),
            'content'=>$this->input->post('content'),
            'admin_id'=>$_SESSION['admin'], //管理员账户名
            'status'=>0,    //0是正常、已审核状态。管理员自己发布的文章难不成要自己再审一遍？
            'anonymity'=>0, //匿名状态，0是非匿名，1匿名
            'time'=>time(), //发布时间
            'source'=>'关工委',
            'top_img_url'=>$info['file_name'] ,
            'top'=>$this->input->post('top'),   //top是否置顶，0未置顶，1置顶
            'article_author'=>$this->input->post('article_author'), 
            'picture_author'=>$this->input->post('picture_author'), 
            'click'=>0, //点击量，默认0
            'show'=>$this->input->post('show') //show是否首页轮播展示，0不展示，1展示
            );
            $this->backstageArticle_model->add_article($data);
        }

        success('admin/article/get_article','发布成功');

    }
	
    //获取所有文章
    public function get_article(){
        //验证用户是否登录，如果没登录就访问则拒绝
        if(!$this->logincenter->adminCheck()){
            success('admin/admin/login','未登录');
            die;
        }

        //分页-------------------------------------------------

        //注意：使用分页，模型里的数据库查询语句不能写query('SELECT * FROM admin ORDER BY adminid DESC;'),
        //而要写this->db->select('*')->from('admin')->order_by('adminid','desc')->get()->result_array();

                //载入分页类
                $this->load->library('pagination');
                
                $perPage=10;
                

                //配置
                $config_page['base_url']=site_url('/admin/article/get_article');
                $config_page['total_rows']=$this->db->count_all_results('article'); //获取hd_article表中的总行数
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

        $data['article']=$this->backstageArticle_model->get_article();

    
        
        $this->load->view('admin/view_all_article',$data);

    }
	
    //删除文章
    public function delete_article($aid){

        //验证用户是否登录，如果没登录就访问则拒绝
        if(!$this->logincenter->adminCheck()){
            success('admin/admin/login','未登录');
            die;
        }

        $this->backstageArticle_model->delete_article($aid);

        //下面这也是跳转，直接调用$this->get_article()，分页会跳转到第二页去
        //下面这就相当于调用了自定义的success()，不过去掉了弹出提示框
        header('Content-Type:text/html;charset=utf-8');
        $url=site_url('/admin/article/get_article');
        echo "<script type='text/javascript'>;location.href='$url'</script>";
        die;
    }

    //跳转到编辑文章界面
    public function edit_article($id){
        //验证用户是否登录，如果没登录就访问则拒绝
        if(!$this->logincenter->adminCheck()){
            success('admin/admin/login','未登录');
            die;
        }

        //根据传过来的aid获取文章的所有信息
        $data['article']=$this->backstageArticle_model->get_article_by_id($id);

        $this->load->view('admin/view_edit_article',$data);

    }

    //编辑文章动作
    public function edit_article_action(){
        //验证用户是否登录，如果没登录就访问则拒绝
        if(!$this->logincenter->adminCheck()){
            success('admin/admin/login','未登录');
            die;
        }

        //往数据库中存数据
        $data=array(
            'id'=>$this->input->post('id'),
            'type'=>$this->input->post('type'),
            'title'=>$this->input->post('title'),
            'content'=>$this->input->post('content'),
            'admin_id'=>$_SESSION['admin'], //管理员账户名
            'status'=>$this->input->post('status'),    //0是正常、已审核状态。管理员自己发布的文章难不成要自己再审一遍？
            'anonymity'=>$this->input->post('anonymity'), //匿名状态，0是非匿名，1匿名
            'time'=>time(), //发布时间
            'source'=>$this->input->post('source'),
            'top_img_url'=>$this->input->post('top_img_url'),
            'top'=>$this->input->post('top'),   //top是否置顶，0未置顶，1置顶
            'click'=>$this->input->post('click'), //点击量，默认0
            'article_author'=>$this->input->post('article_author'), 
            'picture_author'=>$this->input->post('picture_author'), 
            'show'=>$this->input->post('show') //show是否首页轮播展示，0不展示，1展示
            );

        $this->backstageArticle_model->edit_article($data);

        success('admin/article/get_article','修改成功');
    }


    //所有投稿
    public function get_submission(){

        //分页-------------------------------------------------

        //注意：使用分页，模型里的数据库查询语句不能写query('SELECT * FROM admin ORDER BY adminid DESC;'),
        //而要写this->db->select('*')->from('admin')->order_by('adminid','desc')->get()->result_array();

                //载入分页类
                $this->load->library('pagination');
                
                $perPage=10;
                

                //配置
                $config_page['base_url']=site_url('/admin/article/get_submission');
                $config_page['total_rows']=$this->db->count_all_results('submission'); //获取hd_article表中的总行数
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

        $data['submission']=$this->backstageArticle_model->get_submission();

    
        
        $this->load->view('admin/view_all_submission',$data);
    }

    //删除投稿
    public function delete_submission($id){
        $this->backstageArticle_model->delete_submission($id);

        //下面这也是跳转，直接调用$this->get_article()，分页会跳转到第二页去
        //下面这就相当于调用了自定义的success()，不过去掉了弹出提示框
        header('Content-Type:text/html;charset=utf-8');
        $url=site_url('/admin/article/get_submission');
        echo "<script type='text/javascript'>;location.href='$url'</script>";
        die;
    }

    //查看投稿内容
    public function edit_submission($id){

        //根据传过来的id获取投稿的所有信息
        $data['submission']=$this->backstageArticle_model->get_submission_by_id($id);

        $this->load->view('admin/view_edit_submission',$data);
    }
 
}
