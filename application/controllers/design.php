<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class design extends CI_Controller 
{


	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->helper("url");
		$this->load->model("m_login");
		$this->load->model("m_design");
		$this->m_login->check_login();
		$_SESSION['PageActive']		=	"service";
		$_SESSION['SubActive']		=	"list_design";

		if(isset($_GET['view']) && $_GET['view'] == 'list')
		{
			$_SESSION['PageView'] 	=	'list';
		}
		else if(isset($_GET['view']) && $_GET['view'] == 'grid')
		{
			$_SESSION['PageView'] 	=	'grid';
		}
		$_SESSION['PageView']	=	isset($_SESSION['PageView'])?$_SESSION['PageView']:'list';
		
	}
	

	public function index()
	{
		$this->view_list();		
	}

	public function view_list()
	{
		$data['title']	=	'Service Design';
		$data['items']	=	$this->m_design->view();

		$this->load->view('design/'.$_SESSION["PageView"],$data);
	}

	public function add()
	{
		if(isset($_POST['DesignName']))
		{

			$data 	=	$_POST;
			$ImageError	=	0;	
			if(!empty($_FILES['Photo']['tmp_name']))
			{
				$img	=	$_FILES;
				$img['path']	=	'img/design';
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

			$result =	$this->m_design->add($data);

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
				
	            redirect(base_url().'design');	
			}
			else
			{
				$_SESSION['MsgCode']	   =   'error';
	            $_SESSION['MsgTitle']      =   "Item not added ";
	            $_SESSION['MsgContent']    =   "Please add item again ";
	            $this->add();	
			}
		}
		else
		{
			$_SESSION['SubActive']		=	"add_design";

			$data['Services']	=	$this->m_design->view_service();
			$data['title']		=	'Service Design';
			$data['mode']		=	'add';
			$this->load->view('design/add',$data);
		}
		
	}
	public function edit($DesignID)
	{
		$data				=	$this->m_design->view_single($DesignID);
		$data['Services']	=	$this->m_design->view_service();
		$data['title']	=	'Service Design';
		$data['mode']	=	'update';
		$this->load->view('design/add',$data);

	}

	public function update()
	{
		//print_r($_POST);exit;
		$data 	=	$_POST;
		$ImageError	=	0;	
		if(!empty($_FILES['Photo']['tmp_name']))
		{
			$img	=	$_FILES;
			$img['path']	=	'img/design';
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

		$result =	$this->m_design->update($data);

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

	        redirect(base_url().'design');	
		}
		else
		{
			$_SESSION['MsgCode']	   =   'error';
	        $_SESSION['MsgTitle']      =   "Item not update ";
	        $_SESSION['MsgContent']    =   "Please update item again ";
	        $this->edit($_POST['DesignID']);	
		}
	}

	public function delete()
	{
		$DesignID 	=	$_POST['id'];
		$result =	$this->m_design->delete($DesignID);
		echo $result;
	}
}
