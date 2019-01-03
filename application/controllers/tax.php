<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tax extends CI_Controller 
{


	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->helper("url");
		$this->load->model("m_login");
		$this->load->model("m_tax");
		$this->m_login->check_login();
		$_SESSION['PageActive']		=	"tax";
	}
	

	public function index()
	{
		$this->view_list();		
	}

	public function view_list()
	{
		$data['title']	=	'Tax Rates';
		$data['items']	=	$this->m_tax->view();
		$this->load->view('tax/list',$data);
	}

	public function add()
	{
		if(isset($_POST['TaxName']))
		{
			$result =	$this->m_tax->add($_POST);
			if($result == TRUE)
			{
				$_SESSION['MsgCode']	   =   'success';
	            $_SESSION['MsgTitle']      =   "Item Added ";
	            $_SESSION['MsgContent']    =   "New item added succesfully";
	            redirect(base_url().'tax');	
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
			$data['title']	=	'Tax Rates';
			$data['mode']	=	'add';
			$this->load->view('tax/add',$data);
		}
		
	}
	public function edit($TaxID)
	{
		$data	=	$this->m_tax->view_single($TaxID);
		$data['title']	=	'Tax Rates';
		$data['mode']	=	'update';
		$this->load->view('tax/add',$data);

	}

	public function update()
	{
		$result =	$this->m_tax->update($_POST);
		if($result == TRUE)
		{
			$_SESSION['MsgCode']	   =   'success';
	        $_SESSION['MsgTitle']      =   "Item Updated ";
	        $_SESSION['MsgContent']    =   "Item Update succesfully";
	        redirect(base_url().'tax');	
		}
		else
		{
			$_SESSION['MsgCode']	   =   'error';
	        $_SESSION['MsgTitle']      =   "Item not update ";
	        $_SESSION['MsgContent']    =   "Please update item again ";
	        $this->edit($_POST['TaxID']);	
		}
	}

	public function delete()
	{
		$TaxID 	=	$_POST['id'];
		$result =	$this->m_tax->delete($TaxID);
		echo $result;
	}
}
