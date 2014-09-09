<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboard extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function dashboard(){
		parent::__construct();
		$this->load->model ( 'mod_users' );
		$this->load->helper ( array('form', 'url') );
	}
	
	public function index()
	{
		$this->load->view('user_dashboard');
	}
	
	public function login()
	{
		session_start();
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$useremail = $this->input->post('email');
			$password = $this->input->post('password');
			
			$user = $this->mod_users->authenticate($useremail,$password);
			if (!$user)
				$this->load->view("login");
			else {
				//echo $useremail . '###' . $password;
				
				
				$_SESSION['userid'] = $user->id;
				$_SESSION['useremail'] = $user->email;
				$_SESSION['username'] = $user->name;
				$_SESSION['usercompany'] = $user->company;
				$_SESSION['userrole'] = $user->role;
				$_SESSION['userislogin'] = true;
				//echo $user['id'];
				
				redirect( base_url('/index.php?/dashboard') );
			}
				
		}else{ 
			$this->load->view('login');
		}
	}
	
	public function logout()
	{
		
	}
}
