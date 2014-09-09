<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class appman extends CI_Controller {

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
	public function appman(){
		parent::__construct();
		$this->load->model ( 'mod_apps' );
		//$this->load->helper ( array('form', 'url') );
	}
	
	public function index()
	{
		$this->load->view('user_apps');
	}
	public function apps()
	{
		session_start();
		$userid = $_SESSION['userid'];
		$applist = $this->mod_apps->get_apps($userid);
		$data['applist'] = $applist;
		$this->load->view('user_apps',$data);
		
	}
	
	public function addapp()
	{
		session_start();
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			//$this->load->view('user_add_app');
			$appname = $this->input->post('appname');
			$ostype =$this->input->post('ostype');
			$description = $this->input->post('description');
			$userid = $_SESSION['userid'];
			
			$this->mod_apps->add_app($appname,$ostype,$description,$userid);
			$this->load->view('user_apps');
		}else{
			$this->load->view('user_add_app');
		}
	}
}
