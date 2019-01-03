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
			$ProductCost	=	!empty($data['ProductCost'])?$data['ProductCost']:0;
			$ProductPrice	=	$data['ProductPrice'];
			$TaxID			=	$data['TaxID'];
			$TaxMethod		=	$data['TaxMethod'];
			$ImageID		=	!empty($data['ImageID'])?$data['ImageID']:'';
		
			
			$array		=	array('ProductCode'=>$ProductCode,'ProductName'=>$ProductName,'CategoryID'=>$CategoryID,'ProductCost'=>$ProductCost,'ProductPrice'=>$ProductPrice,'TaxID'=>$TaxID,'TaxMethod'=>$TaxMethod,'ImageID'=>$ImageID);
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
			$ProductCost	=	!empty($data['ProductCost'])?$data['ProductCost']:0;
			$ProductPrice	=	$data['ProductPrice'];
			$TaxID			=	$data['TaxID'];
			$TaxMethod		=	$data['TaxMethod'];
			$ImageID		=	!empty($data['ImageID'])?$data['ImageID']:'';
			$ProductActive	=	(isset($data['ProductActive']) && $data['ProductActive'] == 1)?'1':'0';
			
			$array		=	array('ProductCode'=>$ProductCode,'ProductName'=>$ProductName,'CategoryID'=>$CategoryID,'ProductCost'=>$ProductCost,'ProductPrice'=>$ProductPrice,'TaxID'=>$TaxID,'TaxMethod'=>$TaxMethod,'ImageID'=>$ImageID,
							'ProductActive'=>$ProductActive);
			$this->db->where('ProductID',$ProductID);
			$result		=	$this->db->update('product',$array);
			return($result);
		}
		
		public function view()
		{
			$this->db->select('P.ProductID,P.ProductName,P.ProductCost,P.ProductPrice,P.ProductCode,P.ProductActive,C.CategoryName,T.TaxName,I.ImagePath,I.ImageName,P.ImageID');
			$this->db->from('product P');
			$this->db->join('category C','C.CategoryID = P.CategoryID','left');
			$this->db->join('tax T','T.TaxID = P.TaxID','left');
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
			$this->db->delete('product');
			return(1);			
		}
		public function view_single($ProductID)
		{
			$this->db->select('P.ProductID,P.ProductName,P.ProductCode,P.CategoryID,P.TaxID,P.TaxMethod,P.ProductCost,P.ProductPrice,P.ProductActive,P.ImageID,I.ImageName,I.ImagePath');
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