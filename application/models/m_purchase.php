<?php
	
	class m_purchase extends CI_model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		
		
		function view_suppliers()
		{
			$this->db->select('SupplierID,SupplierName');
			$this->db->from('supplier');
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}

		function view_warehouse()
		{
			$this->db->select('WarehouseID,WarehouseName');
			$this->db->from('warehouse');
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}
		function ProductSelect($ProductID)
		{
			$this->db->select('P.ProductID,P.ProductName,P.ProductCost,P.UseExpireDate,P.ProductCode,U.UnitsName');
			$this->db->from('product P');
			$this->db->join('units U','U.UnitsID = P.UnitsID','left');
			$this->db->where('P.ProductID',$ProductID);
			$query 	=	$this->db->get();
			$result =	$query->row_array();
			return($result);
		}
		function ProductSearch($ItemSearch)
		{
			$this->db->select('P.ProductID,P.ProductName,P.ProductCost,P.UseExpireDate,P.ProductCode,U.UnitsName');
			$this->db->from('product P');
			$this->db->join('units U','U.UnitsID = P.UnitsID','left');
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
			$this->db->select('P.ProductID,P.ProductName,M.Cost,P.UseExpireDate,M.Barcode,U.UnitsName,M.ProductMUID,M.Quantity');
			$this->db->from('product_mu M');
			$this->db->join('product P','P.ProductID = M.ProductID','left');
			$this->db->join('units U','U.UnitsID = M.UnitsID','left');
			$this->db->where('M.Barcode',$ItemSearch);
			$query 	=	$this->db->get();
			$result =	$query->row_array();
			return($result);
		}

		function insert_purchase($data)
		{
			$ReferenceNo 	=	$data['ReferenceNo'];
			$SupplierID 	=	$data['SupplierID'];
			$PurchaseDate 	=	date('y-m-d',strtotime($data['PurchaseDate']));
			$WarehouseID 	=	$data['WarehouseID'];
			$Amount 		=	$data['Amount'];
			$TaxRate 		=	!empty($data['TaxRate'])?$data['TaxRate']:0;
			$TaxAmount 		=	!empty($data['TaxAmount'])?$data['TaxAmount']:0;
			$Discount 		=	!empty($data['Discount'])?$data['Discount']:0;
			$TotalAmount 	=	$data['TotalAmount'];
			$ItemNo 		=	$data['ItemNo'];

			$array 		=	array('ReferenceNo'=>$ReferenceNo,'SupplierID'=>$SupplierID,'PurchaseDate'=>$PurchaseDate,'WarehouseID'=>$WarehouseID,'Amount'=>$Amount,'TaxRate'=>$TaxRate,'TaxAmount'=>$TaxAmount,'Discount'=>$Discount,'TotalAmount'=>$TotalAmount,'ItemNo'=>$ItemNo);
			$result 	=	$this->db->insert('purchase',$array);
			
			$PurchaseID 	=	$this->db->insert_id();
			
			foreach($data['ProductID'] as $row => $value)
			{
				$ProductID		=	$data['ProductID'][$row];
				$UseBatch		=	!empty($data['UseBatch'][$row])?$data['UseBatch'][$row]:'no';
				$BatchNo		=	!empty($data['BatchNo'][$row])?$data['BatchNo'][$row]:'';
				$ExpiryDate		=	!empty($data['ExpiryDate'][$row])?date('Y-m-d',strtotime($data['ExpiryDate'][$row])):NULL;
				$MUStat			=	$data['MUStat'][$row];
				$ProductMUID	=	!empty($data['ProductMUID'][$row])?$data['ProductMUID'][$row]:0;
				$SpBarcode		=	!empty($data['SpBarcode'][$row])?$data['SpBarcode'][$row]:'';
				$ProductCost	=	!empty($data['ProductCost'][$row])?$data['ProductCost'][$row]:0;
				$Quantity		=	$data['Quantity'][$row];
				$Price			=	!empty($data['Price'][$row])?$data['Price'][$row]:0;
				$ItemSl 		=	$data['ItemSl'][$row];
				$MUStat			=	!empty($data['MUStat'][$row])?$data['MUStat'][$row]:'no';
				$ProductBatchID	=	!empty($data['ProductBatchID'][$row])?$data['ProductBatchID'][$row]:0;
				
				//check batch already exist or not				
				if($UseBatch == 'yes')
				{
					$CB 	=	$this->check_batch($ProductID,$BatchNo,$ExpiryDate);
					//checking this product using batch or not 
					if($CB == 'no')
					{
						$ProductBatchID 	=	$this->insert_batch($ProductID,$BatchNo,$ExpiryDate);
					}
					else
					{
						$ProductBatchID 	=	$CB;
					}
					
				}
				//inserting stock in items
				$array_item 	=	array('PurchaseID'=>$PurchaseID,'ProductID'=>$ProductID,'ProductBatchID'=>$ProductBatchID,'ProductMUID'=>$ProductMUID,'ProductCost'=>$ProductCost,'Quantity'=>$Quantity,'Price'=>$Price,'ItemSl'=>$ItemSl,'MUStat'=>$MUStat);
				$this->db->insert('purchase_item',$array_item);
				$PurchaseItemID 	=	$this->db->insert_id();

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
				//Stock insert
				$this->stock_insert($StockQuantity,$ProductID,$ProductBatchID);
				
			}	
			//for payment
/*			if($TotalAmount != 0)
			{
				$payarray 		=	array('Type'=>'given','PaymentTypeID'=>3,'PaymentDate'=>$PurchaseDate,'ReferenceNo'=>$ReferenceNo,'PurchaseID'=>$PurchaseID,'Amount'=>$TotalAmount,'SupplierID'=>$SupplierID);
				$this->db->insert('payment',$payarray);
			}*/
			return($result);
			
		}

		function update_purchase($data)
		{
			$PurchaseID 	=	$data['PurchaseID'];
			$ReferenceNo 	=	$data['ReferenceNo'];
			$SupplierID 	=	$data['SupplierID'];
			$PurchaseDate 	=	date('y-m-d',strtotime($data['PurchaseDate']));
			$WarehouseID 	=	$data['WarehouseID'];
			$Amount 		=	$data['Amount'];
			$TaxRate 		=	!empty($data['TaxRate'])?$data['TaxRate']:0;
			$TaxAmount 		=	!empty($data['TaxAmount'])?$data['TaxAmount']:0;
			$Discount 		=	!empty($data['Discount'])?$data['Discount']:0;
			$TotalAmount 	=	$data['TotalAmount'];
			$ItemNo 		=	$data['ItemNo'];

			$array 		=	array('ReferenceNo'=>$ReferenceNo,'SupplierID'=>$SupplierID,'PurchaseDate'=>$PurchaseDate,'WarehouseID'=>$WarehouseID,'Amount'=>$Amount,'TaxRate'=>$TaxRate,'TaxAmount'=>$TaxAmount,'Discount'=>$Discount,'TotalAmount'=>$TotalAmount,'ItemNo'=>$ItemNo);
			$this->db->where('PurchaseID',$PurchaseID);
			$result 	=	$this->db->update('purchase',$array);

			
			foreach($data['ProductID'] as $row => $value)
			{
				$ProductID		=	$data['ProductID'][$row];
				$UseBatch		=	!empty($data['UseBatch'][$row])?$data['UseBatch'][$row]:'no';
				$BatchNo		=	!empty($data['BatchNo'][$row])?$data['BatchNo'][$row]:'';
				$ExpiryDate		=	!empty($data['ExpiryDate'][$row])?date('Y-m-d',strtotime($data['ExpiryDate'][$row])):NULL;
				$MUStat			=	$data['MUStat'][$row];
				$ProductMUID	=	!empty($data['ProductMUID'][$row])?$data['ProductMUID'][$row]:0;
				$SpBarcode		=	!empty($data['SpBarcode'][$row])?$data['SpBarcode'][$row]:'';
				$ProductCost	=	!empty($data['ProductCost'][$row])?$data['ProductCost'][$row]:0;
				$Quantity		=	$data['Quantity'][$row];
				$Price			=	!empty($data['Price'][$row])?$data['Price'][$row]:0;
				$ItemSl 		=	$data['ItemSl'][$row];
				$MUStat			=	!empty($data['MUStat'][$row])?$data['MUStat'][$row]:'no';
				$ProductBatchID	=	!empty($data['ProductBatchID'][$row])?$data['ProductBatchID'][$row]:0;


				//check batch already exist or not
				
				if($UseBatch == 'yes')
				{
					$CB 	=	$this->check_batch($ProductID,$BatchNo,$ExpiryDate);
					//checking this product using batch or not 
					if($CB == 'no')
					{
						$ProductBatchID 	=	$this->insert_batch($ProductID,$BatchNo,$ExpiryDate);
					}
					else
					{
						$ProductBatchID 	=	$CB;
					}
					
				}
		
				//inserting stock in items
				$array_item 	=	array('PurchaseID'=>$PurchaseID,'ProductID'=>$ProductID,'ProductBatchID'=>$ProductBatchID,'ProductMUID'=>$ProductMUID,'ProductCost'=>$ProductCost,'Quantity'=>$Quantity,'Price'=>$Price,'ItemSl'=>$ItemSl,'MUStat'=>$MUStat);
				$this->db->insert('purchase_item',$array_item);
				$PurchaseItemID 	=	$this->db->insert_id();

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
				//Stock insert
				$this->stock_insert($StockQuantity,$ProductID,$ProductBatchID);
				
			}	
			
/*			$payarray 		=	array('Type'=>'given','PaymentTypeID'=>3,'PaymentDate'=>$PurchaseDate,'ReferenceNo'=>$ReferenceNo,'PurchaseID'=>$PurchaseID,'Amount'=>$TotalAmount,'SupplierID'=>$SupplierID);
			$this->db->where('PurchaseID',$PurchaseID);
			$this->db->where('PaymentTypeID',3);
			$this->db->update('payment',$payarray);*/
			
			return($result);
			
		}

		function check_batch($ProductID,$BatchNo,$ExpiryDate)
		{
			$this->db->select('ProductBatchID');
			$this->db->from('product_batch');
			$this->db->where('ProductID',$ProductID);
			$this->db->where('BatchNo',$BatchNo);
			$this->db->where('ExpiryDate',$ExpiryDate);
			$query 	=	$this->db->get();
			$result =	$query->row_array();
			if(isset($result['ProductBatchID']) && $result['ProductBatchID'] != 0)
			{
				return($result['ProductBatchID']);
			}
			else
			{
				return('no');
			}

		}
		function insert_batch($ProductID,$BatchNo,$ExpiryDate)
		{
			$array 		=	array('ProductID'=>$ProductID,'BatchNo'=>$BatchNo,'ExpiryDate'=>$ExpiryDate);
			$this->db->insert('product_batch',$array);			
			return($this->db->insert_id());
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

		//for deleting
		
		function delete($PurchaseID)
		{
			$this->db->where('PurchaseID',$PurchaseID);
			$this->db->delete('purchase_item');

			$this->db->where('PurchaseID',$PurchaseID);
			$this->db->delete('purchase');
			return(1);
		}
		function purchase_item_delete($PurchaseID)
		{
			$this->db->where('PurchaseID',$PurchaseID);
			$this->db->delete('purchase_item');
		}

		function view()
		{
			$this->db->select('S.PurchaseID,S.ReferenceNo,S.PurchaseDate,S.TotalAmount,A.SupplierName,W.WarehouseName');
			$this->db->from('purchase S');
			$this->db->join('supplier A','A.SupplierID = S.SupplierID','left');
			$this->db->join('warehouse W','W.WarehouseID = S.WarehouseID','left');
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}

		function view_tax()
		{
			$this->db->select('TaxID,TaxName,TaxRate');
			$this->db->from('tax');
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}

		function view_single($PurchaseID)
		{
			$this->db->select('P.PurchaseID,P.ReferenceNo,P.PurchaseDate,P.TotalAmount,P.SupplierID,P.WarehouseID,P.Discount,P.Amount,P.TaxRate,P.TaxAmount,P.ItemNo,S.SupplierName,S.SupplierPhone');
			$this->db->from('purchase P');
			$this->db->join('supplier S','S.SupplierID = P.SupplierID','left');
			$this->db->where('PurchaseID',$PurchaseID);
			$query 	=	$this->db->get();
			$result =	$query->row_array();
			return($result);
		}

		function view_purchase_item($PurchaseID)
		{
			$this->db->select('I.PurchaseItemID,I.ProductID,I.ProductBatchID,I.ProductMUID,I.ProductCost,I.Price,P.ProductCode,P.ProductName,U.UnitsName,I.ItemSl,I.Quantity,I.MUStat');
			$this->db->from('purchase_item I');
			$this->db->join('product P','P.ProductID = I.ProductID');
			$this->db->join('units U','U.UnitsID = P.UnitsID');
			$this->db->where('I.PurchaseID',$PurchaseID);
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}
		function view_purchase_mu($ProductID)
		{
			$this->db->select('M.Barcode,M.Quantity,U.UnitsName');
			$this->db->from('product_mu M');
			$this->db->join('units U','U.UnitsID = M.UnitsID','left');
			$this->db->where('M.ProductID',$ProductID);
			$query =	$this->db->get();
			$result =	$query->row_array();
			return($result);
		}


	}
	
	
?>