<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->helper("url");
		$this->load->model("m_login");


	}
	
	public function index()
	{
		$this->m_login->check_login_page();
		
		if(!empty($_POST['UserName']) && !empty($_POST['UserPassword']))
		{
			$this->login($_POST['UserName'],$_POST['UserPassword']);			
		}
		else
		{
			$this->do_login();
		}

	}
	
	public function login($UserName, $RealPassword)
	{
		$UserPassword	=	md5($RealPassword);
		$result				=	$this->m_login->login($UserName, $UserPassword);

		if(isset($result['UserName']) && isset($result['UserPassword']) && $result['UserName'] == $UserName &&
		$result['UserPassword'] == $UserPassword)
		{
			$_SESSION['UserID']		=	$result['UserID'];
			$_SESSION['UserName']	=	$result['UserName'];

			$_SESSION['UserTypeID']	=	$result['UserTypeID'];
			$_SESSION['UserImage']	=	$result['UserImage'];
			$_SESSION['UserTypeName']	=	$result['UserTypeName'];

			redirect(base_url());
		}
		else
		{
	
            $_SESSION['MsgCode']	   =   'error';
            $_SESSION['MsgTitle']      =   "Wrong Credential ";
            $_SESSION['MsgContent']    =   "User Name and Password are not matching ! ";

            $data['title']		=	"Wrong Credential ";
            $this->load->view("login",$data);     

		}
	}

   
	
	public function do_login()
	{
		$data['title']		=	"Please Login";
		$data['message']	=	"";
		$this->load->view("login",$data);
	}
   
	
	public function check_password($RealPassword)
	{
		$UserPassword	=	md5($RealPassword);
		$UserName =	$_SESSION['UserName'];

		$result				=	$this->m_login->login($UserName, $UserPassword);
		
		if(isset($result['UserName']) && isset($result['UserPassword']) && $result['UserName'] == $UserName && $result['UserPassword'] == $UserPassword)
		{
			echo 'yes';
		}
		else
		{
            echo 'no';

		}

	}
	

}

?>