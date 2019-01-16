<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class salary extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->helper("url");
		$this->load->model("m_login");
		$this->load->model("m_salary");
		$this->m_login->check_login();
		$_SESSION['PageActive']		=	"expense";
		$_SESSION['SubActive']		=	"list_salary";


		
	}
	

	public function index()
	{
		$this->view_list();		
	}

	public function view_list()
	{
		$data['title']	=	'Salaries';
		$data['items']	=	$this->m_salary->view();

		$this->load->view('salary/list',$data);
	}

	public function add()
	{
		if(isset($_POST['Amount']))
		{

		$result =	$this->m_salary->add($_POST);

			if($result == TRUE)
			{
				$_SESSION['MsgCode']	   =   'success';
                $_SESSION['MsgTitle']      =   "Item Added ";
                $_SESSION['MsgContent']    =   "New item added succesfully";
				
	            redirect(base_url().'salary');
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

			$data['Staff']		=	$this->m_salary->view_staff();
			$data['title']		=	'Salary';
			$data['mode']		=	'add';
			//print_r($data['Staff']);exit;
			$this->load->view('salary/add',$data);
		}
		
	}
	public function edit($SalaryID)
	{
		$data				=	$this->m_salary->view_single($SalaryID);
        $data['Staff']		=	$this->m_salary->view_staff();
		$data['title']	=	'Salary';
		$data['mode']	=	'update';
		$this->load->view('salary/add',$data);

	}

	public function update()
	{
		$result =	$this->m_salary->update($_POST);

		if($result == TRUE)
		{

            $_SESSION['MsgCode']	   =   'success';
            $_SESSION['MsgTitle']      =   "Item Updated ";
            $_SESSION['MsgContent']    =   "Item Update succesfully";

	        redirect(base_url().'salary');
		}
		else
		{
			$_SESSION['MsgCode']	   =   'error';
	        $_SESSION['MsgTitle']      =   "Item not update ";
	        $_SESSION['MsgContent']    =   "Please update item again ";
	        $this->edit($_POST['SalaryID']);
		}
	}

	public function delete()
	{
        $SalaryID 	=	$_POST['id'];
		$result =	$this->m_salary->delete($SalaryID);
		echo $result;
	}


}
