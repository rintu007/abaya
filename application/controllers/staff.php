<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class staff extends CI_Controller 
{


	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->helper("url");
		$this->load->model("m_login");
		$this->load->model("m_staff");
		$this->m_login->check_login();
		$_SESSION['PageActive']		=	"staff";
	}
	

	public function index()
	{
		$this->view_list();		
	}

	public function view_list()
	{
		$data['title']	=	'Staff';
		$data['items']	=	$this->m_staff->view();
		$this->load->view('staff/list',$data);
	}

	public function add()
	{
		if(isset($_POST['StaffName']))
		{
			$data 	=	$_POST;
			//checking username aleredy exist
			$this->check_user_when_post($data['UserID'],$data['UserName'],$data['UserActive'],$data['StaffID'],$data['mode']);
			
			$ImageError	=	0;	
			if(!empty($_FILES['Photo']['tmp_name']))
			{
				$img	=	$_FILES;
				$img['path']	=	'img/staff';
				$img['field']	=	'Photo';
				$img_result		=	$this->m_login->image_upload($img);
				
				
				if($img_result['status'] == 'success')
				{
					$data['ImageID']	=	$img_result['ImageID'];
				}
				else if($img_result['status'] == 'error')
				{
					$ImageError	=	1;					
				}
			}

			//update staff login details
			$data['UserID']	=	$this->m_staff->update_user($data);

			$result =	$this->m_staff->add($data);

			if($result == TRUE)
			{

				if($ImageError == 1)
				{
					$_SESSION['MsgCode']	   =   'warning';
		            $_SESSION['MsgTitle']      =   "Item Added with Error ";
		            $_SESSION['MsgContent']    =   $img_result['message'];
				}
				else
				{
					$_SESSION['MsgCode']	   =   'success';
		            $_SESSION['MsgTitle']      =   "Item Added ";
		            $_SESSION['MsgContent']    =   "New item added succesfully";
				}

	            redirect(base_url().'staff');	
			}
			else
			{
				$_SESSION['MsgCode']	   =   'error';
	            $_SESSION['MsgTitle']      =   "Item not added ";
	            $_SESSION['MsgContent']    =   "Please add item again ";
	          	redirect(base_url().'staff/add');
			}
		}
		else
		{
			$data['title']			=	'Staff';
			$data['mode']			=	'add';
			$data['FullTimeStaff']	=	1;
			$data['UserType']		=	$this->m_staff->view_usertype();
			$this->load->view('staff/add',$data);
		}
		
	}
	public function edit($StaffID)
	{
		$data				=	$this->m_staff->view_single($StaffID);
		$data['UserType']	=	$this->m_staff->view_usertype();
		$data['title']		=	'Staff';
		$data['mode']		=	'update';
		$this->load->view('staff/add',$data);

	}

	public function update()
	{
		$data 	=	$_POST;
		//checking username aleredy exist
		$this->check_user_when_post($data['UserID'],$data['UserName'],$data['UserActive'],$data['StaffID'],$data['mode']);
		$ImageError	=	0;	
		if(!empty($_FILES['Photo']['tmp_name']))
		{
			$img	=	$_FILES;
			$img['path']	=	'img/staff';
			$img['field']	=	'Photo';
			$img_result		=	$this->m_login->image_upload($img,$data['ImageID']);
				
				
			if($img_result['status'] == 'success')
			{
				$data['ImageID']	=	$img_result['ImageID'];
			}
			else if($img_result['status'] == 'error')
			{
				$ImageError	=	1;					
			}
		}
		//update staff login details
		$data['UserID']	=	$this->m_staff->update_user($data);
		
		$result =	$this->m_staff->update($data);

		if($result == TRUE)
		{
			if($ImageError == 1)
			{
				$_SESSION['MsgCode']	   =   'warning';
		        $_SESSION['MsgTitle']      =   "Item Updated with Error ";
		        $_SESSION['MsgContent']    =   $img_result['message'];
			}
			else
			{
				$_SESSION['MsgCode']	   =   'success';
		        $_SESSION['MsgTitle']      =   "Item Updated ";
		        $_SESSION['MsgContent']    =   "Item Update succesfully";
			}
			
	        redirect(base_url().'staff');	
		}
		else
		{
			$_SESSION['MsgCode']	   =   'error';
	        $_SESSION['MsgTitle']      =   "Item not update ";
	        $_SESSION['MsgContent']    =   "Please update item again ";
	        $this->edit($_POST['StaffID']);	
		}
	}



	public function delete()
	{
		$StaffID 	=	$_POST['id'];
		$result =	$this->m_staff->delete($StaffID);
		echo $result;
	}

	public function check_user()
	{
		$UserName 	=	$_POST['UserName'];
		$UserID 	=	$_POST['UserID'];
		$result =	$this->m_staff->check_user($UserID,$UserName);
		echo $result;
	}
	function check_user_when_post($UserID,$UserName,$UserActive,$StaffID,$mode)
	{

		if($UserActive == 1)
		{
			$result =	$this->m_staff->check_user($UserID,$UserName);
			if($result == true)
			{
				$_SESSION['MsgCode']	   =   'error';
			    $_SESSION['MsgTitle']      =   "Username Exist";
			    $_SESSION['MsgContent']    =   "Username already exist, please try other one";
				if($mode == 'update')
				{
					redirect(base_url().'staff/edit/'.$StaffID);	
				}
				else
				{
			        redirect(base_url().'staff/add');	
				}
				
			}
		}
		
	}
}
