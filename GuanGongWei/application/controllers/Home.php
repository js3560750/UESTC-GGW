<?php
 if(!defined('BASEPATH')) exit('No direct script access allowed');
 
class Home extends CI_Controller {

	

	public function __construct()
	{
			parent::__construct();//这句话必须加，原因是你的构造函数将会覆盖父类的构造函数，所以我们要手工的调用它。
			$this->load->model('front_model');
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->helper('file');
			$this->load->library('session'); //加载session类库自动开启session
			$this->load->library('loginCenter');	//加载自定义的登录验证类
			$this->load->helper('input_check_helper');	//加载自定义的表单验证
			$this->load->helper('encrypt_helper');	//用于密码加密和验证


				
			//$this->output->cache(1); 					//开启缓存，持续时间1分钟
			// $this->output->enable_profiler(TRUE); 	//启用分析器
	}

	//做测试用
	public function test(){
		$this->load->view('homepage');
	}

	//网站首页入口
	public function index(){

		//首页各版块数据
		//工作动态
		$data['workDynamics']=$this->front_model->home_workDynamics();
		$data['workDynamicsTop']=$this->front_model->home_workDynamicsTop();

		//通知公告
		$data['notice']=$this->front_model->home_notice();
		$data['noticeTop']=$this->front_model->home_noticeTop();

		//五老风采
		$data['fiveOld']=$this->front_model->home_fiveOld();
		$data['fiveOldTop']=$this->front_model->home_fiveOldTop();

		//学习园地
		$data['learnGarden']=$this->front_model->home_learnGarden();
		$data['learnGardenTop']=$this->front_model->home_learnGardenTop();

		//健康指南
		$data['healthGuide']=$this->front_model->home_healthGuide();
		$data['healthGuideTop']=$this->front_model->home_healthGuideTop();

		//首页轮播
		$data['showArticle']=$this->front_model->home_showArticle();

		//关工掠影图片
		$data['picture']=$this->front_model->home_picture();

		//友情链接
		$data['link']=$this->front_model->home_link();

		$this->load->view('homepage',$data);
	}

	//文章内容
	public function content($id){
		//增加点击量
		$this->front_model->click($id);

		//本文章内容
		$data['content']=$this->front_model->content($id);
		
		//同一栏目下本文章的上一篇
		$data['previous']=$this->front_model->previous($id);
		//同一栏目下本文章的下一篇
		$data['next']=$this->front_model->next($id);

		//友情链接
		$data['link']=$this->front_model->home_link();

		$this->load->view('news-content',$data);
	}


	//板块入口
	public function category($id){
		//获取该板块文章总数
		$total_rows=$this->front_model->total_rows($id);
		$total_rows=$total_rows['0']['COUNT(*)'];
		
		//分页-------------------------------------------------

		//注意：使用分页，模型里的数据库查询语句不能写query('SELECT * FROM admin ORDER BY adminid DESC;'),
		//而要写this->db->select('*')->from('admin')->order_by('adminid','desc')->get()->result_array();

                //载入分页类
                $this->load->library('pagination');
                
                $perPage=10;
                

                //配置
                $config_page['base_url']=site_url('/home/category/'.$id);
                $config_page['total_rows']=$total_rows; //获取hd_article表中的总行数
                $config_page['per_page']=$perPage;  //设置每个分页显示的行数
                $config_page['num_links'] = 2; //放在你当前页码的前面和后面的“数字”链接的数量
                $config_page['uri_segment']=4;  //设置uri第四个字段为使用区间，默认是4，要与下面的$offset值相等
                $config_page['first_link'] = '第一页';
                $config_page['prev_link'] = '上一页';
                $config_page['next_link'] = '下一页';
                $config_page['last_link'] = '最后一页';

               


                //$config_page['use_page_numbers'] = TRUE;    //设置为TRUE则URL中第三段的数字为页数，但这里改的话，下面的$offset也要改，不然每页查询间隔就是1

                //载入配置
                $this->pagination->initialize($config_page);
                //加载分页样式
				$this->pagination->initialize($this->page_css());

                //创建分页，把分列链接存入$data['links']并传入check_article.html页面，打印$links就能打印出分页链接
                $data['links']=$this->pagination->create_links();

                //设置一个变量$offset等于uri的第四个字段，即数字和 $config_page['uri_segment']相等
                $offset=$this->uri->segment(4);

                //对数据库中查询数据进行限制，第一个参数是结果的显示行数，第二个参数是 Number of rows to skip
                $this->db->limit($perPage,$offset);

		//该板块下所有文章
		$data['category']=$this->front_model->category($id);
		//该板块的名称
		$data['name']=$this->front_model->name($id);
		//友情链接
		$data['link']=$this->front_model->home_link();

		$this->load->view('list-page',$data);
	}

	//搜索功能
	public function search(){
		$text=$this->input->post('text');
		$data['result']=$this->front_model->search($text);

		//友情链接
		$data['link']=$this->front_model->home_link();

		
		$this->load->view('search-result',$data);
	}

	//联系我们页面显示
	public function contact(){
		//友情链接
		$data['link']=$this->front_model->home_link();
		$this->load->view('contact-us',$data);
	}

	//跳转至投稿页面
	public function submission(){
		$this->load->view('submission');
	}

	//投稿
	public function submission_action(){
		//获取用户输入
		$data=array(
			'title'=>$_POST['title'],
			'name'=>$_POST['name'],
			'tel'=>$_POST['tel'],
			'time'=>time(),
			'content'=>$_POST['content']
		);

		$this->load->helper('security');	//防御XSS攻击

		//对数据进行XSS过滤
		$data=$this->security->xss_clean($data);

		$this->front_model->submission($data);

		success('home/index','谢谢您！提交成功');

	}

	//单独设置分页样式函数以便在控制器中多次调用
		private function page_css(){
			//设置分页样式
			$config['full_tag_open'] = '<ul class="am-pagination am-pagination-centered">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = '首页';
			$config['first_tag_open'] = '<li class="">';//“第一页”链接的打开标签。
			$config['first_tag_close'] = '</li>';//“第一页”链接的关闭标签。
			$config['last_link'] = '尾页';//你希望在分页的右边显示“最后一页”链接的名字。
			$config['last_tag_open'] = '<li class="">';//“最后一页”链接的打开标签。
			$config['last_tag_close'] = '</li>';//“最后一页”链接的关闭标签。
			$config['next_link'] = '下一页';//你希望在分页中显示“下一页”链接的名字。
			$config['next_tag_open'] = '<li class="">';//“下一页”链接的打开标签。
			$config['next_tag_close'] = '</li>';//“下一页”链接的关闭标签。
			$config['prev_link'] = '上一页';//你希望在分页中显示“上一页”链接的名字。
			$config['prev_tag_open'] = '<li class="">';//“上一页”链接的打开标签。
			$config['prev_tag_close'] = '</li>';//“上一页”链接的关闭标签。
			$config['cur_tag_open'] = '<li class="am-active"><a>';//“当前页”链接的打开标签。
			$config['cur_tag_close'] = '</a></li>';//“当前页”链接的关闭标签。
			$config['num_tag_open'] = '<li class="">';//“数字”链接的打开标签。
			$config['num_tag_close'] = '</li>';

			return $config;
		}

}