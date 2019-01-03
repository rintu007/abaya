<?php
	
	class m_warehouse extends CI_model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		
		
		
		//for adding management details
		public function add($data)
		{
			
			$WarehouseName	=	($data['WarehouseName'] == '')?"":($data['WarehouseName']);
			
			$array		=	array('WarehouseName'=>$WarehouseName);
			$result 	=	$this->db->insert('warehouse',$array);
			
			return($result);
		}
		//for update management details
		public function update($data)
		{
			$WarehouseID		=	$data['WarehouseID'];
			$WarehouseName	=	($data['WarehouseName'] == '')?"":($data['WarehouseName']);
			
			$array		=	array('WarehouseName'=>$WarehouseName);
			$this->db->where('WarehouseID',$WarehouseID);
			$result		=	$this->db->update('warehouse',$array);
			return($result);
		}
		
		public function view()
		{
			$this->db->select('WarehouseID,WarehouseName');
			$this->db->from('warehouse');
			$this->db->order_by('WarehouseID','DESC');
			$query	=	$this->db->get();
			$result	=	$query->result_array();
			return($result);
		}
		public function delete($WarehouseID)
		{
			$this->db->where('WarehouseID',$WarehouseID);
			$this->db->delete('warehouse');
			return(1);			
		}
		public function view_single($WarehouseID)
		{
			$this->db->select('WarehouseID,WarehouseName');
			$this->db->from('warehouse');
			$this->db->where('WarehouseID',$WarehouseID);
			$query	=	$this->db->get();
			$result	=	$query->row_array();
			return($result);
		}
	
		
		
	}
	
	
?>