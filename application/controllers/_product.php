<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class product extends CI_Controller 
{


	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->helper("url");
		$this->load->model("m_login");
		$this->load->model("m_product");
		$this->m_login->check_login();
		$_SESSION['PageActive']		=	"product";
		$_SESSION['SubActive']		=	"list_product";

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
		$data['title']	=	'Product';
		$data['items']	=	$this->m_product->view();

		$this->load->view('product/'.$_SESSION["PageView"],$data);
	}

	public function add()
	{
		if(isset($_POST['ProductName']))
		{

			$data 	=	$_POST;
			$ImageError	=	0;	
			if(!empty($_FILES['Photo']['tmp_name']))
			{
				$img	=	$_FILES;
				$img['path']	=	'img/product';
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

			$result =	$this->m_product->add($data);

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
				
	            redirect(base_url().'product');	
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
			$_SESSION['SubActive']		=	"add_product";

			$data['Category']	=	$this->m_product->view_category();
			$data['Tax']		=	$this->m_product->view_tax();
			$data['title']		=	'Product';
			$data['mode']		=	'add';
			$this->load->view('product/add',$data);
		}
		
	}
	public function edit($ProductID)
	{
		$data				=	$this->m_product->view_single($ProductID);
		$data['Category']	=	$this->m_product->view_category();
		$data['Tax']		=	$this->m_product->view_tax();
		$data['title']	=	'Product';
		$data['mode']	=	'update';
		$this->load->view('product/add',$data);

	}

	public function update()
	{
		//print_r($_POST);exit;
		$data 	=	$_POST;
		$ImageError	=	0;	
		if(!empty($_FILES['Photo']['tmp_name']))
		{
			$img	=	$_FILES;
			$img['path']	=	'img/product';
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

		$result =	$this->m_product->update($data);

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

	        redirect(base_url().'product');	
		}
		else
		{
			$_SESSION['MsgCode']	   =   'error';
	        $_SESSION['MsgTitle']      =   "Item not update ";
	        $_SESSION['MsgContent']    =   "Please update item again ";
	        $this->edit($_POST['ProductID']);	
		}
	}

	public function delete()
	{
		$ProductID 	=	$_POST['id'];
		$result =	$this->m_product->delete($ProductID);
		echo $result;
	}
}
