<?php
	
	class m_supplier extends CI_model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		
		
		
		//for adding management details
		public function add($data)
		{
			
			$SupplierName	=	$data['SupplierName'];
			$SupplierEmail	=	!empty($data['SupplierEmail'])?$data['SupplierEmail']:'';
			$SupplierPhone	=	!empty($data['SupplierPhone'])?$data['SupplierPhone']:'';
			$SupplierAddress=	!empty($data['SupplierAddress'])?$data['SupplierAddress']:'';
			$TRN			=	!empty($data['TRN'])?$data['TRN']:'';
			$ImageID		=	!empty($data['ImageID'])?$data['ImageID']:'';
	
			$array			=	array('SupplierName'=>$SupplierName,'SupplierEmail'=>$SupplierEmail,'SupplierPhone'=>$SupplierPhone,'SupplierAddress'=>$SupplierAddress,'ImageID'=>$ImageID,'TRN'=>$TRN);
			$result 		=	$this->db->insert('supplier',$array);
			
			return($result);
		}
		//for update management details
		public function update($data)
		{
			$SupplierID		=	$data['SupplierID'];
			$SupplierName	=	$data['SupplierName'];
			$SupplierEmail	=	!empty($data['SupplierEmail'])?$data['SupplierEmail']:'';
			$SupplierPhone	=	!empty($data['SupplierPhone'])?$data['SupplierPhone']:'';
			$SupplierAddress=	!empty($data['SupplierAddress'])?$data['SupplierAddress']:'';
			$TRN			=	!empty($data['TRN'])?$data['TRN']:'';
			$ImageID		=	!empty($data['ImageID'])?$data['ImageID']:'';
			$SupplierActive	=	(isset($data['SupplierActive']) && $data['SupplierActive'] == 1)?'1':'0';

			$array		=	array('SupplierName'=>$SupplierName,'SupplierEmail'=>$SupplierEmail,'SupplierPhone'=>$SupplierPhone,'SupplierAddress'=>$SupplierAddress,'ImageID'=>$ImageID,'SupplierActive'=>$SupplierActive,'TRN'=>$TRN);
			$this->db->where('SupplierID',$SupplierID);
			$result		=	$this->db->update('supplier',$array);
			return($result);
		}
		
		public function view()
		{
			$this->db->select('C.SupplierID,C.SupplierName,C.SupplierEmail,C.SupplierPhone,C.SupplierAddress,C.ImageID,I.ImageName,I.ImagePath,C.SupplierActive');
			$this->db->from('supplier C');
			$this->db->join('image I','I.ImageID = C.ImageID','left');
			$this->db->order_by('SupplierID','DESC');
			$query	=	$this->db->get();
			$result	=	$query->result_array();
			return($result);
		}
		public function delete($SupplierID)
		{

			$this->db->select('ImageID,SupplierID');
			$this->db->from('supplier');
			$this->db->where('SupplierID',$SupplierID);
			$query	=	$this->db->get();
			$result	=	$query->row_array();
			$ImageID	=	(isset($result['ImageID']))?$result['ImageID']:0;
			
			$this->db->select('ImageID,ImageName,ImagePath');
			$this->db->from('image');
			$this->db->where('ImageID',$ImageID);
			$query1	=	$this->db->get();
			$image	=	$query1->row_array();
			//print_r($image);exit;
			//for Image Delete
			if(isset($image['ImageID']))
			{
				$unlink_logo	=	$image['ImagePath'].'/'.$image['ImageName'];
				if(file_exists($unlink_logo) && $image['ImageName'] != "")
				{
					unlink($unlink_logo);
				}
				$this->db->where('ImageID',$image['ImageID']);
				$this->db->delete('image');
			}		
			
			$this->db->where('SupplierID',$SupplierID);
			$this->db->delete('supplier');
			return(1);			
		}
		public function view_single($SupplierID)
		{
			$this->db->select('C.SupplierID,C.SupplierName,C.SupplierEmail,C.SupplierPhone,C.SupplierAddress,C.ImageID,I.ImageName,I.ImagePath,C.SupplierActive,C.TRN');
			$this->db->from('supplier C');
			$this->db->join('image I','I.ImageID = C.ImageID','left');
			$this->db->where('SupplierID',$SupplierID);
			$query	=	$this->db->get();
			$result	=	$query->row_array();
			return($result);
		}
	
		
		
	}
	
	
?>