<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class sale extends CI_Controller 
{


	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->helper("url");
		$this->load->model("m_login");
		$this->load->model("m_sale");
		$this->m_login->check_login();
		$_SESSION['PageActive']		=	"sale";
		$_SESSION['SubActive']		=	"list_sale";

		
	}
	

	function index()
	{
		$this->view_list();		
	}

	function view_list()
	{
		$data['title']	=	'Sales';
		$data['items']	=	$this->m_sale->view();
       // print_r($data['items']);exit;
		$this->load->view('sale/list',$data);
	}

	function add()
	{
		$_SESSION['SubActive']		=	"add_sale";

		$data['Customer']	=	$this->m_sale->view_customer();

        $data['Accounts']	=	$this->m_sale->view_payment_accounts();
        $data['PaymentAccountID']		=	1;

		$data['title']		=	'Sales';
		$data['mode']		=	'add';
		$this->load->view('sale/add',$data);		
	}
	function edit($SaleID)
	{

		$data				=	$this->m_sale->view_single($SaleID);
		$data['Items']		=	$this->m_sale->view_sale_item($SaleID);
		$data['Customer']	=	$this->m_sale->view_customer();
		//echo '<pre>';print_r($data);exit;
		$data['title']	=	'Sale';
		$data['mode']	=	'update';
		$this->load->view('sale/edit',$data);
	}
	function insert()
	{
		//echo '<pre>';print_r($_POST);exit;
		//insert basic stock in details
		$result =	 $this->m_sale->insert_sale($_POST);

		if($result == TRUE)
		{
			$_SESSION['MsgCode']	   =   'success';
	        $_SESSION['MsgTitle']      =   "Item Updated ";
	        $_SESSION['MsgContent']    =   "Item updated succesfully";			
            redirect(base_url().'sale');	
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
		$SaleID 	=	$_POST['SaleID'];
		//echo '<pre>';print_r($_POST);exit;
		//remove stock of all items inside purchase -- if you  are updating delete all items and inserting again
		$ProductItem 	=	$this->m_sale->view_sale_product($SaleID);
		foreach ($ProductItem as $Item) 
		{
			if($Item['MUStat'] == 'yes')
			{
				//fetching normal quantity of product multi unit
				$MUQuantity 	=	$this->m_sale->fetch_MU_quantity($Item['ProductMUID']);
				$StockQuantity 	=	$MUQuantity*$Item['Quantity'];
			}
			else
			{
				$StockQuantity 	=	$Item['Quantity'];
			}
			$this->m_sale->stock_insert($StockQuantity,$Item['ProductID'],$Item['ProductBatchID']);
		}
		//change the status of all order item
		$OrderItem 	=	$this->m_sale->view_sale_order($SaleID);
		foreach ($OrderItem as $Item) 
		{
			$this->m_sale->cancel_sale($Item['OrderItemID']);
		}
		
		//delte all items inside purchase
		$this->m_sale->sale_item_delete($SaleID);

		//update the current one
		$result =	 $this->m_sale->update_sale($_POST);

		if($result == TRUE)
		{
			$_SESSION['MsgCode']	   =   'success';
	        $_SESSION['MsgTitle']      =   "Item Added ";
	        $_SESSION['MsgContent']    =   "New item added succesfully";			
            redirect(base_url().'sale');	
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
		$Product 		=	$this->m_sale->ProductSearch($ItemSearch);
		//print_r($Product);exit;
		if(isset($Product['ProductID']) && $Product['ProductID'] > 0)
		{
			$Result =	array('ProductID'=>$Product['ProductID'],'ProductName'=>$Product['ProductName'],'ProductCode'=>$Product['ProductCode'],'UnitsName'=>$Product['UnitsName'],'UseBatch'=>'no','ProductCost'=>$Product['ProductCost'],
						'ProductMUID'=>0,'MUStat'=>'no','MUQuantity'=>1,'ProductBatchID'=>0,'TaxRate'=>$Product['TaxRate'],'TaxMethod'=>$Product['TaxMethod']);

			if($Product['UseExpireDate'] == 1)
			{
				$Batchs	=	$this->m_sale->list_batch($Product['ProductID']);
				//echo count($Batchs);exit;
				if(!empty($Batchs[0]))
				{
					if(count($Batchs) > 1)
					{
						$Result['UseBatch'] 	=	'yes';
						$Result['Batchs']		=	$Batchs;
					}
					else
					{
						$Result['ProductBatchID']		=	$Batchs[0]['ProductBatchID'];
					}
					
				}
			}
			$Result =	 json_encode($Result);
			echo $Result;exit;

		}
		//check the product code in multi unit
		$MU 		=	$this->m_sale->MUSearch($ItemSearch);
		if(isset($MU['ProductID']) && $MU['ProductID'] > 0)
		{
			$Result =	 json_encode(array('ProductID'=>$MU['ProductID'],'ProductName'=>$MU['ProductName'],'ProductCost'=>$MU['Cost'],'UseExpireDate'=>$MU['UseExpireDate'],'ProductCode'=>$MU['Barcode'],'UnitsName'=>$MU['UnitsName'],
						'ProductMUID'=>$MU['ProductMUID'],'MUStat'=>'yes','MUQuantity'=>$MU['Quantity'],'TaxRate'=>$MU['TaxRate'],'TaxMethod'=>$MU['TaxMethod']));
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
		$Product 		=	$this->m_sale->ProductSelect($ProductID);

		$Result =	 json_encode(array('ProductID'=>$Product['ProductID'],'ProductName'=>$Product['ProductName'],'ProductCost'=>$Product['ProductCost'],'UseExpireDate'=>$Product['UseExpireDate'],'ProductCode'=>$Product['ProductCode'],'UnitsName'=>$Product['UnitsName'],
					'ProductMUID'=>0,'MUStat'=>'no','MUQuantity'=>1,'TaxRate'=>$Product['TaxRate'],'TaxMethod'=>$Product['TaxMethod']));
		echo $Result;exit;
	}

	function search_product_det()
	{
		$ItemSearch 	=	$_POST['ItemSearch'];
		$Search 		=	$this->m_sale->ProductSearchDeep($ItemSearch);
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

	function search_order()
	{
		$CustomerID 	=	$_POST['CustomerID'];
		$Search 		=	$this->m_sale->serarch_order($CustomerID);
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

	function search_advance()
	{
		$CustomerID 	=	$_POST['CustomerID'];
		$Search 		=	$this->m_sale->serarch_advance($CustomerID);
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


    function view_payment()
    {
        $SaleID 	=	$_POST['SaleID'];
        $data			=	$this->m_sale->view_sale_customer($SaleID);
        $data['Type']	=	'view';
        $data['Payments']	=	$this->m_sale->view_payments($SaleID);
        $this->load->view('sale/view_payment',$data);
    }

    //for add and view payment from order list page
    function view_payment_list()
    {
        $SaleID 	=	$_POST['SaleID'];
        $data			=	$this->m_sale->view_sale_customer($SaleID);
        $data['Type']	=	'view';
        $data['Payments']	=	$this->m_sale->view_payments($SaleID);
        $this->load->view('sale/view_payment_list',$data);
    }


    function view_advance(){
        $CustomerID 	=	$_POST['CustomerID'];
        $data['advances'] = $this->m_sale->view_advance($CustomerID);
        $this->load->view('sale/view_advances',$data);

    }


	function view_sale_ajax()
	{
		$SaleID 		=	$_POST['SaleID'];
		$data				=	$this->m_sale->view_single($SaleID);
		$data['Items']		=	$this->m_sale->view_sale_item($SaleID);
		//print_r($data);exit;
		$this->load->view('sale/sale_form',$data);
	}

    function add_payment()
    {
        $data['SaleID'] 	    =	$_POST['SaleID'];
        $data['CustomerID'] 	=	$_POST['CustomerID'];
        $data['ReferenceNo'] 	=	$_POST['ReferenceNo'];
        $data['CustomerName'] 	=	$this->m_sale->view_cutomer_name($_POST['CustomerID']);;
        $data['Type']	=	'add';
        $this->load->view('sale/view_payment',$data);
    }

    function add_payment_list()
    {
        $data['SaleID'] 	    =	$_POST['SaleID'];
        $data['CustomerID'] 	=	$_POST['CustomerID'];
        $data['ReferenceNo'] 	=	$_POST['ReferenceNo'];
        $data['CustomerName'] 	=	$this->m_sale->view_cutomer_name($_POST['CustomerID']);;
        $data['Type']	=	'add';
        $this->load->view('sale/view_payment_list',$data);
    }


    function insert_payment()
    {
        $SaleID 	    =	$_POST['SaleID'];
        $PaymentDate 	=	$_POST['PaymentDate'];
        $Amount 		=	$_POST['Amount'];

        $data			=	$this->m_sale->view_sale_customer($SaleID);
        $ReferenceNo	=	$data['ReferenceNo'];
        $CustomerID 	=	$data['CustomerID'];
        $this->m_sale->insert_payment($SaleID,$PaymentDate,$Amount,$ReferenceNo,$CustomerID);


        $data['Payments']	=	$this->m_sale->view_payments($SaleID);
        $data['Type']	=	'view';
        $this->load->view('sale/view_payment',$data);
    }

    function insert_payment_list()
    {
        $SaleID 	    =	$_POST['SaleID'];
        $PaymentDate 	=	$_POST['PaymentDate'];
        $Amount 		=	$_POST['Amount'];

        $data			=	$this->m_sale->view_sale_customer($SaleID);
        $ReferenceNo	=	$data['ReferenceNo'];
        $CustomerID 	=	$data['CustomerID'];
        $this->m_sale->insert_payment($SaleID,$PaymentDate,$Amount,$ReferenceNo,$CustomerID);


        $data['Payments']	=	$this->m_sale->view_payments($SaleID);
        $data['Type']	=	'view';
        $this->load->view('sale/view_payment_list',$data);
    }


    function delete_payment()
    {
        $PaymentID 	=	$_POST['PaymentID'];
        $result =	$this->m_sale->delete_payment($PaymentID);
        echo $result;
    }

	function delete()
	{
		$SaleID 	=	$_POST['SaleID'];
		//remove stock of all items inside purchase -- if you  are updating delete all items and inserting again
		$ProductItem 	=	$this->m_sale->view_sale_product($SaleID);
		foreach ($ProductItem as $Item) 
		{
			if($Item['MUStat'] == 'yes')
			{
				//fetching normal quantity of product multi unit
				$MUQuantity 	=	$this->m_sale->fetch_MU_quantity($Item['ProductMUID']);
				$StockQuantity 	=	$MUQuantity*$Item['Quantity'];
			}
			else
			{
				$StockQuantity 	=	$Item['Quantity'];
			}
			$this->m_sale->stock_insert($StockQuantity,$Item['ProductID'],$Item['ProductBatchID']);
		}
		//change the status of all order item
		$OrderItem 	=	$this->m_sale->view_sale_order($SaleID);
		foreach ($OrderItem as $Item) 
		{
			$this->m_sale->cancel_sale($Item['OrderItemID']);
		}

		$result =	$this->m_sale->delete($SaleID);
		echo $result;

	}
}
