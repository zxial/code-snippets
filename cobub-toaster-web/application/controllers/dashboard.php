<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Cobub Toaster Web Console
 *
 * Cobub Toaster is an open source push solution for mobile apps
 *
 * @package		Cobub Toaster Web Console
 * @author		Zxial
 * @copyright	Zxial
 * @license		GPL V3
 * @link		http://zxial.me/projects/cobub-toaster-web/
 * @since		Version 0.1
 * @filesource	controller of dashboard
 */
class dashboard extends CI_Controller {

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
