<?php
	class Front_model extends CI_Model{
		
		public function __construct()
		{
			$this->load->database(); //加载数据库，已经在database.php文件中配置默认的数据库为retirement
		}

/**************  首页   **************************/
		//获取所有文章标题
		function all_article_title(){
			return $this->db->select('*')->from('article')->where(array('status'=>0))->order_by('time','desc')->get()->result_array();
		}

		//工作动态
		function home_workDynamics(){
			return $this->db->select('*')->from('article')->where(array('status'=>0,'type'=>0,'top'=>0))->order_by('time','desc')->limit('7')->get()->result_array();
		}

		//工作动态置顶
		function home_workDynamicsTop(){
			return $this->db->select('*')->from('article')->where(array('status'=>0,'type'=>0,'top'=>1))->order_by('time','desc')->limit('1')->get()->result_array();
		}

		//通知公告
		function home_notice(){
			return $this->db->select('*')->from('article')->where(array('status'=>0,'type'=>1,'top'=>0))->order_by('time','desc')->limit('9')->get()->result_array();
		}

		//通知公告置顶
		function home_noticeTop(){
			return $this->db->select('*')->from('article')->where(array('status'=>0,'type'=>1,'top'=>1))->order_by('time','desc')->limit('1')->get()->result_array();
		}

		//五老风采
		function home_fiveOld(){
			return $this->db->select('*')->from('article')->where(array('status'=>0,'type'=>3,'top'=>0))->order_by('time','desc')->limit('9')->get()->result_array();
		}

		//五老风采置顶
		function home_fiveOldTop(){
			return $this->db->select('*')->from('article')->where(array('status'=>0,'type'=>3,'top'=>1))->order_by('time','desc')->limit('1')->get()->result_array();
		}

		//学习园地
		function home_learnGarden(){
			return $this->db->select('*')->from('article')->where(array('status'=>0,'type'=>2,'top'=>0))->order_by('time','desc')->limit('9')->get()->result_array();
		}

		//学习园地置顶
		function home_learnGardenTop(){
			return $this->db->select('*')->from('article')->where(array('status'=>0,'type'=>2,'top'=>1))->order_by('time','desc')->limit('1')->get()->result_array();
		}

		//健康指南
		function home_healthGuide(){
			return $this->db->select('*')->from('article')->where(array('status'=>0,'type'=>4,'top'=>0))->order_by('time','desc')->limit('9')->get()->result_array();
		}

		//健康指南置顶
		function home_healthGuideTop(){
			return $this->db->select('*')->from('article')->where(array('status'=>0,'type'=>4,'top'=>1))->order_by('time','desc')->limit('1')->get()->result_array();
		}

		//首页轮播展示
		function home_showArticle(){
			return $this->db->select('*')->from('article')->where(array('status'=>0,'show'=>1))->order_by('time','desc')->limit('5')->get()->result_array();
		}

		//首页关工掠影图片
		function home_picture(){
			return $this->db->select('*')->from('footer_pic')->get()->result_array();
		}

		//友情链接
		function home_link(){
			return $this->db->select('*')->from('link')->get()->result_array();
		}

/**************  具体文章内容   **************************/
		//文章具体内容
		function content($id){
			return $this->db->select('*')->from('article')->where(array('id'=>$id))->get()->result_array();
		}

		//同一板块某文章的上一篇
		function previous($id){
			$type=$this->db->select('type')->from('article')->where(array('id' =>$id))->get()->result_array();
			$type=$type['0']['type']; //例如$type=1
			
			return $data=$this->db->query("SELECT id,title FROM article WHERE id=(SELECT max(id) FROM article WHERE id<$id AND type=$type)")->result_array();
			
		}

		//同一板块某文章的下一篇
		function next($id){
			$type=$this->db->select('type')->from('article')->where(array('id' =>$id))->get()->result_array();
			$type=$type['0']['type']; //例如$type=1
			
			return $data=$this->db->query("SELECT id,title FROM article WHERE id=(SELECT min(id) FROM article WHERE id>$id AND type=$type)")->result_array();
			
		}

		//增加文章点击量
		function click($id){
			//一定要用""才对，用''就会报错
			$this->db->query("UPDATE article SET click = click+1 WHERE id=$id");
		}

/**************  板块文章列表   **************************/
		//获取该板块所有文章
		function category($id){
			return $this->db->select('id,title,time')->from('article')->where(array('status'=>0,'type'=>$id))->order_by('time','desc')->get()->result_array();
		}

		//该板块的名称
		function name($id){
			return $this->db->select('ar_name')->from('article_type')->where(array('type'=>$id))->get()->result_array();
		}

		//该板块文章总数
		function total_rows($id){
			return $this->db->query("SELECT COUNT(*) FROM article WHERE type=$id")->result_array();
		}

/**************  搜索文章   **************************/	
		//like匹配一个字段，or_like匹配另一个字段，实现同时搜索标题和内容
		function search($text){
			//like匹配一个字段，or_like匹配另一个字段，实现同时搜索标题和内容
			return $this->db->select('*')->from('article')->order_by('time','desc')->like('title',$text)->or_like('content',$text)->get()->result_array();
		}	
/**************  投稿   **************************/	
		function submission($data){
			$this->db->insert('submission',$data);
		}
	}