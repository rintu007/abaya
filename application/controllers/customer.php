<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class customer extends CI_Controller 
{


	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->helper("url");
		$this->load->model("m_login");
		$this->load->model("m_customer");
		$this->m_login->check_login();
		$_SESSION['PageActive']		=	"customer";
	}
	

	public function index()
	{
		$this->view_list();		
	}

	public function view_list()
	{
		$data['title']	=	'Customer';
		$data['items']	=	$this->m_customer->view();
		$this->load->view('customer/list',$data);
	}

	public function add()
	{
		if(isset($_POST['CustomerName']))
		{
			$data 	=	$_POST;
			$ImageError	=	0;	
			if(!empty($_FILES['Photo']['tmp_name']))
			{
				$img	=	$_FILES;
				$img['path']	=	'img/customer';
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

			$result =	$this->m_customer->add($data);
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

	            redirect(base_url().'customer');	
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
			$data['title']	=	'Customers';
			$data['mode']	=	'add';
			$this->load->view('customer/add',$data);
		}
		
	}
	public function edit($CustomerID)
	{
		$data	=	$this->m_customer->view_single($CustomerID);
		$data['title']	=	'Customer';
		$data['mode']	=	'update';
		$this->load->view('customer/add',$data);

	}

	public function update()
	{

		$data 	=	$_POST;
		$ImageError	=	0;	
		if(!empty($_FILES['Photo']['tmp_name']))
		{
			$img	=	$_FILES;
			$img['path']	=	'img/customer';
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

		$result =	$this->m_customer->update($data);

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
			
	        redirect(base_url().'customer');	
		}
		else
		{
			$_SESSION['MsgCode']	   =   'error';
	        $_SESSION['MsgTitle']      =   "Item not update ";
	        $_SESSION['MsgContent']    =   "Please update item again ";
	        $this->edit($_POST['CustomerID']);	
		}
	}

	public function delete()
	{
		$CustomerID 	=	$_POST['id'];
		$result =	$this->m_customer->delete($CustomerID);
		echo $result;
	}
}
