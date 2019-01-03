<?php
	
	class m_design extends CI_model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		
		
		
		//for adding management details
		public function add($data)
		{

			$DesignName		=	$data['DesignName'];
			$ServiceID		=	$data['ServiceID'];
			$DesignPrice	=	!empty($data['DesignPrice'])?$data['DesignPrice']:0;
			$ImageID		=	!empty($data['ImageID'])?$data['ImageID']:'';
		
			
			$array		=	array('DesignName'=>$DesignName,'ServiceID'=>$ServiceID,'DesignPrice'=>$DesignPrice,'ImageID'=>$ImageID);
			$result 	=	$this->db->insert('design',$array);
			
			return($result);
		}
		//for update management details
		public function update($data)
		{
			$DesignID		=	$data['DesignID'];
			$DesignName		=	$data['DesignName'];
			$ServiceID		=	$data['ServiceID'];
			$DesignPrice	=	!empty($data['DesignPrice'])?$data['DesignPrice']:0;
			$ImageID		=	!empty($data['ImageID'])?$data['ImageID']:'';
			$DesignActive	=	(isset($data['DesignActive']) && $data['DesignActive'] == 1)?'1':'0';
			
			$array		=	array('DesignName'=>$DesignName,'ServiceID'=>$ServiceID,'DesignPrice'=>$DesignPrice,'ImageID'=>$ImageID,'DesignActive'=>$DesignActive);
			$this->db->where('DesignID',$DesignID);
			$result		=	$this->db->update('design',$array);
			return($result);
		}
		
		public function view()
		{
			$this->db->select('P.DesignID,P.DesignName,P.DesignPrice,P.DesignActive,C.ServiceName,I.ImagePath,I.ImageName,P.ImageID');
			$this->db->from('design P');
			$this->db->join('service C','C.ServiceID = P.ServiceID','left');
			$this->db->join('image I','I.ImageID = P.ImageID','left');
			$this->db->order_by('DesignID','DESC');
			$query	=	$this->db->get();
			$result	=	$query->result_array();
			return($result);
		}
		public function delete($DesignID)
		{

			$this->db->select('ImageID,DesignID');
			$this->db->from('design');
			$this->db->where('DesignID',$DesignID);
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
			
			$this->db->where('DesignID',$DesignID);
			$this->db->delete('design');
			return(1);			
		}
		public function view_single($DesignID)
		{
			$this->db->select('P.DesignID,P.DesignName,P.ServiceID,P.DesignPrice,P.DesignActive,P.ImageID,I.ImageName,I.ImagePath');
			$this->db->from('design P');
			$this->db->join('image I','I.ImageID = P.ImageID','left');
			$this->db->where('DesignID',$DesignID);
			$query	=	$this->db->get();
			$result	=	$query->row_array();
			return($result);
		}

		public function view_service()
		{
			$this->db->select('ServiceID,ServiceName');
			$this->db->from('service');
			$this->db->where('ServiceActive','1');
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}


		
		
	}
	
	
?>