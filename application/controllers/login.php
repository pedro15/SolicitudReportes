<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');

class Login extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}
	
	public function index()
	{
		$this->load->view('head.php');

		$ci = $this->input->post('cilogin');
		$pw = $this->input->post('passlogin');

		if (isset($ci) && isset($pw) )
		{
			$db = $this->load->database('default' , TRUE);
			$sql = "SELECT * FROM `usuario` WHERE `cedula_usuario` = '" . $ci . "' AND `clave`= '" . $pw . "';" ;
			$query = $db->query($sql);
			$row = $query->row();

			if (isset($row))
			{
				echo '<script type = "text/javascript">alert("Login Correcto");</script>' ;
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
