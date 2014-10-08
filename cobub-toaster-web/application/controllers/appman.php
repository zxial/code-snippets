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
 * @filesource	controller of app management
 */

class appman extends CI_Controller {

	public function appman(){
		parent::__construct();
		$this->load->model ( 'mod_apps' );
		//$this->load->helper ( array('form', 'url') );
	}
	
	public function index()
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
