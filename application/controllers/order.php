<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class order extends CI_Controller 
{


	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->helper("url");
		$this->load->model("m_login");
		$this->load->model("m_order");
		$this->m_login->check_login();
		$_SESSION['PageActive']		=	"order";
		$_SESSION['SubActive']		=	"list_order";
	}
	

	public function index()
	{
		$this->view_list();		
	}


	public function add()
	{
		$_SESSION['SubActive']	=	"add_order";
		$data['title']			=	'Order Form';
		$data['Customers']		=	$this->m_order->view_customers();
		$data['Services']		=	$this->m_order->view_services();
		$this->load->view('order/add',$data);		
	}

	public function view_list()
	{
		$data['title']	=	'Orders';
		$data['items']	=	$this->m_order->view_order();
		$this->load->view('order/list',$data);
	}

	public function completed()
	{
		$_SESSION['SubActive']		=	"complete_order";
		$data['title']	=	'Complete Order';
		$data['items']	=	$this->m_order->view_complete();
		$this->load->view('order/complete',$data);
	}

	public function insert()
	{
		//echo '<pre>';
		//print_r($_POST);exit;
		$result =	$this->m_order->insert($_POST);
		if($result == true)
		{
			$_SESSION['MsgCode']	   =   'success';
		    $_SESSION['MsgTitle']      =   "Item Added ";
		    $_SESSION['MsgContent']    =   "New item added succesfully";
			redirect(base_url().'order');	
		}
		else
		{
			$_SESSION['MsgCode']	   =   'error';
            $_SESSION['MsgTitle']      =   "Item not added ";
            $_SESSION['MsgContent']    =   "Please add item again ";
            $this->add();
		}
	}
	//for edit
	function edit($OrderFormID)
	{
		$data				=	$this->m_order->view_single($OrderFormID);
		$data['Items']		=	$this->m_order->view_order_item($OrderFormID);
		foreach($data['Items'] as $key => $Item)
		{
			$data['Items'][$key]['Designs'] =	$this->m_order->chose_designs($Item['ServiceID']);
		}
		
		$data['Customers']	=	$this->m_order->view_customers();
		$data['Services']	=	$this->m_order->view_services();
		$data['title']	=	'Order';
		$data['mode']	=	'update';
		$this->load->view('order/edit',$data);
	}
	function update()
	{
		//if item deleted when update 
		if(isset($_POST['DeleteOrderItemJson'])&& $_POST['DeleteOrderItemJson'] != 'no')
		{
			$str_json = $_POST['DeleteOrderItemJson'];
			//converting data to array
			$json 		=	json_decode($str_json,true);
			foreach($json as $JSDelete)
			{
				$OrderItemID 	=	$JSDelete['OrderItemID'];
				$this->m_order->delete_item($OrderItemID); 	
			} 
		}
		$result 	=	$this->m_order->update($_POST);
		if($result == TRUE)
		{
			$_SESSION['MsgCode']	   =   'success';
		    $_SESSION['MsgTitle']      =   "Item Updated ";
		    $_SESSION['MsgContent']    =   "Item Update succesfully";
			redirect(base_url().'order');	
		}
		else
		{
			$_SESSION['MsgCode']	   =   'error';
	        $_SESSION['MsgTitle']      =   "Item not update ";
	        $_SESSION['MsgContent']    =   "Please update item again ";
	        $this->edit($_POST['OrderFormID']);	
		}
		
	}
	function service_image($ServiceID = 0)
	{
		if($ServiceID == 0)
		{
			$ServiceID 		=	$_POST['ServiceID'];
		}
		
		$Image 			=	$this->m_order->service_img($ServiceID);
		if(isset($Image['ImageID']) && $Image['ImageID'] != 0 )
		{
			$ImageFile	=	$Image['ImagePath'].'/'.$Image['ImageName'];
			if(file_exists($ImageFile) && $Image['ImageName'] != "")
			{
				echo '<img src="'.base_url().$ImageFile.'" width="100px" height="115px">';
			}
			else
			{
				echo '<img src="'.base_url().'img/noimage.png" width="100px" height="115px">';
			}
		}
		else
		{
			echo '<img src="'.base_url().'img/noimage.png" width="100px" height="115px">';
		}
	}

	function design_image()
	{
		$DesignID 		=	$_POST['DesignID'];
		$ServiceID 		=	$_POST['ServiceID'];
		$Image 			=	$this->m_order->design_img($DesignID);
		//print_r($Image);exit;
		if(isset($Image['ImageID']) && $Image['ImageID'] != 0 )
		{
			$ImageFile	=	$Image['ImagePath'].'/'.$Image['ImageName'];
			if(file_exists($ImageFile) && $Image['ImageName'] != "")
			{
				echo '<img src="'.base_url().$ImageFile.'" width="100px" height="115px">';
			}
			else
			{
				$this->service_image($ServiceID);
			}
		}
		else
		{
			$this->service_image($ServiceID);
		}
	}

	function customer_name()
	{
		$CustomerID 	=	$_POST['CustomerID'];
		echo $this->m_order->view_cutomer_name($CustomerID);
	}

	function chose_design()
	{
		$ServiceID 					=	$_POST['ServiceID'];
		$data['Designs'] 			=	$this->m_order->chose_designs($ServiceID);
		$this->load->view('order/design_ajax',$data);
	}

	function chose_free_item()
	{
		$ServiceID 					=	$_POST['ServiceID'];
		$data['WFServiceName'] 		=	$this->m_order->select_wf_serivce($ServiceID);
		$this->load->view('order/chose_free_ajax',$data);
	}
	function service_price()
	{
		$ServiceID 	=	$_POST['ServiceID'];
		$result		=	$this->m_order->service_price($ServiceID);
		$JsnResult	=	json_encode(array('TaxRate'=>$result["TaxRate"],'ServicePrice'=>$result["ServicePrice"],'TaxMethod'=>$result["TaxMethod"],'ImageID'=>$result["ImageID"]));
		echo $JsnResult;
	}

	function design_price()
	{
		$DesignID 	=	$_POST['DesignID'];
		$result		=	$this->m_order->design_price($DesignID);
		$JsnResult	=	json_encode(array('DesignPrice'=>$result["DesignPrice"],'ImageID'=>$result["ImageID"]));
		echo $JsnResult;
	}
	
	function add_item()
	{
		$data['ItemSl'] 		=	$_POST['ItemNo'];
		$data['Services']		=	$this->m_order->view_services();
		$this->load->view('order/add_item_ajax',$data);	
		
	}

	function delete()
	{
		$OrderFormID 	=	$_POST['id'];
		$result =	$this->m_order->delete($OrderFormID);
		echo $result;
	}


	function view_order_ajax()
	{
		$OrderFormID 	=	$_POST['OrderFormID'];
		$data			=	$this->m_order->view_single($OrderFormID);
		$data['Items']	=	$this->m_order->view_order_item($OrderFormID);
		//print_r($data);exit;
		$this->load->view('order/order_form',$data);
	}

	function order_print()
	{
		$OrderFormID 	=	$_POST['OrderFormID'];
		$data			=	$this->m_order->view_single($OrderFormID);
		$data['Items']	=	$this->m_order->view_order_item($OrderFormID);
		//print_r($data);exit;
		$this->load->view('order/order_print',$data);
	}


	function view_advance()
	{
		$OrderFormID 	=	$_POST['OrderFormID'];
		$data			=	$this->m_order->view_order_customer($OrderFormID);
		$data['Type']	=	'view';
		$data['Payments']	=	$this->m_order->view_payments($OrderFormID);
		$this->load->view('order/view_advance',$data);
	}


	function add_advance()
	{
		$data['OrderFormID'] 	=	$_POST['OrderFormID'];
		$data['CustomerID'] 	=	$_POST['CustomerID'];
		$data['ReferenceNo'] 	=	$_POST['ReferenceNo'];
		$data['CustomerName'] 	=	$this->m_order->view_cutomer_name($_POST['CustomerID']);;
		$data['Type']	=	'add';
		$this->load->view('order/view_advance',$data);
	}

	function insert_advance()
	{
		$OrderFormID 	=	$_POST['OrderFormID'];
		$PaymentDate 	=	$_POST['PaymentDate'];
		$Amount 		=	$_POST['Amount'];

		$data			=	$this->m_order->view_order_customer($OrderFormID);
		$ReferenceNo	=	$data['ReferenceNo'];
		$CustomerID 	=	$data['CustomerID'];
		$this->m_order->insert_advance($OrderFormID,$PaymentDate,$Amount,$ReferenceNo,$CustomerID);

		
		$data['Payments']	=	$this->m_order->view_payments($OrderFormID);
		$data['Type']	=	'view';
		$this->load->view('order/view_advance',$data);
	}


	function delete_advance()
	{
		$PaymentID 	=	$_POST['PaymentID'];
		$result =	$this->m_order->delete_advance($PaymentID);
		echo $result;
	}



	//for add and view advance from order list page
	function view_advance_list()
	{
		$OrderFormID 	=	$_POST['OrderFormID'];
		$data			=	$this->m_order->view_order_customer($OrderFormID);
		$data['Type']	=	'view';
		$data['Payments']	=	$this->m_order->view_payments($OrderFormID);
		$this->load->view('order/view_advance_list',$data);
	}

	function add_advance_list()
	{
		$data['OrderFormID'] 	=	$_POST['OrderFormID'];
		$data['CustomerID'] 	=	$_POST['CustomerID'];
		$data['ReferenceNo'] 	=	$_POST['ReferenceNo'];
		$data['CustomerName'] 	=	$this->m_order->view_cutomer_name($_POST['CustomerID']);;
		$data['Type']	=	'add';
		$this->load->view('order/view_advance_list',$data);
	}

	function insert_advance_list()
	{
		$OrderFormID 	=	$_POST['OrderFormID'];
		$PaymentDate 	=	$_POST['PaymentDate'];
		$Amount 		=	$_POST['Amount'];

		$data			=	$this->m_order->view_order_customer($OrderFormID);
		$ReferenceNo	=	$data['ReferenceNo'];
		$CustomerID 	=	$data['CustomerID'];
		$this->m_order->insert_advance($OrderFormID,$PaymentDate,$Amount,$ReferenceNo,$CustomerID);

		
		$data['Payments']	=	$this->m_order->view_payments($OrderFormID);
		$data['Type']	=	'view';
		$this->load->view('order/view_advance_list',$data);
	}

}
