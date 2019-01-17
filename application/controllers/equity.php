<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class equity extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->helper("url");
		$this->load->model("m_login");
		$this->load->model("m_equity");
		$this->m_login->check_login();
		$_SESSION['PageActive']		=	"equity";
        $_SESSION['SubActive']		=	"capital";

	}
	


	public function capital()
	{
		$data['title']	=	'Capital Equity ';
		$data['items']	=	$this->m_equity->view('capital');
        $data['Type']   =   'capital';
        $_SESSION['SubActive']		=	"capital";
		$this->load->view('equity/list',$data);
	}

    public function withdraw()
    {
        $data['title']	=	'Withdraws ';
        $data['items']	=	$this->m_equity->view('withdraw');
        $data['Type']   =   'withdraw';
        $_SESSION['SubActive']		=	"withdraw";
        $this->load->view('equity/list',$data);
    }

	public function add_capital()
	{
        $_SESSION['SubActive']		=	"capital";
		if(isset($_POST['Amount']))
		{

		$result =	$this->m_equity->add($_POST);

			if($result == TRUE)
			{
				$_SESSION['MsgCode']	   =   'success';
                $_SESSION['MsgTitle']      =   "Item Added ";
                $_SESSION['MsgContent']    =   "New item added succesfully";


	            redirect(base_url().'equity/capital');
			}
			else
			{
				$_SESSION['MsgCode']	   =   'error';
	            $_SESSION['MsgTitle']      =   "Item not added ";
	            $_SESSION['MsgContent']    =   "Please add item again ";
	            $this->add_capital();
			}
		}
		else
		{

			$data['title']		=	'Equity Capital';
            $data['mode']		=	'add';
            $data['Type']		=	'capital';

            $data['Accounts']	=	$this->m_equity->view_payment_accounts();
            $data['PaymentAccountID']		=	1;

			$this->load->view('equity/add',$data);
		}

	}

    public function add_withdraw()
    {
        $_SESSION['SubActive']		=	"withdraw";
        if(isset($_POST['Amount']))
        {

            $result =	$this->m_equity->add($_POST);

            if($result == TRUE)
            {
                $_SESSION['MsgCode']	   =   'success';
                $_SESSION['MsgTitle']      =   "Item Added ";
                $_SESSION['MsgContent']    =   "New item added succesfully";


                redirect(base_url().'equity/withdraw');
            }
            else
            {
                $_SESSION['MsgCode']	   =   'error';
                $_SESSION['MsgTitle']      =   "Item not added ";
                $_SESSION['MsgContent']    =   "Please add item again ";
                $this->add_withdraw();
            }
        }
        else
        {
            $data['title']		=	'Equity withdraw';
            $data['mode']		=	'add';
            $data['Type']		=	'withdraw';

            $data['Accounts']	=	$this->m_equity->view_payment_accounts();
            $data['PaymentAccountID']		=	1;

            $this->load->view('equity/add',$data);
        }

    }

	public function edit($EquityID)
	{
		$data				=	$this->m_equity->view_single($EquityID);
		$data['title']	=	'Equity';
		$data['mode']	=	'update';
        $data['Accounts']	=	$this->m_equity->view_payment_accounts();
		$this->load->view('equity/add',$data);

	}

	public function update()
	{
		$result =	$this->m_equity->update($_POST);

		if($result == TRUE)
		{

            $_SESSION['MsgCode']	   =   'success';
            $_SESSION['MsgTitle']      =   "Item Updated ";
            $_SESSION['MsgContent']    =   "Item Update succesfully";
            $_SESSION['SubActive']		=	$_POST['Type'];

            redirect(base_url().'equity/'.$_POST['Type']);
		}
		else
		{
			$_SESSION['MsgCode']	   =   'error';
	        $_SESSION['MsgTitle']      =   "Item not update ";
	        $_SESSION['MsgContent']    =   "Please update item again ";
	        $this->edit($_POST['EquityID']);
		}
	}

	public function delete()
	{
        $EquityID 	=	$_POST['id'];
		$result =	$this->m_equity->delete($EquityID);
		echo $result;
	}


}
