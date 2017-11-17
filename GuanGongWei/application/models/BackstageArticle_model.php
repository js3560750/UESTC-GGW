<?php
	class BackstageArticle_model extends CI_Model{
		
		public function __construct()
		{
			$this->load->database(); //加载数据库，已经在database.php文件中配置默认的数据库为mydatabase
		}

		//获取文章类型
		function get_article_type(){
			return $this->db->select('*')->from('article_type')->order_by('type')->get()->result_array();
		}

		
		//后台发表、添加文章add_article
 		public function add_article($a){

 			$this->db->insert('article',$a);
 		}

 		//获取所有文章
 		function get_article(){
 			return $this->db->select('*')->from('article')->order_by('time','desc')->get()->result_array();
 		}

 		

 		//根据aid删除文章
 		function delete_article($id){

			
 			$this->db->delete('article',array('id'=>$id));
 		}

 		//根据id获取文章所有信息
 		function get_article_by_id($id){

 			return $this->db->select('*')->from('article')->join('article_type','article.type=article_type.type')->where(array('id'=>$id))->get()->result_array();
 		}

 		//修改文章
 		function edit_article($data){
 			$this->db->update('article',$data,array('id'=>$data['id']));
 		}

 		

 		

 		//获取来稿
 		function get_submission(){
 			return $this->db->select('*')->from('submission')->order_by('time','desc')->get()->result_array();
 		}

 		//根据id删除来稿
 		function delete_submission($id){

			
 			$this->db->delete('submission',array('id'=>$id));
 		}

 		//根据id获取投稿所有信息
 		function get_submission_by_id($id){

 			return $this->db->select('*')->from('submission')->where(array('id'=>$id))->get()->result_array();
 		}


 	}