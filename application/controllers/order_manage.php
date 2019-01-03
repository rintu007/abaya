<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class order_manage extends CI_Controller 
{


	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->helper("url");
		$this->load->model("m_login");
		$this->load->model("m_order_manage");
		$this->m_login->check_login();
		$_SESSION['PageActive']		=	"order_manage";
		$_SESSION['SubActive']		=	"list_order_manage";
	}
	

	public function index()
	{
		$this->view_list();		
	}




	public function view_list()
	{
		$data['title']	=	'Orders Manage';
		$data['items']	=	$this->m_order_manage->view_item();
		$this->load->view('order_manage/list',$data);
	}


	function view_assign()
	{
		$OrderItemID 		=	$_POST['OrderItemID'];
		$data				=	$this->m_order_manage->view_single_item($OrderItemID);
		$data['mode'] 		=	'add';		
		$data['Tailors']	=	$this->m_order_manage->view_tailors();
		//print_r($data['Tailors']);exit;
		$this->load->view('order_manage/view_assign',$data);
	}
	function change_assign()
	{
		$OrderItemID 		=	$_POST['OrderItemID'];
		$data				=	$this->m_order_manage->view_single_item($OrderItemID);
		$data['mode'] 		=	'edit';		
		$data['StaffID'] 	=	$_POST['StaffID'];			
		$data['Tailors']	=	$this->m_order_manage->view_tailors();
		//print_r($data['Tailors']);exit;
		$this->load->view('order_manage/view_assign',$data);
	}

	function do_assign($OrderItemID,$StaffID,$mode)
	{	
		if($mode == 'edit')
		{
			$result 	=	$this->m_order_manage->update_assign($OrderItemID,$StaffID);
		}
		else
		{
			$result 	=	$this->m_order_manage->do_assign($OrderItemID,$StaffID);
		}
		
		if($result == TRUE)
		{
			$_SESSION['MsgCode']	   =   'success';
		    $_SESSION['MsgTitle']      =   "Assigned ";
		    $_SESSION['MsgContent']    =   "Order Assigned to tailor succesfully";
			redirect(base_url().'order_manage/stiching');	
		}
		else
		{
			$_SESSION['MsgCode']	   =   'error';
	        $_SESSION['MsgTitle']      =   "Item not update ";
	        $_SESSION['MsgContent']    =   "Please update item again ";
	        redirect(base_url().'order_manage');
		}
	}
	function stiching()
	{
		$_SESSION['SubActive']	=	"stiching_order";
		$data['title']	=	'Stiching';
		$data['items']	=	$this->m_order_manage->view_stiching();
		$this->load->view('order_manage/stiching',$data);
	}

	function make_ready($OrderItemID)
	{
		$result 	=	$this->m_order_manage->make_ready($OrderItemID);
		if($result == TRUE)
		{
			$_SESSION['MsgCode']	   =   'success';
		    $_SESSION['MsgTitle']      =   "Stiching complete";
		    $_SESSION['MsgContent']    =   "Order now Ready to deliver";
			redirect(base_url().'order_manage/ready');	
		}
		else
		{
			$_SESSION['MsgCode']	   =   'error';
	        $_SESSION['MsgTitle']      =   "Item not update ";
	        $_SESSION['MsgContent']    =   "Please update item again ";
	        redirect(base_url().'order_manage');
		}
		
	}

	function ready()
	{
		$_SESSION['SubActive']	=	"ready_order";
		$data['title']	=	'Ready To Deliver';
		$data['items']	=	$this->m_order_manage->view_ready();
		$this->load->view('order_manage/ready',$data);
	}

	function make_deliver($OrderItemID)
	{
		$result 	=	$this->m_order_manage->make_deliver($OrderItemID);
		if($result == TRUE)
		{
			$_SESSION['MsgCode']	   =   'success';
		    $_SESSION['MsgTitle']      =   "Stiching complete";
		    $_SESSION['MsgContent']    =   "Order now Ready to deliver";
			redirect(base_url().'order_manage/ready');	
		}
		else
		{
			$_SESSION['MsgCode']	   =   'error';
	        $_SESSION['MsgTitle']      =   "Item not update ";
	        $_SESSION['MsgContent']    =   "Please update item again ";
	        redirect(base_url().'order_manage');
		}
		
	}

	function completed()
	{
		$_SESSION['SubActive']	=	"delivered_order";
		$data['title']	=	'Completed';
		$data['items']	=	$this->m_order_manage->view_copleted();
		$this->load->view('order_manage/completed',$data);
	}

}
