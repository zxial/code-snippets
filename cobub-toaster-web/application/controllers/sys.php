<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sys extends CI_Controller {

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
	public function sys(){
		parent::__construct();
		$this->load->model ( 'mod_pns' );
		//$this->load->helper ( array('form', 'url') );
	}
	
	public function index()
	{
		//session_start();
		//$userid = $_SESSION['userid'];
		//$applist = $this->mod_apps->get_apps($userid);
		//$data['applist'] = $applist;
		//session_start();
				
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			//$this->load->view('user_add_app');
			$server_add = $this->input->post('server_add');
			$server_port =$this->input->post('server_port');
		
			$this->mod_pns->save_pns($server_add,$server_port);
		}
		
		$pns = $this->mod_pns->get_pns();
		$data['pns'] = $pns;
		$status = $this->mod_pns->check_pns();
		$data['status'] = $status;
		$this->load->view('sys',$data);
		
	}
	

}
