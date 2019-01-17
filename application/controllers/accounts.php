<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class accounts extends CI_Controller 
{


	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->helper("url");
		$this->load->model("m_login");
		$this->load->model("m_accounts");
		$this->m_login->check_login();
		$_SESSION['PageActive']		=	"accounts";
		$_SESSION['SubActive']		=	"list_accounts";
	}
	

	public function index()
	{
		$this->view_list();		
	}

	public function view_list()
{
    $data['title']	=	'Accounts';
    $data['items']	=	$this->m_accounts->view();
    $this->load->view('accounts/list',$data);
}

    public function add()
    {
        if(isset($_POST['PaymentAccountName']))
        {
            $result =	$this->m_accounts->add($_POST);
            if($result == TRUE)
            {
                $_SESSION['MsgCode']	   =   'success';
                $_SESSION['MsgTitle']      =   "Item Added ";
                $_SESSION['MsgContent']    =   "New item added succesfully";
                redirect(base_url().'accounts');
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
            $data['title']	=	'Accounts';
            $data['mode']	=	'add';
            $this->load->view('accounts/add',$data);
        }

    }
    public function edit($PaymentAccountID)
    {
        $data	=	$this->m_accounts->view_single($PaymentAccountID);
        $data['title']	=	'Accounts';
        $data['mode']	=	'update';
        $this->load->view('accounts/add',$data);

    }

    public function update()
    {
        $result =	$this->m_accounts->update($_POST);
        if($result == TRUE)
        {
            $_SESSION['MsgCode']	   =   'success';
            $_SESSION['MsgTitle']      =   "Item Updated ";
            $_SESSION['MsgContent']    =   "Item Update succesfully";
            redirect(base_url().'accounts');
        }
        else
        {
            $_SESSION['MsgCode']	   =   'error';
            $_SESSION['MsgTitle']      =   "Item not update ";
            $_SESSION['MsgContent']    =   "Please update item again ";
            $this->edit($_POST['PaymentAccountID']);
        }
    }

    public function transfer_list()
    {
        $_SESSION['SubActive']		=	"transfer";
        $data['title']	=	'Tranfers';
        $data['items']	=	$this->m_accounts->transfer_view();
        $this->load->view('accounts/t_list',$data);
    }

    public function add_transfer()
    {
        $_SESSION['SubActive']		=	"transfer";

        if(isset($_POST['Amount']))
        {
            $result =	$this->m_accounts->add_transfer($_POST);
            if($result == TRUE)
            {
                $_SESSION['MsgCode']	   =   'success';
                $_SESSION['MsgTitle']      =   "Item Added ";
                $_SESSION['MsgContent']    =   "New item added succesfully";
                redirect(base_url().'accounts/transfer_list');
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
            $data['title']	=	'Tranfers';
            $data['mode']	=	'add_transfer';
            $data['Accounts']	=	$this->m_accounts->view();
            $this->load->view('accounts/t_add',$data);
        }

    }
    public function edit_transfer($TransferID)
    {
        $_SESSION['SubActive']		=	"transfer";

        $data	=	$this->m_accounts->transfer_view_single($TransferID);

        $data['Accounts']	=	$this->m_accounts->view();

        $data['title']	=	'Transfer';
        $data['mode']	=	'update_transfer';
        $this->load->view('accounts/t_add',$data);

    }

    public function update_transfer()
    {
        $result =	$this->m_accounts->update_transfer($_POST);
        if($result == TRUE)
        {
            $_SESSION['MsgCode']	   =   'success';
            $_SESSION['MsgTitle']      =   "Item Updated ";
            $_SESSION['MsgContent']    =   "Item Update succesfully";
            redirect(base_url().'accounts/transfer_list');
        }
        else
        {
            $_SESSION['MsgCode']	   =   'error';
            $_SESSION['MsgTitle']      =   "Item not update ";
            $_SESSION['MsgContent']    =   "Please update item again ";
            $this->edit_tranfer($_POST['TransferID']);
        }
    }

	public function delete()
	{
		$PaymentAccountID 	=	$_POST['id'];
		$result =	$this->m_accounts->delete($PaymentAccountID);
		echo $result;
	}

    public function delete_transfer()
    {
        $TransferID 	=	$_POST['id'];
        $result =	$this->m_accounts->delete_transfer($TransferID);
        echo $result;
    }
}
