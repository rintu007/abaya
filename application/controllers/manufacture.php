<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class manufacture extends CI_Controller 
{


	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->helper("url");
		$this->load->model("m_login");
		$this->load->model("m_manufacture");
		$this->m_login->check_login();
		$_SESSION['PageActive']		=	"manufacture";
		//$_SESSION['SubActive']		=	"units";
	}
	

	public function index()
	{
		$this->view_list();		
	}

	public function view_list()
	{
		$data['title']	=	'manufacture';
		$data['items']	=	$this->m_manufacture->view();
		$this->load->view('manufacture/list',$data);
	}

	public function add()
	{
		if(isset($_POST['ManufactureName']))
		{
			$result =	$this->m_manufacture->add($_POST);
			if($result == TRUE)
			{
				$_SESSION['MsgCode']	   =   'success';
	            $_SESSION['MsgTitle']      =   "Item Added ";
	            $_SESSION['MsgContent']    =   "New item added succesfully";
	            redirect(base_url().'manufacture');	
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
			$data['title']	=	'manufacture';
			$data['mode']	=	'add';
			$this->load->view('manufacture/add',$data);
		}
		
	}
	public function edit($ManufactureID)
	{
		$data	=	$this->m_manufacture->view_single($ManufactureID);
		$data['title']	=	'manufacture';
		$data['mode']	=	'update';
		$this->load->view('manufacture/add',$data);

	}

	public function update()
	{
		$result =	$this->m_manufacture->update($_POST);
		if($result == TRUE)
		{
			$_SESSION['MsgCode']	   =   'success';
	        $_SESSION['MsgTitle']      =   "Item Updated ";
	        $_SESSION['MsgContent']    =   "Item Update succesfully";
	        redirect(base_url().'manufacture');	
		}
		else
		{
			$_SESSION['MsgCode']	   =   'error';
	        $_SESSION['MsgTitle']      =   "Item not update ";
	        $_SESSION['MsgContent']    =   "Please update item again ";
	        $this->edit($_POST['ManufactureID']);	
		}
	}

	public function delete()
	{
		$ManufactureID 	=	$_POST['id'];
		$result =	$this->m_manufacture->delete($ManufactureID);
		echo $result;
	}
}
