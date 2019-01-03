<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class purchase extends CI_Controller 
{


	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->helper("url");
		$this->load->model("m_login");
		$this->load->model("m_purchase");
		$this->m_login->check_login();
		$_SESSION['PageActive']		=	"purchase";
		$_SESSION['SubActive']		=	"list_purchase";

		
	}
	

	function index()
	{
		$this->view_list();		
	}

	function view_list()
	{
		$data['title']	=	'Purchase';
		$data['items']	=	$this->m_purchase->view();

		$this->load->view('purchase/list',$data);
	}

	function add()
	{
		$_SESSION['SubActive']		=	"add_purchase";

		$data['Warehouse']	=	$this->m_purchase->view_warehouse();
		$data['Suppliers']	=	$this->m_purchase->view_suppliers();
		$data['Tax']		=	$this->m_purchase->view_tax();
		$data['title']		=	'Purchase';
		$data['mode']		=	'add';
		$this->load->view('purchase/add',$data);		
	}
	function edit($PurchaseID)
	{
		$data				=	$this->m_purchase->view_single($PurchaseID);
		$data['Items']		=	$this->m_purchase->view_purchase_item($PurchaseID);
		$data['Warehouse']	=	$this->m_purchase->view_warehouse();
		$data['Suppliers']	=	$this->m_purchase->view_suppliers();
		$data['Tax']		=	$this->m_purchase->view_tax();

		$data['title']	=	'Purchase';
		$data['mode']	=	'update';
		$this->load->view('purchase/edit',$data);
	}
	function insert()
	{
		//echo '<pre>';print_r($_POST);exit;
		//insert basic stock in details
		$result =	 $this->m_purchase->insert_purchase($_POST);

		if($result == TRUE)
		{
			$_SESSION['MsgCode']	   =   'success';
	        $_SESSION['MsgTitle']      =   "Item Updated ";
	        $_SESSION['MsgContent']    =   "Item updated succesfully";			
            redirect(base_url().'purchase');	
		}
		else
		{
			$_SESSION['MsgCode']	   =   'error';
            $_SESSION['MsgTitle']      =   "Item not added ";
            $_SESSION['MsgContent']    =   "Please add item again ";
            $this->add();	
		}

	}
	function update()
	{
		$PurchaseID 	=	$_POST['PurchaseID'];
		//echo '<pre>';print_r($_POST);exit;
		//remove stock of all items inside purchase -- if you  are updating delete all items and inserting again
		$PUrchaseItems 	=	$this->m_purchase->view_purchase_item($PurchaseID);
		foreach ($PUrchaseItems as $Item) 
		{
			if($Item['MUStat'] == 'yes')
			{
				//fetching normal quantity of product multi unit
				$MUQuantity 	=	$this->m_purchase->fetch_MU_quantity($Item['ProductMUID']);
				$StockQuantity 	=	$MUQuantity*$Item['Quantity'];
			}
			else
			{
				$StockQuantity 	=	$Item['Quantity'];
			}
			$this->m_purchase->stock_delete($StockQuantity,$Item['ProductID'],$Item['ProductBatchID']);
		}
		//delte all items inside purchase
		$this->m_purchase->purchase_item_delete($PurchaseID);

		//update the current one

		$result =	 $this->m_purchase->update_purchase($_POST);

		if($result == TRUE)
		{
			$_SESSION['MsgCode']	   =   'success';
	        $_SESSION['MsgTitle']      =   "Item Added ";
	        $_SESSION['MsgContent']    =   "New item added succesfully";			
            redirect(base_url().'purchase');	
		}
		else
		{
			$_SESSION['MsgCode']	   =   'error';
            $_SESSION['MsgTitle']      =   "Item not added ";
            $_SESSION['MsgContent']    =   "Please add item again ";
            $this->add();	
		}

	}
	function search_product()
	{
		$ItemSearch 	=	$_POST['ItemSearch'];
		//seraching item barcode
		$Product 		=	$this->m_purchase->ProductSearch($ItemSearch);
		//print_r($Product);exit;
		if(isset($Product['ProductID']) && $Product['ProductID'] > 0)
		{
			$Result =	 json_encode(array('ProductID'=>$Product['ProductID'],'ProductName'=>$Product['ProductName'],'ProductCost'=>$Product['ProductCost'],'UseExpireDate'=>$Product['UseExpireDate'],'ProductCode'=>$Product['ProductCode'],'UnitsName'=>$Product['UnitsName'],
						'ProductMUID'=>0,'MUStat'=>'no','MUQuantity'=>1));
			echo $Result;exit;
		}
		//check the product code in multi unit
		$MU 		=	$this->m_purchase->MUSearch($ItemSearch);
		if(isset($MU['ProductID']) && $MU['ProductID'] > 0)
		{
			$Result =	 json_encode(array('ProductID'=>$MU['ProductID'],'ProductName'=>$MU['ProductName'],'ProductCost'=>$MU['Cost'],'UseExpireDate'=>$MU['UseExpireDate'],'ProductCode'=>$MU['Barcode'],'UnitsName'=>$MU['UnitsName'],
						'ProductMUID'=>$MU['ProductMUID'],'MUStat'=>'yes','MUQuantity'=>$MU['Quantity']));
			echo $Result;exit;
		}
		else
		{
			echo 0;		
		}
	}

	function select_product()
	{
		$ProductID 	=	$_POST['ProductID'];
		//seraching item barcode
		$Product 		=	$this->m_purchase->ProductSelect($ProductID);

		$Result =	 json_encode(array('ProductID'=>$Product['ProductID'],'ProductName'=>$Product['ProductName'],'ProductCost'=>$Product['ProductCost'],'UseExpireDate'=>$Product['UseExpireDate'],'ProductCode'=>$Product['ProductCode'],'UnitsName'=>$Product['UnitsName'],
					'ProductMUID'=>0,'MUStat'=>'no','MUQuantity'=>1));
		echo $Result;exit;
	}

	function search_product_det()
	{
		$ItemSearch 	=	$_POST['ItemSearch'];
		$Search 		=	$this->m_purchase->ProductSearchDeep($ItemSearch);
		//print_r($Search);exit;
		if(isset($Search) && sizeof($Search) > 0)
		{
			$Result =	 json_encode($Search);
			echo $Result;exit;
		}
		else
		{
			echo 0;
		}
	}

	function view_purchase_ajax()
	{
		$PurchaseID 		=	$_POST['PurchaseID'];
		$data				=	$this->m_purchase->view_single($PurchaseID);
		$data['Items']		=	$this->m_purchase->view_purchase_item($PurchaseID);
		//print_r($data);exit;
		$this->load->view('purchase/purchase_form',$data);
	}


	function delete()
	{
		$PurchaseID 	=	$_POST['PurchaseID'];
		//remove stock of all items inside purchase -- if you  are updating delete all items and inserting again
		$PUrchaseItems 	=	$this->m_purchase->view_purchase_item($PurchaseID);
		foreach ($PUrchaseItems as $Item) 
		{
			if($Item['MUStat'] == 'yes')
			{
				//fetching normal quantity of product multi unit
				$MUQuantity 	=	$this->m_purchase->fetch_MU_quantity($Item['ProductMUID']);
				$StockQuantity 	=	$MUQuantity*$Item['Quantity'];
			}
			else
			{
				$StockQuantity 	=	$Item['Quantity'];
			}
			$this->m_purchase->stock_delete($StockQuantity,$Item['ProductID'],$Item['ProductBatchID']);
		}

		$result =	$this->m_purchase->delete($PurchaseID);
		echo $result;

	}
}
