<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');

class Login extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('loginsystem');
	}
	
	public function index()
	{
		$this->load->view('head.php');
		$this->load->view('letterhead.php');
		$ci = $this->input->post('cilogin');
		$pw = $this->input->post('passlogin');

		if (isset($ci) && isset($pw) )
		{
			if ( $this->loginsystem->login($ci,$pw))
			{
				redirect('user');
			}else 
			{
				$data['message'] = "Fallo autenticacion";
				$this->load->view('app/v_login.php', $data);
			}
		}else 
		{
			$this->load->view('app/v_login.php');
		}
	}
}
