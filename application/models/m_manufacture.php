<?php
	
	class m_manufacture extends CI_model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		
		
		
		//for adding management details
		public function add($data)
		{
			
			$ManufactureName	=	($data['ManufactureName'] == '')?"":($data['ManufactureName']);
			
			$array		=	array('ManufactureName'=>$ManufactureName);
			$result 	=	$this->db->insert('manufacture',$array);
			
			return($result);
		}
		//for update management details
		public function update($data)
		{
			$ManufactureID		=	$data['ManufactureID'];
			$ManufactureName	=	($data['ManufactureName'] == '')?"":($data['ManufactureName']);
			
			$array		=	array('ManufactureName'=>$ManufactureName);
			$this->db->where('ManufactureID',$ManufactureID);
			$result		=	$this->db->update('manufacture',$array);
			return($result);
		}
		
		public function view()
		{
			$this->db->select('ManufactureID,ManufactureName');
			$this->db->from('manufacture');
			$this->db->order_by('ManufactureID','DESC');
			$query	=	$this->db->get();
			$result	=	$query->result_array();
			return($result);
		}
		public function delete($ManufactureID)
		{
			$this->db->where('ManufactureID',$ManufactureID);
			$this->db->delete('manufacture');
			return(1);			
		}
		public function view_single($ManufactureID)
		{
			$this->db->select('ManufactureID,ManufactureName');
			$this->db->from('manufacture');
			$this->db->where('ManufactureID',$ManufactureID);
			$query	=	$this->db->get();
			$result	=	$query->row_array();
			return($result);
		}
	
		
		
	}
	
	
?>