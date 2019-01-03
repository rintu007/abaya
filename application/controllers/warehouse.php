<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class warehouse extends CI_Controller 
{


	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->helper("url");
		$this->load->model("m_login");
		$this->load->model("m_warehouse");
		$this->m_login->check_login();
		$_SESSION['PageActive']		=	"warehouse";
		//$_SESSION['SubActive']		=	"units";
	}
	

	public function index()
	{
		$this->view_list();		
	}

	public function view_list()
	{
		$data['title']	=	'Warehouse';
		$data['items']	=	$this->m_warehouse->view();
		$this->load->view('warehouse/list',$data);
	}

	public function add()
	{
		if(isset($_POST['WarehouseName']))
		{
			$result =	$this->m_warehouse->add($_POST);
			if($result == TRUE)
			{
				$_SESSION['MsgCode']	   =   'success';
	            $_SESSION['MsgTitle']      =   "Item Added ";
	            $_SESSION['MsgContent']    =   "New item added succesfully";
	            redirect(base_url().'warehouse');	
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
			$data['title']	=	'Warehouse';
			$data['mode']	=	'add';
			$this->load->view('warehouse/add',$data);
		}
		
	}
	public function edit($WarehouseID)
	{
		$data	=	$this->m_warehouse->view_single($WarehouseID);
		$data['title']	=	'warehouse';
		$data['mode']	=	'update';
		$this->load->view('warehouse/add',$data);

	}

	public function update()
	{
		$result =	$this->m_warehouse->update($_POST);
		if($result == TRUE)
		{
			$_SESSION['MsgCode']	   =   'success';
	        $_SESSION['MsgTitle']      =   "Item Updated ";
	        $_SESSION['MsgContent']    =   "Item Update succesfully";
	        redirect(base_url().'warehouse');	
		}
		else
		{
			$_SESSION['MsgCode']	   =   'error';
	        $_SESSION['MsgTitle']      =   "Item not update ";
	        $_SESSION['MsgContent']    =   "Please update item again ";
	        $this->edit($_POST['WarehouseID']);	
		}
	}

	public function delete()
	{
		$WarehouseID 	=	$_POST['id'];
		$result =	$this->m_warehouse->delete($WarehouseID);
		echo $result;
	}
}
