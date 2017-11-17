<?php
	class Admin_model extends CI_Model{
		
		public function __construct()
		{
			$this->load->database(); //加载数据库，已经在database.php文件中配置默认的数据库为retirement
		}

		//管理员登录时验证id
		function admin_id_check($a)
		{
			$query=$this->db->get('admin');
			
			foreach ($query->result_array() as $row)
			{
				if($a['nickName']==$row['nickName'])
				{
					return true;
				}
				
			}
			return false;
		}
		
		//管理员登录时验证password用，获得对应账号的密码
		function admin_password_check($a)
		{
			return $this->db->select('password')->from('admin')->where(array('nickName'=>$a['nickName']))->get()->result_array();
		}

		//管理员登录时验证管理员等级，等级0,最高等级可删管理员。等级1，可删除修改文章，审核文章
		function admin_level_check($a){
			$data=$a['nickName'];
			//where条件后面的参量必须要用引号括起来，而$a又是一个数组，所以只能这样写，不能直接写where nickName='$a['nickName']'
			$row=$this->db->query("SELECT level FROM admin where nickName='$data';")->result_array();
			return $row['0']['level'];
		}

		//获得管理员列表
		function get_admin_list(){

			return $this->db->select('*')->from('admin')->order_by('admin_id','desc')->get()->result_array();
			
			//设置分页的时候不能用下面这种查询语句，因为分页自动添加了limit语句，而下面这种写法就无法自动添加limit语句了
			//return $this->db->query("SELECT * FROM admin ORDER BY adminid DESC;")->result_array();
		}

		//根据管理员id获取该管理员的全部信息
		function get_admin_by_id($aid){

			return $this->db->select('*')->from('admin')->where(array('admin_id'=>$aid))->get()->result_array();
		}

		//删除管理员，根据adminid
 		function delete_admin($aid){
 			$this->db->delete('admin',array('admin_id'=>$aid));
 		}

 		//添加管理员
 		function add_admin_action($a){
 			$this->db->insert('admin',$a);
 		}

 		//编辑管理员
 		function edit_admin_action($a){
 			
 			$this->db->update('admin',$a,array('admin_id'=>$a['admin_id']));
 		}

 		//获得底部图片
 		function get_foot_pic(){
 			return $this->db->select('*')->from('footer_pic')->get()->result_array();
 		}

 		//替换底部图片
 		function edit_foot_pic($data){
 			$this->db->update('footer_pic',$data,array('id'=>$data['id']));
 		}

 		//获得友情链接
 		function get_link(){
 			return $this->db->select('*')->from('link')->get()->result_array();
 		}

 		//根据id获取友情链接
 		function get_link_by_id($id){
 			return $this->db->select('*')->from('link')->where(array('id'=>$id))->get()->result_array();
 		}

 		//替换友情链接
 		function edit_link($data){
 			$this->db->update('link',$data,array('id'=>$data['id']));
 		}

}