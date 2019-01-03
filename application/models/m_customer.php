<?php
	
	class m_customer extends CI_model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		
		
		
		//for adding management details
		public function add($data)
		{
			
			$CustomerName	=	$data['CustomerName'];
			$CustomerEmail	=	!empty($data['CustomerEmail'])?$data['CustomerEmail']:'';
			$CustomerPhone	=	!empty($data['CustomerPhone'])?$data['CustomerPhone']:'';
			$CustomerAddress=	!empty($data['CustomerAddress'])?$data['CustomerAddress']:'';
			$TRN			=	!empty($data['TRN'])?$data['TRN']:'';
			$ImageID		=	!empty($data['ImageID'])?$data['ImageID']:'';
	
			$array			=	array('CustomerName'=>$CustomerName,'CustomerEmail'=>$CustomerEmail,'CustomerPhone'=>$CustomerPhone,'CustomerAddress'=>$CustomerAddress,'ImageID'=>$ImageID,'TRN'=>$TRN);
			$result 		=	$this->db->insert('customer',$array);
			
			return($result);
		}
		//for update management details
		public function update($data)
		{
			$CustomerID		=	$data['CustomerID'];
			$CustomerName	=	$data['CustomerName'];
			$CustomerEmail	=	!empty($data['CustomerEmail'])?$data['CustomerEmail']:'';
			$CustomerPhone	=	!empty($data['CustomerPhone'])?$data['CustomerPhone']:'';
			$CustomerAddress=	!empty($data['CustomerAddress'])?$data['CustomerAddress']:'';
			$TRN			=	!empty($data['TRN'])?$data['TRN']:'';
			$ImageID		=	!empty($data['ImageID'])?$data['ImageID']:'';
			$CustomerActive	=	(isset($data['CustomerActive']) && $data['CustomerActive'] == 1)?'1':'0';

			$array		=	array('CustomerName'=>$CustomerName,'CustomerEmail'=>$CustomerEmail,'CustomerPhone'=>$CustomerPhone,'CustomerAddress'=>$CustomerAddress,'ImageID'=>$ImageID,'CustomerActive'=>$CustomerActive,'TRN'=>$TRN);
			$this->db->where('CustomerID',$CustomerID);
			$result		=	$this->db->update('customer',$array);
			return($result);
		}
		
		public function view()
		{
			$this->db->select('C.CustomerID,C.CustomerName,C.CustomerEmail,C.CustomerPhone,C.CustomerAddress,C.ImageID,I.ImageName,I.ImagePath,C.CustomerActive');
			$this->db->from('customer C');
			$this->db->join('image I','I.ImageID = C.ImageID','left');
			$this->db->order_by('CustomerID','DESC');
			$query	=	$this->db->get();
			$result	=	$query->result_array();
			return($result);
		}
		public function delete($CustomerID)
		{

			$this->db->select('ImageID,CustomerID');
			$this->db->from('customer');
			$this->db->where('CustomerID',$CustomerID);
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
			
			$this->db->where('CustomerID',$CustomerID);
			$this->db->delete('customer');
			return(1);			
		}
		public function view_single($CustomerID)
		{
			$this->db->select('C.CustomerID,C.CustomerName,C.CustomerEmail,C.CustomerPhone,C.CustomerAddress,C.ImageID,I.ImageName,I.ImagePath,C.CustomerActive,C.TRN');
			$this->db->from('customer C');
			$this->db->join('image I','I.ImageID = C.ImageID','left');
			$this->db->where('CustomerID',$CustomerID);
			$query	=	$this->db->get();
			$result	=	$query->row_array();
			return($result);
		}
	
		
		
	}
	
	
?>