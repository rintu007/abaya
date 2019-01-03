<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller 
{


	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->helper("url");
		$this->load->model("m_login");
		$this->m_login->check_login();
		$_SESSION['PageActive']		=	"dashboard";
	}
	

	public function index()
	{
		$data['title']	=	'Abaya Shop';
		$this->load->view('home',$data);
	}
}
