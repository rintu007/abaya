<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class expense extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->helper("url");
		$this->load->model("m_login");
		$this->load->model("m_expense");
		$this->m_login->check_login();
		$_SESSION['PageActive']		=	"expense";
		$_SESSION['SubActive']		=	"list_expense";

		
	}
	

	public function index()
	{
		$this->view_list();		
	}

	public function view_list()
	{
		$data['title']	=	'Expenses';
		$data['items']	=	$this->m_expense->view();

		$this->load->view('expense/list',$data);
	}

	public function add()
	{
		if(isset($_POST['Amount']))
		{

		$result =	$this->m_expense->add($_POST);

			if($result == TRUE)
			{
				$_SESSION['MsgCode']	   =   'success';
                $_SESSION['MsgTitle']      =   "Item Added ";
                $_SESSION['MsgContent']    =   "New item added succesfully";
				
	            redirect(base_url().'expense');
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
			$data['Cats']		=	$this->m_expense->view_expense_category();
			$data['title']		=	'Expense';
			$data['mode']		=	'add';
			//print_r($data['Staff']);exit;
			$this->load->view('expense/add',$data);
		}
		
	}
	public function edit($ExpenseID)
	{
		$data				=	$this->m_expense->view_single($ExpenseID);
        $data['Cats']		=	$this->m_expense->view_expense_category();
		$data['title']	=	'Expense';
		$data['mode']	=	'update';
		$this->load->view('expense/add',$data);

	}

	public function update()
	{
		$result =	$this->m_expense->update($_POST);

		if($result == TRUE)
		{

            $_SESSION['MsgCode']	   =   'success';
            $_SESSION['MsgTitle']      =   "Item Updated ";
            $_SESSION['MsgContent']    =   "Item Update succesfully";

	        redirect(base_url().'expense');
		}
		else
		{
			$_SESSION['MsgCode']	   =   'error';
	        $_SESSION['MsgTitle']      =   "Item not update ";
	        $_SESSION['MsgContent']    =   "Please update item again ";
	        $this->edit($_POST['ExpenseID']);
		}
	}

	public function delete()
	{
        $ExpenseID 	=	$_POST['id'];
		$result =	$this->m_expense->delete($ExpenseID);
		echo $result;
	}


}
