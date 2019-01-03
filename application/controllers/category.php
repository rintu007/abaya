<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class category extends CI_Controller 
{


	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->helper("url");
		$this->load->model("m_login");
		$this->load->model("m_category");
		$this->m_login->check_login();
		$_SESSION['PageActive']		=	"product";
		$_SESSION['SubActive']		=	"category";
	}
	

	public function index()
	{
		$this->view_list();		
	}

	public function view_list()
	{
		$data['title']	=	'Product category';
		$data['items']	=	$this->m_category->view();
		$this->load->view('category/list',$data);
	}

	public function add()
	{
		if(isset($_POST['CategoryName']))
		{
			$result =	$this->m_category->add($_POST);
			if($result == TRUE)
			{
				$_SESSION['MsgCode']	   =   'success';
	            $_SESSION['MsgTitle']      =   "Item Added ";
	            $_SESSION['MsgContent']    =   "New item added succesfully";
	            redirect(base_url().'category');	
			}
			else
			{
				$_SESSION['MsgCode']	   =   'error';
	            $_SESSION['MsgTitle']      =   "Item not added ";
	            $_SESSION['MsgContent']    =   "Please add item again ";
	            //$this->add();	
			}
		}
		else
		{
			$data['title']	=	'Product Category';
			$data['mode']	=	'add';
			$this->load->view('category/add',$data);
		}
		
	}
	public function edit($CategoryID)
	{
		$data	=	$this->m_category->view_single($CategoryID);
		$data['title']	=	'Product Category';
		$data['mode']	=	'update';
		$this->load->view('category/add',$data);

	}

	public function update()
	{
		$result =	$this->m_category->update($_POST);
		if($result == TRUE)
		{
			$_SESSION['MsgCode']	   =   'success';
	        $_SESSION['MsgTitle']      =   "Item Updated ";
	        $_SESSION['MsgContent']    =   "Item Update succesfully";
	        redirect(base_url().'category');	
		}
		else
		{
			$_SESSION['MsgCode']	   =   'error';
	        $_SESSION['MsgTitle']      =   "Item not update ";
	        $_SESSION['MsgContent']    =   "Please update item again ";
	        $this->edit($_POST['CategoryID']);	
		}
	}

	public function delete()
	{
		$CategoryID 	=	$_POST['id'];
		$result =	$this->m_category->delete($CategoryID);
		echo $result;
	}
}
