<?php
	
	class m_category extends CI_model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		
		
		
		//for adding management details
		public function add($data)
		{
			
			$CategoryName	=	($data['CategoryName'] == '')?"":($data['CategoryName']);
			
			$array		=	array('CategoryName'=>$CategoryName);
			$result 	=	$this->db->insert('category',$array);
			
			return($result);
		}
		//for update management details
		public function update($data)
		{
			$CategoryID		=	$data['CategoryID'];
			$CategoryName	=	($data['CategoryName'] == '')?"":($data['CategoryName']);
			
			$array		=	array('CategoryName'=>$CategoryName);
			$this->db->where('CategoryID',$CategoryID);
			$result		=	$this->db->update('category',$array);
			return($result);
		}
		
		public function view()
		{
			$this->db->select('CategoryID,CategoryName');
			$this->db->from('category');
			$this->db->order_by('CategoryID','DESC');
			$query	=	$this->db->get();
			$result	=	$query->result_array();
			return($result);
		}
		public function delete($CategoryID)
		{
			$this->db->where('CategoryID',$CategoryID);
			$this->db->delete('category');
			return(1);			
		}
		public function view_single($CategoryID)
		{
			$this->db->select('CategoryID,CategoryName');
			$this->db->from('category');
			$this->db->where('CategoryID',$CategoryID);
			$query	=	$this->db->get();
			$result	=	$query->row_array();
			return($result);
		}
	
		
		
	}
	
	
?>