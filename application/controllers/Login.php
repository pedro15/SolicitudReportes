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
							if ( $this->loginsystem->verify_password($ci,$pw))
							{
								if ($this->loginsystem->has_user_question($ci))
								{
									redirect('/login/securityquestion?ci=' . $ci ); 
								}else 
								{
									$this->loginsystem->set_user_data($ci);
									redirect('user');
								}
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
				redirect('/');$this->load->view('head.php');
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

	public function securityquestion()
	{
		$ci = $this->input->get('ci') ; 
		if ($this->loginsystem->has_user_question($ci))
		{
			$this->load->view('head.php');
			$q = $this->loginsystem->get_user_question($ci);
			$data['question'] = $q ;
			$a = $this->input->post('user_a') ;
			if (isset($a))
			{
				if ($this->loginsystem->verify_user_answer($ci,$a))
				{
					$this->loginsystem->set_user_data($ci);
					redirect('user');
				}else 
				{
					$data['errormsg'] = "Respuesta de seguridad invalida" ; 
				}
			}
			$this->load->view('app/v_validatequestion.php', $data);
		}else 
		{
			redirect('/');
		}
	}

}
