<?php
	
	class m_tax extends CI_model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		
		
		
		//for adding management details
		public function add($data)
		{
			
			$TaxName	=	($data['TaxName'] == '')?"":($data['TaxName']);
			$TaxRate	=	($data['TaxRate'] == '')?"":($data['TaxRate']);

			$array		=	array('TaxName'=>$TaxName,'TaxRate'=>$TaxRate);
			$result 	=	$this->db->insert('tax',$array);
			
			return($result);
		}
		//for update management details
		public function update($data)
		{
			$TaxID		=	$data['TaxID'];
			$TaxName	=	($data['TaxName'] == '')?"":($data['TaxName']);
			$TaxRate	=	($data['TaxRate'] == '')?"":($data['TaxRate']);

			$array		=	array('TaxName'=>$TaxName,'TaxRate'=>$TaxRate);
			$this->db->where('TaxID',$TaxID);
			$result		=	$this->db->update('tax',$array);
			return($result);
		}
		
		public function view()
		{
			$this->db->select('TaxID,TaxName,TaxRate');
			$this->db->from('tax');
			$this->db->order_by('TaxID','DESC');
			$query	=	$this->db->get();
			$result	=	$query->result_array();
			return($result);
		}
		public function delete($TaxID)
		{
			$this->db->where('TaxID',$TaxID);
			$this->db->delete('tax');
			return(1);			
		}
		public function view_single($TaxID)
		{
			$this->db->select('TaxID,TaxName,TaxRate');
			$this->db->from('tax');
			$this->db->where('TaxID',$TaxID);
			$query	=	$this->db->get();
			$result	=	$query->row_array();
			return($result);
		}
	
		
		
	}
	
	
?>