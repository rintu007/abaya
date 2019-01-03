<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class units extends CI_Controller 
{


	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->helper("url");
		$this->load->model("m_login");
		$this->load->model("m_units");
		$this->m_login->check_login();
		$_SESSION['PageActive']		=	"product";
		$_SESSION['SubActive']		=	"units";
	}
	

	public function index()
	{
		$this->view_list();		
	}

	public function view_list()
	{
		$data['title']	=	'Product Units';
		$data['items']	=	$this->m_units->view();
		$this->load->view('units/list',$data);
	}

	public function add()
	{
		if(isset($_POST['UnitsName']))
		{
			$result =	$this->m_units->add($_POST);
			if($result == TRUE)
			{
				$_SESSION['MsgCode']	   =   'success';
	            $_SESSION['MsgTitle']      =   "Item Added ";
	            $_SESSION['MsgContent']    =   "New item added succesfully";
	            redirect(base_url().'units');	
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
			$data['title']	=	'Product Units';
			$data['mode']	=	'add';
			$this->load->view('units/add',$data);
		}
		
	}
	public function edit($UnitsID)
	{
		$data	=	$this->m_units->view_single($UnitsID);
		$data['title']	=	'Product Units';
		$data['mode']	=	'update';
		$this->load->view('units/add',$data);

	}

	public function update()
	{
		$result =	$this->m_units->update($_POST);
		if($result == TRUE)
		{
			$_SESSION['MsgCode']	   =   'success';
	        $_SESSION['MsgTitle']      =   "Item Updated ";
	        $_SESSION['MsgContent']    =   "Item Update succesfully";
	        redirect(base_url().'units');	
		}
		else
		{
			$_SESSION['MsgCode']	   =   'error';
	        $_SESSION['MsgTitle']      =   "Item not update ";
	        $_SESSION['MsgContent']    =   "Please update item again ";
	        $this->edit($_POST['UnitsID']);	
		}
	}

	public function delete()
	{
		$UnitsID 	=	$_POST['id'];
		$result =	$this->m_units->delete($UnitsID);
		echo $result;
	}
}
