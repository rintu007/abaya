<?php
	
	class m_report extends CI_model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		
		
		

		public function list_stock()
		{
			$this->db->select('SUM(S.Quantity) as Stock,P.ProductID,P.ProductName,P.ProductCost,P.ProductPrice,P.ProductCode,P.ProductActive,C.CategoryName');
			$this->db->from('stock S');
			$this->db->join('product P','P.ProductID = S.ProductID','left');
			$this->db->join('category C','C.CategoryID = P.CategoryID','left');
			$this->db->join('units U','U.UnitsID = P.UnitsID','left');
			$this->db->order_by('S.Quantity','DESC');
			$this->db->group_by('S.ProductID'); 
			$query	=	$this->db->get();
			$result	=	$query->result_array();
			return($result);
		}

		function list_stock_item($ProductID)
		{
			$this->db->select('SUM(S.Quantity) as Stock,P.ProductID,P.ProductName,U.UnitsName');
			$this->db->from('stock S');
			$this->db->join('product P','P.ProductID = S.ProductID','left');
			$this->db->join('category C','C.CategoryID = P.CategoryID','left');
			$this->db->join('units U','U.UnitsID = P.UnitsID','left');
			$this->db->order_by('S.Quantity','DESC');
			$this->db->where('S.ProductID',$ProductID); 
			$query	=	$this->db->get();
			$result	=	$query->row_array();
			return($result);
		}
		
		function list_stock_mu($ProductID)
		{
			$this->db->select('SUM(S.Quantity) as Stock,U.UnitsName,M.Quantity');
			$this->db->from('product_mu M');
			$this->db->join('stock S','S.ProductID = M.ProductID','left');
			$this->db->join('product P','P.ProductID = S.ProductID','left');
			$this->db->join('units U','U.UnitsID = M.UnitsID','left');
			$this->db->where('M.ProductID',$ProductID);
			$this->db->group_by('M.UnitsID'); 
			$query	=	$this->db->get();
			$result	=	$query->result_array();
			return($result);
		}

		function list_batch($ProductID)
		{
			$this->db->select('S.ProductBatchID,B.BatchNo,B.ExpiryDate,B.ProductID');
			$this->db->from('stock S');
			//$this->db->from('product_batch B');
			$this->db->join('product_batch B','B.ProductBatchID = S.ProductBatchID','left');
			$this->db->where('B.ProductID',$ProductID);
			$this->db->where('S.Quantity != 0');
			$this->db->order_by('ExpiryDate','ASC');
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}
		function list_stock_item_pb($ProductID,$ProductBatchID)
		{
			$this->db->select('SUM(S.Quantity) as Stock,P.ProductID,P.ProductName,U.UnitsName');
			$this->db->from('stock S');
			$this->db->join('product P','P.ProductID = S.ProductID','left');
			$this->db->join('category C','C.CategoryID = P.CategoryID','left');
			$this->db->join('units U','U.UnitsID = P.UnitsID','left');
			$this->db->order_by('S.Quantity','DESC');
			$this->db->where('S.ProductID',$ProductID); 
			$this->db->where('S.ProductBatchID',$ProductBatchID); 
			$query	=	$this->db->get();
			$result	=	$query->row_array();
			return($result);
		}
		function list_stock_mu_pb($ProductID,$ProductBatchID)
		{
			$this->db->select('SUM(S.Quantity) as Stock,U.UnitsName,M.Quantity');
			$this->db->from('product_mu M');
			$this->db->join('stock S','S.ProductID = M.ProductID','left');
			$this->db->join('product P','P.ProductID = S.ProductID','left');
			$this->db->join('units U','U.UnitsID = M.UnitsID','left');
			$this->db->where('M.ProductID',$ProductID);
			$this->db->where('S.ProductBatchID',$ProductBatchID);
			$this->db->group_by('M.UnitsID'); 
			$query	=	$this->db->get();
			$result	=	$query->result_array();
			return($result);
		}

        function view_balance($PaymentAccountID){
            $this->db->select('sum(Amount) as Total');
            $this->db->from('payment');
            $this->db->where('PaymentAccountID',$PaymentAccountID);
            $this->db->where('Type','received');
            $this->db->group_by('PaymentAccountID');
            $query = $this->db->get();
            $rec    = $query->row_array();

            $this->db->select('sum(Amount) as Total');
            $this->db->from('payment');
            $this->db->where('PaymentAccountID',$PaymentAccountID);
            $this->db->where('Type','given');
            $this->db->group_by('PaymentAccountID');
            $query2 = $this->db->get();
            $giv    = $query2->row_array();


            return($rec['Total']-$giv['Total']);
        }

        function payment_type_amount($PaymentTypeID,$type){
            $this->db->select('sum(Amount) as Total');
            $this->db->from('payment');
            $this->db->where('PaymentTypeID',$PaymentTypeID);
            $this->db->where('Type',$type);
            $this->db->group_by('PaymentTypeID');
            $query = $this->db->get();
            $rec    = $query->row_array();
            return($rec['Total']);
        }
		
	}
	
	
?>