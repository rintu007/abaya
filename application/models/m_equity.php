<?php
	
	class m_equity extends CI_model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		
		
		
		//for adding management details
		public function add($data)
		{
			
			$Date	    =	date('Y-m-d',strtotime($data['Date']));;
			$Type	    =	$data['Type'];
            $PaymentAccountID	  =	$data['PaymentAccountID'];
            $Amount	        =	!empty($data['Amount'])?$data['Amount']:0;
            $Description	=	!empty($data['Description'])?$data['Description']:'';

            $array		=	array('Date'=>$Date,'Type'=>$Type,'Amount'=>$Amount,'Description'=>$Description);
			$result 	=	$this->db->insert('equity',$array);
            $EquityID 	=	$this->db->insert_id();


            if($Type == 'capital'){
                $payarray 		=	array('Type'=>'received','PaymentTypeID'=>6,'PaymentDate'=>$Date,'ReferenceNo'=>'','EquityID'=>$EquityID,'Amount'=>$Amount,'PaymentAccountID'=>$PaymentAccountID);
            }
            else{
                $payarray 		=	array('Type'=>'given','PaymentTypeID'=>7,'PaymentDate'=>$Date,'ReferenceNo'=>'','EquityID'=>$EquityID,'Amount'=>$Amount,'PaymentAccountID'=>$PaymentAccountID);
            }
            $this->db->insert('payment',$payarray);

			
			return($result);
		}
		//for update management details
		public function update($data)
		{
            $EquityID		=	$data['EquityID'];
            $Date	    =	date('Y-m-d',strtotime($data['Date']));;
            $Type	    =	$data['Type'];
            $PaymentAccountID	  =	$data['PaymentAccountID'];
            $Amount	        =	!empty($data['Amount'])?$data['Amount']:0;
            $Description	=	!empty($data['Description'])?$data['Description']:'';

            $array		=	array('Date'=>$Date,'Type'=>$Type,'Amount'=>$Amount,'Description'=>$Description);
            $this->db->where('EquityID',$EquityID);
			$result		=	$this->db->update('equity',$array);

            if($Type == 'capital'){
                $payarray 		=	array('Type'=>'received','PaymentTypeID'=>6,'PaymentDate'=>$Date,'ReferenceNo'=>'','EquityID'=>$EquityID,'Amount'=>$Amount,'PaymentAccountID'=>$PaymentAccountID);
            }
            else{
                $payarray 		=	array('Type'=>'given','PaymentTypeID'=>7,'PaymentDate'=>$Date,'ReferenceNo'=>'','EquityID'=>$EquityID,'Amount'=>$Amount,'PaymentAccountID'=>$PaymentAccountID);
            }
            $this->db->where('EquityID',$EquityID);
            $this->db->update('payment',$payarray);

			return($result);
		}
		
		public function view($type)
		{
            $this->db->select('S.EquityID,S.Type,,S.Date,S.Amount,A.PaymentAccountName');
            $this->db->from('equity S');
            $this->db->join('payment P','S.EquityID = P.EquityID','left');
            $this->db->join('payment_account A','A.PaymentAccountID = P.PaymentAccountID','left');
            $this->db->where('S.Type',$type);
			$this->db->order_by('S.EquityID','DESC');
			$query	=	$this->db->get();
			$result	=	$query->result_array();
			return($result);
		}
		public function delete($EquityID)
		{
			$this->db->where('EquityID',$EquityID);
			$this->db->delete('payment');

			$this->db->where('EquityID',$EquityID);
			$this->db->delete('equity');
			return(1);			
		}


		public function view_single($EquityID)
		{
            $this->db->select('S.EquityID,S.Type,S.Date,S.Amount,S.Description,P.PaymentAccountID');
			$this->db->from('equity S');
            $this->db->join('payment P','P.EquityID = S.EquityID','left');
     			$this->db->where('S.EquityID',$EquityID);
			$query	=	$this->db->get();
			$result	=	$query->row_array();
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


	}
	
	
?>