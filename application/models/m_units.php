<?php
	
	class m_units extends CI_model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		
		
		
		//for adding management details
		public function add($data)
		{
			
			$UnitsName	=	($data['UnitsName'] == '')?"":($data['UnitsName']);
			
			$array		=	array('UnitsName'=>$UnitsName);
			$result 	=	$this->db->insert('units',$array);
			
			return($result);
		}
		//for update management details
		public function update($data)
		{
			$UnitsID		=	$data['UnitsID'];
			$UnitsName	=	($data['UnitsName'] == '')?"":($data['UnitsName']);
			
			$array		=	array('UnitsName'=>$UnitsName);
			$this->db->where('UnitsID',$UnitsID);
			$result		=	$this->db->update('units',$array);
			return($result);
		}
		
		public function view()
		{
			$this->db->select('UnitsID,UnitsName');
			$this->db->from('units');
			$this->db->order_by('UnitsID','DESC');
			$query	=	$this->db->get();
			$result	=	$query->result_array();
			return($result);
		}
		public function delete($UnitsID)
		{
			$this->db->where('UnitsID',$UnitsID);
			$this->db->delete('units');
			return(1);			
		}
		public function view_single($UnitsID)
		{
			$this->db->select('UnitsID,UnitsName');
			$this->db->from('units');
			$this->db->where('UnitsID',$UnitsID);
			$query	=	$this->db->get();
			$result	=	$query->row_array();
			return($result);
		}
	
		
		
	}
	
	
?>