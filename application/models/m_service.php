<?php
	
	class m_service extends CI_model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		
		
		
		//for adding management details
		public function add($data)
		{

			$ServiceName	=	$data['ServiceName'];
			$ServicePrice	=	!empty($data['ServicePrice'])?$data['ServicePrice']:0;
			$TaxID			=	$data['TaxID'];
			$TaxMethod		=	$data['TaxMethod'];
			$ImageID		=	!empty($data['ImageID'])?$data['ImageID']:'';
			$WFServiceID 	=	!empty($data['WFServiceID'])?$data['WFServiceID']:0;
		
			
			$array		=	array('ServiceName'=>$ServiceName,'ServicePrice'=>$ServicePrice,'TaxID'=>$TaxID,'TaxMethod'=>$TaxMethod,'ImageID'=>$ImageID,'WFServiceID'=>$WFServiceID);
			$result 	=	$this->db->insert('service',$array);
			
			return($result);
		}
		//for update management details
		public function update($data)
		{
			$ServiceID		=	$data['ServiceID'];
			$ServiceName	=	$data['ServiceName'];
			$ServicePrice	=	!empty($data['ServicePrice'])?$data['ServicePrice']:0;
			$TaxID			=	$data['TaxID'];
			$TaxMethod		=	$data['TaxMethod'];
			$ImageID		=	!empty($data['ImageID'])?$data['ImageID']:'';
			$ServiceActive	=	(isset($data['ServiceActive']) && $data['ServiceActive'] == 1)?'1':'0';
			$WFServiceID 	=	!empty($data['WFServiceID'])?$data['WFServiceID']:0;
			
			$array		=	array('ServiceName'=>$ServiceName,'ServicePrice'=>$ServicePrice,'TaxID'=>$TaxID,'TaxMethod'=>$TaxMethod,'ImageID'=>$ImageID,'ServiceActive'=>$ServiceActive,'WFServiceID'=>$WFServiceID);
			$this->db->where('ServiceID',$ServiceID);
			$result		=	$this->db->update('service',$array);
			return($result);
		}
		
		public function view()
		{
			$this->db->select('P.ServiceID,P.ServiceName,P.ServicePrice,P.ServiceActive,T.TaxName,I.ImagePath,I.ImageName,P.ImageID');
			$this->db->from('service P');
			$this->db->join('tax T','T.TaxID = P.TaxID','left');
			$this->db->join('image I','I.ImageID = P.ImageID','left');
			$this->db->order_by('ServiceID','DESC');
			$query	=	$this->db->get();
			$result	=	$query->result_array();
			return($result);
		}
		public function delete($ServiceID)
		{

			$this->db->select('ImageID,ServiceID');
			$this->db->from('service');
			$this->db->where('ServiceID',$ServiceID);
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
			
			$this->db->where('ServiceID',$ServiceID);
			$this->db->delete('service');
			return(1);			
		}
		public function view_single($ServiceID)
		{
			$this->db->select('P.ServiceID,P.ServiceName,P.TaxID,P.TaxMethod,P.ServicePrice,P.ServiceActive,P.ImageID,I.ImageName,I.ImagePath,P.WFServiceID');
			$this->db->from('service P');
			$this->db->join('image I','I.ImageID = P.ImageID','left');
			$this->db->where('ServiceID',$ServiceID);
			$query	=	$this->db->get();
			$result	=	$query->row_array();
			return($result);
		}

		public function view_tax()
		{
			$this->db->select('TaxID,TaxName');
			$this->db->from('tax');
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}
	
		public function view_service()
		{
			$this->db->select('ServiceID,ServiceName');
			$this->db->from('service');
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}
	
		
	}
	
	
?>