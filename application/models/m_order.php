<?php
	
	class m_order extends CI_model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		
		
		
		//for adding management details
		public function insert($data)
		{

			$ReferenceNo	=	$data['ReferenceNo'];
			$CustomerID		=	$data['CustomerID'];
			$OrderDate 		=	date('Y-m-d',strtotime($data['OrderDate']));
			$DeliveryDate	=	!empty($data['DeliveryDate'])?date('Y-m-d',strtotime($data['DeliveryDate'])):NULL;
			$Type 			=	!empty($data['Type'])?$data['Type']:'';
			$Discount		=	!empty($data['Discount'])?$data['Discount']:0;
			$TotalTax		=	!empty($data['TotalTax'])?$data['TotalTax']:0;
			$TotalWD		=	!empty($data['TotalWD'])?$data['TotalWD']:0;
			$TotalAmount	=	!empty($data['TotalAmount'])?$data['TotalAmount']:0;
			$ItemNo			=	!empty($data['ItemNo'])?$data['ItemNo']:0;
			$ItemCount		=	!empty($data['ItemCount'])?$data['ItemCount']:0;
			$AdvanceAmount	=	!empty($data['AdvanceAmount'])?$data['AdvanceAmount']:0;

	
			$array			=	array('ReferenceNo'=>$ReferenceNo,'CustomerID'=>$CustomerID,'OrderDate'=>$OrderDate,'DeliveryDate'=>$DeliveryDate,'Type'=>$Type,'Discount'=>$Discount,'TotalTax'=>$TotalTax,'TotalWD'=>$TotalWD,
								'TotalAmount'=>$TotalAmount,'ItemNo'=>$ItemNo,'ItemCount'=>$ItemCount);
			$result 		=	$this->db->insert('order_form',$array);
			if($result == true)
			{
				$OrderFormID 	=	$this->db->insert_id();
				foreach($data['ItemName'] as $row => $value)
				{
					$OrderNo 		=	$data['OrderNo'][$row];
					$BookNo 		=	!empty($data['BookNo'][$row])?$data['BookNo'][$row]:0;					
					$ItemName		=	$data['ItemName'][$row];
					$ItemSl			=	$data['ItemSl'][$row];
					$ServiceID		=	$data['ServiceID'][$row];
					$DesignID		=	!empty($data['DesignID'][$row])?$data['DesignID'][$row]:'';
					$WFQuantity 	=	!empty($data['WFQuantity'][$row])?$data['WFQuantity'][$row]:0;
					$ImageID		=	!empty($data['ImageID'][$row])?$data['ImageID'][$row]:'';
					$TaxRate		=	!empty($data['TaxRate'][$row])?$data['TaxRate'][$row]:0;
					$TaxMethod		=	!empty($data['TaxMethod'][$row])?$data['TaxMethod'][$row]:'';
					$Rate			=	!empty($data['Rate'][$row])?$data['Rate'][$row]:'';
					$Quantity		=	!empty($data['Quantity'][$row])?$data['Quantity'][$row]:'';
					$TaxValue		=	!empty($data['TaxValue'][$row])?$data['TaxValue'][$row]:'';
					$Amount			=	!empty($data['Amount'][$row])?$data['Amount'][$row]:'';
					$LEN			=	!empty($data['LEN'][$row])?$data['LEN'][$row]:NULL;
					$CHE			=	!empty($data['CHE'][$row])?$data['CHE'][$row]:NULL;
					$WE				=	!empty($data['WE'][$row])?$data['WE'][$row]:NULL;
					$HIP			=	!empty($data['HIP'][$row])?$data['HIP'][$row]:NULL;
					$SLEE			=	!empty($data['SLEE'][$row])?$data['SLEE'][$row]:NULL;
					$RIGA			=	!empty($data['RIGA'][$row])?$data['RIGA'][$row]:NULL;
					$FAR			=	!empty($data['FAR'][$row])?$data['FAR'][$row]:NULL;
					$BOX			=	!empty($data['BOX'][$row])?$data['BOX'][$row]:NULL;
					$NOR			=	!empty($data['NOR'][$row])?$data['NOR'][$row]:NULL;
					$BOT			=	!empty($data['BOT'][$row])?$data['BOT'][$row]:NULL;
					$NECK			=	!empty($data['NECK'][$row])?$data['NECK'][$row]:NULL;
					$items			=	array('OrderFormID'=>$OrderFormID,'OrderNo'=>$OrderNo,'BookNo'=>$BookNo,'ItemName'=>$ItemName,'ItemSl'=>$ItemSl,'ServiceID'=>$ServiceID,'DesignID'=>$DesignID,'WFQuantity'=>$WFQuantity,'TaxRate'=>$TaxRate,'TaxMethod'=>$TaxMethod,'Rate'=>$Rate,
										'Quantity'=>$Quantity,'TaxValue'=>$TaxValue,'Amount'=>$Amount,'LEN'=>$LEN,'CHE'=>$CHE,'WE'=>$WE,'HIP'=>$HIP,'SLEE'=>$SLEE,'RIGA'=>$RIGA,'FAR'=>$FAR,'BOX'=>$BOX,'NOR'=>$NOR,'BOT'=>$BOT,'NECK'=>$NECK,'ImageID'=>$ImageID);
					$this->db->insert('order_item',$items);
				}
				//for payment
				if($AdvanceAmount != 0)
				{
					$payarray 		=	array('Type'=>'received','PaymentTypeID'=>1,'PaymentDate'=>$OrderDate,'ReferenceNo'=>$ReferenceNo,'OrderFormID'=>$OrderFormID,'Amount'=>$AdvanceAmount,'CustomerID'=>$CustomerID);
					$this->db->insert('payment',$payarray);
				}

				return($result);

			}
			else
			{
				return($result);
			}
			
			
		}

		public function update($data)
		{

			$OrderFormID	=	$data['OrderFormID'];
			$ReferenceNo 	=	$data['ReferenceNo'];
			$CustomerID		=	$data['CustomerID'];
			$OldCustomerID	=	$data['OldCustomerID'];
			$OrderDate 		=	date('Y-m-d',strtotime($data['OrderDate']));
			$DeliveryDate	=	!empty($data['DeliveryDate'])?date('Y-m-d',strtotime($data['DeliveryDate'])):NULL;
			$Type 			=	!empty($data['Type'])?$data['Type']:'';
			$Discount		=	!empty($data['Discount'])?$data['Discount']:0;
			$TotalTax		=	!empty($data['TotalTax'])?$data['TotalTax']:0;
			$TotalWD		=	!empty($data['TotalWD'])?$data['TotalWD']:0;
			$TotalAmount	=	!empty($data['TotalAmount'])?$data['TotalAmount']:0;
			$ItemNo			=	!empty($data['ItemNo'])?$data['ItemNo']:0;
			$ItemCount		=	!empty($data['ItemCount'])?$data['ItemCount']:0;

	
			$array			=	array('ReferenceNo'=>$ReferenceNo,'CustomerID'=>$CustomerID,'OrderDate'=>$OrderDate,'DeliveryDate'=>$DeliveryDate,'Type'=>$Type,'Discount'=>$Discount,'TotalTax'=>$TotalTax,'TotalWD'=>$TotalWD,
								'TotalAmount'=>$TotalAmount,'ItemNo'=>$ItemNo,'ItemCount'=>$ItemCount);
			$this->db->where('OrderFormID',$OrderFormID);
			$result 		=	$this->db->update('order_form',$array);
			if($result == true)
			{
				foreach($data['ItemName'] as $row => $value)
				{	
					$OrderNo 		=	$data['OrderNo'][$row];
					$BookNo 		=	!empty($data['BookNo'][$row])?$data['BookNo'][$row]:0;						
					$ItemName		=	$data['ItemName'][$row];
					$ItemSl			=	$data['ItemSl'][$row];
					$ServiceID		=	$data['ServiceID'][$row];
					$DesignID		=	!empty($data['DesignID'][$row])?$data['DesignID'][$row]:'';
					$WFQuantity 	=	!empty($data['WFQuantity'][$row])?$data['WFQuantity'][$row]:0;
					$ImageID		=	!empty($data['ImageID'][$row])?$data['ImageID'][$row]:'';
					$TaxRate		=	!empty($data['TaxRate'][$row])?$data['TaxRate'][$row]:0;
					$TaxMethod		=	!empty($data['TaxMethod'][$row])?$data['TaxMethod'][$row]:'';
					$Rate			=	!empty($data['Rate'][$row])?$data['Rate'][$row]:'';
					$Quantity		=	!empty($data['Quantity'][$row])?$data['Quantity'][$row]:'';
					$TaxValue		=	!empty($data['TaxValue'][$row])?$data['TaxValue'][$row]:'';
					$Amount			=	!empty($data['Amount'][$row])?$data['Amount'][$row]:'';
					$LEN			=	!empty($data['LEN'][$row])?$data['LEN'][$row]:NULL;
					$CHE			=	!empty($data['CHE'][$row])?$data['CHE'][$row]:NULL;
					$WE				=	!empty($data['WE'][$row])?$data['WE'][$row]:NULL;
					$HIP			=	!empty($data['HIP'][$row])?$data['HIP'][$row]:NULL;
					$SLEE			=	!empty($data['SLEE'][$row])?$data['SLEE'][$row]:NULL;
					$RIGA			=	!empty($data['RIGA'][$row])?$data['RIGA'][$row]:NULL;
					$FAR			=	!empty($data['FAR'][$row])?$data['FAR'][$row]:NULL;
					$BOX			=	!empty($data['BOX'][$row])?$data['BOX'][$row]:NULL;
					$NOR			=	!empty($data['NOR'][$row])?$data['NOR'][$row]:NULL;
					$BOT			=	!empty($data['BOT'][$row])?$data['BOT'][$row]:NULL;
					$NECK			=	!empty($data['NECK'][$row])?$data['NECK'][$row]:NULL;
					$items			=	array('OrderFormID'=>$OrderFormID,'OrderNo'=>$OrderNo,'BookNo'=>$BookNo,'ItemName'=>$ItemName,'ItemSl'=>$ItemSl,'ServiceID'=>$ServiceID,'DesignID'=>$DesignID,'WFQuantity'=>$WFQuantity,'TaxRate'=>$TaxRate,'TaxMethod'=>$TaxMethod,'Rate'=>$Rate,
										'Quantity'=>$Quantity,'TaxValue'=>$TaxValue,'Amount'=>$Amount,'LEN'=>$LEN,'CHE'=>$CHE,'WE'=>$WE,'HIP'=>$HIP,'SLEE'=>$SLEE,'RIGA'=>$RIGA,'FAR'=>$FAR,'BOX'=>$BOX,'NOR'=>$NOR,'BOT'=>$BOT,'NECK'=>$NECK,'ImageID'=>$ImageID);
					if(isset($data['ItemMode'][$row]) && $data['ItemMode'][$row] == 'update')
					{
						$OrderItemID		=	$data['OrderItemID'][$row];
						$this->db->where('OrderItemID',$OrderItemID);
						$this->db->update('order_item',$items);
					}
					else
					{
						$this->db->insert('order_item',$items);
					}
					
				}

				//if change the customer
				if($CustomerID != $OldCustomerID)
				{
					$this->db->where('OrderFormID',$OrderFormID);
					$this->db->update('payment',array("CustomerID"=>$CustomerID));
				}

				
				
				return($result);

			}
			else
			{
				return($result);
			}
			
			
		}

		function view_order()
		{
			$this->db->select('O.OrderFormID,O.ReferenceNo,O.OrderDate,O.DeliveryDate,O.Type,O.TotalAmount,O.ItemCount,C.CustomerName,C.CustomerPhone,O.Status');
			$this->db->from('order_form O');
			$this->db->join('customer C','C.CustomerID = O.CustomerID','left');
			$this->db->where('O.OrderFormActive','1');
			$this->db->where('O.Sale','0');
			$this->db->order_by('OrderFormID','desc');
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}

		function view_complete()
		{
			$this->db->select('O.OrderFormID,O.ReferenceNo,O.OrderDate,O.DeliveryDate,O.Type,O.TotalAmount,O.ItemCount,C.CustomerName,C.CustomerPhone,O.Status');
			$this->db->from('order_form O');
			$this->db->join('customer C','C.CustomerID = O.CustomerID','left');
			//$this->db->join('payment P','P.OrderFormID = O.OrderFormID','left');
			//$this->db->where('O.OrderFormActive','0');
			$this->db->where('O.Sale','1');
			$this->db->order_by('O.OrderFormID','desc');
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}


		function view_single($OrderFormID)
		{
			$this->db->select('O.OrderFormID,O.ReferenceNo,O.OrderDate,O.TotalAmount,O.ItemCount,C.CustomerName,C.CustomerPhone,O.Discount,O.TotalTax,O.ItemNo,O.TotalWD,O.CustomerID,O.DeliveryDate,O.Type,sum(Amount) as AdvanceAmount');
			$this->db->from('order_form O');
			$this->db->join('customer C','C.CustomerID = O.CustomerID','left');
			$this->db->join('payment P','P.OrderFormID = O.OrderFormID','left');
			$this->db->where('O.OrderFormID',$OrderFormID);
			$query 	=	$this->db->get();
			$result =	$query->row_array();
			return($result);
		}
		function view_order_item($OrderFormID)
		{
			$this->db->select('I.ItemName,I.Rate,I.TaxValue,I.Quantity,I.Amount,S.ServiceName,D.DesignName,I.ItemSl,I.ServiceID,P.ImageName,P.ImagePath,I.ImageID,I.DesignID,I.LEN,I.CHE,I.WE,I.HIP,I.SLEE,I.RIGA,I.FAR,I.BOX,
							I.NOR,I.BOT,I.NECK,I.OrderItemID,I.TaxMethod,I.TaxRate,I.BookNo,I.OrderNo,I.WFQuantity,W.ServiceName as WFServiceName');
			$this->db->from('order_item I');
			$this->db->join('service S','S.ServiceID = I.ServiceID','left');
			$this->db->join('service W','W.ServiceID = S.WFServiceID','left');
			$this->db->join('design D','D.DesignID = I.DesignID','left');
			$this->db->join('image P','P.ImageID = I.ImageID','left');
			$this->db->where('I.OrderFormID',$OrderFormID);
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}

		public function view_customers()
		{
			$this->db->select('CustomerID,CustomerName,CustomerPhone');
			$this->db->from('customer');
			$this->db->where('CustomerActive','1');
			$this->db->order_by('CustomerName','ASC');
			$query	=	$this->db->get();
			$result	=	$query->result_array();
			return($result);
		}

		public function view_services()
		{
			$this->db->select('ServiceID,ServiceName');
			$this->db->from('service');
			$this->db->where('ServiceActive','1');
			$this->db->order_by('ServiceName','ASC');
			$query	=	$this->db->get();
			$result	=	$query->result_array();
			return($result);
		}
		public function service_img($ServiceID)
		{
			$this->db->select('S.ImageID,I.ImageName,I.ImagePath');
			$this->db->from('service S');
			$this->db->join('image I','I.ImageiD = S.ImageID','left');
			$this->db->where('S.ServiceID',$ServiceID);
			$query	=	$this->db->get();
			$result	=	$query->row_array();
			return($result);
		}

		public function design_img($DesignID)
		{
			$this->db->select('D.ImageID,I.ImageName,I.ImagePath');
			$this->db->from('design D');
			$this->db->join('image I','I.ImageiD = D.ImageID','left');
			$this->db->where('D.DesignID',$DesignID);
			$query	=	$this->db->get();
			$result	=	$query->row_array();
			return($result);
		}
		public function chose_designs($ServiceID)
		{
			$this->db->select('DesignID,DesignName');
			$this->db->from('design');
			$this->db->where('ServiceID',$ServiceID);
			$this->db->order_by('DesignName','ASC');
			$query	=	$this->db->get();
			$result	=	$query->result_array();
			return($result);
		}

		function service_price($ServiceID)
		{
			$this->db->select('S.ServicePrice,T.TaxRate,S.TaxMethod,S.ImageID');
			$this->db->from('service S');
			$this->db->join('tax T','T.TaxID = S.TaxID','left');
			$this->db->where('S.ServiceID',$ServiceID);
			$query	=	$this->db->get();
			$result	=	$query->row_array();
			return($result);
		}

		function design_price($DesignID)
		{
			$this->db->select('DesignPrice,ImageID');
			$this->db->from('design');
			$this->db->where('DesignID',$DesignID);
			$query	=	$this->db->get();
			$result	=	$query->row_array();
			return($result);
		}
	
		
		public function delete($OrderFormID)
		{
			$this->db->select('OrderItemID');
			$this->db->from('order_item');
			$this->db->where('OrderFormID',$OrderFormID);
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			foreach($result as $res)
			{
				$this->db->where('OrderItemID',$res['OrderItemID']);
				$this->db->delete('order_assign');
			}
	
			$this->db->where('OrderFormID',$OrderFormID);
			$this->db->delete('order_item');	

			//delete payment
			$this->db->where('OrderFormID',$OrderFormID);
			$this->db->delete('payment');
			
			$this->db->where('OrderFormID',$OrderFormID);
			$this->db->delete('order_form');
			return(1);			
		}

		function delete_item($OrderItemID)
		{	
			$this->db->where('OrderItemID',$OrderItemID);
			$this->db->delete('order_assign');

			$this->db->where('OrderItemID',$OrderItemID);
			$this->db->delete('order_item');	
		}


		

		function select_wf_serivce($ServiceID)
		{
			$this->db->select('B.ServiceName');
			$this->db->from('service A');
			$this->db->join('service B','B.ServiceID = A.WFServiceID','left');
			$this->db->where('A.ServiceID',$ServiceID);
			$query 	=	$this->db->get();
			$result =	$query->row_array();
			if(isset($result['ServiceName']) && $result['ServiceName'] != '')
			{
				return($result['ServiceName']);
			}
			else
			{
				return('no');
			}
			
		}


		function view_order_customer($OrderFormID)
		{
			$this->db->select('O.OrderFormID,O.ReferenceNo,C.CustomerName,C.CustomerPhone,C.CustomerID,O.ReferenceNo,O.TotalAmount');
			$this->db->from('order_form O');
			$this->db->join('customer C','C.CustomerID = O.CustomerID','left');
			$this->db->where('O.OrderFormID',$OrderFormID);
			$query 	=	$this->db->get();
			$result =	$query->row_array();
			return($result);
		}

		function view_payments($OrderFormID)
		{
			$this->db->select('PaymentDate,Amount,PaymentID');
			$this->db->from('payment');
			$this->db->where('OrderFormID',$OrderFormID);
			$this->db->where('PaymentTypeID','1');
			$query =	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}

		function insert_advance($OrderFormID,$PaymentDate,$Amount,$ReferenceNo,$CustomerID)
		{
			$payarray 		=	array('Type'=>'received','PaymentTypeID'=>1,'PaymentDate'=>$PaymentDate,'ReferenceNo'=>$ReferenceNo,'OrderFormID'=>$OrderFormID,'Amount'=>$Amount,'CustomerID'=>$CustomerID);
			$this->db->insert('payment',$payarray);
		}

		function delete_advance($PaymentID)
		{
			$this->db->where('PaymentID',$PaymentID);
			$result = $this->db->delete('payment');
			return($result);
		}

		function view_cutomer_name($CustomerID)
		{
			$this->db->select('CustomerName');
			$this->db->from('customer');
			$this->db->where('CustomerID',$CustomerID);
			$query =	$this->db->get();
			$result =	$query->row_array();
			return($result['CustomerName']);
		}

		
	}
	
	
?>