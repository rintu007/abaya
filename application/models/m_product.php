<?php
	
	class m_product extends CI_model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		
		
		
		//for adding management details
		public function add($data)
		{
			
			$ProductCode	=	$data['ProductCode'];
			$ProductName	=	$data['ProductName'];
			$CategoryID		=	$data['CategoryID'];
			$UnitsID		=	$data['UnitsID'];
			$ProductCost	=	!empty($data['ProductCost'])?$data['ProductCost']:0;
			$ProductPrice	=	!empty($data['ProductPrice'])?$data['ProductPrice']:0;
			$ImageID		=	!empty($data['ImageID'])?$data['ImageID']:'';
			$UseExpireDate	=	(isset($data['UseExpireDate']) && $data['UseExpireDate'] == 1)?'1':'0';
			$TaxID			=	$data['TaxID'];
			$TaxMethod		=	$data['TaxMethod'];

			$ReferenceNo	=	!empty($data['ReferenceNo'])?$data['ReferenceNo']:'';
			$ReOrderLevel	=	!empty($data['ReOrderLevel'])?$data['ReOrderLevel']:0;
			$ManufactureID	=	!empty($data['ManufactureID'])?$data['ManufactureID']:0;
		
			
			$array		=	array('ProductCode'=>$ProductCode,'ProductName'=>$ProductName,'CategoryID'=>$CategoryID,'UnitsID'=>$UnitsID,'ProductCost'=>$ProductCost,'ProductPrice'=>$ProductPrice,'ImageID'=>$ImageID,
							'UseExpireDate'=>$UseExpireDate,'ReferenceNo'=>$ReferenceNo,'ReOrderLevel'=>$ReOrderLevel,'ManufactureID'=>$ManufactureID,'TaxID'=>$TaxID,'TaxMethod'=>$TaxMethod);
			$result 	=	$this->db->insert('product',$array);
			
			return($result);
		}
		//for update management details
		public function update($data)
		{
			$ProductID		=	$data['ProductID'];
			$ProductCode	=	$data['ProductCode'];
			$ProductName	=	$data['ProductName'];
			$CategoryID		=	$data['CategoryID'];
			$UnitsID		=	$data['UnitsID'];
			$ProductCost	=	!empty($data['ProductCost'])?$data['ProductCost']:0;
			$ProductPrice	=	!empty($data['ProductPrice'])?$data['ProductPrice']:0;
			$ImageID		=	!empty($data['ImageID'])?$data['ImageID']:'';
			$ProductActive	=	(isset($data['ProductActive']) && $data['ProductActive'] == 1)?'1':'0';
			$UseExpireDate	=	(isset($data['UseExpireDate']) && $data['UseExpireDate'] == 1)?'1':'0';
			$TaxID			=	$data['TaxID'];
			$TaxMethod		=	$data['TaxMethod'];

			$ReferenceNo	=	!empty($data['ReferenceNo'])?$data['ReferenceNo']:'';
			$ReOrderLevel	=	!empty($data['ReOrderLevel'])?$data['ReOrderLevel']:0;
			$ManufactureID	=	!empty($data['ManufactureID'])?$data['ManufactureID']:0;
			
			$array		=	array('ProductCode'=>$ProductCode,'ProductName'=>$ProductName,'CategoryID'=>$CategoryID,'UnitsID'=>$UnitsID,'ProductCost'=>$ProductCost,'ProductPrice'=>$ProductPrice,'ImageID'=>$ImageID,
							'ProductActive'=>$ProductActive,'UseExpireDate'=>$UseExpireDate,'ReferenceNo'=>$ReferenceNo,'ReOrderLevel'=>$ReOrderLevel,'ManufactureID'=>$ManufactureID,'TaxID'=>$TaxID,'TaxMethod'=>$TaxMethod);
			$this->db->where('ProductID',$ProductID);
			$result		=	$this->db->update('product',$array);
			return($result);
		}
		
		public function view()
		{
			$this->db->select('P.ProductID,P.ProductName,P.ProductCost,P.ProductPrice,P.ProductCode,P.ProductActive,C.CategoryName,I.ImagePath,I.ImageName,P.ImageID');
			$this->db->from('product P');
			$this->db->join('category C','C.CategoryID = P.CategoryID','left');
			$this->db->join('units U','U.UnitsID = P.UnitsID','left');
			$this->db->join('image I','I.ImageID = P.ImageID','left');
			$this->db->order_by('ProductID','DESC');
			$query	=	$this->db->get();
			$result	=	$query->result_array();
			return($result);
		}
		public function delete($ProductID)
		{

			$this->db->select('ImageID,ProductID');
			$this->db->from('product');
			$this->db->where('ProductID',$ProductID);
			$query	=	$this->db->get();
			$result	=	$query->row_array();
			$ImageID	=	(isset($result['ImageID']))?$result['ImageID']:0;
			
			$this->db->select('ImageID,ImageName,ImagePath');
			$this->db->from('image');
			$this->db->where('ImageID',$ImageID);
			$query1	=	$this->db->get();
			$image	=	$query1->row_array();
			//print_r($image);exit;
			//for Image Delete
			if(isset($image['ImageID']))
			{
				$unlink_logo	=	$image['ImagePath'].'/'.$image['ImageName'];
				if(file_exists($unlink_logo) && $image['ImageName'] != "")
				{
					unlink($unlink_logo);
				}
				$this->db->where('ImageID',$image['ImageID']);
				$this->db->delete('image');
			}		
			
			$this->db->where('ProductID',$ProductID);
			$this->db->delete('product_mu');

			$this->db->where('ProductID',$ProductID);
			$this->db->delete('product_batch');

			$this->db->where('ProductID',$ProductID);
			$this->db->delete('stock');
			
			
			$this->db->where('ProductID',$ProductID);
			$this->db->delete('product');
			return(1);			
		}

		public function delete_mu($ProductMUID)
		{	
			$this->db->where('ProductMUID',$ProductMUID);
			$this->db->delete('product_mu');
			return(1);			
		}
		public function view_single($ProductID)
		{
			$this->db->select('P.ProductID,P.ProductName,P.ProductCode,P.CategoryID,P.ProductCost,P.ProductPrice,P.ProductActive,P.ImageID,I.ImageName,I.ImagePath,P.UnitsID,P.UseExpireDate,P.ReferenceNo,P.ReOrderLevel,P.ManufactureID,P.TaxID,P.TaxMethod');
			$this->db->from('product P');
			$this->db->join('image I','I.ImageID = P.ImageID','left');
			$this->db->where('ProductID',$ProductID);
			$query	=	$this->db->get();
			$result	=	$query->row_array();
			return($result);
		}

		public function view_category()
		{
			$this->db->select('CategoryID,CategoryName');
			$this->db->from('category');
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}

		public function view_manufacture()
		{
			$this->db->select('ManufactureID,ManufactureName');
			$this->db->from('manufacture');
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}

		public function view_units()
		{
			$this->db->select('UnitsID,UnitsName');
			$this->db->from('units');
			$this->db->order_by('UnitsID','ASC');
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}
		function add_multi_unit($data)
		{
			$ProductID 	=	$data['ProductID'];
			$Barcode 	=	$data['Barcode'];
			$UnitsID 	=	$data['UnitsID'];
			$Quantity 	=	$data['Quantity'];
			$Cost 		=	!empty($data['Cost'])?$data['Cost']:0;
			$Price 		=	!empty($data['Price'])?$data['Price']:0;
			$array 	 	=	array('ProductID'=>$ProductID,'Barcode'=>$Barcode,'UnitsID'=>$UnitsID,'Quantity'=>$Quantity,'Cost'=>$Cost,'Price'=>$Price);
			$result 	=	$this->db->insert('product_mu',$array);			
			return($this->db->insert_id());

		}
		function multi_unit_unitname($ProductMUID)
		{
			$this->db->select('U.UnitsName');
			$this->db->from('product_mu P');
			$this->db->join('units U','U.UnitsID = P.UnitsID','left');
			$this->db->where('P.ProductMUID',$ProductMUID);
			$query 	=	$this->db->get();
			$result =	$query->row_array();
			return($result['UnitsName']);
		}

		function view_mu($ProductID)
		{
			$this->db->select('P.ProductMUID,P.UnitsID,P.Cost,P.Barcode,P.Price,P.ProductID,U.UnitsName,P.Quantity');
			$this->db->from('product_mu P');
			$this->db->join('units U','U.UnitsID = P.UnitsID','left');
			$this->db->where('P.ProductID',$ProductID);
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}

		public function view_tax()
		{
			$this->db->select('TaxID,TaxName');
			$this->db->from('tax');
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}
		
		
	}
	
	
?>