<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class reports extends CI_Controller {

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
	public function index()
	{
		$this->load->view('user_report_allapps');
	}
	
	public function allapp()
	{
		$this->load->view('user_report_allapps');
	}
	public function app()
	{
		$this->load->view('user_report_app');
	}
	public function timephase()
	{
		$this->load->view('user_report_timephase');
	}
	public function tasks()
	{
		$this->load->view('user_report_tasks');
	}
	
	
	
	
}
