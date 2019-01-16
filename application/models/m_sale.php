<?php
	
	class m_sale extends CI_model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}


		function view_customer()
		{
			$this->db->select('CustomerID,CustomerName');
			$this->db->from('customer');
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}

		function list_batch($ProductID)
		{
			$this->db->select('S.ProductBatchID,B.BatchNo,B.ExpiryDate,B.ProductID,S.Quantity');
			$this->db->from('stock S');
			//$this->db->from('product_batch B');
			$this->db->join('product_batch B','B.ProductBatchID = S.ProductBatchID','left');
			$this->db->where('B.ProductID',$ProductID);
			$this->db->where('S.Quantity > 0');
			$this->db->order_by('ExpiryDate','ASC');
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}



		function ProductSelect($ProductID)
		{
			$this->db->select('P.ProductID,P.ProductName,P.ProductCost,P.UseExpireDate,P.ProductCode,U.UnitsName,T.TaxRate,P.TaxMethod');
			$this->db->from('product P');
			$this->db->join('units U','U.UnitsID = P.UnitsID','left');
			$this->db->join('tax T','T.TaxID = P.TaxID','left');
			$this->db->where('P.ProductID',$ProductID);
			$query 	=	$this->db->get();
			$result =	$query->row_array();
			return($result);
		}
		function ProductSearch($ItemSearch)
		{
			$this->db->select('P.ProductID,P.ProductName,P.ProductCost,P.UseExpireDate,P.ProductCode,U.UnitsName,T.TaxRate,P.TaxMethod');
			$this->db->from('product P');
			$this->db->join('units U','U.UnitsID = P.UnitsID','left');
			$this->db->join('tax T','T.TaxID = P.TaxID','left');
			$this->db->where('P.ProductCode',$ItemSearch);
			$query 	=	$this->db->get();
			$result =	$query->row_array();
			return($result);
		}
		//search products in deep
		function ProductSearchDeep($ItemSearch)
		{
			$this->db->select('P.ProductID,P.ProductName,P.ProductCost,P.ProductCode,U.UnitsName');
			$this->db->from('product P');
			$this->db->join('units U','U.UnitsID = P.UnitsID','left');
			$this->db->where('P.ProductName LIKE "%'.$ItemSearch.'%" || P.ProductCode LIKE "%'.$ItemSearch.'%"');
			$this->db->limit(15);
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}
		function MUSearch($ItemSearch)
		{
			$this->db->select('P.ProductID,P.ProductName,M.Cost,P.UseExpireDate,M.Barcode,U.UnitsName,M.ProductMUID,M.Quantity,T.TaxRate,P.TaxMethod');
			$this->db->from('product_mu M');
			$this->db->join('product P','P.ProductID = M.ProductID','left');
			$this->db->join('units U','U.UnitsID = M.UnitsID','left');
			$this->db->join('tax T','T.TaxID = P.TaxID','left');
			$this->db->where('M.Barcode',$ItemSearch);
			$query 	=	$this->db->get();
			$result =	$query->row_array();
			return($result);
		}

		function serarch_order($CustomerID)
		{
			$this->db->select('I.Rate,I.TaxValue,I.Quantity,I.Amount,S.ServiceName,D.DesignName,I.OrderItemID,I.TaxMethod,I.TaxRate,I.BookNo,I.OrderNo,I.OrderFormID');
			$this->db->from('order_item I');
			$this->db->join('order_form O','O.OrderFormID = I.OrderFormID','left');
			$this->db->join('service S','S.ServiceID = I.ServiceID','left');
			$this->db->join('design D','D.DesignID = I.DesignID','left');
			$this->db->where('O.CustomerID',$CustomerID);
			$this->db->where('I.Ready','1');
			$this->db->where('I.Sale','0');			
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}

		function serarch_advance($CustomerID)
		{
			$this->db->select('PaymentID,PaymentDate,Amount,ReferenceNo');
			$this->db->from('payment');
			$this->db->where('PaymentTypeID','1');			
			$this->db->where('CustomerID',$CustomerID);			
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}






		function insert_sale($data)
		{
			$ReferenceNo 	=	$data['ReferenceNo'];
			$CustomerID 	=	$data['CustomerID'];
			$SaleDate 		=	date('y-m-d',strtotime($data['SaleDate']));
			$Total 			=	$data['Total'];
			$TaxAmount 		=	!empty($data['TaxAmount'])?$data['TaxAmount']:0;
			$Discount 		=	!empty($data['Discount'])?$data['Discount']:0;
			$TotalAmount 	=	$data['TotalAmount'];
			$ItemNo 		=	$data['ItemNo'];
            $PaidAmount 	=	!empty($data['PaidAmount'])?$data['PaidAmount']:0;
            $PaymentAccountID	=	$data['PaymentAccountID'];



            $array 		=	array('ReferenceNo'=>$ReferenceNo,'CustomerID'=>$CustomerID,'SaleDate'=>$SaleDate,'Total'=>$Total,'TaxAmount'=>$TaxAmount,'Discount'=>$Discount,'TotalAmount'=>$TotalAmount,'ItemNo'=>$ItemNo);
			$result 	=	$this->db->insert('sale',$array);
			
			$SaleID 	=	$this->db->insert_id();

			//sale item inserting
			foreach($data['ItemSl'] as $row => $value)
			{
				$ItemType		=	$data['ItemType'][$row];
				$ProductID		=	!empty($data['ProductID'][$row])?$data['ProductID'][$row]:0;
				$OrderItemID	=	!empty($data['OrderItemID'][$row])?$data['OrderItemID'][$row]:0;
				$CheckOrderItem	=	!empty($data['CheckOrderItem'][$row])?$data['CheckOrderItem'][$row]:0;
				$ItemSl 		=	$data['ItemSl'][$row];
				$TaxRate 		=	!empty($data['TaxRate'][$row])?$data['TaxRate'][$row]:0;
				$TaxMethod 		=	$data['TaxMethod'][$row];
				$Rate			=	!empty($data['Rate'][$row])?$data['Rate'][$row]:0;
				$Quantity 		=	$data['Quantity'][$row];
				$TaxValue		=	!empty($data['TaxValue'][$row])?$data['TaxValue'][$row]:0;
				$Amount			=	!empty($data['Amount'][$row])?$data['Amount'][$row]:0;
				$MUStat			=	!empty($data['MUStat'][$row])?$data['MUStat'][$row]:'no';
				$ProductMUID	=	!empty($data['ProductMUID'][$row])?$data['ProductMUID'][$row]:0;
                $ProductBatchID	=	!empty($data['ProductBatchID'][$row])?$data['ProductBatchID'][$row]:0;

				//inserting stock in items
				$array_item 	=	array('SaleID'=>$SaleID,'ItemType'=>$ItemType,'ProductID'=>$ProductID,'OrderItemID'=>$OrderItemID,'CheckOrderItem'=>$CheckOrderItem,'ItemSl'=>$ItemSl,'TaxRate'=>$TaxRate,'TaxMethod'=>$TaxMethod,
									'Rate'=>$Rate,'Quantity'=>$Quantity,'TaxValue'=>$TaxValue,'Amount'=>$Amount,'ProductBatchID'=>$ProductBatchID,'ProductMUID'=>$ProductMUID);
				$this->db->insert('sale_item',$array_item);
				$SaleItemID 	=	$this->db->insert_id();

				//Stock delete if type is product
				if($ItemType == 'product')
				{
					//changing stock if it is multi units			
					if($MUStat == 'yes')
					{
						//fetching normal quantity of product multi unit
						$MUQuantity 	=	$this->fetch_MU_quantity($ProductMUID);
						$StockQuantity 	=	$MUQuantity*$Quantity;
					}
					else
					{
						$StockQuantity 	=	$Quantity;
					}
					$this->stock_delete($StockQuantity,$ProductID,$ProductBatchID);
				}	
				else
				{
					//change all order item to sale
					$this->order_sale($OrderItemID,$SaleDate);
				}
			}

            //for payment against sale
            if($PaidAmount != 0)
            {
                $payarray 		=	array('Type'=>'received','PaymentTypeID'=>2,'PaymentDate'=>$SaleDate,'ReferenceNo'=>$ReferenceNo,'SaleID'=>$SaleID,'Amount'=>$PaidAmount,'CustomerID'=>$CustomerID,'PaymentAccountID'=>$PaymentAccountID);
                $this->db->insert('payment',$payarray);
            }

            //update advance amounts to sale amount
            if(!empty($data['PaymentID'])){
                foreach($data['PaymentID'] as $row => $value)
                {
                    $PaymentID = $data['PaymentID'][$row];
                    $payarray 		=	array('PaymentTypeID'=>2,'ReferenceNo'=>$ReferenceNo,'SaleID'=>$SaleID,'OrderFormID'=>'');
                    $this->db->where('PaymentID',$PaymentID);
                    $this->db->update('payment',$payarray);
                }
            }

			return($result);
			
		}

		function update_sale($data)
		{
			$SaleID 		=	$data['SaleID'];
			$ReferenceNo 	=	$data['ReferenceNo'];
			$CustomerID 	=	$data['CustomerID'];
            $OldCustomerID	=	$data['OldCustomerID'];
            $SaleDate 		=	date('y-m-d',strtotime($data['SaleDate']));
			$Total 			=	$data['Total'];
			$TaxAmount 		=	!empty($data['TaxAmount'])?$data['TaxAmount']:0;
			$Discount 		=	!empty($data['Discount'])?$data['Discount']:0;
			$TotalAmount 	=	$data['TotalAmount'];
			$ItemNo 		=	$data['ItemNo'];

			$array 		=	array('ReferenceNo'=>$ReferenceNo,'CustomerID'=>$CustomerID,'SaleDate'=>$SaleDate,'Total'=>$Total,'TaxAmount'=>$TaxAmount,'Discount'=>$Discount,'TotalAmount'=>$TotalAmount,'ItemNo'=>$ItemNo);
			$this->db->where('SaleID',$SaleID);
			$result 	=	$this->db->update('sale',$array);

			
			foreach($data['ItemSl'] as $row => $value)
			{
				$ItemType		=	$data['ItemType'][$row];
				$ProductID		=	!empty($data['ProductID'][$row])?$data['ProductID'][$row]:0;
				$OrderItemID	=	!empty($data['OrderItemID'][$row])?$data['OrderItemID'][$row]:0;
				$CheckOrderItem	=	!empty($data['CheckOrderItem'][$row])?$data['CheckOrderItem'][$row]:0;
				$ItemSl 		=	$data['ItemSl'][$row];
				$TaxRate 		=	!empty($data['TaxRate'][$row])?$data['TaxRate'][$row]:0;
				$TaxMethod 		=	$data['TaxMethod'][$row];
				$Rate			=	!empty($data['Rate'][$row])?$data['Rate'][$row]:0;
				$Quantity 		=	$data['Quantity'][$row];
				$TaxValue		=	!empty($data['TaxValue'][$row])?$data['TaxValue'][$row]:0;
				$Amount			=	!empty($data['Amount'][$row])?$data['Amount'][$row]:0;
				$MUStat			=	!empty($data['MUStat'][$row])?$data['MUStat'][$row]:'no';
				$ProductMUID	=	!empty($data['ProductMUID'][$row])?$data['ProductMUID'][$row]:0;
				$ProductBatchID	=	!empty($data['ProductBatchID'][$row])?$data['ProductBatchID'][$row]:0;

		
				//inserting stock in items
				$array_item 	=	array('SaleID'=>$SaleID,'ItemType'=>$ItemType,'ProductID'=>$ProductID,'OrderItemID'=>$OrderItemID,'CheckOrderItem'=>$CheckOrderItem,'ItemSl'=>$ItemSl,'TaxRate'=>$TaxRate,'TaxMethod'=>$TaxMethod,
									'Rate'=>$Rate,'Quantity'=>$Quantity,'TaxValue'=>$TaxValue,'Amount'=>$Amount,'ProductBatchID'=>$ProductBatchID,'ProductMUID'=>$ProductMUID);
				$this->db->insert('sale_item',$array_item);
				$SaleItemID 	=	$this->db->insert_id();

				//Stock delete if type is product
				if($ItemType == 'product')
				{
					//changing stock if it is multi units			
					if($MUStat == 'yes')
					{
						//fetching normal quantity of product multi unit
						$MUQuantity 	=	$this->fetch_MU_quantity($ProductMUID);
						$StockQuantity 	=	$MUQuantity*$Quantity;
					}
					else
					{
						$StockQuantity 	=	$Quantity;
					}
					$this->stock_delete($StockQuantity,$ProductID,$ProductBatchID);
				}	
				else
				{
					//change all order item to sale
					$this->order_sale($OrderItemID,$SaleDate);
				}
				
			}

            //update advance amounts to sale amount
            if(!empty($data['PaymentID'])){
                foreach($data['PaymentID'] as $row => $value)
                {
                    $PaymentID = $data['PaymentID'][$row];
                    $payarray 		=	array('PaymentTypeID'=>2,'ReferenceNo'=>$ReferenceNo,'SaleID'=>$SaleID,'OrderFormID'=>'');
                    $this->db->where('PaymentID',$PaymentID);
                    $this->db->update('payment',$payarray);
                }
            }

            //if change the customer
            if($CustomerID != $OldCustomerID)
            {
                $this->db->where('SaleID',$SaleID);
                $this->db->update('payment',array("CustomerID"=>$CustomerID));
            }

			return($result);
			
		}

        function view_payment_accounts()
        {
            $this->db->select('PaymentAccountID,PaymentAccountName');
            $this->db->from('payment_account');
            $query 	=	$this->db->get();
            $result =	$query->result_array();
            return($result);
        }


        function order_sale($OrderItemID,$SaleDate)
		{
			$array =	array('Sale'=>'1','SaleDate'=>$SaleDate);
			$this->db->where('OrderItemID',$OrderItemID);
			$this->db->update('order_item',$array);
			$this->order_form_sale($OrderItemID,'sale',$SaleDate);
		}
		function cancel_sale($OrderItemID)
		{
			$array =	array('Sale'=>'0','SaleDate'=>NULL);
			$this->db->where('OrderItemID',$OrderItemID);
			$this->db->update('order_item',$array);
			$this->order_form_sale($OrderItemID,'cancel');
		}

		//update the order for assign and complete
		function order_form_sale($OrderItemID,$mode,$date = '')
		{
			$this->db->select('OrderFormID');
			$this->db->from('order_item');
			$this->db->where('OrderItemID',$OrderItemID);
			$query 	=	$this->db->get();
			$result =	$query->row_array();
			$OrderFormID 	=	$result['OrderFormID'];
			if($mode == 'sale')
			{
				//check all item inside the order is ready
				$this->db->select('count(OrderItemID) as Count');
				$this->db->from('order_item');
				$this->db->where('OrderFormID',$OrderFormID);
				$this->db->where('Ready','0');
				$query1 	=	$this->db->get();
				$result1 	=	$query1->row_array();

				if(isset($result1['Count']) && $result1['Count'] > 0)
				{
					$this->db->where('Status !=','Partial Complete');
					$this->db->where('OrderFormID',$OrderFormID);
					$this->db->update('order_form',array("Status"=>"Partial Complete"));
				}
				else
				{
					$this->db->where('OrderFormID',$OrderFormID);
					$this->db->update('order_form',array("Status"=>"Complete","Sale"=>"1","CompleteDate"=>$date));
				}
			}
			else
			{
				//check all item inside the order is ready
				$this->db->select('count(OrderItemID) as Count');
				$this->db->from('order_item');
				$this->db->where('OrderFormID',$OrderFormID);
				$this->db->where('Ready','1');
				$query1 	=	$this->db->get();
				$result1 	=	$query1->row_array();
				if(isset($result1['Count']) && $result1['Count'] > 0)
				{
					$this->db->where('Status !=','Partial Complete');
					$this->db->where('OrderFormID',$OrderFormID);
					$this->db->update('order_form',array("Status"=>"Partial Complete","Sale"=>"0","CompleteDate"=>NULL));
				}
				else
				{
					$this->db->where('OrderFormID',$OrderFormID);
					$this->db->update('order_form',array("Status"=>"Ready","Sale"=>"0","CompleteDate"=>NULL));
				}
			}


		}

		function fetch_MU_quantity($ProductMUID)
		{
			$this->db->select('Quantity');
			$this->db->from('product_mu');
			$this->db->where('ProductMUID',$ProductMUID);
			$query 	=	$this->db->get();
			$result =	$query->row_array();
			return($result['Quantity']);
		}

		function stock_insert($StockQuantity,$ProductID,$ProductBatchID = 0)
		{
			//check this product stock already exist
			$this->db->select('StockID,Quantity');
			$this->db->from('stock');
			$this->db->where('ProductID',$ProductID);
			$this->db->where('ProductBatchID',$ProductBatchID);
			$query	=	$this->db->get();
			$result =	$query->row_array();
			if(isset($result['StockID']) && $result['StockID'] != '')
			{
				$Quantity 		=	$result['Quantity']+$StockQuantity;
				$array 			=	array('Quantity'=>$Quantity);
				$this->db->where('StockID',$result['StockID']);
				$this->db->update('stock',$array);
			}
			else
			{
				$array 			=	array('ProductID'=>$ProductID,'ProductBatchID'=>$ProductBatchID,'Quantity'=>$StockQuantity);
				$this->db->insert('stock',$array);
			}
			
		}

		function stock_delete($StockQuantity,$ProductID,$ProductBatchID = 0)
		{
			//check this product stock already exist
			$this->db->select('StockID,Quantity');
			$this->db->from('stock');
			$this->db->where('ProductID',$ProductID);
			$this->db->where('ProductBatchID',$ProductBatchID);
			$query	=	$this->db->get();
			$result =	$query->row_array();
			if(isset($result['StockID']) && $result['StockID'] != '')
			{
				$Quantity 		=	$result['Quantity'] - $StockQuantity;
				$array 			=	array('Quantity'=>$Quantity);
				$this->db->where('StockID',$result['StockID']);
				$this->db->update('stock',$array);
			}
			else
			{
				$StockQuantity 	=	0-$StockQuantity;
				$array 			=	array('ProductID'=>$ProductID,'ProductBatchID'=>$ProductBatchID,'Quantity'=>$StockQuantity);
				$this->db->insert('stock',$array);
			}
			
		}


        function view_sale_customer($SaleID)
        {
            $this->db->select('O.SaleID,O.ReferenceNo,C.CustomerName,C.CustomerPhone,C.CustomerID,O.TotalAmount');
            $this->db->from('sale O');
            $this->db->join('customer C','C.CustomerID = O.CustomerID','left');
            $this->db->where('O.SaleID',$SaleID);
            $query 	=	$this->db->get();
            $result =	$query->row_array();
            return($result);
        }

        function view_payments($SaleID)
        {
            $this->db->select('P.PaymentDate,P.Amount,P.PaymentID,P.SaleID,A.PaymentAccountName');
            $this->db->from('payment P');
            $this->db->join('payment_account A','A.PaymentAccountID = P.PaymentAccountID','left');
            $this->db->where('SaleID',$SaleID);
            $this->db->where('PaymentTypeID','2');
            $query =	$this->db->get();
            $result =	$query->result_array();
            return($result);
        }


        //for deleting

        function delete_payment($PaymentID)
        {
            $this->db->where('PaymentID',$PaymentID);
            $result = $this->db->delete('payment');
            return($result);
        }
		
		function delete($SaleID)
		{
		    //deleting payments
            $this->db->where('SaleID',$SaleID);
            $this->db->delete('payment');

			$this->db->where('SaleID',$SaleID);
			$this->db->delete('sale_item');

			$this->db->where('SaleID',$SaleID);
			$this->db->delete('sale');

			return(1);
		}
		function sale_item_delete($SaleID)
		{
			$this->db->where('SaleID',$SaleID);
			$this->db->delete('sale_item');
		}

		function view()
		{
			$this->db->select('S.SaleID,S.ReferenceNo,S.SaleDate,S.TotalAmount,A.CustomerName,SUM(P.Amount) as PaidAmount');
			$this->db->from('sale S');
			$this->db->join('customer A','A.CustomerID = S.CustomerID','left');
            $this->db->join('payment P','S.SaleID = P.SaleID','left');
            $this->db->group_by('S.SaleID');
            $query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}


		function view_single($SaleID)
		{
			$this->db->select('P.SaleID,P.ReferenceNo,P.SaleDate,P.TotalAmount,P.CustomerID,P.Discount,P.Total,P.TaxAmount,P.ItemNo,S.CustomerName,S.CustomerPhone,sum(A.Amount) as PaidAmount');
			$this->db->from('sale P');
            $this->db->join('customer S','S.CustomerID = P.CustomerID','left');
            $this->db->join('payment A','A.SaleID = P.SaleID','left');
           // $this->db->where('A.PaymentTypeID',2);
            $this->db->where('P.SaleID',$SaleID);
			$query 	=	$this->db->get();
			$result =	$query->row_array();
			return($result);
		}

		function view_sale_item($SaleID)
		{
			$this->db->select('I.SaleItemID,I.ProductID,I.ProductBatchID,I.ProductMUID,I.Rate,I.Amount,I.ItemSl,I.Quantity,I.MUStat,I.ItemType,I.OrderItemID,I.TaxRate,I.TaxMethod,I.TaxValue,I.CheckOrderItem');
			$this->db->from('sale_item I');
			$this->db->where('I.SaleID',$SaleID);
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}
		function view_sale_product($SaleID)
		{
			$this->db->select('I.ProductID,I.ProductBatchID,I.ProductMUID,I.Quantity,I.MUStat');
			$this->db->from('sale_item I');
			$this->db->join('product P','P.ProductID = I.ProductID');
			$this->db->join('units U','U.UnitsID = P.UnitsID');
			$this->db->where('I.SaleID',$SaleID);
			$this->db->where('I.ItemType','product');
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}
		function view_sale_order($SaleID)
		{
			$this->db->select('I.OrderItemID');
			$this->db->from('sale_item I');
			$this->db->where('I.SaleID',$SaleID);
			$this->db->where('I.ItemType','order');
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}
		function view_sale_mu_item($ProductID)
		{
			$this->db->select('M.Barcode,M.Quantity,U.UnitsName,P.ProductName,P.ProductCode');
			$this->db->from('product_mu M');
			$this->db->join('units U','U.UnitsID = M.UnitsID','left');
			$this->db->join('product P','P.ProductID = M.ProductID','left');
			$this->db->where('M.ProductID',$ProductID);
			$query =	$this->db->get();
			$result =	$query->row_array();
			return($result);
		}
		function view_sale_product_item($ProductID)
		{
			$this->db->select('U.UnitsName,P.ProductName,P.ProductCode');
			$this->db->from('product P');
			$this->db->join('units U','U.UnitsID = P.UnitsID','left');
			$this->db->where('P.ProductID',$ProductID);
			$query =	$this->db->get();
			$result =	$query->row_array();
			return($result);
		}
		function view_sale_order_item($OrderItemID)
		{
			$this->db->select('I.OrderItemID,I.OrderNo,S.ServiceName,D.DesignName');
			$this->db->from('order_item I');
			$this->db->join('service S','S.ServiceID = I.ServiceID','left');
			$this->db->join('design D','D.DesignID = I.DesignID','left');
			$this->db->where('I.OrderItemID',$OrderItemID);
			$query 	=	$this->db->get();
			$result =	$query->row_array();
			return($result);
		}

		function view_advance($CustomerID){
            $this->db->select('PaymentDate,Amount,PaymentID,ReferenceNo,OrderFormID');
            $this->db->from('payment');
            $this->db->where('CustomerID',$CustomerID);
            $this->db->where('PaymentTypeID','1');
            $query =	$this->db->get();
            $result =	$query->result_array();
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

        function insert_payment($SaleID,$PaymentDate,$Amount,$ReferenceNo,$CustomerID,$PaymentAccountID)
        {
            $payarray 		=	array('Type'=>'received','PaymentTypeID'=>2,'PaymentDate'=>$PaymentDate,'ReferenceNo'=>$ReferenceNo,'SaleID'=>$SaleID,'Amount'=>$Amount,'CustomerID'=>$CustomerID,'PaymentAccountID'=>$PaymentAccountID);
            $this->db->insert('payment',$payarray);
        }


	}
	
	
?>