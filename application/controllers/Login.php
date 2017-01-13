<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');

class Login extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('loginsystem');
	}

	public function index()
	{
		$this->load->view('head.php');
		$this->load->view('letterhead.php');
		
		if($this->syshelper->database_valid())
		{
			if ($this->usr->has_admins())
			{
				$ci = $this->input->post('cilogin');
				$pw = $this->input->post('passlogin');
			
				if (isset($ci) && isset($pw) )
				{
					if ($this->loginsystem->user_exists($ci))
					{
						if (!$this->loginsystem->is_disabled($ci))
						{
							if ( $this->loginsystem->login_internal($ci,$pw))
							{
								redirect('user');
							}else 
							{
								$data['message'] = "Clave incorrecta.";
								$this->load->view('app/v_login.php', $data);
							}
						}else 
						{
							$data['message'] = "Usted se encuentra desabilitado en el sistema.";
							$this->load->view('app/v_login.php', $data);
						}	
					}else 
					{
						$data['message'] = "No existe un usuario con la cedula: " . $ci;
						$this->load->view('app/v_login.php', $data);
					}
				}else 
				{
					$this->load->view('app/v_login.php');
				}
			}else 
			{
				redirect('/login/install');
			}
		}else
		{ 
			redirect('/login/install');
		}
	}

	public function install()
	{
		$this->load->view('head.php');
		$request_type = $this->input->post('request_type'); 
		if (isset($request_type))
		{
			if ($request_type == 'admin')
			{
				$admin_name = $this->input->post('admin_name') ; 
				$admin_ci = $this->input->post('admin_ci') ; 
				$admin_email = $this->input->post('admin_email') ; 
				if (isset($admin_name , $admin_ci , $admin_email ))
				{
					if ($this->usr->register($admin_ci , $admin_name , $admin_ci , '' , '3' , $admin_email))
					{
						redirect('/');		
					}
				}
			}else if ($request_type == 'db') 
			{
				$this->syshelper->install_database();
				redirect('/');
			}
		}
		if($this->syshelper->database_valid())
		{
			if (!$this->usr->has_admins())
			{
				$this->load->view('app/v_setupadmin.php') ; 
			}else 
			{
				redirect('/');
			}
		}else 
		{
			$this->load->view('app/v_installdb.php') ; 
		}
	}

}
