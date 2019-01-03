<?php
	
	class m_login extends CI_model
	{
		function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		
		//do the login
		function login($UserName, $UserPassword)
		{
			$this->db->select('M.UserID,M.UserName,M.UserPassword,M.UserTypeID,M.ImageID,L.UserTypeName');
			$this->db->from('user M');
			$this->db->join('usertype L', 'L.UserTypeID = M.UserTypeID', 'left');
			$this->db->where('M.UserName',$UserName);
			$this->db->where('M.UserPassword',$UserPassword);
			$this->db->where('M.UserActive','1');
			$query	=	$this->db->get();
			$result	=	$query->row_array();
			return($result);
		}


        function view_user($UserID)
        {
            $this->db->select('M.UserID,M.UserName,M.UserPassword,M.UserTypeID,M.ImageID,L.UserTypeName');
            $this->db->from('user M');
            $this->db->join('usertype L', 'L.UserTypeID = M.UserTypeID', 'left');
            $this->db->where('M.UserID',$UserID);
            $query	=	$this->db->get();
            $result	=	$query->row_array();
            return($result);
        }

		//check login status in every page
		function check_login()
		{
			if(isset($_SESSION['UserID']) && isset($_SESSION['UserName']) )
			{
				$this->db->select('UserID,UserName');
				$this->db->from('user');
				$this->db->where('UserID',$_SESSION['UserID']);
				$this->db->where('UserName',$_SESSION['UserName']);
				$query	=	$this->db->get();
				$result	=	$query->row_array();
				if(isset($result['UserID']) && isset($result['UserName']) && $_SESSION['UserID'] == $result['UserID'] 
					&& $_SESSION['UserName'] == $result['UserName'])
				{
					return(1);	
				}
				else
				{
					
					redirect(base_url().'login');
				}
			}
			else
			{
				redirect(base_url().'login');
			}
		}
		
		//check user login or not from the login page(use Only in the login Controller)
		function check_login_page()
		{
			if(isset($_SESSION['UserID']) && isset($_SESSION['UserName']) )
			{
				$this->db->select('UserID,UserName');
				$this->db->from('user');
				$this->db->where('UserID',$_SESSION['UserID']);
				$this->db->where('UserName',$_SESSION['UserName']);
				$query	=	$this->db->get();
				$result	=	$query->row_array();
				if(isset($result['UserID']) && isset($result['UserName']) && $_SESSION['UserID'] == $result['UserID'] 
					&& $_SESSION['UserName'] == $result['UserName'])
				{
					redirect(base_url());
				}
			}
		}
		
		//change the current user password
		function change_password($data)
		{
			$UserID	=	$data['UserID'];
			$c_pass			=	md5($data['current']);
			$n_pass			=	md5($data['UserPassword']);
			$this->db->select('UserPassword');
			$this->db->where('UserID',$UserID);
			$query	=	$this->db->get('user');
			$result	=	$query->row_array();
			if($result['UserPassword'] == $c_pass)
			{
				$array	=	array('UserPassword' => $n_pass);
				$this->db->where('UserID',$UserID);
				$this->db->update('user',$array);
				return(1);
			}
			else
			{
				return(0);
			}
			
		}


		//for image upload

		public function image_upload($img,$ImageID = 0)
		{
		
			//print_r($img);exit;
			$config['upload_path'] 		= $img['path'];
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
			$config['source_image'] 	= $img['image']['tmp_name'];
			$config['max_size'] 		= '5242880';
			$config['overwrite'] 		= FALSE;
			$this->load->library('upload', $config);
			
			//print_r($img['image']);exit;
			if($config['max_size'] < $img['image']['size'])
			{
				$msg['status']	=	'error';
				$msg['message']	=	'Maximum Size exceeds , Please select file below 2MB';
				return($msg);
			}
			else if (!$this->upload->do_upload($img['field']))
			{
				$msg['status']	=	'error';
				$msg['message']	=	$this->upload->display_errors();
				return($msg);
			}
			else
			{
				//inserting new image
				$msg['status']	=	'success';
				$updata			= 	$this->upload->data();
				$msg['name']	=	$updata['file_name'];
				$ImageName		=	$updata['file_name'];
				$ImagePath		=	$img['path'];
				$ImageArray		=	array('ImageName'=>$ImageName,'ImagePath'=>$ImagePath);
				
				//for Delete ecisting image
				$this->db->select('ImageID,ImageName,ImagePath');
				$this->db->from('image');
				$this->db->where('ImageID',$ImageID);
				$query1	=	$this->db->get();
				$image	=	$query1->row_array();  
				if(isset($image['ImageID']) && $image['ImageID'] != 0 && $image['ImageID'] != '')
				{
					$unlink_logo	=	$image['ImagePath'].'/'.$image['ImageName'];
					if(file_exists($unlink_logo) && $image['ImageName'] != "")
					{
						unlink($unlink_logo);
					}
					//updatinh new image table
					$this->db->where('ImageID',$ImageID);
					$this->db->update('image',$ImageArray);		
					$msg['ImageID']	=	$ImageID;	
				}
				else
				{
					$this->db->insert('image',$ImageArray);		
					$msg['ImageID']	=	$this->db->insert_id();	
				}	
				$msg['status']	=	'success';
				return($msg);
			}
		}


		
		
		
		
	}

?>
