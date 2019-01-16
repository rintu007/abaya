<?php
	
	class m_salary extends CI_model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		
		
		
		//for adding management details
		public function add($data)
		{
			
			$SalaryDate	    =	date('Y-m-d',strtotime($data['SalaryDate']));;
			$StaffID	    =	$data['StaffID'];
            $ReferenceNo	=	!empty($data['ReferenceNo'])?$data['ReferenceNo']:'';
			$Amount	        =	!empty($data['Amount'])?$data['Amount']:0;
            $Description	=	!empty($data['Description'])?$data['Description']:'';

            $array		=	array('SalaryDate'=>$SalaryDate,'StaffID'=>$StaffID,'ReferenceNo'=>$ReferenceNo,'Amount'=>$Amount,'Description'=>$Description);
			$result 	=	$this->db->insert('salary',$array);
            $SalaryID 	=	$this->db->insert_id();

            $payarray 		=	array('Type'=>'given','PaymentTypeID'=>4,'PaymentDate'=>$SalaryDate,'ReferenceNo'=>$ReferenceNo,'SalaryID'=>$SalaryID,'Amount'=>$Amount,'StaffID'=>$StaffID);
            $this->db->insert('payment',$payarray);

			
			return($result);
		}
		//for update management details
		public function update($data)
		{
            $SalaryID		=	$data['SalaryID'];
            $SalaryDate	    =	date('Y-m-d',strtotime($data['SalaryDate']));;
            $StaffID	    =	$data['StaffID'];
            $ReferenceNo	=	!empty($data['ReferenceNo'])?$data['ReferenceNo']:'';
            $Amount	        =	!empty($data['Amount'])?$data['Amount']:0;
            $Description	=	!empty($data['Description'])?$data['Description']:'';

            $array		=	array('SalaryDate'=>$SalaryDate,'StaffID'=>$StaffID,'ReferenceNo'=>$ReferenceNo,'Amount'=>$Amount,'Description'=>$Description);
            $this->db->where('SalaryID',$SalaryID);
			$result		=	$this->db->update('salary',$array);

            $payarray 		=	array('Type'=>'given','PaymentTypeID'=>4,'PaymentDate'=>$SalaryDate,'ReferenceNo'=>$ReferenceNo,'SalaryID'=>$SalaryID,'Amount'=>$Amount,'StaffID'=>$StaffID);
            $this->db->where('SalaryID',$SalaryID);
            $this->db->update('payment',$payarray);

			return($result);
		}
		
		public function view()
		{
            $this->db->select('S.SalaryID,S.StaffID,S.ReferenceNo,S.SalaryDate,S.Amount,A.StaffName');
            $this->db->from('salary S');
            $this->db->join('staff A','S.StaffID = A.StaffID','left');
			$this->db->order_by('S.SalaryID','DESC');
			$query	=	$this->db->get();
			$result	=	$query->result_array();
			return($result);
		}
		public function delete($SalaryID)
		{


			$this->db->where('SalaryID',$SalaryID);
			$this->db->delete('payment');

			$this->db->where('SalaryID',$SalaryID);
			$this->db->delete('salary');

			return(1);			
		}


		public function view_single($SalaryID)
		{
            $this->db->select('S.SalaryID,S.StaffID,S.ReferenceNo,S.SalaryDate,S.Amount,A.StaffName,S.Description');
			$this->db->from('salary S');
			$this->db->join('staff A','S.StaffID = A.StaffID','left');
			$this->db->where('SalaryID',$SalaryID);
			$query	=	$this->db->get();
			$result	=	$query->row_array();
			return($result);
		}

		public function view_staff()
		{
			$this->db->select('StaffID,StaffName');
			$this->db->from('staff');
			$query 	=	$this->db->get();
			$result =	$query->result_array();
			return($result);
		}

	}
	
	
?>