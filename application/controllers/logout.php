<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class logout extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		session_start();

	}

	public function index()
	{
		session_destroy();
		redirect(base_url());
	}
	
}