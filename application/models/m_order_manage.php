<?php
	
	class m_order_manage extends CI_model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		
		
		
		
		function view_item()
		{
			$this->db->select('I.ItemName,I.Quantity,S.ServiceName,D.DesignName,P.ImageName,P.ImagePath,I.ImageID,C.CustomerName,I.OrderNo,I.OrderItemID,O.OrderFormID,C.CustomerPhone');
			$this->db->from('order_item I');
			$this->db->join('order_form O','O.OrderFormID = I.OrderFormID','left');
			$this->db->join('customer C','C.CustomerID = O.CustomerID','left');
			$this->db->join('service S','S.ServiceID = I.ServiceID','left');
			$this->db->join('design D','D.DesignID = I.DesignID','left');
			$this->db->join('image P','P.ImageID = I.ImageID','left');
			$this->db->where('I.Status','new');
			$this->db->order_by('I.OrderItemID','desc');
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}


		function view_single_item($OrderItemID)
		{
			$this->db->select('I.ItemName,I.Quantity,S.ServiceName,D.DesignName,P.ImageName,P.ImagePath,C.CustomerName,I.OrderNo,I.OrderItemID,O.OrderFormID,C.CustomerPhone,I.Quantity');
			$this->db->from('order_item I');
			$this->db->join('order_form O','O.OrderFormID = I.OrderFormID','left');
			$this->db->join('customer C','C.CustomerID = O.CustomerID','left');
			$this->db->join('service S','S.ServiceID = I.ServiceID','left');
			$this->db->join('design D','D.DesignID = I.DesignID','left');
			$this->db->join('image P','P.ImageID = I.ImageID','left');
			$this->db->where('I.OrderItemID',$OrderItemID);
			$query 	=	$this->db->get();
			$result =	$query->row_array();
			return($result);
		}



		function view_stiching()
		{
			$this->db->select('I.ItemName,I.Quantity,S.ServiceName,D.DesignName,P.ImageName,P.ImagePath,U.ImageID,C.CustomerName,I.OrderNo,I.OrderItemID,O.OrderFormID,C.CustomerPhone,I.AssignDate,U.StaffName,A.StaffID');
			$this->db->from('order_item I');
			$this->db->join('order_assign A','A.OrderItemID = I.OrderItemID','left');
			$this->db->join('staff U','U.StaffID = A.StaffID','left');
			$this->db->join('order_form O','O.OrderFormID = I.OrderFormID','left');
			$this->db->join('customer C','C.CustomerID = O.CustomerID','left');
			$this->db->join('service S','S.ServiceID = I.ServiceID','left');
			$this->db->join('design D','D.DesignID = I.DesignID','left');
			$this->db->join('image P','P.ImageID = U.ImageID','left');
			$this->db->where('I.Status','stitching');
			$this->db->order_by('I.OrderItemID','desc');
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}


		function view_ready()
		{

			$this->db->select('I.ItemName,I.Quantity,S.ServiceName,D.DesignName,P.ImageName,P.ImagePath,U.ImageID,C.CustomerName,I.OrderNo,I.OrderItemID,O.OrderFormID,C.CustomerPhone,I.AssignDate,U.StaffName,A.StaffID,I.ReadyDate,I.Status,I.DeliveredDate');
			$this->db->from('order_item I');
			$this->db->join('order_assign A','A.OrderItemID = I.OrderItemID','left');
			$this->db->join('staff U','U.StaffID = A.StaffID','left');
			$this->db->join('order_form O','O.OrderFormID = I.OrderFormID','left');
			$this->db->join('customer C','C.CustomerID = O.CustomerID','left');
			$this->db->join('service S','S.ServiceID = I.ServiceID','left');
			$this->db->join('design D','D.DesignID = I.DesignID','left');
			$this->db->join('image P','P.ImageID = I.ImageID','left');
			$this->db->where('I.Ready','1');
			$this->db->where('I.Sale','0');
			$this->db->order_by('I.OrderItemID','desc');
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}

		function view_copleted()
		{

			$this->db->select('I.ItemName,I.Quantity,S.ServiceName,D.DesignName,P.ImageName,P.ImagePath,U.ImageID,C.CustomerName,I.OrderNo,I.OrderItemID,O.OrderFormID,C.CustomerPhone,I.AssignDate,U.StaffName,A.StaffID,I.ReadyDate,I.DeliveredDate,I.SaleDate');
			$this->db->from('order_item I');
			$this->db->join('order_assign A','A.OrderItemID = I.OrderItemID','left');
			$this->db->join('staff U','U.StaffID = A.StaffID','left');
			$this->db->join('order_form O','O.OrderFormID = I.OrderFormID','left');
			$this->db->join('customer C','C.CustomerID = O.CustomerID','left');
			$this->db->join('service S','S.ServiceID = I.ServiceID','left');
			$this->db->join('design D','D.DesignID = I.DesignID','left');
			$this->db->join('image P','P.ImageID = I.ImageID','left');
			$this->db->where('I.Sale','1');
			$this->db->order_by('I.OrderItemID','desc');
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}
		

	

		public function view_tailors()
		{
			$this->db->select('S.StaffID,S.StaffID,S.StaffName,I.ImageID,I.ImagePath,I.ImageName');
			$this->db->from('staff S');
			$this->db->join('image I','I.ImageID = S.ImageID','left');
			$this->db->where('S.UserTypeID','5');
			$query	=	$this->db->get();
			$result	=	$query->result_array();
			return($result);
		}
		function do_assign($OrderItemID,$StaffID)
		{
			$OrderAssignDate 	=	date('Y-m-d');	
			$array 				=	array('OrderItemID'=>$OrderItemID,'OrderAssignDate'=>$OrderAssignDate,'StaffID'=>$StaffID,'Status'=>'stitching');
			$result =	$this->db->insert('order_assign',$array);

			$orderArray 	=	array('AssignDate'=>$OrderAssignDate,'Status'=>'stitching');
			$this->db->where('OrderItemID',$OrderItemID);
			$this->db->update('order_item',$orderArray);
			//udate the order form
			$this->update_order($OrderItemID,'stitching');

			return($result);

		}

		function update_assign($OrderItemID,$StaffID)
		{
			$OrderAssignDate 	=	date('Y-m-d');	
			$array 				=	array('OrderAssignDate'=>$OrderAssignDate,'StaffID'=>$StaffID);
			$this->db->where('OrderItemID',$OrderItemID);
			$result =	$this->db->update('order_assign',$array);
			return($result);

		}
		function make_ready($OrderItemID)
		{
			$ReadyDate 		=	date('Y-m-d');	
			$array 			=	array('ReadyDate'=>$ReadyDate,'Status'=>'ready');
			$this->db->where('OrderItemID',$OrderItemID);
			$result =	$this->db->update('order_assign',$array);

			$orderArray 	=	array('ReadyDate'=>$ReadyDate,'Status'=>'ready','Ready'=>'1');
			$this->db->where('OrderItemID',$OrderItemID);
			$this->db->update('order_item',$orderArray);

			//udate the order form
			$this->update_order($OrderItemID,'ready');

			return($result);
		}

		function make_deliver($OrderItemID)
		{
			$DeliveredDate	=	date('Y-m-d');	
			$array 			=	array('DeliveredDate'=>$DeliveredDate,'Status'=>'delivered');
			$this->db->where('OrderItemID',$OrderItemID);
			$result =	$this->db->update('order_assign',$array);

			$orderArray 	=	array('DeliveredDate'=>$DeliveredDate,'Status'=>'delivered');
			$this->db->where('OrderItemID',$OrderItemID);
			$this->db->update('order_item',$orderArray);

			return($result);
		}
		//update the order for assign and complete
		function update_order($OrderItemID,$Mode)
		{
			$this->db->select('OrderFormID');
			$this->db->from('order_item');
			$this->db->where('OrderItemID',$OrderItemID);
			$query 	=	$this->db->get();
			$result =	$query->row_array();
			$OrderFormID 	=	$result['OrderFormID'];
			//if mode is stitching
			if($Mode == 'stitching')
			{
				$this->db->where('Status','new');
				$this->db->where('OrderFormID',$OrderFormID);
				$this->db->update('order_form',array("Status"=>"stitching"));
			}
			else if($Mode == 'ready')
			{
				//check all item inside the order is ready
				$this->db->select('count(OrderItemID) as Count');
				$this->db->from('order_item');
				$this->db->where('OrderFormID',$OrderFormID);
				$this->db->where('Status !=','ready');
				$query1 	=	$this->db->get();
				$result1 	=	$query1->row_array();

				if(isset($result1['Count']) && $result1['Count'] > 0)
				{
					$this->db->where('Status !=','partial');
					$this->db->where('OrderFormID',$OrderFormID);
					$this->db->update('order_form',array("Status"=>"partial"));
				}
				else
				{
					$this->db->where('OrderFormID',$OrderFormID);
					$this->db->update('order_form',array("Status"=>"ready"));
				}

			}
		}

		


		
	}
	
	
?>