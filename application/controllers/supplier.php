<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class supplier extends CI_Controller 
{


	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->helper("url");
		$this->load->model("m_login");
		$this->load->model("m_supplier");
		$this->m_login->check_login();
		$_SESSION['PageActive']		=	"supplier";
	}
	

	public function index()
	{
		$this->view_list();		
	}

	public function view_list()
	{
		$data['title']	=	'Suppliers';
		$data['items']	=	$this->m_supplier->view();
		$this->load->view('supplier/list',$data);
	}

	public function add()
	{
		if(isset($_POST['SupplierName']))
		{
			$data 	=	$_POST;
			$ImageError	=	0;	
			if(!empty($_FILES['Photo']['tmp_name']))
			{
				$img	=	$_FILES;
				$img['path']	=	'img/supplier';
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

			$result =	$this->m_supplier->add($data);
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

	            redirect(base_url().'supplier');	
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
			$data['title']	=	'Supplier';
			$data['mode']	=	'add';
			$this->load->view('supplier/add',$data);
		}
		
	}
	public function edit($SupplierID)
	{
		$data	=	$this->m_supplier->view_single($SupplierID);
		$data['title']	=	'Supllier';
		$data['mode']	=	'update';
		$this->load->view('supplier/add',$data);

	}

	public function update()
	{

		$data 	=	$_POST;
		$ImageError	=	0;	
		if(!empty($_FILES['Photo']['tmp_name']))
		{
			$img	=	$_FILES;
			$img['path']	=	'img/supplier';
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

		$result =	$this->m_supplier->update($data);

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
			
	        redirect(base_url().'supplier');	
		}
		else
		{
			$_SESSION['MsgCode']	   =   'error';
	        $_SESSION['MsgTitle']      =   "Item not update ";
	        $_SESSION['MsgContent']    =   "Please update item again ";
	        $this->edit($_POST['SupplierID']);	
		}
	}

	public function delete()
	{
		$SupplierID 	=	$_POST['id'];
		$result =	$this->m_supplier->delete($SupplierID);
		echo $result;
	}
}
