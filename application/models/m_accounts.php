<?php
	
	class m_accounts extends CI_model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		
		
		
		//for adding management details
		public function add($data)
		{
			
			$PaymentAccountName	=	($data['PaymentAccountName'] == '')?"":($data['PaymentAccountName']);
			
			$array		=	array('PaymentAccountName'=>$PaymentAccountName);
			$result 	=	$this->db->insert('payment_account',$array);
			
			return($result);
		}
		//for update management details
		public function update($data)
		{
			$PaymentAccountID		=	$data['PaymentAccountID'];
			$PaymentAccountName	=	($data['PaymentAccountName'] == '')?"":($data['PaymentAccountName']);
			
			$array		=	array('PaymentAccountName'=>$PaymentAccountName);
			$this->db->where('PaymentAccountID',$PaymentAccountID);
			$result		=	$this->db->update('payment_account',$array);
			return($result);
		}
		
		public function view()
		{
			$this->db->select('A.PaymentAccountID,A.PaymentAccountName,');
			$this->db->from('payment_account A');
			$this->db->join('payment P','P.PaymentAccountID = A.PaymentAccountID','left');
			$this->db->group_by('A.PaymentAccountID');
			//$this->db->order_by('PaymentAccountID','DESC');
			$query	=	$this->db->get();
			$result	=	$query->result_array();
			return($result);
		}
		public function delete($PaymentAccountID)
		{
			$this->db->where('PaymentAccountID',$PaymentAccountID);
			$this->db->delete('payment_account');
			return(1);			
		}
		public function view_single($PaymentAccountID)
		{
			$this->db->select('PaymentAccountID,PaymentAccountName');
			$this->db->from('payment_account');
			$this->db->where('PaymentAccountID',$PaymentAccountID);
			$query	=	$this->db->get();
			$result	=	$query->row_array();
			return($result);
		}

		function view_balance($PaymentAccountID,$Type){
		    $this->db->select('sum(Amount) as Total');
		    $this->db->from('payment');
            $this->db->where('PaymentAccountID',$PaymentAccountID);
            $this->db->where('Type',$Type);
            $this->db->group_by('PaymentAccountID');
            $query = $this->db->get();
            $result = $query->row_array();
            return($result['Total']);
        }


        //for tranfers
        public function add_transfer($data)
        {
            $FromAc		=	$data['FromAc'];
            $ToAc		=	$data['ToAc'];
            $Date	    =	date('Y-m-d',strtotime($data['Date']));;
            $Amount	        =	!empty($data['Amount'])?$data['Amount']:0;

            $array		=	array('Date'=>$Date,'FromAc'=>$FromAc,'ToAc'=>$ToAc,'Amount'=>$Amount);
            $result 	=	$this->db->insert('transfer',$array);
            $TransferID	=	$this->db->insert_id();

            //given entry on payment
            $payarray 		=	array('Type'=>'given','PaymentTypeID'=>8,'PaymentDate'=>$Date,'ReferenceNo'=>'','TransferID'=>$TransferID,'Amount'=>$Amount,'PaymentAccountID'=>$FromAc);
            $this->db->insert('payment',$payarray);

            //receive entry on payment
            $payarray2 		=	array('Type'=>'received','PaymentTypeID'=>9,'PaymentDate'=>$Date,'ReferenceNo'=>'','TransferID'=>$TransferID,'Amount'=>$Amount,'PaymentAccountID'=>$ToAc);
            $this->db->insert('payment',$payarray2);

            return($result);
        }

        public function update_transfer($data)
        {
            $TransferID		=	$data['TransferID'];
            $FromAc		=	$data['FromAc'];
            $ToAc		=	$data['ToAc'];
            $Date	    =	date('Y-m-d',strtotime($data['Date']));;
            $Amount	        =	!empty($data['Amount'])?$data['Amount']:0;

            $array		=	array('Date'=>$Date,'FromAc'=>$FromAc,'ToAc'=>$ToAc,'Amount'=>$Amount);
            $this->db->where('TransferID',$TransferID);
            $result 	=	$this->db->update('transfer',$array);


            //given entry on payment
            $payarray 		=	array('PaymentDate'=>$Date,'Amount'=>$Amount,'PaymentAccountID'=>$FromAc);
            $this->db->where('TransferID',$TransferID);
            $this->db->where('PaymentTypeID',8);
            $this->db->update('payment',$payarray);

            //receive entry on payment
            $payarray2 		=	array('PaymentDate'=>$Date,'Amount'=>$Amount,'PaymentAccountID'=>$ToAc);
            $this->db->where('TransferID',$TransferID);
            $this->db->where('PaymentTypeID',9);
            $this->db->update('payment',$payarray2);

            return($result);
        }

        public function transfer_view()
        {
            $this->db->select('A.TransferID,A.Date,A.FromAc,A.ToAc,A.Date,A.Amount,F.PaymentAccountName as FromAccount,T.PaymentAccountName as ToAccount');
            $this->db->from('transfer A');
            $this->db->join('payment P','P.TransferID = A.TransferID','left');
            $this->db->join('payment_account F','A.FromAc = F.PaymentAccountID','left');
            $this->db->join('payment_account T','A.ToAc = T.PaymentAccountID','left');
            $this->db->group_by('A.TransferID');
            //$this->db->order_by('PaymentAccountID','DESC');
            $query	=	$this->db->get();
            $result	=	$query->result_array();
            return($result);
        }

        public function transfer_view_single($TransferID)
        {
            $this->db->select('A.TransferID,A.Date,A.FromAc,A.ToAc,A.Date,A.Amount');
            $this->db->from('transfer A');
            $this->db->where('A.TransferID',$TransferID);
            //$this->db->order_by('PaymentAccountID','DESC');
            $query	=	$this->db->get();
            $result	=	$query->row_array();
            return($result);
        }


        public function delete_transfer($TransferID)
        {

            $this->db->where('TransferID',$TransferID);
            $this->db->delete('payment');

            $this->db->where('TransferID',$TransferID);
            $this->db->delete('transfer');
            return(1);
        }
	
		
		
	}
	
	
?>