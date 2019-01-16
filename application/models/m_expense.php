<?php
	
	class m_expense extends CI_model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		
		
		
		//for adding management details
		public function add($data)
		{
			
			$ExpenseDate	    =	date('Y-m-d',strtotime($data['ExpenseDate']));;
			$ExpenseCategoryID	    =	$data['ExpenseCategoryID'];
            $ReferenceNo	=	!empty($data['ReferenceNo'])?$data['ReferenceNo']:'';
			$Amount	        =	!empty($data['Amount'])?$data['Amount']:0;
            $Description	=	!empty($data['Description'])?$data['Description']:'';

            $array		=	array('ExpenseDate'=>$ExpenseDate,'ExpenseCategoryID'=>$ExpenseCategoryID,'ReferenceNo'=>$ReferenceNo,'Amount'=>$Amount,'Description'=>$Description);
			$result 	=	$this->db->insert('expense',$array);
            $ExpenseID 	=	$this->db->insert_id();

            $payarray 		=	array('Type'=>'given','PaymentTypeID'=>5,'PaymentDate'=>$ExpenseDate,'ReferenceNo'=>$ReferenceNo,'ExpenseID'=>$ExpenseID,'Amount'=>$Amount);
            $this->db->insert('payment',$payarray);

			
			return($result);
		}
		//for update management details
		public function update($data)
		{
            $ExpenseID		=	$data['ExpenseID'];
            $ExpenseDate	    =	date('Y-m-d',strtotime($data['ExpenseDate']));;
            $ExpenseCategoryID	    =	$data['ExpenseCategoryID'];
            $ReferenceNo	=	!empty($data['ReferenceNo'])?$data['ReferenceNo']:'';
            $Amount	        =	!empty($data['Amount'])?$data['Amount']:0;
            $Description	=	!empty($data['Description'])?$data['Description']:'';

            $array		=	array('ExpenseDate'=>$ExpenseDate,'ExpenseCategoryID'=>$ExpenseCategoryID,'ReferenceNo'=>$ReferenceNo,'Amount'=>$Amount,'Description'=>$Description);
            $this->db->where('ExpenseID',$ExpenseID);
			$result		=	$this->db->update('expense',$array);

            $payarray 		=	array('Type'=>'given','PaymentTypeID'=>5,'PaymentDate'=>$ExpenseDate,'ReferenceNo'=>$ReferenceNo,'ExpenseID'=>$ExpenseID,'Amount'=>$Amount);
            $this->db->where('ExpenseID',$ExpenseID);
            $this->db->update('payment',$payarray);

			return($result);
		}
		
		public function view()
		{
            $this->db->select('S.ExpenseID,S.ExpenseCategoryID,S.ReferenceNo,S.ExpenseDate,S.Amount,A.ExpenseCategoryName');
            $this->db->from('expense S');
            $this->db->join('expense_category A','S.ExpenseCategoryID = A.ExpenseCategoryID','left');
			$this->db->order_by('S.ExpenseID','DESC');
			$query	=	$this->db->get();
			$result	=	$query->result_array();
			return($result);
		}
		public function delete($ExpenseID)
		{


			$this->db->where('ExpenseID',$ExpenseID);
			$this->db->delete('payment');

			$this->db->where('ExpenseID',$ExpenseID);
			$this->db->delete('expense');

			return(1);			
		}


		public function view_single($ExpenseID)
		{
            $this->db->select('S.ExpenseID,S.ExpenseCategoryID,S.ReferenceNo,S.ExpenseDate,S.Amount,A.ExpenseCategoryName,S.Description');
			$this->db->from('expense S');
			$this->db->join('expense_category A','S.ExpenseCategoryID = A.ExpenseCategoryID','left');
			$this->db->where('ExpenseID',$ExpenseID);
			$query	=	$this->db->get();
			$result	=	$query->row_array();
			return($result);
		}

		public function view_expense_category()
		{
			$this->db->select('ExpenseCategoryID,ExpenseCategoryName');
			$this->db->from('expense_category');
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}

	}
	
	
?>