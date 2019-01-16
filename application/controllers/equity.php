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
		$_SESSION['PageActive']		=	"expense";
		$_SESSION['SubActive']		=	"list_expense";

		
	}
	


	public function capital()
	{
		$data['title']	=	'Capital Equity ';
		$data['items']	=	$this->m_equity->view('capital');
        $data['type']   =   'capital';
		$this->load->view('equity/list',$data);
	}

    public function withdraw()
    {
        $data['title']	=	'Withdraws ';
        $data['items']	=	$this->m_equity->view('withdraw');
        $data['type']   =   'withdraw';
        $this->load->view('equity/list',$data);
    }

	public function add_capital()
	{
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
            $data['type']		=	'capital';
			//print_r($data['Staff']);exit;
			$this->load->view('equity/add',$data);
		}

	}

    public function add_withdraw()
    {
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
            $data['type']		=	'withdraw';
            //print_r($data['Staff']);exit;
            $this->load->view('equity/add',$data);
        }

    }

	public function edit($EquityID)
	{
		$data				=	$this->m_equity->view_single($EquityID);
		$data['title']	=	'Equity';
		$data['mode']	=	'update';
		$this->load->view('expense/add',$data);

	}

	public function update()
	{
		$result =	$this->m_equity->update($_POST);

		if($result == TRUE)
		{

            $_SESSION['MsgCode']	   =   'success';
            $_SESSION['MsgTitle']      =   "Item Updated ";
            $_SESSION['MsgContent']    =   "Item Update succesfully";

	        redirect(base_url().'equity/'.$_POST['type']);
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
