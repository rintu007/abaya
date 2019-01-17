<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class report extends CI_Controller 
{


	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->helper("url");
		$this->load->model("m_login");
		$this->load->model("m_report");
		$this->m_login->check_login();
		$_SESSION['PageActive']		=	"reports";
		

		
	}
	

	public function stock_list()
	{
		$_SESSION['SubActive']		=	"stock_list";

		$data['title']	=	'Stock List';
		$data['items']	=	$this->m_report->list_stock();

		$this->load->view('report/stock_list',$data);
	}

	function view_stock_detail()
	{
		$ProductID 				=	$_POST['ProductID'];
		$data['StockItem']		=	$this->m_report->list_stock_item($ProductID);
		$data['StockMU']		=	$this->m_report->list_stock_mu($ProductID);	
		$data['ProductBatch']	=	$this->m_report->list_batch($ProductID);	

		//echo '<pre>';print_r($data);exit;
		$this->load->view('report/stock_detail',$data);
	}

	function trial_balance(){
        $_SESSION['SubActive']		=	"trial_balance";

        $data['CashBalance'] = $this->m_report->view_balance(1);
        $data['BankBalance'] = $this->m_report->view_balance(2);
        $data['PurchaseAmount'] = $this->m_report->payment_type_amount(3,'given');
        $data['SalaryExpense'] = $this->m_report->payment_type_amount(4,'given');
        $data['OtherExpense'] = $this->m_report->payment_type_amount(5,'given');
        $data['EquityWithdraw'] = $this->m_report->payment_type_amount(7,'given');


        $data['EquityCapital'] = $this->m_report->payment_type_amount(6,'received');
        $data['SaleAmount'] = $this->m_report->payment_type_amount(2,'received');
        $data['AdvanceAmount'] = $this->m_report->payment_type_amount(1,'received');

        $data['title']	=	'Tiral balance';
        $this->load->view('report/trial_balance',$data);
    }



}
