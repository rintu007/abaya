<?php
	
	class m_staff extends CI_model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		
		
		
		//for adding management details
		public function add($data)
		{
			
			$StaffName		=	$data['StaffName'];
			$StaffEmail		=	!empty($data['StaffEmail'])?$data['StaffEmail']:'';
			$StaffPhone		=	!empty($data['StaffPhone'])?$data['StaffPhone']:'';
			$StaffAddress	=	!empty($data['StaffAddress'])?$data['StaffAddress']:'';
			$ImageID		=	!empty($data['ImageID'])?$data['ImageID']:'';
			$FullTimeStaff	=	(isset($data['FullTimeStaff']) && $data['FullTimeStaff'] == 1)?'1':'0';
			$UserTypeID		=	!empty($data['UserTypeID'])?$data['UserTypeID']:'';
			$UserActive		=	(isset($data['UserActive']) && $data['UserActive'] == 1)?'1':'0';
			$UserID			=	!empty($data['UserID'])?$data['UserID']:0;
	
			$array			=	array('StaffName'=>$StaffName,'StaffEmail'=>$StaffEmail,'StaffPhone'=>$StaffPhone,'StaffAddress'=>$StaffAddress,'ImageID'=>$ImageID,'UserActive'=>$UserActive,'UserID'=>$UserID,
								'FullTimeStaff'=>$FullTimeStaff,'UserTypeID'=>$UserTypeID);
			$result 		=	$this->db->insert('staff',$array);
			
			return($result);
		}
		//for update management details
		public function update($data)
		{
			$StaffID		=	$data['StaffID'];
			$StaffName		=	$data['StaffName'];
			$StaffEmail		=	!empty($data['StaffEmail'])?$data['StaffEmail']:'';
			$StaffPhone		=	!empty($data['StaffPhone'])?$data['StaffPhone']:'';
			$StaffAddress	=	!empty($data['StaffAddress'])?$data['StaffAddress']:'';
			$ImageID		=	!empty($data['ImageID'])?$data['ImageID']:'';
			$FullTimeStaff	=	(isset($data['FullTimeStaff']) && $data['FullTimeStaff'] == 1)?'1':'0';
			$UserTypeID		=	!empty($data['UserTypeID'])?$data['UserTypeID']:'';
			$UserActive		=	(isset($data['UserActive']) && $data['UserActive'] == 1)?'1':'0';
			$UserID			=	!empty($data['UserID'])?$data['UserID']:0;
			$StaffActive	=	(isset($data['StaffActive']) && $data['StaffActive'] == 1)?'1':'0';

			$array		=	array('StaffName'=>$StaffName,'StaffEmail'=>$StaffEmail,'StaffPhone'=>$StaffPhone,'StaffAddress'=>$StaffAddress,'ImageID'=>$ImageID,'UserActive'=>$UserActive,'UserID'=>$UserID,'StaffActive'=>$StaffActive,
							'FullTimeStaff'=>$FullTimeStaff,'UserTypeID'=>$UserTypeID);
			//print_r($array);exit;
			$this->db->where('StaffID',$StaffID);
			$result		=	$this->db->update('staff',$array);
			//echo $this->db->last_query();exit;
			return($result);
		}
		
		public function view()
		{
			$this->db->select('C.StaffID,C.StaffName,C.StaffPhone,C.ImageID,I.ImageName,I.ImagePath,C.StaffActive,C.UserActive,T.UserTypeName,U.UserName');
			$this->db->from('staff C');
			$this->db->join('image I','I.ImageID = C.ImageID','left');
			$this->db->join('usertype T','T.UserTypeID = C.UserTypeID','left');
			$this->db->join('user U','U.UserID = C.UserID','left');
			$this->db->order_by('StaffID','DESC');
			$query	=	$this->db->get();
			$result	=	$query->result_array();
			return($result);
		}
		public function delete($StaffID)
		{

			$this->db->select('ImageID,StaffID,UserID');
			$this->db->from('staff');
			$this->db->where('StaffID',$StaffID);
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

			$this->db->where('UserID',$result['UserID']);
			$this->db->delete('user');	
			
			$this->db->where('StaffID',$StaffID);
			$this->db->delete('staff');
			return(1);			
		}
		public function view_single($StaffID)
		{
			$this->db->select('C.StaffID,C.StaffName,C.StaffEmail,C.StaffPhone,C.StaffAddress,C.ImageID,I.ImageName,I.ImagePath,C.StaffActive,C.UserTypeID,C.UserActive,C.UserID,U.UserName,C.FullTimeStaff');
			$this->db->from('staff C');
			$this->db->join('image I','I.ImageID = C.ImageID','left');
			$this->db->join('user U','U.UserID = C.UserID','left');
			$this->db->where('StaffID',$StaffID);
			$query	=	$this->db->get();
			$result	=	$query->row_array();
			return($result);
		}

		public function view_usertype()
		{
			$this->db->select('UserTypeID,UserTypeName');
			$this->db->from('usertype');
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}

		function update_user($data)
		{
			$UserID 		=	$data['UserID'];
			$UserName 		=	$data['UserName'];
			$UserPassword 	=	!empty($data['UserPassword'])?md5($data['UserPassword']):'';
			$UserTypeID		=	$data['UserTypeID'];
			$UserActive		=	(isset($data['UserActive']) && $data['UserActive'] == 1)?'1':'0';
			$ImageID		=	!empty($data['ImageID'])?$data['ImageID']:'';
			$this->db->select('UserID');
			$this->db->from('user');
			$this->db->where('UserID',$UserID);
			$query 	=	$this->db->get();
			$result =	$query->row_array();

			if(isset($result['UserID']) && ($result['UserID'] == $UserID))
			{
				$array 	=	array('UserName'=>$UserName,'UserTypeID'=>$UserTypeID,'ImageID'=>$ImageID,'UserActive'=>$UserActive);
				$this->db->where('UserID',$UserID);
				$this->db->update('user',$array);
				return($UserID);
			}
			else
			{
				if(isset($UserActive) && $UserActive == '1')
				{
					$array 	=	array('UserName'=>$UserName,'UserTypeID'=>$UserTypeID,'ImageID'=>$ImageID,'UserPassword'=>$UserPassword);
					$this->db->insert('user',$array);
					return $this->db->insert_id();
				}
				else
				{
					return($UserID);
				}
			}	
		}

		function check_user($UserID,$UserName)
		{
			$this->db->select('UserName');
			$this->db->from('user');
			$this->db->where('UserName',$UserName);
			$this->db->where('UserID !=',$UserID);
			$query 	=	$this->db->get();
			$result =	$query->row_array();
			if($result['UserName'] == $UserName)
			{
				return(true);
			}
			else
			{
				return(false);
			}

		}
	
		
		
	}
	
	
?>